<?php
	require_once 'header-internal.php';
	
	if ($_SESSION["usertype"] == "seller") {
		
	$data = json_decode(file_get_contents($baseurl."/listings/".$_SESSION['userid']), true)["data"];
?>
		<div id="content" class="site-content">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><span class="current">My Listings</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="container">
				<h1 class="center"><u>Your Listings</u></h1><br><br>
				<form class="cart-form">
				<div class="table-responsive">
					<table class="table cart-table">
						<thead>
								<tr>
									
									<th class="product-name">Product</th>
									<th class="hidden-sm-down hidden-xs-down">Price</th>
									<th class="hidden-sm-down hidden-xs-down">Deposit</th>
									<th>Total</th>
								</tr>
							</thead>

							<tbody>
								<?php if(isset($data)){ 
									foreach($data as $item) { 
                                    $imgArray = $item["imgs"];
                                ?>
								<tr>
									
									<td class="product-name">
										<a href="single-product.php?item=<?php echo $item["itemcode"]; ?>">
											<img class="hidden-xs-down" src="images/items/<?php echo $imgArray[0]["image"]; ?>" alt="">
											<span><?php echo ucwords($item["title"]); ?></span>
										</a>
									</td>
									<td class="product-price hidden-sm-down hidden-xs-down">
										<p class="price">₹<?php echo $item["rent_price"]; ?></p>
									</td>
									<td class="product-price hidden-sm-down hidden-xs-down">
										<p class="price">₹<?php echo $item["security_deposit"]; ?></p>
									</td>
									<td class="product-subtotal">
										<a class="btn btn-danger" href="editlisting.php?item=<?php echo $item["itemcode"]; ?>">Edit</a>
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
		

<?php  } else{ 
	echo "<br><br><br><br><br><h2 class='center'>Unauthorized</h2><br><br><br><br><br>";
 } require_once 'footer.php'; ?>
