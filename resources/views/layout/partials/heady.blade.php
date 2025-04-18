<?php error_reporting(0); ?>

<body>
    <style>
        #cartquantity{
            position: relative;
            right: 20px;
            background-color: rgba(43, 128, 0, 0.748);
            width: 20px;
            height: 20px;
            border-radius: 100%;
            font-size: 10px;
        }

        /* Navbar toggler styling */
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            width: 1.5em;
            height: 1.5em;
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }

        /* Mobile navbar styling for slide-in effect */
        #mobileNavbar {
            position: fixed;
            top: 0;
            right: -300px; /* Start off-screen */
            width: 280px;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1050;
            padding: 20px;
            transition: all 0.3s ease;
            opacity: 0;
            overflow-y: auto;
        }

        #mobileNavbar.show {
            right: 0;
            opacity: 1;
        }

        /* Close button for mobile menu */
        .mobile-menu-close {
            position: absolute;
            top: 15px;
            right: 15px;
            color: white;
            font-size: 20px;
            cursor: pointer;
            background: none;
            border: none;
        }

        /* Mobile menu styling */
        #mobileNavbar .navbar-nav {
            margin-top: 50px;
        }

        #mobileNavbar .nav-item {
            margin: 10px 0;
        }

        #mobileNavbar .nav-link {
            color: white;
            font-size: 18px;
            padding: 10px 0;
            display: block;
            transition: all 0.2s ease;
        }

        #mobileNavbar .nav-link:hover {
            color: #ccc;
        }

        /* Improved dropdown styling */
        #mobileNavbar .dropdown-toggle {
            position: relative;
            padding-right: 25px;
        }

        #mobileNavbar .dropdown-toggle::after {
            content: '';
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid white;
            transition: transform 0.3s ease;
        }

        #mobileNavbar .dropdown-toggle.show::after {
            transform: translateY(-50%) rotate(180deg);
        }

        #mobileNavbar .dropdown-menu {
            background-color: rgba(0, 0, 0, 0.7);
            border: none;
            padding: 0 0 0 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            display: block;
            opacity: 0;
        }

        #mobileNavbar .dropdown-menu.show {
            max-height: 200px; /* Adjust as needed */
            opacity: 1;
        }

        #mobileNavbar .dropdown-item {
            color: white;
            padding: 8px 15px;
            opacity: 0.8;
        }

        #mobileNavbar .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            opacity: 1;
        }

        /* Overlay for when mobile menu is open */
        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }

        .mobile-menu-overlay.show {
            display: block;
        }

        /* Mobile menu buttons styling */
        #mobileNavbar .mobile-menu-buttons {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        #mobileNavbar .btn-main {
            display: inline-block;
            text-align: center;
            color: black;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        #mobileNavbar .btn-success {
            background-color: #bbbbbb;
        }

        #mobileNavbar .btn-main:not(.btn-success) {
            background-color: #bbbbbb;
        }

        #mobileNavbar .btn-main:hover {
            opacity: 0.9;
        }

        /* Body class to prevent scrolling */
        body.no-scroll {
            overflow: hidden;
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
                        <!-- Mobile Toggle Button -->
                        <button class="d-block d-lg-none navbar-toggler ms-auto" type="button" id="mobileMenuToggle"
                            aria-label="Toggle navigation"
                            style="border: none; background: transparent;">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="de-flex-col header-col-mid">
                            <ul id="mainmenu">
                                <li><a class="menu-item {{ Request::is('home') ? 'active' : '' }}"
                                        href="/">Home</a>
                                </li>
                                <li><a
                                        class="{{ Request::is('about') ? 'active' : '' }} menu-item"href="{{ route('about') }}">About
                                        Us</a>
                                </li>
                                <li><a class="{{ Request::is('programs') ? 'active' : '' }} menu-item"
                                        href="{{ route('programs.all') }}"><b>Program</b></a>
                                </li>
                                <li><a class="{{ Request::is('blogs') ? 'active' : '' }} menu-item"
                                    href="/blogs"><b>Blogs</b></a>
                                <ul>
                                    <li><a class="menu-item {{ Request::is('services') ? 'active' : '' }}" href="/services">Services</a></li>
                                    <li><a class="menu-item {{ Request::is('events') ? 'active' : '' }}" href="/events">Events</a></li>
                                    <li><a class="menu-item {{ Request::is('blogs') ? 'active' : '' }}" href="/podcasts">Podcast</a></li>
                                    <li><a class="menu-item {{ Request::is('blogs') ? 'active' : '' }}" href="/videos">Vidoes</a></li>
                                </ul>
                            </li>
                                <li> <a class="{{ Request::is('contact') ? 'active' : '' }} menu-item"
                                        href="{{ route('contact') }}">Contact</a>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Overlay for mobile menu -->
                        <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

                        <!-- Mobile Menu with slide-in effect -->
                        <div class="navbar-collapse d-lg-none" id="mobileNavbar">
                            <button class="mobile-menu-close" id="mobileMenuClose">&times;</button>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('programs') ? 'active' : '' }}" href="{{ route('programs.all') }}"><b>Program</b></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle {{ Request::is('blogs') ? 'active' : '' }}" href="#" id="navbarDropdownMobile"
                                       role="button">
                                        <b>Blogs</b>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMobile">
                                        <li><a class="dropdown-item" href="/services">Services</a></li>
                                        <li><a class="dropdown-item" href="/events">Events</a></li>
                                        <li><a class="dropdown-item" href="/podcasts">Podcast</a></li>
                                        <li><a class="dropdown-item" href="/videos">Videos</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                                </li>
                            </ul>
                            
                            <!-- Added Login and Appointment buttons -->
                            <div class="mobile-menu-buttons">
                                <a href="/login" class="btn-main btn-success {{ Request::is('login') ? 'active' : '' }}">Login</a>
                                <a href="/register" class="btn-main">Appointment</a>
                            </div>
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
            
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Elements
                    const menuToggle = document.getElementById('mobileMenuToggle');
                    const mobileMenu = document.getElementById('mobileNavbar');
                    const mobileMenuClose = document.getElementById('mobileMenuClose');
                    const overlay = document.getElementById('mobileMenuOverlay');
                    const dropdownToggles = document.querySelectorAll('#mobileNavbar .dropdown-toggle');
                    
                    // Toggle mobile menu
                    menuToggle.addEventListener('click', function() {
                        mobileMenu.classList.add('show');
                        overlay.classList.add('show');
                        document.body.classList.add('no-scroll'); // Prevent body scrolling
                    });
                    
                    // Close menu function
                    function closeMenu() {
                        mobileMenu.classList.remove('show');
                        overlay.classList.remove('show');
                        document.body.classList.remove('no-scroll'); // Re-enable body scrolling
                    }
                    
                    // Close button event
                    if (mobileMenuClose) {
                        mobileMenuClose.addEventListener('click', closeMenu);
                    }
                    
                    // Close when clicking on overlay
                    if (overlay) {
                        overlay.addEventListener('click', closeMenu);
                    }
                    
                    // Improved dropdown toggle handling
                    dropdownToggles.forEach(function(toggle) {
                        toggle.addEventListener('click', function(e) {
                            e.preventDefault();
                            
                            // Toggle this dropdown
                            this.classList.toggle('show');
                            const dropdownMenu = this.nextElementSibling;
                            dropdownMenu.classList.toggle('show');
                            
                            // Close other open dropdowns
                            dropdownToggles.forEach(function(otherToggle) {
                                if (otherToggle !== toggle && otherToggle.classList.contains('show')) {
                                    otherToggle.classList.remove('show');
                                    otherToggle.nextElementSibling.classList.remove('show');
                                }
                            });
                            
                            // If this is a blog link and it's showing now, prevent navigation
                            if (this.getAttribute('href') === '/blogs' && this.classList.contains('show')) {
                                e.preventDefault();
                            }
                        });
                    });
                    
                    // Close menu when clicking menu items that aren't dropdowns
                    const menuItems = document.querySelectorAll('#mobileNavbar .nav-link:not(.dropdown-toggle)');
                    menuItems.forEach(item => {
                        item.addEventListener('click', closeMenu);
                    });

                    // Close menu when clicking dropdown items
                    const dropdownItems = document.querySelectorAll('#mobileNavbar .dropdown-item');
                    dropdownItems.forEach(item => {
                        item.addEventListener('click', closeMenu);
                    });

                    // Close menu when clicking the Login or Appointment buttons
                    const menuButtons = document.querySelectorAll('#mobileNavbar .btn-main');
                    menuButtons.forEach(button => {
                        button.addEventListener('click', closeMenu);
                    });
                });
            </script>
        </body>