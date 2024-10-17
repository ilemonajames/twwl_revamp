<?php error_reporting(0);?>
<!-- Loader -->
{{-- @if(Route::is(['map-grid','map-list']))
<div id="loader">
		<div class="loader">
			<span></span>
			<span></span>
		</div>
	</div>
	@endif
	<!-- /Loader  -->
<!-- Main Wrapper -->
		<div class="main-wrapper ">
			<!-- Top Header -->
			<div class="top-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<a href="{{ route('home')}}" class="navbar-brand logo">
								<img src="{{ asset('assets/img/logo2.png')}}" class="img-fluid" alt="Logo">
							</a>
						</div>
					
						<div class="col d-flex align-items-center justify-content-end">
							<ul class="d-flex">
                                <li class="call-div">
									<i class="fas fa-phone-alt"></i>
									<div>
										{{-- <h4>Free Call</h4> --
										<h6>+(804) 721-0983</h6>
									</div>
								</li>
							
								<li class="header-social-media">
									<a href="#">
										<i class="fab fa-facebook-f"></i>
									</a>
									<a href="#">
										<i class="fab fa-twitter"></i>
									</a>
									<a href="#">
										<i class="fab fa-youtube"></i>
									</a>
									{{-- <a href="#">
										<i class="fab fa-linkedin-in"></i>
									</a> --
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- Top Header -->

			<!-- Header -->
			<header class="header ml-auto">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="{{ route('home')}}" class="menu-logo">
								<img src="{{ asset('assets/img/logo2.png')}}" class="img-fluid" alt="Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);">
								<i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">
							<li class="{{ Request::is('/') ? 'active' : '' }}">
								<a href="{{ route('home') }}"><b>Home</b></a>
							</li>
							<li class="{{ Request::is('about') ? 'active' : '' }}">
								<a href="{{ route('about') }}"><b>About Us</b></a>
							</li>
							<li class="{{ Request::is('services') ? 'active' : '' }}">
								<a href="{{ route('services.all') }}"><b>Services</b></a>
							</li>
							{{-- <li class="{{ Request::is('find-counselor') ? 'active' : '' }}">
								<a href="#"><b>Mission</b></a>
							</li> --
							<li class="has-submenu {{ Request::is('resources') ? 'active' : '' }} "><a href="#"><b>Resources</b></a>
								<ul class="submenu">
									<li><a href="{{ route('resources.all') }}">All Resources</a></li>
									<li><a href="{{ route('resources.videos') }}">Videos</a></li>	
									<li><a href="{{ route('resources.podcasts') }}">Podcasts</a></li>
									<li><a href="{{ route('resources.books') }}">Books</a></li>
									<li><a href="{{ route('resources.articles') }}">Articles</a></li>
								</ul>
							</li>
                            {{-- <li class="sub-menu {{ Request::is('blogs') ? 'active' : '' }} ">
								<a href="{{ route('blogs.all')}}"><b>Blog</b></a>
								<ul class="sub-menu"><li class="active">Podcast</li><li class="sub-menu-item">Videos</li></ul>
							</li> --

                            <li class="{{ Request::is('programs') ? 'active' : '' }}">
								<a href="{{ route('programs.all')}}"><b>Program</b></a>
							</li>
							<li class="{{ Request::is('contact') ? 'active' : '' }}">
								<a href="{{ route('contact') }}"><b>Contact</b></a>
							</li>
							<li class="{{ Request::is('frequently-asked-question') ? 'active' : '' }}">
								<a href="{{route('faq')}}"><b>FAQ</b></a>
							</li>
							<li class="login-link">
								<a href="login">Login / Signup</a>
							</li>
						</ul>
					</div>
					<ul class="nav header-navbar-rht">
					@guest

						<li>
							<a href="checkout"><i class="fas fa-shopping-cart"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link header-login" href="login">login / Signup </a>
						</li>
                    @else
                    <li class="nav-item dropdown has-arrow logged-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img">
                                <img class="rounded-circle" src="{{ asset('assets/images/users/'.Auth::user()->profile_photo_path) }}" width="31" alt="Darren Elder">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="{{ asset('assets/images/users/'.Auth::user()->profile_photo_path) }}" alt="User Image" class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">
                                    <h6>{{ Auth::user()->surname." ".Auth::user()->othernames}}</h6>
                                    <p class="text-muted mb-0">{{ Auth::user()->user_type }}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('dashboard')}}">Dashboard</a>
                            {{-- <a class="dropdown-item" href="#">Profile Settings</a> --
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">  @csrf</form>Logout</a>
                        </div>
                    </li>
                    @if(Auth::user()->user_type=="Client")

                    <li class="nav-item">
                        <a class="nav-link header-login" href="{{ route('client.book')}}">Book Appointment </a>
                    </li>
                    @endif
                    @endguest

					</ul>
				</nav>
			</header>
			<!-- /Header -->
        </div> --}}


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
				<header class="transparent scroll-light">
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
											<li><a class="menu-item" href="index.html">Home</a>
												{{-- <ul>
													<li><a class="menu-item" href="index.html">Homepage One</a></li>
													<li><a class="menu-item" href="homepage-2.html">Homepage Two</a></li>
													<li><a class="menu-item" href="homepage-3.html">Homepage Three</a></li>
													<li><a class="menu-item" href="homepage-4.html">Homepage Four</a></li>
												</ul> --}}
											</li>
											<li><a class="menu-item" href="#">Services</a>
												{{-- <ul>
													<li><a class="menu-item" href="services.html">Services Style 1</a></li>
													<li><a class="menu-item" href="services-2.html">Services Style 2</a></li>
													<li><a class="menu-item" href="services-3.html">Services Style 3</a></li>
													<li><a class="menu-item" href="service-single.html">Services Single</a></li>
													<li><a class="menu-item" href="appointment.html">Appointment</a></li>
												</ul> --}}
											</li>
											<li class="{{ Request::is('about') ? 'active' : '' }} menu-item">
												<a href="{{ route('about') }}"><b>About Us</b></a>
											</li>
											<li class="{{ Request::is('programs') ? 'active' : '' }} menu-item">
												<a href="{{ route('programs.all')}}"><b>Program</b></a>
											</li>
											<li class="{{ Request::is('contact') ? 'active' : '' }} menu-item">
												<a href="{{ route('contact') }}"><b>Contact</b></a>
											</li>
											<li class="{{ Request::is('frequently-asked-question') ? 'active' : '' }} menu-item">
												<a href="{{route('faq')}}"><b>FAQ</b></a>
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
											<a href="/bookings" class="btn-main">Book an Appointment</a>
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

