@extends('layout.mainlayout')
@section('title')
    Our Events
@endsection

@section('content')
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-0">Event</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Event</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- /Breadcrumb -->
    <section class="relative overflow-hidden pb60">
        <img src="images/misc/flowers-crop-2.webp" class="w-30 absolute top-0 start-0 sw-anim" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <div class="subtitle wow fadeInUp mb-3">Our Events</div>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Events &amp; <span
                            class="alt-font fw-500 fs-64 id-color-2">Training</span></h2>
                    <div class="spacer-half"></div>
                </div>
            </div>

            <div class="row g-4">
                @foreach($events as $event)
                <div class="col-lg-4 col-sm-6">
                    <div class="relative mb-3">
                        <a href="{{ route('events.show',$event->id)}}" class="d-block hover mb-3">
                            <div class="relative overflow-hidden rounded-20px shadow-soft">
                                <img src="{{ asset('guest/images/uploads/'.$event->image)}}" class="w-50 end-0 absolute hover-op-0"
                                    alt="">
                                <div class="absolute start-0 w-100 abs-middle fs-36 text-white text-center">
                                    <span class="btn-main hover-scale-in-2">Read More</span>
                                </div>
                                <img src="{{ asset('guest/images/uploads/'.$event->image)}}" class="img-fluid hover-scale-1-2" alt="">
                            </div>
                        </a>
                        <h4>{{ $event->event_title}}</h4>
                        <p class="no-bottom">{!! Str::limit($event->description,200) !!}</p>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="spacer-double"></div>
        </div>
    </section>
</div>
@endsection
