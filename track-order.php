<?php require_once 'header-internal.php';?>

		<div id="content" class="site-content">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><span class="current">Track Your Order</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="page-title no-bg">
				<div class="container">
					<h1 class="title">TRACK YOUR ORDER</h1>
					<p>Please enter your Order ID in the box below and press Enter. This was given to you on your receipt and in the <br />confirmation email you should have received.</p>
				</div>
			</div>

			<div class="container">
				<form class="track-order" action="#">
					<div class="input-field">
						<label for="order-id">Order ID</label>
						<input name="order-id" type="text" class="input-text" id="order-id" required>
					</div><!-- .input-field -->

					<div class="input-field">
						<label for="email">Billing Email</label>
						<input name="email" type="email" class="input-text" id="email" required>
					</div><!-- .input-field -->

					<div class="input-field">
						<input type="submit" class="button yellow bold" value="Track">
					</div><!-- .input-field -->
				</form>
			</div><!-- .container -->
		</div><!-- .site-content -->
		

<?php require_once 'footer.php';?>