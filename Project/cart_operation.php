<?php
    @session_start();
    $Type=$_POST['Type'];
    $Cart_Id = $_POST['Cart_Id'];
    $Quantity = $_POST['Quantity'];
    $Total_Price = $_POST['Total_Price']; 
    $Customer_Id = $_POST['Customer_Id'];
    $Item_Id = $_POST['Item_Id'];

    include("db_connection.php");
    $con->connect();

    if(strcmp($Type,"update")==0)
    {
        $sqlupdate = "update Carts set Cart_Quantity = $Quantity where Cart_Id = $Cart_Id"; 
        $result = $con->query($sqlupdate);
    }
    else if(strcmp($Type,"delete") == 0)
    {
        $sqldelete = "delete from Carts where Cart_Id = $Cart_Id "; 
        $resultdelete = $con->query($sqldelete);
        if($resultdelete) 
            {
                $SqlQuery_Cart = $con->query(" SELECT * FROM  Carts where Customer_Id=$Customer_Id ");  
                while ($Result_Cart = mysqli_fetch_assoc($SqlQuery_Cart)) 
                {
                    $Cart_Id = $Result_Cart['Cart_Id'];
                    $Item_Id = $Result_Cart['Item_Id'];
                    $Cart_Quantity = $Result_Cart['Cart_Quantity'];

                    $SqlQuery_Item = $con->query(" SELECT * FROM  Items where Item_Id=$Item_Id ");  
                    if ($Result_Item = mysqli_fetch_assoc($SqlQuery_Item)) 
                    {
                        $Item_Name = $Result_Item['Item_Name'];
                        $Item_Image = $Result_Item['Item_Image'];
                        $Item_Price = $Result_Item['Item_Price'];
                    }
                    $Cart_Total = $Cart_Quantity * $Item_Price;
                    
                    echo '
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="images/home/'.$Item_Image.'" width="110px" height="110px" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">'.$Item_Name.'</a></h4>
                            </td>
                            <td class="cart_price">
                                <p>SAR <label id="'.$Cart_Id.'_price" >'.$Item_Price.'</label></p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" style="cursor:pointer;" onclick="Increase_Quantity('.$Cart_Id.');"> + </a>
                                    <input class="cart_quantity_input" type="text" name="'.$Cart_Id.'_quantity" id="'.$Cart_Id.'_quantity" value="'.$Cart_Quantity.'" autocomplete="off" size="2" disabled >
                                    <a class="cart_quantity_down" style="cursor:pointer;" onclick="Decrease_Quantity('.$Cart_Id.');"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">SAR <label id="'.$Cart_Id.'_total_price" >'.$Cart_Total.'</label></p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" style="cursor:pointer;" onclick="Remove_Item('.$Cart_Id.','.$Customer_Id.');"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>';

                }
            } 
    }
    else if(strcmp($Type,"insert")==0)
    {
        $Insert = 0;
        $SqlQuery_Cart = $con->query(" SELECT * FROM  Carts where Customer_Id=$Customer_Id and Item_Id = $Item_Id "); 
        if($Result_Cart = mysqli_fetch_assoc($SqlQuery_Cart))
        {
            $Cart_Id = $Result_Cart['Cart_Id'];
            $Cart_Quantity = $Result_Cart['Cart_Quantity'];
            $Cart_Quantity = $Cart_Quantity + 1;
            $sqlupdate = "update Carts set Cart_Quantity = $Cart_Quantity where Cart_Id = $Cart_Id"; 
            $result = $con->query($sqlupdate);
            $Insert = 1;
        }
        else
        {
            $sqlinsert = "insert Carts (Customer_Id,Item_Id,Cart_Quantity) values('$Customer_Id','$Item_Id','1')"; 
            $resultinsert = $con->query($sqlinsert);  
            $Insert = 1; 
        }
        if($Insert)
            echo "The add item to cart  was successful!";
        else 
             echo "The add item to cart  wasn't successful!";
    }
    
    $con->disconnect();
?>
