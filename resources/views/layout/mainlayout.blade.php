<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head')
    <link rel="stylesheet" href="https://nacomns.fra1.digitaloceanspaces.com/portal/staff/assets/vendor/toastr/css/toastr.min.css"/>
    <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
</head>
  @if(Route::is(['map-grid','map-list']))
  <body class="map-page">
  @endif
  @if(Route::is(['chat-councellor','chat']))
  <body class="chat-page">
  @endif
  @if(Route::is(['forgot-password','login','register','councellor-register']))
  <body class="account-page">
  @endif
  @if(Route::is(['video-call','voice-call']))
  <body class="call-page containter">
  @endif
@include('layout.partials.header')
{{-- @livewire('guest.guest-navigation') --}}
@yield('content')
@if(!Route::is(['chat-councellor','map-grid','map-list','chat','voice-call','video-call']))
@include('layout.partials.footer')
@endif
@include('layout.partials.footer-scripts')




<script src="https://nacomns.fra1.digitaloceanspaces.com/portal/staff/assets/vendor/toastr/js/toastr.min.js"></script>
<script src="https://nacomns.fra1.digitaloceanspaces.com/portal/staff/assets/js/plugins-init/toastr-init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
<x-confirm-alert/>
<x-toast-notification/>

  </body>
</html>
