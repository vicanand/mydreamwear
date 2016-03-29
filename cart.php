<?php 
	require_once 'header-internal.php';
?>
		<div id="content" class="site-content">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><span class="current">Shopping cart</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="shop-step">
				<div class="container">
					<ul class="clearfix">
						<li class="checked">
							<span class="count">01</span>
							<span class="label">Shopping cart</span>
						</li>
						<li>
							<span class="count">02</span>
							<span class="label">Check out</span>
						</li>
						<li>
							<span class="count">03</span>
							<span class="label">Order Complete</span>
						</li>
					</ul>
				</div><!-- .container -->
			</div><!-- .shop-step -->

			<div class="container">
				<form class="cart-form" action="#">
					<div class="table-responsive">
						<table class="table cart-table">
							<thead>
								<tr>
									
									<th class="product-name">Product</th>
									<th>Price</th>
									<th>Deposit</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>

							<tbody>
								<?php if(isset($data)){ 
									foreach($data as $item) { 
                                    $imgArray = $item["imgs"];
                                ?>
								<tr>
									<td class="product-remove product-name">
										<a href="#" class="remove removefromcart" data="<?php echo $item["itemcode"]; ?>"><i class="fa fa-times-circle"></i></a>
									
										<a href="single-product.php?item=<?php echo $item["itemcode"]; ?>">
											<img src="images/items/<?php echo $imgArray[0]["image"]; ?>" alt="">
											<span><?php echo ucwords($item["title"]); ?></span>
										</a>
									</td>
									<td class="product-price">
										<p class="price">₹<?php echo $item["rent_price"]; ?></p>
									</td>
									<td class="product-price">
										<p class="price">₹<?php echo $item["rent_price"]; ?></p>
									</td>
									<td>
										<div class="quantity">
											<input type="number" step="1" min="0" value="<?php echo $item["quantity"]; ?>" title="Qty" class="qty" size="4">
										</div>
									</td>
									<td class="product-subtotal">
										<p class="price">₹<?php echo $item["rent_price"] * $item["quantity"] * 2; ?></p>
									</td>
								</tr>
								<?php }}else{
									echo "<tr><td><h3>Nothing to display.</h3></td></tr>";
									} ?>
							</tbody>
						</table>
					</div>
				</form>

				<div class="cart-collaterals row">
					<div class="col-md-6">
						<div class="cal-shipping">
							<h3>Calculate Shipping</h3>
							<form action="#">
								<div class="selectbox cart-input">
									<select name="country">
										<option value="india">India</option>
									</select>
								</div>

								<div class="selectbox cart-input">
									<select name="country">
										<option value="bangalore">Bangalore</option>
									</select>
								</div>
								
							</form>
						</div><!-- .cal-shipping -->
					</div>

					<div class="col-md-6">
						<div class="cal-shipping">
							<h3>Cart totals</h3>
							<table>
								<tr class="cart-subtotal">
									<th>Subtotals:</th>
									<td><strong><span class="amount totalamt">₹<?php if($subtotal) { echo $subtotal * 2; }else{ echo "0"; } ?></span></strong></td>
								</tr>
								<tr class="shipping">
									<th>Shipping:</th>
									<td>Free Shipping</td>
								</tr>
								<tr class="order-total">
									<th><div class="black-bg">Order Totals :</div></th>
									<td><div class="black-bg"><strong><span class="amount totalamt">₹<?php if($subtotal) { echo $subtotal * 2; }else{ echo "0"; } ?></span></strong></div></td>
								</tr>
							</table>
						</div><!-- .cal-shipping -->
					</div>
				</div><!-- .cart-collaterals -->

				<div class="cart-actions clearfix">
					<form action="#">
						<div class="cart-input pull-left">
							<input type="text" placeholder="Enter Coupon Code" disabled="true">
						</div>
						<input class="button bold default" type="submit" value="APPLY COUPON" disabled="true">
						<a id="processcart" class="button bold default pull-right" href="checkout.php">PROCESS TO CHECK OUT</a>
						<input class="button bold yellow pull-right" type="submit" value="UPDATE CART" disabled="true">
					</form>
				</div><!-- .cart-actions -->
			</div><!-- .container -->
		</div><!-- .site-content -->
		

<?php require_once 'footer.php';?>