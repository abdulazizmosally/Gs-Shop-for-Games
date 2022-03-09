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
		$SqlQuery_Insert_Customer = " Insert Customers (Customer_Name,Customer_Date)values('$Customer_Name','$Customer_Date')";  
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
    <title>Home | Gs Shop for games</title>
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
		<div class="header_top" style="position: fixed; top:0px; width:100%; z-index:100; padding-top:5px; padding-bottom:5px; border-bottom: 1px solid white;"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
					<marquee direction = "left">Hello and welcome to our website &
					We have the latest new games &
					We have discounts and gifts up to half the amount </marquee>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		
		<div class="header_top" style="margin-top:36px; background-color:#2b2a29;"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +96650678934</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> Gs@gmail.com</a></li>
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
								<li><a href="AboutUs.php"> About Us </a></li>
								<?php
									$con->connect();
									$SqlQuery_Products = $con->query(" SELECT * FROM  Products where Product_Status=1 ");  
									while ($Result_Products = mysqli_fetch_assoc($SqlQuery_Products)) 
									{
										$Product_Id = $Result_Products['Product_Id'];
										$Flage = 1;
										$SqlQuery_Types_Games = $con->query(" SELECT * FROM  Types_Games where Product_Id=$Product_Id and Type_Game_Status=1 ");  
										while ($Result_Types_Games = mysqli_fetch_assoc($SqlQuery_Types_Games)) 
										{
											if($Flage)
											{
												echo
												'<li class="dropdown"><a href="#all_product">'.$Result_Products['Product_Name'].'<i class="fa fa-angle-down"></i></a>
													<ul role="menu" class="sub-menu">';
												$Flage = 0;
											}
											
											echo '<li><a href="#SectionsType">'.$Result_Types_Games['Type_Game_Name'].'</a></li>';

										}

										if($Flage)
											echo'<li><a href="#all_product">'.$Result_Products['Product_Name'].'</a></li>';
										else 
											echo '</ul></li>';
									}
									$con->disconnect();
								?>
								<li><a href="#contact-us">Contact</a></li>
								<li><a href="#location">Location</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel" >
						<ol class="carousel-indicators" >
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner" >
							<div class="item active"  >
								<div class="col-sm-12" style="right: 50px;">
									<img src="images/home/bg1.jpg" class="girl img-responsive" width="100%" height="500px" alt="" />
								</div>
							</div>
							<div class="item" >
								<div class="col-sm-12" style="right: 50px;">
									<img src="images/home/bg2.jpg" class="girl img-responsive" width="100%" height="500px" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-12"  style="right: 50px;">
									<img src="images/home/bg3.jpg" class="girl img-responsive" width="100%" height="500px" alt="" />
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="left-sidebar">
						
						<fieldset >
							<legend style="text-align:left; color: #FE980F; font-family: 'Roboto', sans-serif; font-size: 18px;font-weight: 700;"> About Us</legend>
							We are a marketing website that markets and sells all game products for children, which in turn works to develop children's skills and strengthen the child's thinking. We offer all kinds of games. We are agents of all game companies in the world. Our company was founded in the 2000 and is still the leader in the world of digital marketing.
						</fieldset>
						<br><br><br>

					</div>
				</div>
				<?php include("Products.php"); ?>
			</div>
			<!-------------------------------------------------->
			<!--Start Contact-->
			<?php include("Concat.php"); ?>
			<!--End Contact-->
			<!-------------------------------------------------->
		</div>
	</section>
	<!--Start Location-->
	<?php include("Location.php"); ?>
	<!--End Location-->
	<!--Start Footer-->
	<?php include("Footer.php"); ?>
	<!--End Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>