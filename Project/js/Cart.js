function Increase_Quantity(Cart_Id)
{
    var quantity =parseInt(document.getElementById(Cart_Id+"_quantity").value);
    var price =parseInt(document.getElementById(Cart_Id+"_price").textContent);
    quantity = quantity + 1;
    var total_price = quantity * price;
    document.getElementById(Cart_Id+"_quantity").value=quantity;
    document.getElementById(Cart_Id+"_total_price").textContent=total_price;
    Upade_Carts(Cart_Id,quantity,total_price,"update");
}

function Decrease_Quantity(Cart_Id)
{
    var quantity = parseInt(document.getElementById(Cart_Id+"_quantity").value);
    if(quantity > 1)
    {
        var price =parseInt(document.getElementById(Cart_Id+"_price").textContent);
        quantity = quantity - 1;
        var total_price = quantity * price;
        document.getElementById(Cart_Id+"_quantity").value=quantity;
        document.getElementById(Cart_Id+"_total_price").textContent=total_price;
        Upade_Carts(Cart_Id,quantity,total_price,"update");
    }
    else
        alert("If you don't want the item you can delete it!");
}

function Upade_Carts(Cart_Id,Quantity,Total_Price,Type){
    $.ajax({
        type: 'POST',
        url:"cart_operation.php",
        data:{
            Type : Type,
            Cart_Id : Cart_Id,
            Quantity : Quantity,
            Total_Price : Total_Price
        },
        success: function(Result) { 
            Update_Notification();
        }
    });
}

function Remove_Item(Cart_Id,Customer_Id)
{
    $.ajax({
        type: 'POST',
        url:"cart_operation.php",
        data:{
            Type : "delete",
            Cart_Id : Cart_Id,
            Customer_Id : Customer_Id
        },
        success: function(Result) { 
            Update_Notification();
            document.getElementById('Cards').innerHTML = Result;
        }
    });

}

function Insert_Item(Item_Id,Customer_Id)
{
    $.ajax({
        type: 'POST',
        url:"cart_operation.php",
        data:{
            Type : "insert",
            Item_Id : Item_Id,
            Customer_Id : Customer_Id
        },
        success: function(Result) { 
            Update_Notification();
            alert(Result);
        }
    });

}

function Update_Notification()
{
    $.ajax({
        type: 'POST',
        url:"notification_cart.php",
        data:{
        },
        success: function(Result) { 
            document.getElementById('Count_Items').innerHTML = Result;
        }
    });

}

function Check_Out()
{
    $.ajax({
        type: 'POST',
        url:"check_out.php",
        data:{
        },
        success: function(Result) { 
            location.href = "index.php";
        }
    });
}