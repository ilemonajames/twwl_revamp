<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.partials.head')
    <link rel="stylesheet" href="https://nacomns.fra1.digitaloceanspaces.com/portal/staff/assets/vendor/toastr/css/toastr.min.css">
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('assets/css/site-refinements.css') }}?v={{ filemtime(public_path('assets/css/site-refinements.css')) }}">
    @stack('styles')
</head>
<body @class(['site-public', 'site-home-page' => Route::is('home'), 'account-page' => Route::is(['password.*', 'login', 'register'])])>
    <a href="#site-main" class="site-skip-link">Skip to content</a>
    @include('layout.partials.heady')
    <main id="site-main">
    @yield('content')
    {{ $slot ?? '' }}
    </main>
    @include('layout.partials.footer')
    @include('layout.partials.footer-scripts')
    @livewireScripts
    <script src="https://nacomns.fra1.digitaloceanspaces.com/portal/staff/assets/vendor/toastr/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <x-confirm-alert/>
    <x-toast-notification/>
    @stack('scripts')
</body>
</html>
