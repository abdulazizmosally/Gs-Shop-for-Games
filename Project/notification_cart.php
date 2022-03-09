<?php
    @session_start();
	$Customer_Id = $_SESSION['Customer_Id'];
	$Count_Items = 0;
	include("db_connection.php");
	$con->connect();
	$SqlQuery_Count_Items = $con->query(" SELECT * FROM  Carts where Customer_Id=$Customer_Id ");  
	while ($Result_Count_Items = mysqli_fetch_assoc($SqlQuery_Count_Items)) 
	{
		$Count_Items = $Count_Items + 1;
	}
    echo '<span class="top-number">'.$Count_Items.'</span>';

    $con->disconnect();
?>