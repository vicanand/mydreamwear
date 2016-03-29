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
						<li><span class="current">Login / Register</span></li>
						<li><span class="current">Buyer</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="">
							<h2 class="heading-title">Sign in</h2>
							<!-- <p>Hello, welcome to your account.</p> -->
							<div class="social-signin">
								<a href="fbconfig.php?user=buyer" class="button facebook"><i class="fa fa-facebook"></i> SIGN IN WITH FACEBOOK</a>
								<!-- <a href="#" class="button twitter"><i class="fa fa-twitter"></i> SIGN IN WITH TWITTER</a> -->
							</div>
							<p><strong>Are you a seller </strong><a href="login-register-seller.php">Login/SignUp Here</a></p>
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
									<div class="checkbox">
										<input type="hidden" name="user" value="buyer">
										<input type="hidden" name="method" value="custom">
									</div>
									<a href="forgot.php?type=buyer" class="fogot">Fogot your password?</a>
								</div>
								<p id="error"></p>
								<div class="input-field">
									<input type="hidden" name="type" value="signin">
									<input type="submit" value="Login now" class="button bold yellow">
								</div>
							</form>
						</div><!-- .signin -->
					</div>

					<div class="col-md-6">
						<div class="register">
							<h2 class="heading-title">Create a new account</h2>
							<!-- <p>Create your own Rimbus account.</p> -->

							<form class="signup" id="signup" method="post" action="loginvalidator.php">
								<div class="input-field">
									<label>Name</label>
									<input type="text" class="input-text" name="name" placeholder="Full Name" required>
								</div>
								<div class="input-field">
									<label for="r-email">Email Address *</label>
									<input id="r-email" class="input-text" type="email" name="email" placeholder="Your Email" required>
								</div>
								<div class="input-field">
									<label>Mobile</label>
									<input type="text" class="input-text mobile" pattern="\d{10}" name="mobile" placeholder="Mobile Number" required>
								</div>
								<div class="input-field">
									<label>Password</label>
									<input type="password" class="input-text" name="password" placeholder="Choose a password" required>
								</div>
								<div class="input-field">
									<label>Locality</label>
									<textarea type="text" class="input-text" name="locality" rows="3" placeholder="Locality" required></textarea>
								</div>
								<div class="input-field">
									<label>City</label>
									<input type="text" class="input-text" name="city" placeholder="City" required>
								</div>
								<div class="input-field">
									<label>ZIP</label>
									<input type="text" class="input-text zip" name="zip" placeholder"Zip" pattern="\d{6}" required>
								</div>
								<div class="input-field">
									<label>Designer</label>
									<select type="text" class="selectbox" name="designer">
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
								<div class="input-field">
									<input type="hidden" name="user" value="buyer">
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