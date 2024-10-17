<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'The way we love counselling' }}</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_NG">
    <meta property="og:url" content="{{ \URL::current() }}">
    <meta property="og:title" content="{{ $title ?? 'The way we love counselling' }}">
    <meta property="og:description"  content="{{ $description ?? 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.' }}">
    <meta property="og:image" content="{{ $logo ?? asset('guest/images/meta-logo.png') }}">

    <meta property="twitter:type" content="website">
    <meta property="twitter:locale" content="en_NG">
    <meta property="twitter:url" content="{{ \URL::current() }}">
    <meta property="twitter:title" content="{{ $title ?? 'The way we love counselling' }}">
    <meta property="twitter:description"  content="{{ $description ?? 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.' }}">
    <meta property="twitter:image" content="{{ $logo ?? asset('guest/images/meta-logo.png') }}">

    <meta name="google:card" content="summary_large_image">
    <meta name="google:url" content="{{ \URL::current() }}">
    <meta name="google:description" content="{{ $description ?? 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.' }}">
    <meta name="google:title" content="{{ $title ?? 'The way we love counselling' }}">
    <meta name="google:image" content="{{ $logo ?? asset('guest/images/meta-logo.png') }}">

    <meta name="description" content="{{ $description ?? 'Was born out of a deep desire to serve and mend relationships. We are committed to helping individuals, couples, and families achieve mental health and well-being by  fostering a lifestyle of self-care. Through our work, we guide clients in identifying the core values that bring them happiness and fulfillment in their  relationships, empowering them to build stronger, more meaningful connections.' }}" />
    <meta name="author" content="The way we love counselling" />
    <meta name="url" content="{{ \URL::current() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="The way we love counselling" />
    <link href="{{ asset('guest/images/favicon.png')}}" rel="icon">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fancybox/jquery.fancybox.min.css')}}">
		<!-- Daterangepikcer CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
		<!-- Full Calander CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar/fullcalendar.min.css')}}">
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}">
		<link rel="stylesheet" href="{{asset('assets/plugins/dropzone/dropzone.min.css')}}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>
    @include('layouts.partials.navbar')
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
