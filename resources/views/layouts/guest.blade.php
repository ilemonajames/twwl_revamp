<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://nacomns.fra1.digitaloceanspaces.com/portal/staff/assets/vendor/toastr/css/toastr.min.css"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
        <script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>


        <script src="https://nacomns.fra1.digitaloceanspaces.com/portal/staff/assets/vendor/toastr/js/toastr.min.js"></script>
    <script src="https://nacomns.fra1.digitaloceanspaces.com/portal/staff/assets/js/plugins-init/toastr-init.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <x-confirm-alert/>
    <x-toast-notification/>
    </body>

</html>
