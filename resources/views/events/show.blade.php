@extends('layout.mainlayout')
@section('title')
    Our Events
@endsection

@section('content')
<style>
    <style>body {
        font-family: 'Arial', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background: linear-gradient(to bottom, #ff7e5f, #feb47b);
        color: #fff;
        text-align: center;
    }

    .countdown {
        background: rgba(0, 0, 0, 0.5);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    .countdown h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: white;
        font-weight: bolder;
    }

    .timer {
        display: flex;
        justify-content: center;
        gap: 20px;
        font-size: 1.5rem;
    }

    .time-box {
        color: white;
        text-align: center;
    }

    .time-box span {
        display: block;
        font-size: 3rem;
        font-weight: bold;
    }
</style>
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-0">Events</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Events</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden">
        {{-- <img src="{{ asset('guest/images/uploads/'.$event->image)}}" class="w-40 absolute top-0 end-10 sw-anim" alt=""> --}}

        <div class="container">
            <div class="row align-items-center g-4 gx-5">
                <div class="col-lg-6">
                    <div class="subtitle wow fadeInUp mb-3">Our Event</div>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">{{ $event->event_title }}</h2>
                    <p class="lead">{!! $event->description !!}</p>

                    <div class="fs-14 text-dark fw-500">Start from</div>
                    <div class="mb-3">
                        <h2 class="d-inline id-color-2">{{ $event->type_of_event }}</h2><span class="fs-14">/{{ $event->event_location }}</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('guest/images/uploads/'.$event->image)}}" class="img-fluid rounded-20px" alt="">
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
