<?php 
	require_once 'header-internal.php';
	$data = json_decode(file_get_contents($baseurl."/myorders/".$_SESSION['userid']), true)["data"];
?>
		<div id="content" class="site-content">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><span class="current">My Orders</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="container">
				<h1 class="center"><u>Your Orders</u></h1><br><br>
				<div class="table-responsive">
					<table class="table cart-table">
						<thead>
							<tr>
								
								<th class="product-name">Product</th>
								<th>Quantity</th>
								<th>Total</th>
								<th>Status</th>
							</tr>
						</thead>

						<tbody>
							<?php if(isset($data)){ 
								foreach($data as $item) { 
                                //$imgArray = $item["imgs"];
                            ?>
							<tr>
								<td class="product-name">
									<p><?php echo ucwords($item["itemname"]); ?></p>
								</td>
								<td class="product-price">
									<p><?php echo $item["order_quantity"]; ?></p>
								</td>
								<td>
									<div>
										<p class="price">₹<?php echo $item["total_amt"]; ?></p>
									</div>
								</td>
								<td class="product-subtotal">
									<p><?php echo ucwords($item["order_status"]); ?></p>
								</td>
							</tr>
							<?php }}else{
								echo "<tr><td><h3>Nothing to display.</h3></td></tr><br><tr><td>You have not made any orders yet. <a href='shop.php'>Shop Here</a></td></tr>";
								} ?>
						</tbody>
					</table>
				</div>
			</div><!-- .container -->
		</div><!-- .site-content -->
		

<?php require_once 'footer.php';?>