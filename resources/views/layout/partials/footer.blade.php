{{-- <!-- Footer -->
			<footer class="footer">
				<div class="footer-top">
					<div class="container">
						<h4>Sign Up For Newsletter</h4>
						{{-- <p>Check out Join 12.000+ Subscribers and get a new discount coupon </p> --}
						<form method="post" action="{{ route('subscribe')}}" class="input-group">
                            @csrf
							<input type="email" name="email" class="form-control" placeholder="Enter your email...">

							<div class="input-group-append">
								<button class="btn btn-secondary" type="submit">
									<i class="fas fa-location-arrow"></i> Subscribe Now
								</button>
							</div><br>

						</form>
						<ul class="mt-4 mb-4">
							<li>
								<a href="#">
									<i class="fab fa-facebook-f"></i>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fab fa-twitter"></i>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fab fa-youtube"></i>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fab fa-linkedin-in"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="footer-bottom">
					<div class="container">
						<ul>
							<li>
								<a href="{{ route('home')}}">Home</a>
							</li>
                            <li>
								<a href="{{ route('about')}}">About</a>
							</li>
							<li>
								<a href="{{ route('services.all')}}">Services</a>
							</li>
							<li>
								<a href="{{ route('login')}}">Login</a>
							</li>
							<li>
								<a href="{{ route('register')}}">Register</a>
							</li>
							<li>
								<a href="#">Blogs</a>
							</li>
                            <li>
								<a href="{{ route('contact')}}">Contact</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="copy-rights mt-5">
					<p>© 2024 The Way We Love Relationship Counseling</p>
				</div>
			</footer>
			<!-- /Footer --> --}}
<!-- footer begin -->
<footer class="footer-black">
	<div class="container relative z-1000">
		<div class="row gx-5">
			<div class="col-lg-4 col-sm-6">
				<img src="{{asset('assets/images/logo.png')}}" alt="" class="mb-3" width="260px" height="65px">
				<div class="spacer-20"></div>
				{{-- <h5>About Us</h5> --}}
				<p>The Way We Love Relationship Counseling
					Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals,
					couples, and families achieve mental health and well-being by fostering a lifestyle of self-care. .</p>
				
			</div>
			<div class="col-lg-4 col-sm-12 order-lg-1 order-sm-2">
				<div class="row">
					<div class="col-lg-6 col-sm-6">
						<div class="widget">
							<h5>Services</h5>
							{{-- <ul>                                        
								<li><a href="#">Individual Therapy</a></li>
								<li><a href="#">Couples Counseling</a></li>
								<li><a href="#">Stress management</a></li>
								<li><a href="#">Anxiety Treatment</a></li>
								<li><a href="#">Depression Therapy</a></li>
							</ul> --}}
						</div>
					</div>
					<div class="col-lg-6 col-sm-6">
						<div class="widget">
							<h5>Pages</h5>
							<ul>
								<li><a href="/about">About Us</a></li>
								<li><a href="/services">Our Services</a></li>
								<li><a href="/programs">Packages</a></li>
								<li><a href="/blog">Blog</a></li>
								<li><a href="/contact">Contact Us</a></li>
								{{-- <li><a href="#">Testimonials</a></li> --}}
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 order-lg-2 order-sm-1">
				<div class="widget">
					<h5>Contact</h5>

					<div class="fw-bold text-dark"><i class="icofont-location-pin me-2 id-color"></i>Office Location</div>
					205 ½ E Broadway, Suite F & G Hopewell VA. 23860

					<div class="spacer-20"></div>

					<div class="fw-bold text-dark"><i class="icofont-envelope me-2 id-color"></i>Send a Message</div>
					contact@thewaywelove.com

					<div class="spacer-20"></div>

					<div class="social-icons mb-sm-30">
						<a href="https://web.facebook.com/profile.php?id=61567812427624"><i class="fa-brands fa-facebook-f"></i></a>
						
						<a href="https://www.instagram.com/coffeewithliz_"><i class="fa-brands fa-instagram"></i></a>
						{{-- <a href="#"><i class="fa-brands fa-youtube"></i></a> --}}
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="subfooter relative z-1000">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="de-flex">
						<div class="de-flex-col">
							© 2024 The Way We Love Relationship Counseling
						</div>
						<ul class="menu-simple">
							<li><a href="/terms">Terms &amp; Conditions</a></li>
							<li><a href="/privacy-policy">Privacy Policy</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<img src="{{asset('assets/images/misc/flowers-crop-3.webp')}}" class="w-20 absolute top-0 end-0 sw-anim" alt="">
</footer>
<!-- footer close -->
</div>
