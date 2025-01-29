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
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
       
            <script src="https://www.google.com/recaptcha/enterprise.js?render=6LdBucYqAAAAAIQdZIZSDx-ySzCydJFpCZuA0qHN"></script>
            

        <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- color scheme -->
        <link id="colors" href="{{ asset('assets/css/colors/scheme-02.css/') }}" rel="stylesheet" type="text/css" >
        <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/676937deaf5bfec1dbe09dd6/1ifpg4glh';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

    </head>
