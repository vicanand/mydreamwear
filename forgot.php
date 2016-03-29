<?php
	require "header-internal.php";
?>

		<div id="content" class="site-content">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><span class="current">Forgot Password</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->
			<div class="container">
				<div class="col-md-6">
					<form class="forgotpass" action="resetpass.php" method="post">
						<div class="input-field">
							<label for="pass">Registered Email*</label>
							<input class="input-text" name="email" type="email" placeholder="Email" required>
						</div>
						<p id="error"></p>
						<div class="input-field">
							<input type="hidden" name="usertype" value="<?php echo $_GET['type'];?>">
							<input type="hidden" name="action" value="emailverify">
							<input type="submit" value="Submit" class="button bold yellow">
						</div>
					</form>
				</div>
			</div>
			<br><br><br>
		</div>

<?php
	require "footer.php";
?>