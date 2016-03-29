<?php
    session_start();
    include "helpers.php";
    $baseurl = get_base_url();

    
    $ch_2 = curl_init($baseurl."/categories");
    $ch_3 = curl_init($baseurl."/lookups");

    if (isset($_SESSION["userid"])) {
        $ch_1 = curl_init($baseurl."/getcart/".$_SESSION["userid"]);
        //$result = file_get_contents($baseurl."/getcart/".$_SESSION["userid"]);
        //$response = json_decode($result, true);
        //$data = $response["data"];
    }

    curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_3, CURLOPT_RETURNTRANSFER, true);

    $mh = curl_multi_init();

    curl_multi_add_handle($mh, $ch_1);
    curl_multi_add_handle($mh, $ch_2);
    curl_multi_add_handle($mh, $ch_3);

    $running = null;
    do {
        curl_multi_exec($mh, $running);
    } while ($running);

    curl_multi_remove_handle($mh, $ch_1);
    curl_multi_remove_handle($mh, $ch_2);
    curl_multi_remove_handle($mh, $ch_3);
    curl_multi_close($mh);

    $data = json_decode(curl_multi_getcontent($ch_1), true)["data"];
    $categories = json_decode(curl_multi_getcontent($ch_2), true)["data"];
    $lookups = json_decode(curl_multi_getcontent($ch_3), true)["data"];
    $subtotal = "";
    // $categories = json_decode(file_get_contents($baseurl."/categories"), true)["data"];
    // $lookups = json_decode(file_get_contents($baseurl."/lookups"), true)["data"];
    // function get_cat_id($cat_name, $cats){
    //     $res = 0;
    //     foreach ($cats as $value) {
    //         if (strtolower($cat_name) == $value["name"]) {
                
    //             return $value["id"];
    //         }
    //     }
    //     return $res;
    // }
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo ucwords(str_replace("/","",strtok(strtok($_SERVER["REQUEST_URI"],'?'),"."))); ?> - My Dream Wear</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="images/assets/favicon.png"/>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-60725557-1', 'auto');
        ga('send', 'pageview');

    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/ie9/html5shiv.min.js"></script>
      <script src="js/ie9/respond.min.js"></script>
    cvbcvbcvb
    <![endif]-->
</head>

<body>

	<div id="pageloader">
		<div class="loading">
			<div class="bullet"></div>
			<div class="bullet"></div>
			<div class="bullet"></div>
			<div class="bullet"></div>
		</div>
	</div>

	<div id="wrapper">
		<header id="header" class="site-header">
			<div class="site-brand">
				<a class="logo" href="index.php">
					<img src="images/assets/logo.png" alt="MyDreamWear">
				</a>
			</div><!-- .site-brand -->

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

			<div class="right-header">

				<div class="setting">
					<span class="icon"><i class="fa fa-cog"></i></span>
					<div class="setting-wrap">
                        <nav class="setting-menu">
                            <ul>
                                <?php if (isset($_SESSION['name'])) { ?>
                                    <li><a><i class="fa fa-user"></i><?php echo $_SESSION['name']; ?></a></li>
                                <?php }else{ ?>
                                    <li><a href="login-register.php"><i class="fa fa-sign-in"></i>Login / Register</a></li>
                                <?php } ?>
                                <?php if (isset($_SESSION['name'])) { ?>
                                    
                                    <?php if($_SESSION["usertype"] == "seller"){ ?>
                                        <li><a href="listings.php"><i class="fa fa-list"></i>My Listings</a></li>
                                        <li><a href="listingupload.php"><i class="fa fa-upload"></i>List/Upload</a></li>
                                    <?php }else{ ?>
                                        <li><a href="cart.php"><i class="fa fa-shopping-cart"></i>My Cart</a></li>
                                        <li><a href="wishlist.php"><i class="fa fa-heart"></i>My Wishlist</a></li>
                                        <li><a href="orders.php"><i class="fa fa-shopping-bag"></i>My Orders</a></li>
                                        <li><a href="checkout.php"><i class="fa fa-check-circle"></i>Checkout</a></li>
                                    <?php } ?>
                                    <li><a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
                                <?php } ?>


                            </ul>
                        </nav><!-- .setting-menu -->
                    </div>
				</div><!-- .setting -->
                <?php if(isset($_SESSION["name"]) && $_SESSION["usertype"] != "seller"){ ?>
    				<div class="shop-cart-v2">
    					<a href="#" class="cart-control">
                            <img src="images/assets/icons/cart.png" alt="">
    						<span id="cart-number" class="cart-number"><?php echo sizeof($data); ?></span>
    					</a><!-- .cart-control -->

    					<div class="shop-item">
    						<div class="widget_shopping_cart_content">
    							<ul id="cart_list" class="cart_list">
    								<?php
                                    if(!empty($data)){ 
                                        foreach($data as $item) { 
                                        $imgArray = $item["imgs"];
                                        //var_dump($imgArray[0]);
                                        $subtotal += $item["rent_price"] * $item["quantity"];
                                    ?>
                                    <li id="item-<?php echo $item["itemcode"]; ?>" class="clearfix">
                                        <a class="p-thumb" href="single-product.php">
                                            <img src="images/items/<?php echo $imgArray[0]["image"]; ?>" alt="">
                                        </a>
                                        <div class="p-info">
                                            <a class="p-title" href="single-product.php?item=<?php echo $item["itemcode"]; ?>"><?php echo ucwords($item["title"]); ?></a>
                                            <span class="price">
                                                <ins><span class="amount units">₹<?php echo $item["rent_price"] * $item["quantity"]; ?></span></ins>
                                                <del>₹<?php echo $item["retail_price"] * $item["quantity"]; ?></del>
                                            </span>
                                            <span class="p-qty">QTY: <?php echo $item["quantity"]; ?></span>
                                            
                                        </div>
                                    </li>
                                    <?php }} else{ ?>
                                        <li>Your Cart is Empty</li>
                                    <?php } ?>
    							</ul><!-- end cart_list -->
    							<p class="total"><strong>Subtotal:</strong> <span id="totalamthead" class="amount totalamt">₹<?php echo $subtotal; ?></span></p>
    							<p class="buttons">
    								<a class="button cart-button" href="cart.php">View Cart</a>
    							</p>
                                <p class="buttons">
                                    <a class="button yellow wc-forward" href="checkout.php">Checkout</a>
                                </p>
    						</div>
    					</div><!-- .shop-item -->
    				</div><!-- .shop-cart -->
                <?php }else{ ?>
                    <div class="shop-cart-v2">
                        <h2>&nbsp;</h2>
                    </div>
                <?php } ?>
			</div><!-- .right-header -->
		</header><!-- .site-header -->