<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head><!--/head-->

<body>
			
	<div class="col-sm-12 padding-right" id="products">
		<div class="features_items">
			<h2 class="title text-center" id="all_product">All Games</h2>
					<?php
						$con->connect();
						$SqlQuery_Type_Game = $con->query(" SELECT * FROM  Types_Games where Type_Game_Status=1 ");  
						while ($Result_Type_Game = mysqli_fetch_assoc($SqlQuery_Type_Game)) 
						{
							$Type_Game_Id = $Result_Type_Game['Type_Game_Id'];
							$Type_Game_Name = $Result_Type_Game['Type_Game_Name'];

							$SqlQuery_Item = $con->query(" SELECT * FROM  Items where Type_Game_Id ='$Type_Game_Id' and Item_Status=1 ");  
							while ($Result_Item  = mysqli_fetch_assoc($SqlQuery_Item )) 
							{
								$Item_Id = $Result_Item['Item_Id'];
								$Item_Name = $Result_Item['Item_Name'];
								$Item_Image = $Result_Item['Item_Image'];
								$Item_Price = $Result_Item['Item_Price'];
								
								echo '
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/'.$Item_Image.'" width="208px" height="350px" alt="" />
													<h2>SAR '.$Item_Price.'</h2>
													<p>'.$Item_Name.'</p>
													<a style="cursor:pointer;" onclick="Insert_Item('.$Item_Id.','.$Customer_Id.');" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												<div class="product-overlay">
													<div class="overlay-content">
														<h2>SAR '.$Item_Price.'</h2>
														<p>'.$Item_Name.'</p>
														<a style="cursor:pointer;" onclick="Insert_Item('.$Item_Id.','.$Customer_Id.');" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
													</div>
												</div>
										</div>
									</div>
								</div>';
							}
						}
						$con->disconnect();
					?>
		</div>
		
		<div class="category-tab">
			<div class="col-sm-12">
				<ul class="nav nav-tabs">
					<?php
						$con->connect();
						$First = 1;
						$SqlQuery_Type_Game = $con->query(" SELECT * FROM  Types_Games where Type_Game_Status=1 ");  
						while ($Result_Type_Game = mysqli_fetch_assoc($SqlQuery_Type_Game)) 
						{
							$Type_Game_Id =  $Result_Type_Game['Type_Game_Id'];
							$Type_Game_Name = $Result_Type_Game['Type_Game_Name'];
							if($First)
							{
								echo
								'<li class="active">
									<a href="#Tab_'.$Type_Game_Id.'" data-toggle="tab">'.$Type_Game_Name.'</a>
								</li>';
								$First = 0;
							}
							else
							{
								echo 
								'<li>
									<a href="#Tab_'.$Type_Game_Id.'" data-toggle="tab">'.$Type_Game_Name.'</a>
								</li>';
							}
						}
						$con->disconnect();
					?>
				</ul>
			</div>
			<div class="tab-content" id="SectionsType">
					<?php
						$con->connect();
						$First = 1;
						$SqlQuery_Type_Game = $con->query(" SELECT * FROM  Types_Games where Type_Game_Status=1 ");  
						while ($Result_Type_Game = mysqli_fetch_assoc($SqlQuery_Type_Game)) 
						{
							$Type_Game_Id = $Result_Type_Game['Type_Game_Id'];
							$Type_Game_Name = $Result_Type_Game['Type_Game_Name'];

							if($First)
							{
								echo
								'<div class="tab-pane fade active in" id="Tab_'.$Type_Game_Id.'" >';
								$First = 0;
							}
							else
							{
								echo 
								'<div class="tab-pane fade" id="Tab_'.$Type_Game_Id.'" >';
							}

							$SqlQuery_Item = $con->query(" SELECT * FROM  Items where Type_Game_Id ='$Type_Game_Id' and Item_Status=1 ");  
							while ($Result_Item  = mysqli_fetch_assoc($SqlQuery_Item )) 
							{
								$Item_Id = $Result_Item['Item_Id'];
								$Item_Name = $Result_Item['Item_Name'];
								$Item_Image = $Result_Item['Item_Image'];
								$Item_Price = $Result_Item['Item_Price'];
								
								echo '
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/'.$Item_Image.'" width="208px" height="350px" alt="" />
												<h2>SAR '.$Item_Price.'</h2>
												<p>'.$Item_Name.'</p>
												<a  style="cursor:pointer;" onclick="Insert_Item('.$Item_Id.','.$Customer_Id.');" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>';
							}

							echo '</div>';
						}
						$con->disconnect();
					?>
			</div>
		</div>
		
		<div class="recommended_items">
			<h2 class="title text-center">recommended items</h2>
			
			<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<?php
						$con->connect();
						$Active = 1;
						$Count=0;
						$SqlQuery_Item_Cart = $con->query(" SELECT Item_Id, sum(Cart_Quantity) as Max_Items FROM  Carts GROUP BY Item_Id order by Max_Items desc ");  
						while ($Result_Item_Cart  = mysqli_fetch_assoc($SqlQuery_Item_Cart)) 
						{
							$Item_Id = $Result_Item_Cart['Item_Id'];

							if($Active && $Count % 3 ==0 )
								{
									echo
									'<div class="item active">';
									$Active = 0;
								}
							else if($Count % 3 ==0)
								{
									echo 
									'<div class="item">';
								}

							$SqlQuery_Item = $con->query(" SELECT * FROM  Items where Item_Id ='$Item_Id' and Item_Status=1 ");  
							if ($Result_Item  = mysqli_fetch_assoc($SqlQuery_Item )) 
							{
								$Count = $Count + 1;
								$Item_Name = $Result_Item['Item_Name'];
								$Item_Image = $Result_Item['Item_Image'];
								$Item_Price = $Result_Item['Item_Price'];
								echo '
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/'.$Item_Image.'" width="208px" height="350px" alt="" />
												<h2>SAR '.$Item_Price.'</h2>
												<p>'.$Item_Name.'</p>
												<a  style="cursor:pointer;" onclick="Insert_Item('.$Item_Id.','.$Customer_Id.');" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>';
							}

							if($Count % 3 == 0 && $Count != 0)
								{
									echo '</div>';

									if($Count == 6)
										break;
								}
						}

						if($Count % 3 != 0)
							echo '</div>';
						$con->disconnect();
					?>
					
				</div>
					<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
					<i class="fa fa-angle-left"></i>
					</a>
					<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
					<i class="fa fa-angle-right"></i>
					</a>			
			</div>
		</div>
		
	</div>
	
</body>
</html>