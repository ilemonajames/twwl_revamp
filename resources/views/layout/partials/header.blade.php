<?php error_reporting(0); ?>

<body>
    <style>
        #cartquantity{
            position: relative;
            right: 20px;
            background-color: green;
            width: 20px;
            height: 20px;

            border-radius: 100%;
            font-size: 10px;
        }
    </style>
    <div id="wrapper">
        <div class="float-text show-on-scroll">
            <span><a href="#">Scroll to top</a></span>
        </div>
        <div class="scrollbar-v show-on-scroll"></div>

        <!-- page preloader begin -->
        <div id="de-loader"></div>
        <!-- page preloader close -->

        <!-- header begin -->
        @if (Route::is(['/', 'home']))
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
                                    <img src="{{ asset('assets/images/logo.png') }}" class="logo-main" alt="Logo">
                                    <img class="logo-scroll" src="{{ asset('assets/images/logo_black.png') }}"
                                        alt="">
                                    <img class="logo-mobile" src="{{ asset('assets/images/logo_black.png') }}"
                                        alt="">
                                </a>
                            </div>
                            <!-- logo close -->
                        </div>

                        <div class="de-flex-col header-col-mid">

                            <ul id="mainmenu">

                                <li><a class="menu-item {{ Request::is('home') ? 'active' : '' }}"
                                        href="/">Home</a>

                                </li>
                                <li><a
                                        class="{{ Request::is('about') ? 'active' : '' }} menu-item"href="{{ route('about') }}">About
                                        Us</a>
                                </li>
                                <li><a class="menu-item {{ Request::is('services') ? 'active' : '' }}"
                                        href="/services">Services</a>

                                </li>

                                {{-- <li><a class="{{ Request::is('programs') ? 'active' : '' }} menu-item"
                                        href="{{ route('programs.all') }}"><b>Program</b></a>
                                </li> --}}

                                <li><a class="{{ Request::is('resource') ? 'active' : '' }} menu-item"
                                    href="#"><b>Resource</b></a>
                                <ul>
                                    <li><a class="menu-item {{ Request::is('programs') ? 'active' : '' }}" href="/podcasts">Program</a></li>
                                    <li><a class="menu-item {{ Request::is('events') ? 'active' : '' }}" href="/events">Events</a></li>
                                    <li><a class="menu-item {{ Request::is('blogs') ? 'active' : '' }}" href="/podcasts">Podcast</a></li>
                                    <li><a class="menu-item {{ Request::is('blogs') ? 'active' : '' }}" href="/videos">Vidoes</a></li>
                                </ul>
                            </li>
                                {{-- <li><a class="{{ Request::is('blogs') ? 'active' : '' }} menu-item"
                                        href="/blogs"><b>Blog</b></a>
                                    <ul>
                                        <li><a class="menu-item {{ Request::is('blogs') ? 'active' : '' }}"
                                                href="/podcasts">Podcast</a></li>
                                        <li><a class="menu-item {{ Request::is('blogs') ? 'active' : '' }}"
                                                href="/videos">Vidoes</a></li>
                                    </ul>
                                </li> --}}
                                <li> <a class="{{ Request::is('contact') ? 'active' : '' }} menu-item"
                                        href="{{ route('contact') }}">Contact</a>
                                </li>
                                {{-- <li><a href="/login" class="menu-item btn-success sm-hide btn  " {{ Request::is('login') ? 'active' : '' }}>Login</a>
												</li> --}}
                                {{-- <li class="sm-hide"> <a class="{{ Request::is('login') ? 'active' : '' }} menu-item " href="{{ route('login') }}">Login</a>
												</li> --}}

                            </ul>
                        </div>
                        @guest
                        @livewire('guest.guest-navigation')
                        @else
                            <!--User Profile-->
                            <div class="widget-profile pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="#" class="booking-counc-img">
                                        <img src="{{ asset('assets/images/users/' . Auth::user()->profile_photo_path) }}">
                                    </a>
                                    <div class="profile-det-info">
                                        <h4>{{ Auth::user()->surname . ' ' . Auth::user()->othernames }}</h4>
                                        <div class="patient-details">
                                            <h5 class="mb-0">({{ Auth::user()->user_type }})</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--User Profile end-->
                        @endguest

                    </div>
                </div>
            </div>
        </div>
        </header>
        <!-- header close -->
        <div class="no-bottom no-top" id="content">

            <div id="top"></div>
