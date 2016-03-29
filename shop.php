<?php 

require_once 'header-internal.php';
//$category = $_GET["cat"];
$paramobj = new stdClass();
$paramobj->city=0;
$paramobj->cat=0;
$paramobj->look=0;
$paramobj->ocas=0;
$paramobj->brand=0;
$paramobj->page=1;

$brands = json_decode(file_get_contents($baseurl."/brands"), true)["data"];


$start_index = 0;
$count = 9;
$item_url = $baseurl."/getitems/".strval(isset($_GET["city"]) ? urlencode($_GET["city"]) : 0)."/".strval(isset($_GET["cat"]) ? $_GET["cat"] : 0)."/".strval(isset($_GET["look"]) ? $_GET["look"] : 0)."/".strval(isset($_GET["ocas"]) ? $_GET["ocas"] : 0)."/".strval(isset($_GET["brand"]) ? urlencode($_GET["brand"]) : 0)."/";


$size = json_decode(file_get_contents($baseurl."/numrecords/".strval(isset($_GET["city"]) ? urlencode($_GET["city"]) : 0)."/".strval(isset($_GET["cat"]) ? $_GET["cat"] : 0)."/".strval(isset($_GET["look"]) ? $_GET["look"] : 0)."/".strval(isset($_GET["ocas"]) ? $_GET["ocas"] : 0)."/".strval(isset($_GET["brand"]) ? urlencode($_GET["brand"]) : 0)), true)["data"];
//$item_url = $baseurl."/getitems/".strval(isset($_GET["city"]) ? urlencode($_GET["city"]) : 0)."/".strval(isset($_GET["cat"]) ? $_GET["cat"] : 0)."/".strval(isset($_GET["look"]) ? $_GET["look"] : 0)."/".strval(isset($_GET["ocas"]) ? $_GET["ocas"] : 0)."/".strval(isset($_GET["brand"]) ? urlencode($_GET["brand"]) : 0)."/".strval(isset($_GET["page"]) ? ($_GET["page"]-1)*9 : 0)."/9";
$items = json_decode(file_get_contents($item_url.$start_index."/".$count), true)["data"];


$recentitems = json_decode(file_get_contents($baseurl."/recentitems"), true)["data"];


if ($_GET["city"]) {
    $paramobj->city=$_GET['city'];
}
if ($_GET["cat"]) {
	$paramobj->cat=$_GET['cat'];
}
if ($_GET["look"]) {
    $paramobj->look=$_GET['look'];
}
if ($_GET["ocas"]) {
    $paramobj->ocas=$_GET['ocas'];
}
if ($_GET["brand"]) {
    $paramobj->brand=$_GET['brand'];
}
if ($_GET["page"]) {
    $paramobj->page=$_GET['page'];
}



function filteredurl($params){
	$filtered_url = "shop.php";
	if ($params->city) {
	    $filtered_url .= "?city=".$params->city;
	    if ($params->cat) {
	        $filtered_url .= "&cat=".$params->cat;
	    }if ($params->look) {
	        $filtered_url .= "&look=".$params->look;
	    }if ($params->ocas) {
	        $filtered_url .= "&ocas=".$params->ocas;
	    }if ($params->brand) {
            $filtered_url .= "&brand=".$params->brand;
        // }elseif ($params->page) {
        //     $filtered_url .= "&page=".$params->page;
        }
	}elseif ($params->cat) {
	    $filtered_url .= "?cat=".$params->cat;
	    if ($params->look) {
	        $filtered_url .= "&look=".$params->look;
	    }if ($params->ocas) {
	        $filtered_url .= "&ocas=".$params->ocas;
	    }if ($params->brand) {
            $filtered_url .= "&brand=".$params->brand;
        // }elseif ($params->page) {
        //     $filtered_url .= "&page=".$params->page;
        }
	}elseif ($params->look) {
	    $filtered_url .= "?look=".$params->look;
	    if ($params->ocas) {
	        $filtered_url .= "&ocas=".$params->ocas;
	    }if ($params->brand) {
            $filtered_url .= "&brand=".$params->brand;
        // }elseif ($params->page) {
        //     $filtered_url .= "&page=".$params->page;
        }
	}elseif ($params->ocas) {
	    $filtered_url .= "?ocas=".$params->ocas;
	    if ($params->brand) {
	        $filtered_url .= "&brand=".$params->brand;
	    // }elseif ($params->page) {
     //        $filtered_url .= "&page=".$params->page;
        }
	}elseif ($params->brand) {
	    $filtered_url .= "?brand=".$params->brand;
	}
	//     if ($params->page) {
 //            $filtered_url .= "&page=".$params->page;
 //        }
	// }elseif($params->page){
	// 	$filtered_url .= "?page=".$params->page;
	// }

	return $filtered_url;
}


?>
		

		<div id="content" class="site-content shop-content left-sidebar">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<!-- <li>echo filteredurl($paramobj)</li> -->
						<li><a href="index.php">Home</a></li>
						<li><span class="current">Shop</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="container">
				<div class="row">
					<main id="main" class="site-main col-md-9">
						<div class="sort clearfix">
							<form action="#" class="ordering pull-left">
								<div class="selectbox emphasize">
									<select class="orderby" name="orderby">
										<option value="lowhigh">price: low to high</option>
										<option value="highlow">price: high to low</option>
									</select>
								</div>
							</form>

							<div class="style-switch pull-right">								
								<a class="active" href="#" data-view="list"><i class="fa fa-th"></i></a>
								<a href="#" data-view="grid"><i class="fa fa-th-list"></i></a>
							</div>
						</div><!-- .sort -->

						<div class="products list" id="productslist">
						<?php 
							$price_array = array();
							
							foreach ($items as $value) {
								array_push($price_array, (int)$value['rent_price']);
								
								$imgArray = $value["imgs"];
						?>
								<div class="product" data-price="<?php echo $value['rent_price']; ?>">
									<div class="p-inner row">
										<div class="p-thumb col-md-4 col-sm-6">
											<a href="single-product.php?item=<?php echo $value["itemcode"]; ?>">
												<img src="images/items/<?php echo $imgArray[0]["image"]; ?>" alt="">
											</a>
										</div>

										<div class="p-info col-md-8 col-sm-6">
											<a href="#product-quickview-<?php echo $value["itemcode"]; ?>" class="quick-view">QUICK LOOK</a>
											<h3 class="p-title"><a href="single-product.php?item=<?php echo $value["itemcode"]; ?>"><?php echo ucwords($value["title"]); ?></a></h3>
											
											<span class="price">
												<ins><span class="amount">₹<?php echo $value["rent_price"]; ?></span></ins>
												<del>₹<?php echo $value["retail_price"]; ?></del>
											</span>

											<div class="p-desc">
												<p><?php echo $value["description"]; ?></p>
											</div>

											<div class="p-actions">
												<?php if($_SESSION["usertype"] != "seller" && isset($_SESSION["name"])){ ?>
													<a href="#" data="<?php echo $value["itemcode"]; ?>" class="button black add-to-cart-button"><i class="icon-cart"></i><span>Add to cart</span></a>
													<a href="#" data="<?php echo $value["itemcode"]; ?>" class="button black add-to-wishlist"><i class="icon-heart"></i></a>
												<?php } ?>
												<a href="#product-quickview-<?php echo $value["itemcode"]; ?>" class="button square dark quick-view"><i class="icon-zoom"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div id="product-quickview-<?php echo $value["itemcode"]; ?>" class="quickview popup">
									<div class="quickview-inner popup-inner clearfix">
										<a href="#" class="popup-close">Close</a>
										<div class="images">
											<div class="p-preview">
				                            	<div class="slider">
				                            		<?php foreach ($imgArray as $key) { ?>
			                            			<div class="item">
				                            			<a data-gal="prettyPhoto[<?php echo $value["itemcode"]; ?>]" href="images/items/<?php echo $key["image"]; ?>" target="_blank">
				                            				<img src="images/items/<?php echo $key["image"]; ?>" alt="<?php echo $key["image"]; ?>">
				                            			</a>
				                            		</div>
				                            		<?php } ?>

				                            		
				                            	</div>
					                        </div>

											<div class="p-thumb">
												<div class="thumb-slider">
													<?php foreach ($imgArray as $key) { ?>
													<div class="item">
				                            			<a href="images/items/<?php echo $key["image"]; ?>">
				                            				<img src="images/items/<?php echo $key["image"]; ?>" alt="<?php echo $key["image"]; ?>">
				                            			</a>
				                            		</div>
				                            		<?php } ?>
												</div>
											</div>
										</div>

										<div class="summary">
											<h3 class="p-title"><a href="single-product.php?item=<?php echo $value["itemcode"]; ?>"><?php echo ucwords($value["title"]); ?></a></h3>
											<h4><?php echo ucwords($value["brand"]); ?></h4><br>
											<div class="star-rating">
												<span style="width:80%"></span>
											</div>

											<span class="price">
												<ins><span class="amount">₹<?php echo $value["rent_price"]; ?></span></ins>
												<del>₹<?php echo $value["retail_price"]; ?></del>
											</span>

											<div class="p-desc">
												<p><?php echo $value["description"]; ?></p>
											</div>

											<form action="#">
												<div class="attribute clearfix">
													<div class="attr-item pull-left">
														<label>Color:</label>
														<div class="selectbox medium">
															<select name="color">
																<option value="<?php echo $value["colors"]; ?>"><?php echo $value["colors"]; ?></option>
															</select>
														</div>
													</div>

													<div class="attr-item pull-left left10">
														<label>Size:</label>
														<div class="selectbox medium">
															<select name="size">
																<option value="<?php echo $value["size"]; ?>"><?php echo $value["size"]; ?></option>
															</select>
														</div>
													</div>
												</div>

												<div class="attribute attribute-actions clearfix">
													<div class="attr-item">
														<label>Qty:</label>
														<div class="quantity">
															<input type="number" step="1" min="0" value="1" title="Qty" class="qty" size="4">
														</div>
													</div>

													<div class="attr-item">
														<div class="p-actions">
															<?php if($_SESSION["usertype"] != "seller" && isset($_SESSION["name"])){ ?>
																<a href="#" data="<?php echo $value["itemcode"]; ?>" class="button yellow add-to-cart-button">Add to cart</a>
																<a href="#" data="<?php echo $value["itemcode"]; ?>" class="button square add-to-wishlist"><i class="icon-heart"></i></a>
															<?php }else{ ?>
																<br><br>
																<p>You are not logged in as a buyer. Please login/signup to continue.</p>
																<a href="login-register.php" class="button yellow">Login</a>
															<?php } ?>
														</div>
													</div>
												</div>
											</form>

										</div>
									</div>

									<div class="mask popup-close"></div>
								</div>
							<?php } ?>
						</div>
						
						
						<div class="pagination">
							<?php if(sizeof($items) > 8) {?>
							<a href="#" id="showmore" data-url="<?php echo $item_url; ?>" data-index="9" data-count="9" class="button yellow" type="button">Show More</a>
							<img id="ajaxloader" src="images/assets/AjaxLoader.gif">
							<?php } ?>
						</div>
						
						
					</main><!-- .site-main -->

					<div id="sidebar" class="sidebar left-sidebar col-md-3">

						<aside class="widget product-cat-widget">
							<h3 class="widget-title">Categories</h3>
							<ul>
								<?php
									if(!$_GET["cat"]){ ?>
										<li class="current-menu-item"><a href="shop.php">All</a></li>
								<?php }else{ ?>
										<li><a href="shop.php">All</a></li>
								<?php } ?>

								<?php foreach ($categories as $cat) { 
									if($cat["id"] == $_GET["cat"]){
								?>
										<li class="current-menu-item"><a><?php echo ucwords($cat["name"]); ?></a></li>
									<?php }else{ ?>
										<li><a href="<?php $temp = clone $paramobj; $temp->cat=$cat["id"]; echo filteredurl($temp); ?>"><?php echo ucwords($cat["name"]);?></a></li>
								<?php }} ?>
								
							</ul>
						</aside>

						<aside class="widget">

							<h3 class="widget-title">Filter by price</h3>

							<div class="f-price">

								<div id="slider-range"></div>

								<span>Price: <strong id="amount"></strong></span>

								<a id="filternow" href="#" data-min="<?php echo min($price_array); ?>" data-max="<?php echo max($price_array); ?>" class="btn btn-dashed textup" type="button">Filter</a>

							</div>

						</aside>



						<aside class="widget">

							<h3 class="widget-title">By Brands</h3>
							<ul>
								<?php
									if(!$_GET["brand"]){ ?>
										<li class="current-menu-item"><a>All</a></li>
								<?php }else{ ?>
										<li><a href="<?php $temp1 = clone $paramobj; $temp1->brand=0; echo filteredurl($temp1); ?>">All</a></li>
								<?php } ?>

								<?php 
									foreach ($brands as $val) { if($val["brand"] != "none") {
										if(strtolower($val["brand"]) == strtolower($_GET["brand"])){
									
								?>
											<li class="current-menu-item"><a><?php echo ucwords($val["brand"]); ?></a></li>
									<?php }else{ $b = $val["brand"];?>
											<li><a href="<?php $temp1 = clone $paramobj; $temp1->brand=strval($b); echo filteredurl($temp1); ?>"><?php echo ucwords($val["brand"]);?></a></li>
								<?php } } } ?>
								
							</ul>
							<!-- <ul>

								<li><a href="#">Zara <span class="count">(33)</span></a></li>

							</ul> -->

						</aside>



						<!-- <aside class="widget">

							<h3 class="widget-title">By Colors</h3>

							<ul>

								<li><a href="#">Red <span class="count">(120)</span></a></li>

								<li><a href="#">White <span class="count">(65)</span></a></li>

								<li><a href="#">Black <span class="count">(87)</span></a></li>

								<li><a href="#">Blue <span class="count">(25)</span></a></li>

							</ul>

						</aside>

 -->

						<!-- <aside class="widget">

							<h3 class="widget-title">By Size</h3>

							<ul>

								<li><a href="#">X - Small <span class="count">(20)</span></a></li>

								<li><a href="#">Small <span class="count">(65)</span></a></li>

								<li><a href="#">Medium <span class="count">(87)</span></a></li>

							</ul>

						</aside> -->



						<!-- <aside class="widget">

							<h3 class="widget-title">Compare</h3>



							<div class="compare-content">

								<p>You have no items to compare!</p>

							</div>

						</aside>
 -->
						<aside class="widget product-sale-widget">
							<h3 class="widget-title">Recent Products</h3>
							<ul>
							<?php foreach($recentitems as $value) { ?>
								<li class="clearfix">
									<a class="product-thumb" href="single-product.php">
										<img src="images/items/<?php echo $value["imgs"][0]["image"]; ?>" alt="">
									</a>
									<div class="product-info">
										<h3 class="title"><a href="single-product.php?item=<?php echo $value["itemcode"]; ?>"><?php echo ucwords($value["title"]); ?></a></h3>
										<div class="star-rating">
											<span style="width:80%"></span>
										</div>
										<span class="price">
											<ins><span class="amount">₹<?php echo $value["rent_price"]; ?></span></ins>
											<del>₹<?php echo $value["retail_price"]; ?></del>
										</span>
									</div><!-- .product-info -->
								</li>
							<?php } ?>
							</ul>
						</aside>
					</div><!-- .left-sidebar -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .site-content -->

<?php require_once 'footer.php';?>