<?php
	
	require "header-internal.php";
	$token = $_GET["token"];
?>

		<div id="content" class="site-content">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><span class="current">Reset Password</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->
			
			<div class="container">
				<div class="col-md-6">
					<?php if( time() < $token ) { ?>
					<form class="resetpass" action="resetpass.php" method="post">
						<div class="input-field">
							<label for="pass">New Password*</label>
							<input id="pass" class="input-text" type="password" name="newpass" placeholder="New Password" required>
						</div>
						<div class="input-field">
							<label for="pass">Confirm Password*</label>
							<input id="pass1" class="input-text" type="password" placeholder="Confirm Password" required>
						</div>
						<p id="error"></p>
						<div class="input-field">
							<input type="hidden" name="usertype" value="<?php echo $_GET["user"];?>">
							<input type="hidden" name="token" value="<?php echo $_GET["data"];?>">
							<input type="submit" value="Submit" class="button bold yellow">
						</div>
					</form>
					<?php }else{ ?>
					<h3>This link has expired. Please try again.</h3>
					<?php } ?>
				</div>
			</div><br><br><br>
		</div>

<?php
	require "footer.php";
?>