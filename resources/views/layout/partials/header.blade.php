
<?php error_reporting(0); ?>
<body>
    
<style>
#cartquantity {
    position: relative;
    right: 20px;
    background-color: rgba(43, 128, 0, 0.748);
    width: 20px;
    height: 20px;
    border-radius: 100%;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

</style>
<header class="navbar navbar-expand-lg navbar-light bg-light transparent scroll-light" id="wrapper">
    <div class="float-text show-on-scroll">
            <span><a href="#">Scroll to top</a></span>
        </div>
        <div class="scrollbar-v show-on-scroll"></div>

        <!-- page preloader begin -->
        <div id="de-loader"></div>
        <!-- page preloader close -->
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="logo-main">
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
                    <a class="nav-link dropdown-toggle {{ Request::is('blogs') ? 'active' : '' }}" href="/blogs" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <b>Blogs</b>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
        </div>

        <!-- User Profile Section -->
        @guest
            @livewire('guest.guest-navigation')
        @else
            <div class="widget-profile pro-widget-content">
                <div class="profile-info-widget">
                    <a href="#" class="booking-counc-img">
                        <img src="{{ asset('assets/images/users/' . Auth::user()->profile_photo_path) }}" alt="Profile">
                    </a>
                    <div class="profile-det-info">
                        <h4>{{ Auth::user()->surname . ' ' . Auth::user()->othernames }}</h4>
                        <div class="patient-details">
                            <h5 class="mb-0">({{ Auth::user()->user_type }})</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
    </div>
</header>