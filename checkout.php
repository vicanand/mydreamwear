<?php require_once 'header-internal.php';?>


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
						<li class="checked">
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
<?php if(isset($_SESSION["name"])){ ?>
			<div class="container">
				
				
					
				<form class="checkoutform" method="post" action="completeorder.php" >
					<div class="row">
						<div class="col-md-6">
							<div class="billing-fields">
								<h2>Billing Details</h2><br>
								
								<div class="input-field">
									<label>Email *</label>
									<input type="email" placeholder="Email" class="input-text" name="useremail" required>
								</div>
								<div class="input-field">
									<label>Mobile *</label>
									<input type="number" placeholder="Mobile" class="input-text" name="userphone" required>
								</div>
								<div class="input-field">
									<label>Delivery Date *</label>
									<input type="text" placeholder="Delivery Date" class="input-text datepicker" name="deliverydate" required>
								</div>
								<div class="input-field">
									<label>Return Date *</label>
									<input type="text" placeholder="Return Date" class="input-text datepicker" name="returndate" required>
								</div>
								
							</div><!-- .billing-fields -->
						</div>

						<div class="col-md-6">
							<div class="billing-fields">
								<h2>&nbsp;</h2><br>
								<div class="input-field">
									<label>Rent Days *</label>
									<input type="number" placeholder="Rent Days" class="input-text" name="rentdays" required>
								</div>

								<div class="input-field">
									<label for="state">Rent Type</label>
									<select name="rent_type" class="selectbox">
										<option value="Prebook">Prebook</option>
										<option value="Express">Express</option>
									</select>
								</div>
								<input type="hidden" value="10000" name="deposit">
								<input type="hidden" value="1" name="quantity">
								<input type="hidden" value="<?php echo $_SESSION["userid"]; ?>" name="userid">

								<div class="input-field">
									<label>&nbsp;</label>
									<input type="submit" class="button yellow wc-forward" value="Order">
								</div><!-- .input-field -->
							</div>
						</div>  
					</div>

				</form>
					<div class="your-order">
						<h2 class="title">YOUR ORDER</h2>

						<div class="row">
							<div class="col-md-6">
								<div class="product-total">
									<table>
										<tr class="table-title">
											<th>Product</th>
											<th>Totals</th>
										</tr>
										<tr class="product-order">
											<td colspan="2">
												<ul>
													<?php foreach($data as $item) { ?>
													<li class="checkoutitem" data-price="<?php echo $item["rent_price"]; ?>" data-code="<?php echo $item["itemcode"]; ?>" data-title="<?php echo ucwords($item["title"]); ?>" data-quant="1">
														<span class="product-qty"><a href="single-product.php?item=<?php echo $item["itemcode"]; ?>"><?php echo ucwords($item["title"]); ?></a>  x 01</span>
														<span class="price">₹<?php echo $item["rent_price"] * 2 ; ?></span>
													</li>
													<?php } ?>
												</ul>
											</td>
										</tr>
										<tr class="cart-subtotal">
											<th>Subtotals:</th>
											<td><strong><span class="amount">₹<?php echo $subtotal * 2; ?></span></strong></td>
										</tr>
										<tr class="shipping">
											<th>Shipping:</th>
											<td>Free Shipping</td>
										</tr>
										<tr class="order-total">
											<th><div class="black-bg">Order Totals :</div></th>
											<td><div class="black-bg"><strong><span class="amount">₹<?php echo $subtotal * 2; ?></span></strong></div></td>
										</tr>								
									</table>
								</div><!-- .product-total -->
								<br>
								
							</div>

							<div class="col-md-6">
								<div class="payment_methods">
									<ul>
										<li>
											<div class="checkbox">
												<input type="radio" checked="checked" value="cheque" name="payment_method" id="direct">
												<label for="direct">CASH ON DELIVERY</label>
											</div>

											<div class="payment-box">
												<p>Make your payment directly to the delivery person as currently we offer only cash on delivery.</p>
											</div>
										</li>

										<!-- <li>
											<div class="checkbox">
												<input type="radio" value="cheque" name="payment_method" id="payment_method">
												<label for="payment_method">CHEQUE PAYMENT</label>
											</div>
										</li>

										<li class="paypal-method">
											<div class="checkbox">
												<input type="radio" value="cheque" name="payment_method" id="paypal">
												<label for="paypal">Paypal</label>
												<img src="images/assets/payment_method.png" alt="">
												
											</div>
											<p>Pay via PayPal you can pay with your credit card if you don’t have a PayPal account.</p>
										</li> -->
									</ul>
								</div><!-- .payment_methods -->
							</div>
						</div>
					</div><!-- .your-order -->
				
			</div><!-- .container -->
			<?php }else{ ?>
				<br><br><h2 class="center">Unauthorized</h2><br><br><br>	
			<?php } ?>
		</div><!-- .site-content -->
		

<?php require_once 'footer.php';?>