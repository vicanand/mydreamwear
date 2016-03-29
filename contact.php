<?php require_once 'header-internal.php';?>

		<div id="content" class="site-content contact-page">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><span class="current">Contact Us</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->
			<div class="container">
			<div class="google-map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15552.034819396957!2d77.58743005352147!3d12.97129461921243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBengaluru%2C+Karnataka+560001!5e0!3m2!1sen!2sin!4v1458296953190" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div><!-- .google-map -->
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2 class="heading-title">LEAVE A MESSAGE!</h2>
						<form class="contact-form" method="post" action="thanks.php">
							<div class="row">
								<div class="col-md-4 col-sm-4">
									<div class="input-field">
										<input class="input-text" type="text" name="name" placeholder="Your name *" required>
									</div>									
								</div>

								<div class="col-md-4 col-sm-4">
									<div class="input-field">
										<input class="input-text" type="email" name="email" placeholder="Your email *" required>
									</div>									
								</div>

								<div class="col-md-4 col-sm-4">
									<div class="input-field">
										<input class="input-text" type="text" name="phone" pattern="\d{10}" placeholder="Your phone" required>
									</div>									
								</div>
							</div>
							
							<div class="input-field">
								<textarea name="message" placeholder="Your message *" cols="30" rows="8" required></textarea>
							</div>

							<div class="input-field">
								<input id="contact-submit" type="submit" value="Send message" class="button bold yellow"><img id="ajaxloader" src="images/assets/AjaxLoader.gif">
								<p id="result"></p>
							</div>	
						</form>
					</div>
					
					<div class="col-md-4">
						<h2 class="heading-title">Contact information</h2>
						<div class="contact-info">
							
							<strong>TEL</strong>  <a href="tel:08197319692">08197319692</a>, <a href="tel:07829913570">07829913570</a><br>
							<strong>MAIL</strong>  <a href="mailto:mdw@my-dream-wear.com">mdw@my-dream-wear.com</a><br>
							<strong>OPEN</strong> Mon - Fri: 9:00 - 18:00</p>
							<div class="social">
								<ul>
									<li><a href="https://www.facebook.com/mydreamwear/" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
								</ul>
							</div>
						</div>	
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .site-content -->
		
<?php require_once 'footer.php';?>