<?php 
	
	require_once 'header-internal.php';
	$itemcode = $_GET["item"];
	$result = file_get_contents($baseurl."/getitem/".$itemcode);
	$data = json_decode($result, true);
	$item = $data["data"];
	$imgs = $item["imgs"];
	//$images = explode(',', $imgs);
	//var_dump($images);
?>

		<div id="content" class="site-content single-product">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="shop.php">Shop</a></li>
						<li><span class="current">Single Product</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="container">
				<div class="row product-detail">
					<div class="col-md-5">
						<div class="images clearfix">
							<div class="p-preview">
								<?php foreach($imgs as $value){ ?>
								<div class="item">
									<a data-gal="prettyPhoto[p-gal1]" class="zoom" href="images/items/<?php echo $value["image"]; ?>">
			                    		<img src="images/items/<?php echo $value["image"]; ?>" alt="" />
			                    	</a>
								</div>
								<?php } ?>
		                    	
		                    </div><!-- #p-preview -->

							<div class="p-thumb">
								<ul>
									<?php foreach($imgs as $value){ ?>
		                            <li><a href="#">
		                            	<img src="images/items/<?php echo $value["image"]; ?>" alt="" />
		                            </a></li>
		                            <?php } ?>
		                        </ul>
							</div><!-- #p-thumb -->
						</div><!-- .images -->
					</div>	

					<div class="col-md-7">
						<div class="summary">
							<h3 class="p-title"><?php echo ucwords($item["title"]); ?></h3>
							<h4><?php echo ucwords($item["brand"]); ?></h4><br>
							<div class="star-rating">
								<span style="width:80%"></span>
							</div>

							<span class="price">
								<ins><span class="amount rent-single">₹<?php echo $item["rent_price"]; ?></span></ins>
								<del class="retail-single">₹<?php echo $item["retail_price"]; ?></del>
							</span>

							<div class="p-desc">
								<p><?php echo $item["description"]; ?></p>
							</div><!-- .p-desc -->

							<form action="#">
								<div class="attribute clearfix">
									<div class="attr-item pull-left">
										<label>Color:</label>
										<div class="selectbox medium">
											<select name="color">
												<option value="<?php echo $value["colors"]; ?>"><?php echo $item["colors"]; ?></option>
											</select>
										</div>
									</div><!-- .attr-item -->

									<div class="attr-item pull-left">
										<label>Size:</label>
										<div class="selectbox medium">
											<select name="size">
												<option value="<?php echo $item["size"]; ?>"><?php echo $item["size"]; ?></option>
											</select>
										</div>
									</div><!-- .attr-item -->

									<div class="attr-item pull-left">
										<label>Qty:</label>
										<div class="quantity">
											<input id="quantity" type="number" step="1" min="0" value="1" title="Qty" class="qty qty-single" size="4" disabled="true">
										</div>
									</div><!-- .attr-item -->
								</div><!-- .attribute -->

								<div class="attribute clearfix">
									<div class="attr-item">
										<div class="p-actions">
										<?php if($_SESSION["usertype"] != "seller" && isset($_SESSION["name"])){ ?>
											<a href="#" class="button yellow add-to-cart-button" data="<?php echo $itemcode; ?>"><i class="icon-cart"></i><span>Add to cart</span></a>
											<a href="#" class="button square add-to-wishlist" data="<?php echo $itemcode; ?>"><i class="icon-heart"></i></a>
										<?php }else{ ?>
											<br><br>
											<p>You are not logged in as a buyer. Please login/signup to continue.</p>
											<a href="login-register.php" class="button yellow">Login</a>
										<?php } ?>		
											<a href="#product-quickview-<?php echo $item["itemcode"]; ?>" class="button square quick-view"><i class="icon-zoom"></i></a>
										</div><!-- .p-actions -->
									</div><!-- .attr-item -->
								</div><!-- .attribute -->
							</form>
							<!--
							<div class="single-share">
								<strong>SHARE THIS:</strong>
								<div class="social">
									<ul>
										<li><a target="_blank" href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a target="_blank" href="#"><i class="fa fa-pinterest"></i></a></li>
										<li><a target="_blank" href="#"><i class="fa fa-facebook-square"></i></a></li>
										<li><a target="_blank" href="#"><i class="fa fa-behance"></i></a></li>
										<li><a target="_blank" href="#"><i class="fa fa-dribbble"></i></a></li>
									</ul>
								</div>
							</div> .single-share -->
						</div><!-- .summary -->
					</div>
				</div><!-- .row -->
				<div id="product-quickview-<?php echo $item["itemcode"]; ?>" class="quickview popup">
					<div class="quickview-inner popup-inner clearfix">
						<a href="#" class="popup-close">Close</a>
						<div class="images">
							<div class="p-preview">
                            	<div class="slider">
                            		<?php foreach ($imgs as $key) { ?>
                        			<div class="item">
                            			<a data-gal="prettyPhoto[<?php echo $item["itemcode"]; ?>]" href="images/items/<?php echo $key["image"]; ?>" target="_blank">
                            				<img src="images/items/<?php echo $key["image"]; ?>" alt="<?php echo $key["image"]; ?>">
                            			</a>
                            		</div>
                            		<?php } ?>

                            		
                            	</div>
	                        </div><!-- #p-preview -->

							<div class="p-thumb">
								<div class="thumb-slider">
									<?php foreach ($imgs as $key) { ?>
									<div class="item">
                            			<a href="images/items/<?php echo $key["image"]; ?>">
                            				<img src="images/items/<?php echo $key["image"]; ?>" alt="<?php echo $key["image"]; ?>">
                            			</a>
                            		</div>
                            		<?php } ?>
								</div><!-- .thumb-slider -->
							</div><!-- #p-thumb -->
						</div><!-- .images -->

						<div class="summary">
							<h3 class="p-title"><a><?php echo ucwords($item["title"]); ?></a></h3>
							<h4><?php echo ucwords($item["brand"]); ?></h4><br>
							<div class="star-rating">
								<span style="width:80%"></span>
							</div>

							<span class="price">
								<ins><span class="amount">₹<?php echo $item["rent_price"]; ?></span></ins>
								<del>₹<?php echo $item["retail_price"]; ?></del>
							</span>

							<div class="p-desc">
								<p><?php echo $item["description"]; ?></p>
							</div>

							<form action="#">
								<div class="attribute clearfix">
									<div class="attr-item pull-left">
										<label>Color:</label>
										<div class="selectbox medium">
											<select name="color">
												<option value="<?php echo $value["colors"]; ?>"><?php echo $item["colors"]; ?></option>
											</select>
										</div>
									</div>

									<div class="attr-item pull-left left10">
										<label>Size:</label>
										<div class="selectbox medium">
											<select name="size">
												<option value="<?php echo $item["size"]; ?>"><?php echo $item["size"]; ?></option>
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
											<a href="#" data="<?php echo $item["itemcode"]; ?>" class="button yellow add-to-cart-button">Add to cart</a>
											<a href="#" data="<?php echo $item["itemcode"]; ?>" class="button square add-to-wishlist"><i class="icon-heart"></i></a>
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
				</div><!-- #product-quickview -->
				<div class="tabs-container">
					<ul class="tabs clearfix">									
						<li><a href="#tab-description">Description</a></li>
					</ul>

					<div id="tab-description" class="tab-content">	
						<p><?php echo $item["description"]; ?>.</p>
					</div>
				</div><!-- .tabs-container -->

			</div><!-- .container -->
		</div><!-- .site-content -->


<?php require_once 'footer.php';?>