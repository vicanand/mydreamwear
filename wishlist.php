<?php
	 
	require_once 'header-internal.php';
	if (isset($_SESSION["userid"])) {
		$wishlist = file_get_contents($baseurl."/getwishlist/".$_SESSION["userid"]);
		$res_wish = json_decode($wishlist, true);
		$data_wish = $res_wish["data"];
	}
?>

		<div id="content" class="site-content wishlist-page">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><span class="current">Wishlist</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="page-title no-bg">
				<div class="container">
					<h1 class="title">Wishlist</h1>
					
				</div>
			</div>

			<div class="container">
				<form class="cart-form wishlist-cart" action="#">
					<div class="table-responsive">
						<table class="table cart-table">
							<thead>
								<tr>
									<th></th>
									<th class="product-name">Product</th>
									<th>Price</th>
									<th>Stock status</th>
									<th></th>
								</tr>
							</thead>

							<tbody>
								<?php if($data_wish){ 
									foreach($data_wish as $item) { 
                                    $imgArray = $item["imgs"];
                                    $subtotal += $item["rent_price"];
                                ?>
								<tr>
									<td class="product-remove">
										<a href="#" class="remove removefromwish" data="<?php echo $item["itemcode"]; ?>"><i class="fa fa-times-circle"></i></a>
									</td>
									<td class="product-name">
										<a href="single-product.php?item=<?php echo $item["itemcode"]; ?>">
											<img src="images/items/<?php echo $imgArray[0]["image"]; ?>" alt="">
											<span><?php echo ucwords($item["title"]); ?></span>
										</a>
									</td>
									<td class="product-price">
										<p class="price">₹<?php echo $item["rent_price"]; ?></p>
									</td>
									<td class="product-stock-status">
	                                	<span class="wishlist-in-stock">In Stock</span>                            
	                                </td>
									<td class="product-add-to-cart">
                                        <a href="#" data="<?php echo $item["itemcode"]; ?>" class="button yellow add-to-cart-button">Add to cart</a>
                                    </td>
								</tr>
								<?php }}else{
									echo "<tr><td><h3>Nothing to display.</h3></td></tr>";
									} ?>
								
							</tbody>
						</table>
					</div>
				</form>
			</div><!-- .container -->
		</div><!-- .site-content -->
		
<?php require_once 'footer.php';?>