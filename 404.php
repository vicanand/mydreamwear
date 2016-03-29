<?php require_once 'header-internal.php';?>

		<div id="content" class="site-content page-404">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><span class="current">404 Page</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="container">
				<div class="error-404">
					<img src="images/assets/404.png" alt="">
					<h1>THIS IS NOT THE WEB PAGE YOU ARE LOOKING FOR</h1>
					<div class="desc-404">
						<p><span>Please try one of the following pages</span> <a href="index.html" class="button yellow">Home page</a></p>
					</div><!-- desc-404 -->

					<form action="#" class="search-form" method="get">
						<label>
							<span class="screen-reader-text">Search for:</span>
							<input type="search" name="s" placeholder="Search here ..." class="search-field">
						</label>
						<input type="submit" value="Search" class="search-submit">
					</form>
				</div><!-- .error-404 -->
			</div><!-- .container -->
		</div><!-- .site-content -->
		

<?php require_once 'footer.php';?>