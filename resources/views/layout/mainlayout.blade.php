<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head')
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
@yield('content')
@if(!Route::is(['chat-councellor','map-grid','map-list','chat','voice-call','video-call']))
@include('layout.partials.footer')
@endif
@include('layout.partials.footer-scripts')
  </body>
</html>
