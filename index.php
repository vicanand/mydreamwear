<?php 
	require_once 'header-index.php';
	
	
?>
		<div id="content" class="site-content">
			<div class="main-carousel">
				<div class="slider">
					<?php $count=1; foreach ($categories as $value) {  if($count <= 4) { ?>
					
						<div class="item">
							<a href="shop.php?cat=<?php echo $value["id"]; ?>">
							<div class="products-cat">
								<img src="images/banners/<?php echo $value["banner"]; ?>" alt="">
								
								<div class="cat-info">
									<h2 class="title"><?php echo strtoupper($value["name"]); ?></h2>
									<span class="button black bold" href="shop.php?cat=<?php echo $value["id"]; ?>">View All</span>
								</div><!-- .cat-info -->
								
							</div><!-- .products-cat -->
							</a>
						</div><!-- .item -->
					
					<?php $count++; }} ?>
				</div><!-- .slider -->
			</div><!-- .main-carousel -->
	
			<ul class="parallax-section">
				<?php foreach ($banners as $value) { ?>
				<li>
					<div id="section<?php echo $value["id"]; ?>" class="parallax-window" data-parallax="scroll" data-image-src="images/banners/<?php echo $value["banner"]; ?>">
						<div class="container">
							<div class="parallax-content">
								<span class="more-text">2015</span>
								<div class="title">
									<h2><?php echo strtoupper($value["name"]); ?></h2>
									<h3><?php //echo $value["title"]; ?></h3>
									<!-- <p class="subtitle">valid on all our store items</p> -->
								</div>								
							</div><!-- .parallax-content -->
						</div>
					</div><!-- #section1 -->
				</li>

				<?php } ?>
				<li><a href="howitworks.php">
					<div id="section-how" class="parallax-window" data-parallax="scroll" data-image-src="images/assets/rent-in-mdw-page.jpg">
						<div class="container">
							<div class="parallax-content">
															
							</div>
						</div>
					</div></a>
				</li>
				
			</ul><!-- .parallax-section -->

			<div class="parallax-count">
				<span class="prev"><i class="fa fa-long-arrow-up"></i></span>
				<span class="count"></span>
				<span class="next"><i class="fa fa-long-arrow-down"></i></span>
			</div><!-- .parallax-count -->
		</div>
		
		
	<?php require_once 'footer.php';?>	