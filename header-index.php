<?php
	session_start();
	include "helpers.php";
	$baseurl = get_base_url();

	$categories = json_decode(file_get_contents($baseurl."/categories"), true)["data"];
	$lookups = json_decode(file_get_contents($baseurl."/lookups"), true)["data"];
	$banners = json_decode(file_get_contents($baseurl."/collections"), true)["data"];
	if (isset($_SESSION["userid"])) {
		$wishlist = file_get_contents($baseurl."/getwishlist/".$_SESSION["userid"]);
		$res_wish = json_decode($wishlist, true);
		$data_wish = $res_wish["data"];
		
		$cart = file_get_contents($baseurl."/getcart/".$_SESSION["userid"]);
		$response = json_decode($cart, true);
		$data = $response["data"];
	}
	$subtotal = "";
	function get_cat_id($cat_name, $cats){
		$res = 0;
		foreach ($cats as $value) {
			if (strtolower($cat_name) == $value["name"]) {
				
				return $value["id"];
			}
		}
		return $res;
	}


	
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home - My Dream Wear</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="images/assets/favicon.png"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/ie9/html5shiv.min.js"></script>
      <script src="js/ie9/respond.min.js"></script>
    <![endif]-->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-60725557-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>

<body class="home6 home7 header6 header2">

	<div id="pageloader">
		<div class="loading">
			<div class="bullet"></div>
			<div class="bullet"></div>
			<div class="bullet"></div>
			<div class="bullet"></div>
		</div>
	</div><!-- #pageloader -->

	

	<div id="wrapper">
		<!-- .site-header -->
		<header id="header" class="site-header">
			<div class="top-header">
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-sm-5 col-xs-1">
							<!-- .searchbox -->
						</div>

						<div class="col-md-7 col-sm-7 col-xs-11">
							<div class="top-nav">
								<ul>
									<?php if (isset($_SESSION['name'])) { ?>
										<li><?php if(isset($_SESSION['FBID'])){echo "<img class='fb-img' src='https://graph.facebook.com/".$_SESSION['FBID']."/picture' alt='fb_image'>";}?><?php echo $_SESSION['name']; ?></li>
										
										<?php if($_SESSION['usertype'] == "seller"){?>
											<li><a href="listingupload.php">List/Upload</a></li>
											<li class="has-child"><a href="listings.php">My Listings</a></li>
									<?php } ?>
										<li><a href="logout.php">Logout</a></li>
									<?php }else{ ?>
										<li><a href="login-register.php">Login/SignUp</a></li>
									<?php } ?>
								</ul>
								<?php if(isset($_SESSION['name']) && $_SESSION["usertype"] != "seller"){ ?>
								<div class="your-products">
									
									<div class="wishlist-header">
										<a href="wishlist.php">
					                        <img src="images/assets/icons/heart.png" alt="">
											<span class="wishlist-number number"><?php echo sizeof($data_wish); ?></span>
										</a><!-- .cart-control -->
									</div><!-- .wishlist-header -->

									<div class="shop-cart">
										<a href="#" class="cart-control">
					                        <img src="images/assets/icons/cart.png" alt="">
											<span class="cart-number number"><?php echo sizeof($data); ?></span>
										</a><!-- .cart-control -->

										<div class="shop-item">
											<div class="widget_shopping_cart_content">
												<ul class="cart_list">
													<?php
													if(!empty($data)) 
														foreach($data as $item) { 
														$imgArray = $item["imgs"];
														$subtotal += $item["rent_price"] * $item["quantity"];
													?>
													<li class="clearfix">
														<a class="p-thumb" href="single-product.php">
															<img src="images/items/<?php echo $imgArray[0]["image"]; ?>" alt="">
														</a>
														<div class="p-info">
															<a class="p-title" href="single-product.php?item=<?php echo $item["itemcode"]; ?>"><?php echo ucwords($item["title"]); ?></a>
															<span class="price">
																<ins><span class="amount">₹<?php echo $item["rent_price"] * $item["quantity"]; ?></span></ins>
																<del>₹<?php echo $item["retail_price"] * $item["quantity"]; ?></del>
															</span>
															<span class="p-qty">QTY: <?php echo $item["quantity"]; ?></span>
															<!-- <a class="remove" href="#"><i class="fa fa-times-circle"></i></a> -->
														</div>
													</li>
													<?php }else{ ?>
													<li>Your Cart is Empty</li>
													<?php } ?>
												</ul><!-- end cart_list -->
												<p class="total"><strong>Subtotal:</strong> <span class="amount">₹<?php echo $subtotal; ?></span></p>
												<p class="buttons">
													<a class="button cart-button" href="cart.php">View Cart</a>
													<a class="button yellow wc-forward" href="checkout.php">Checkout</a>
												</p>
											</div>
										</div><!-- .shop-item -->
									</div><!-- .shop-cart -->
								</div><!-- .your-products -->
								<?php } ?>
							</div><!-- .top-nav -->
						</div>
					</div>
				</div><!-- .container -->
			</div><!-- .top-header -->

			<div class="container">
				<div class="mid-header">
					<div class="site-brand">
						<a class="logo" href="index.php">
							<img src="images/assets/logo-full.png" alt="MyDreamWear">
						</a>
					</div><!-- .site-brand -->
				</div><!-- .mid-header -->

				<nav class="main-menu">
	                <span class="mobile-menu"><i class="fa fa-bars"></i></span>
	                <ul>
	                    
	                <?php foreach($categories as $value) { ?>
                        <li><a href="shop.php?cat=<?php echo $value["id"]; ?>"><?php echo $value["name"]; ?></a>
                            <ul class="sub-menu">
                        <?php foreach($lookups as $key) { if($key["category_id"] == $value["id"]) { ?>
                                <li><a href="shop.php?cat=<?php echo $value["id"]; ?>&look=<?php echo $key["id"]; ?>"><?php echo $key["name"]; ?></a></li>
                        <?php } } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    	<li><a href="howitworks.php">How It Works</a></li>
	                    <li><a href="aboutus.php">About Us</a></li>
	                    <li><a href="contact.php">Contact Us</a></li>
	                </ul>
	            </nav><!-- .main-menu -->
			</div><!-- .container -->
		</header>