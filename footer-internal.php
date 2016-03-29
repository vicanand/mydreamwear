		<div class="policy">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="policy-item">
                            <i class="pe-7s-plane"></i>
                            <span>FREE SHIPPING WORLDWIDE</span>
                            <p>Guaranteed Delivery In 4 Days</p>
                        </div><!-- .policy-item -->
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="policy-item">
                            <i class="pe-7s-headphones"></i>
                            <span>24/7 CUSTOMER SERVICE</span>
                            <p>Call Us 24/7 At 070-7782-9137</p>
                        </div><!-- .policy-item -->
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="policy-item">
                            <i class="pe-7s-refresh-2"></i>
                            <span>MONEY BACK GUARATEE!</span>
                            <p>Send Within 30 Days</p>
                        </div><!-- .policy-item -->
                    </div>
                </div>
            </div>
        </div>

		<footer id="footer" class="site-footer">
			<div class="container">
				<div class="footer-widget">
					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="footer-item">
								<aside class="widget about">
									<h3 class="widget-title">ABOUT MyDreamWear</h3>
									<div class="textwidget">
										<p><strong>ADD</strong>  262 Milacina Mrest, Behansed, Paris<br/>
										<strong>TEL</strong>  070-7782-9137<br/>
										<strong>MAIL</strong>  contact@mydreamwear.com</p>
										<div class="social">
											<ul>
												<li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#" target="_blank"><i class="fa fa-pinterest"></i></a></li>
												<li><a href="#" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
												<li><a href="#" target="_blank"><i class="fa fa-behance"></i></a></li>
												<li><a href="#" target="_blank"><i class="fa fa-dribbble"></i></a></li>
											</ul>
										</div>
									</div><!-- .textwidget -->
								</aside><!-- .widget -->
							</div><!-- .footer-item -->							
						</div>

						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="footer-item">
								<aside class="widget time-work">
									<h3 class="widget-title">Customer center</h3>
									<strong>070-7782-9137</strong>
									<p>
										working time<br/>
										mon-fri am 09:00 - pm 18:00<br/>
										lunch time pm 12:00 - 13:00
									</p>
									<p>
										sat, sun, holiday of.
									</p>
								</aside><!-- .widget -->
							</div><!-- .footer-item -->							
						</div>

						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="footer-item">
								<aside class="widget nav_menu_widget">
									<h3 class="widget-title">Our service</h3>
									<ul>
										<li><a href="#">Shipping Policy</a></li>
										<li><a href="#">My Account</a></li>
										<li><a href="#">Return Policy</a></li>
										<li><a href="#">Contact Us</a></li>
									</ul>
								</aside><!-- .widget -->
							</div><!-- .footer-item -->
						</div>

						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="footer-item">
								<aside class="widget newsletter-widget">
									<h3 class="widget-title">NEWSLETTER!</h3>
	                                <form action="#">
	                                    <input type="email" placeholder="Your email ...">
	                                    <input type="submit" value="Subcribe">
	                                </form>
	                                <div class="payment">
										<img alt="" src="images/assets/payment.png">
									</div>
								</aside><!-- .widget -->
							</div><!-- .footer-item -->
						</div>
					</div><!-- .row -->
				</div><!-- .footer-widget -->
				
				<div class="row">
					<div class="col-md-12">
						<div class="bot-footer clearfix">
							<nav class="footer-menu">
								<ul>
									<li><a href="#">Privacy & Cookies</a></li>
									<li><a href="#">Terms & Conditions</a></li>
									<li><a href="#">Accessibility</a></li>
									<li><a href="#">Store Directory</a></li>
									<li><a href="#">About Us</a></li>
								</ul>
							</nav><!-- .footer-menu -->

							<div class="copyright">
								<p>Copyrights © 2015 All Rights Reserved by itcthemes.com</p>
							</div><!-- .copyright -->
						</div><!-- .bot-footer -->
					</div>
				</div><!-- .row -->
			</div><!-- .container -->

			<a href="#" class="back-to-top"><span><i class="fa fa-long-arrow-up"></i></span></a>
		</footer><!-- .site-footer -->
	</div><!-- #wrapper -->

	<!-- jQuery -->    
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Boostrap -->    
    <script src="js/vendor/bootstrap.min.js"></script>
    <!-- jQuery Sticky -->    
    <script src="js/vendor/jquery.sticky.js"></script>
    <!-- OWL CAROUSEL Slider -->    
    <script src="js/vendor/owl.carousel.js"></script>
	<!-- PrettyPhoto -->   
    <script src="js/vendor/jquery.prettyPhoto.js"></script>
    <!-- Jquery Countdown -->
    <script src="js/vendor/jquery.countdown.js"></script>
    <!-- Jquery Parallax -->
    <script src="js/vendor/parallax.js"></script>
    <!-- jQuery UI -->
	<script src="js/vendor/jquery-ui.min.js"></script>
	<!-- Jquery Masonry -->
    <script src="js/vendor/masonry.pkgd.min.js"></script>
    <!-- Main -->    
    <script src="js/main.js"></script>



    <!-- Custom scripts -->

	<script>

		(function($) {

			"use strict";



			/*  [ Filter by price ]

			- - - - - - - - - - - - - - - - - - - - */

			$('#slider-range').slider({

				range: true,

				min: 0,

				max: 500,

				values: [0, 300],

				slide: function (event, ui) {

					$('#amount').text('$' + ui.values[0] + ' - $' + ui.values[1]);

				}

			});

			$('#amount').text('$' + $('#slider-range').slider('values', 0) + ' - $' + $('#slider-range').slider('values', 1));



		})(jQuery);

	</script>

</body>

</html>

