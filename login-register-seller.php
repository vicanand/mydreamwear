<?php 
session_start();

if (isset($_SESSION["name"])) {
	
	header('Location: index.php');
}else{
	require_once 'header-internal.php';
}

?>

		<div id="content" class="site-content account-page">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="login-register.php">Login / Register</span></a></li>
						<li><span class="current">Seller</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="container">
				<div class="row">
					<div class="col-md-6">
						
							<h2 class="heading-title">Sign in</h2>
							
							<div class="social-signin">
								<a href="fbconfig.php?user=seller" class="button facebook"><i class="fa fa-facebook"></i> SIGN IN WITH FACEBOOK</a>
								<!-- <a href="#" target="_blank" class="button twitter"><i class="fa fa-twitter"></i> SIGN IN WITH TWITTER</a> -->
							</div>

							<form class="signin" id="signin" action="loginvalidator.php" method="post">
								<div class="input-field">
									<label for="s-email">Email Address *</label>
									<input id="email" class="input-text" type="email" name="email" placeholder="Your email" required>
								</div>

								<div class="input-field">
									<label for="pass">Password *</label>
									<input id="pass" class="input-text" type="password" name="password" placeholder="Password" required>
								</div>
								<div class="input-field">
									<a href="forgot.php?type=seller" class="fogot">Fogot your password?</a>
								</div>
								<p id="error"></p>
								<div class="input-field">
									<input type="hidden" name="user" value="seller">
									<input type="hidden" name="method" value="custom">
									<input type="hidden" name="type" value="signin">
									<input type="submit" value="Login now" class="button bold yellow">
								</div>
							</form>
						
					</div>

					<div class="col-md-6">
						<div class="register">
							<h2 class="heading-title">Create a new account</h2>
							<!-- <p>Create your own Rimbus account.</p> -->

							<form class="signup" id="signup" method="post" action="loginvalidator.php">
								<div class="input-field">
									<label>Name</label>
									<input type="text" class="input-text" name="name" placeholder="Name" required>
								</div>
								<div class="input-field">
									<label for="r-email">Email Address *</label>
									<input id="r-email" class="input-text" type="email" name="email" placeholder="Your email" required>
								</div>
								<div class="input-field">
									<label>Mobile</label>
									<input type="text" class="input-text mobile" pattern="\d{10}" name="mobile" placeholder="Mobile" required>
								</div>
								<div class="input-field">
									<label>Password</label>
									<input type="password" class="input-text" name="password" placeholder="Password" required>
								</div>
								<div class="input-field">
									<label>Address</label>
									<textarea type="text" class="input-text" name="address" rows="3" placeholder="Address" required></textarea>
								</div>
								<div class="input-field">
									<label>Designer</label>
									<select type="text" class="selectbox" name="designer">
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
								<div class="input-field">
									<input type="hidden" name="user" value="seller">
									<input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
									<input type="hidden" name="type" value="signup">
									<input type="submit" value="Sign up" class="button bold yellow">
								</div>
							</form>
							
							<div class="signup-today">
								<h2 class="heading-title">SIGN UP TODAY AND YOU’LL BE ABLE TO</h2>

								<div class="input-field">
									<div class="checkbox">
										<input type="radio" checked="checked">
										<label for="speed">Speed your way through the checkout.</label>
									</div>
								</div>

								<div class="input-field">
									<div class="checkbox">
										<input type="radio" checked="checked">
										<label for="track">Track your orders easily.</label>
									</div>
								</div>
								<p id="error1"></p>
								<div class="input-field">
									<div class="checkbox">
										<input type="radio" checked="checked">
										<label for="keep">Keep a record of all purchases.</label>
									</div>
								</div>
							</div>
						</div><!-- .register -->
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .site-content -->

<?php require_once 'footer.php';?>