import multiprocessing
from flask import Flask
from flask import request,render_template,redirect,jsonify,make_response
from flask_restful import reqparse
from detect import run
import base64
from io import BytesIO
from PIL import Image
from os import remove
from os import listdir
from os.path import exists
from re import split
import mysql.connector
import json
from flask_cors import CORS, cross_origin

app = Flask(__name__)
#cors = CORS(app, resources={r"/*": {"origins":"*"}})
CORS(app, support_credentials=True)

labels = {
    "0" : "Wheel_mark_part",
    "1" : "Construction_joint_part",
    "2" : "Equal_interval",
    "3" : "Construction_joint_part",
    "4" : "Partial_pavement,overall_pavement",
    "5" : "Rutting,bump,pothole,separation",
    "6" : "White_line_blur",
    "7" : "Cross_walk_blur"
}

# Auxiliar sort function.
def sort_alphanum(data):
    transform = lambda text: int(text) if text.isdigit() else text.lower()
    alphanum_key = lambda key: [transform(c) for c in split('([0-9]+)',key)]
    return sorted(data, key=alphanum_key)

ALLOWED_EXTENSIONS = frozenset(['png','jpg','jpeg','bmp'])

def inference(nn_weights, queue):

    ret = queue.get()
    if request.method == 'POST':
        data = request.json
        db_index = data["db_index"]
        dbconnection = mysql.connector.connect(
            host="localhost",
            user="up2smartuser",
            password="up2smart10052019",
            database="Crack_DB"
        )

        cursor = dbconnection.cursor()
        cursor.execute("SELECT Crack_Informations_Image FROM Crack_Informations WHERE Crack_Informations_Id = %s",(str(db_index),))

        img = cursor.fetchone()

        # If the image exists in the database:
        if img is not None:
            #img = img[0]#.encode('ascii')
            img = img[0].split(",")[1]
            decoded_img = base64.b64decode(img)

            # Read, resize and store the given image in the server.          
            Image.open(BytesIO(decoded_img)).resize((608,608)).save(str(db_index)+".jpg")

            # We run detect.py to detect objects in the given image.
            run(weights=nn_weights, source=str(db_index)+".jpg",view_img=False, imgsz=[608,608], augment=True,line_thickness=2,save_txt=True,save_conf=True)
            remove(str(db_index)+".jpg")

            # We get the directory of the current image detection (it will be the last one).
            prediction_dir = "runs/detect/"+sort_alphanum(listdir("runs/detect"))[-1]+"/"

            # Upload inferenced image to the database.
            with open(prediction_dir+str(db_index)+".jpg","rb") as inferenced_img:
                img_base64 = base64.b64encode(inferenced_img.read()).decode('ascii')

            cursor.execute("UPDATE Crack_Informations SET Crack_Informations_Prediction = %s, Crack_Confirm = 1 WHERE Crack_Informations_Id = %s",(img_base64,str(db_index)))
            dbconnection.commit()

            # True if Yolov5 has detected damages in the inferenced image.
            label_file_path = prediction_dir+"labels/"+str(db_index)+".txt"

            if (exists(label_file_path)):
                with open(label_file_path,"r") as f:
                    damages = f.readlines()

                for damage in damages:
                    item = damage.replace("[","").replace("]","").replace("\'","").split(" ")
                    item[0] = labels[item[0]]
                    cursor.execute("INSERT INTO Crack_Types (Crack_Types_Class, Crack_Types_X_Center, Crack_Types_Y_Center, Crack_Types_Height, Crack_Types_Width, Crack_Types_Score, Crack_Informations_Id) VALUES (%s, %s, %s, %s, %s, %s, %s)",(item[0],float(item[1]),float(item[2]),float(item[3]),float(item[4]),float(item[5]),str(db_index)))
                    dbconnection.commit()

            ret["Status"] = "Done"
        else:
            ret["Status"] ="Not_Found"      # 406 Not Acceptable error code.
    else:
        ret["Status"] = "Not_POST"          # 403 Forbidden error code
    queue.put(ret)
################################################################################################

ret = {"Status": ""}
q = multiprocessing.Queue()

@app.route('/detect2020', methods=['POST'])
@cross_origin(supports_credentials=True)
def detect2020():
    q.put(ret)
    p = multiprocessing.Process(target=inference,args=('yolov5x_608_2020.pt',q))
    p.start()
    p.join()
    return q.get()
 
@app.route('/detect2018', methods=['POST'])
@cross_origin(supports_credentials=True)
def detect2018():
    q.put(ret)
    p = multiprocessing.Process(target=inference,args=('yolov5x_608_2018.pt',q))
    p.start()
    p.join()
    return q.get()

if __name__ == "__main__":
    app.run(debug=False,host="0.0.0.0",ssl_context=('/etc/letsencrypt/live/up2smart.com/fullchain.pem','/etc/letsencrypt/live/up2smart.com/privkey.pem'),port=5000)

