@extends('layout.mainlayout')

@section('content')

 <!-- content begin -->
 <div id="content" class="no-top no-bottom">
    <div id="top"></div>
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-0">Our Services</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Services</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <section class="relative overflow-hidden pb60">
        <img src="images/misc/flowers-crop-2.webp" class="w-30 absolute top-0 start-0 sw-anim" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <div class="subtitle wow fadeInUp mb-3">Our Services</div>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s"> Plans  &amp; <span class="alt-font fw-500 fs-64 id-color-2">Packages</span></h2>
                    <div class="spacer-half"></div>
                </div>
            </div>
            <div class="row g-4">
            @php
             $sn   = 1;
            @endphp

           @foreach($services as $service)

                <div class="col-lg-4 col-sm-6">
                    <div class="relative">
                        <a href="services/{{ $service->id }}" class="d-block hover">
                            <div class="relative overflow-hidden rounded-10px shadow-soft">
                                {{-- <img src="{{asset('assets/images/misc/flowers-crop-5-white.webp')}}" class="w-50 start-0 bottom-0 absolute hover-op-0" alt=""> --}}
                                <div class="absolute start-0 w-100 hover-op-0 abs-middle text-center">
                                    <h3 class="text-white">{{$service->service_title}}</h3>
                                </div>
                                <div class="absolute start-0 w-100 hover-op-1 p-5 abs-middle z-2 text-center text-white">
                                    <p class="no-bottom">{{$service->service_description ? Str::limit($service->service_description, 150) : ''}}
                                        .</p>
                                </div>
                                <div class="absolute start-0 w-100 h-100 bg-dark-op-50 hover-op-1"></div>
                                <img src="{{asset('assets/images/services/'.$sn++.'.webp')}}" class="img-fluid hover-scale-1-2" alt="">
                            </div>
                        </a>
                    </div>
                </div>
           
            @endforeach
            </div>
        
            <div class="spacer-double"></div>
        </div>
    </section>

    <section class="no-top no-bottom">
        <div class="container-fluid">
            <div class="row g-0">
                <div class="col-lg-6 col-md-6">
                    <div class="relative p-5 text-center h-100 bg-color text-light">
                        <i class="d-block fs-40 mb-2 icofont-clock-time"></i>
                        <h3>Schedule Your Appointment Today!</h3>
                        Tue, & Thu, 10 am -6PM <br>
                        Satu 11am- 4PM & <br>
                        Sun 4-6PM<br>
                        <a class="btn-main btn-light-trans text-light mt-3" href="/bookings">Book an Appointment</a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="relative p-5 text-center h-100 bg-color-2 text-light">
                        <i class="d-block fs-40 mb-2 icofont-location-pin"></i>
                        <h3>Visit Our Office</h3>
                        205 ½ E Broadway, <br>
                        Suite F & G Hopewell VA. 23860<br>
                        <a class="btn-main btn-light-trans text-light mt-3" href="#">Get Direction</a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

</div>

    
       
    

 @endsection 
