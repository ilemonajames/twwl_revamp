<?php error_reporting(0);?>

		<body>
			<div id="wrapper">
				<div class="float-text show-on-scroll">
					<span><a href="#">Scroll to top</a></span>
				</div>
				<div class="scrollbar-v show-on-scroll"></div>
				
				<!-- page preloader begin -->
				<div id="de-loader"></div>
				<!-- page preloader close -->
		
				<!-- header begin -->
				@if(Route::is(['/','home']))
				<header class="transparent scroll-light">

@else
					<header class="transparent header-light">
						@endif
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="de-flex sm-pt10">
									<div class="de-flex-col">
										<!-- logo begin -->
										<div id="logo">
											<a href="/">
												{{-- <img class="logo-main" src="images/logo.webp" alt="" > --}}
												<img src="{{ asset('assets/images/logo.png')}}" class="logo-main" alt="Logo">
												<img class="logo-scroll" src="{{asset('assets/images/logo_black.png') }}" alt="" >
												<img class="logo-mobile" src="{{asset('assets/images/logo_black.png') }}" alt="" >
											</a>
										</div>
										<!-- logo close -->
									</div>
									<div class="de-flex-col header-col-mid">
										<ul id="mainmenu">
											<li><a class="menu-item" href="/">Home</a>
												
											</li>
											<li class="{{ Request::is('about') ? 'active' : '' }} menu-item">
												<a href="{{ route('about') }}"><b>About Us</b></a>
											</li>
											<li><a class="menu-item" href="/services">Services</a>
												
											</li>
											
											<li class="{{ Request::is('programs') ? 'active' : '' }} menu-item">
												<a href="{{ route('programs.all')}}"><b>Program</b></a>
											</li>
											
											<li class="{{ Request::is('blogs') ? 'active' : '' }} menu-item">
												<a href="/blogs"><b>Blog</b></a>
												<ul>
													<li><a class="menu-item" href="/podcasts">Podcast</a></li>
													<li><a class="menu-item" href="/videos">Vidoes</a></li>
												</ul>
											</li>
											<li class="{{ Request::is('contact') ? 'active' : '' }} menu-item">
												<a href="{{ route('contact') }}"><b>Contact</b></a>
											</li>
											{{-- <li class="login-link menu-item">
												<a href="login">Login / Signup</a>
											</li> --}}
											{{-- <li><a class="menu-item" href="study-case.html">Study Case</a></li>
											<li><a class="menu-item" href="blog.html">Blog</a></li>
											<li><a class="menu-item" href="contact.html">Contact</a></li> --}}
										</ul>
									</div>
									<div class="de-flex-col">
										<div class="menu_side_area">
											<div class="h-phone sm-hide">
												<i class="icofont-headphone-alt"></i>
												<span>Phone</span>+(804) 721-0983
											</div>                                    
											<a href="/booking" class="btn-main">Book an Appointment</a>
											<span id="menu-btn"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</header>
				<!-- header close -->
				<div class="no-bottom no-top" id="content">

					<div id="top"></div>

