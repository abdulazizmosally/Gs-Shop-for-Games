<?php
    @session_start();
	include("db_connection.php");
	$con->connect();
	if(isset($_SESSION['Customer_Id']) )
	{   
		$Customer_Id = $_SESSION['Customer_Id'];
	}
	else
	{
		$Customer_Date = date('Y-m-d h:i:s', time());
		$Customer_Name = 'Guest';
		$SqlQuery_Insert_Customer = " Insert Customers(Customer_Name,Customer_Date)values('.$Customer_Name.','.$Customer_Date.')";  
		$resultinsert = $con->query($SqlQuery_Insert_Customer); 
		if($resultinsert)
        {
			$SqlQuery_Customer = $con->query(" SELECT * FROM  Customers order by Customer_Id desc ");  
			if ($Result_Customer = mysqli_fetch_assoc($SqlQuery_Customer)) 
			{
				$Customer_Id= $Result_Customer['Customer_Id'];
			}	
			$_SESSION['Customer_Id'] = $Customer_Id;
		}
	}
	$Count_Items = 0;
	$SqlQuery_Count_Items = $con->query(" SELECT * FROM  Carts where Customer_Id=$Customer_Id ");  
	while ($Result_Count_Items = mysqli_fetch_assoc($SqlQuery_Count_Items)) 
	{
		$Count_Items = $Count_Items + 1;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart | E-Shopper</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/Cart.js"></script>
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +96650678934</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> Gs@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" height="70px" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li>
									<a href="cart.php">
										<i class="fa fa-shopping-cart">
											<span id="Count_Items"><span class="top-number"><?php echo $Count_Items; ?> </span></span>
										</i> Cart
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php" class="active">Home</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody id="Cards">
						<?php
							$con->connect();
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
											<h4>&nbsp;&nbsp;&nbsp;'.$Item_Name.'</h4>
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
							$con->disconnect();
						?>
					</tbody>
					<?php
					if($Count_Items !=0)
					echo'
					<tbody>
						<tr>
							<td colspan="5">&nbsp;</td>
							<td><a class="btn btn-default check_out" style="cursor:pointer;" onclick="Check_Out();">Check Out</a></td>
						</tr>
					</tbody>';
					else
					echo'
					<tbody>
						<tr>
							<td colspan="6" style="text-align:center;"><h3>No items in the cart</h3></td>
						</tr>
					</tbody>';
					?>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	
	<footer id="footer"><!--Footer-->

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="index.php">Home</a></li>
								<li><a href="index.php#all_product">Products</a></li>
								<li><a href="index.php#contact-us">Contact</a></li>
								<li><a href="index.php#location">Location</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>ABOUT Gs Shope</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>ABOUT Gs Shope</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p >Copyright © 2021 Gs Shop for games Inc. All rights reserved.</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>