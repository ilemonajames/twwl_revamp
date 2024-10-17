{{-- 
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>@yield('title','The way we love counselling')</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

        <meta property="og:type" content="website">
        <meta property="og:locale" content="en_NG">
        <meta property="og:url" content="{{ \URL::current() }}">
        <meta property="og:title" content="@yield('title','The way we love counselling')">
        <meta property="og:description"  content="@yield('description', 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.')">
        <meta property="og:image" content="@yield('title', asset('guest/images/meta-logo.png'))">

        <meta property="twitter:type" content="website">
        <meta property="twitter:locale" content="en_NG">
        <meta property="twitter:url" content="{{ \URL::current() }}">
        <meta property="twitter:title" content="@yield('title','The way we love counselling')">
        <meta property="twitter:description"  content="@yield('description', 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.')">
        <meta property="twitter:image" content="@yield('title', asset('guest/images/meta-logo.png'))">

        <meta name="google:card" content="summary_large_image">
        <meta name="google:url" content="{{ \URL::current() }}">
        <meta name="google:description" content="@yield('description', 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.')">
        <meta name="google:title" content="@yield('title','The way we love counselling')">
        <meta name="google:image" content="@yield('title', asset('guest/images/meta-logo.png'))">

        <meta name="description" content="@yield('description', 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.' )" />
        <meta name="author" content="The way we love counselling" />
        <meta name="url" content="{{ \URL::current() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="keywords" content="The way we love counselling" />
        <link href="{{ asset('guest/images/favicon.png')}}" rel="icon">

		<!-- Favicons -->
		<link type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}" rel="icon">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/fancybox/jquery.fancybox.min.css') }}">
		<!-- Daterangepikcer CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
		<!-- Full Calander CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.css') }}">
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css' integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <title>@yield('title','The way we love counselling')</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

        <meta property="og:type" content="website">
        <meta property="og:locale" content="en_NG">
        <meta property="og:url" content="{{ \URL::current() }}">
        <meta property="og:title" content="@yield('title','The way we love counselling')">
        <meta property="og:description"  content="@yield('description', 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.')">
        <meta property="og:image" content="@yield('title', asset('guest/images/meta-logo.png'))">

        <meta property="twitter:type" content="website">
        <meta property="twitter:locale" content="en_NG">
        <meta property="twitter:url" content="{{ \URL::current() }}">
        <meta property="twitter:title" content="@yield('title','The way we love counselling')">
        <meta property="twitter:description"  content="@yield('description', 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.')">
        <meta property="twitter:image" content="@yield('title', asset('guest/images/meta-logo.png'))">

        <meta name="google:card" content="summary_large_image">
        <meta name="google:url" content="{{ \URL::current() }}">
        <meta name="google:description" content="@yield('description', 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.')">
        <meta name="google:title" content="@yield('title','The way we love counselling')">
        <meta name="google:image" content="@yield('title', asset('guest/images/meta-logo.png'))">

        <meta name="description" content="@yield('description', 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.' )" />
        <meta name="author" content="The way we love counselling" />
        <meta name="url" content="{{ \URL::current() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="keywords" content="The way we love counselling" />
        <!-- CSS Files
        ================================================== -->
        <link href="{{ asset('assets/css/bootstrap.min.css/') }}" rel="stylesheet" type="text/css" id="bootstrap">
        <link href="{{ asset('assets/css/plugins.css/') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('assets/css/swiper.css/') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('assets/css/style.css/') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('assets/css/coloring.css/') }}" rel="stylesheet" type="text/css" >
        <!-- color scheme -->
        <link id="colors" href="{{ asset('assets/css/colors/scheme-02.css/') }}" rel="stylesheet" type="text/css" >
    
    </head>
    