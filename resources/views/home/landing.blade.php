@extends('layout.mainlayout')
@section('content')
@include('home.slider')

<section class="bg-color no-top no-bottom">
    <div class="container-fluid">
        <div class="row g-0 align-items-center">
           
            <div class="col-lg-4 col-md-4">
                <div class="relative p-4 bg-color-2 text-light">
                    <i class="d-block fs-40 mb-2 icofont-location-pin"></i>
                    205 ½ E Broadway, <br>Suite F & G Hopewell VA. 23860
                </div>
            </div>

            <div class="col-lg-4 col-md-4">
                <div class="relative p-4 bg-color-3 text-dark">
                    <i class="d-block fs-40 mb-2 icofont-phone"></i>
                    804-721-0983<br>
                    contact@thewaywelove.com
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row g-4 gx-5 align-items-center">
            <div class="col-lg-6">
                <div class="relative rounded-20px overflow-hidden shadow-soft">
                    <a class="de-video-play-button popup-youtube" href="https://www.youtube.com/watch?v=Qf9GBIntSaY">
                        <span></span>
                    </a>
                    <img src="{{(asset('assets/images/about.png'))}}" class="img-fluid" width="100%" height="60%" align="middle" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="subtitle wow fadeInUp mb-3">Who We Are</div>
                <h2 class="wow fadeInUp">Introducing Who We Are</h2>
                <p class="wow fadeInUp">{{$aboutUsText}}</p>
                <div class="spacer-10"></div>
                <a class="btn-main wow fadeInUp" href="/about">About Us</a>
            </div>
        </div>
        
    </div>
</section>

<section class="bg-grey relative overflow-hidden">
    <img src="{{(asset('assets/images/misc/flowers-crop-2.webp'))}}" class="w-30 absolute top-0 start-0 sw-anim" alt="">
    <div class="container">
       <div class="row g-4">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="subtitle wow fadeInUp mb-3">Our Services</div>
                <h2 class="wow fadeInUp" data-wow-delay=".2s">Transform The Way<span class="d-block mt-3 alt-font fw-500 fs-64 id-color-2"> You Love</span></h2>
                <p class="lead wow fadeInUp">Empowering individuals, couples, & family to build stronger and meaningful connections.</p>
            </div>
        
           
            @php 
            $sn = 1; 
            @endphp

@foreach ($programs as $program)

<div class="col-lg-4 col-sm-6">
    <div class="relative p-4 pb-0 text-center bg-white mt-5 h-100 rounded-10px">
        {{-- <div class="alt-font absolute end-0 pe-4 fw-bold fs-24 id-color">06</div> --}}
        <img src="{{ asset('/guest/images/uploads/' . $program->program_image) }}" class="img-fluid circle mb-4 w-30 mt-50 shadow-soft wow scaleIn" data-wow-delay=".2s" alt="" data-wow-delay=".2s" >
        <h4>{{$program->program_title}}</h4>
        <p class="no-bottom">{{$program->program_description}}</p>
        <a class="btn-main btn-main btn-light-trans mt-3" href="{{ route('programs.details', $program->id) }}">Our programs</a>
    </div>
</div>
@endforeach
           
        </div>

        <div class="spacer-double"></div>
    </div>
</section>


<section class="section-dark jarallax">
    <img src="{{(asset('assets/images/background/1.webp'))}}" class="jarallax-img" alt="">
    <div class="container">
        <div class="row text-light">
            <div class="col-lg-6 offset-lg-3 text-center">                            
                <div class="subtitle s2 wow fadeInUp mb-3">Our Package</div>
                <h2 class="wow fadeInUp" data-wow-delay=".2s">Plans</h2>
                {{-- <p class="lead">Qui culpa qui consequat officia cillum quis irure aliquip ut dolore sit eu culpa ut irure nisi occaecat dolore adipisicing.</p> --}}
                <div class="spacer-single"></div>
            </div>
        </div>

        <div class="row g-4 align-items-center">
            
         

            <div class="col-lg-4 col-sm-6">
                <div class="relative bg-white h-100 rounded-10px overflow-hidden wow fadeInUp" data-wow-delay=".2s">
                    <h4 class="bg-color-2 text-light p-3">Couples Counseling & Coaching</h4>
                    <div class="p-3 px-4 mb-4 relative">
                        <img src="{{(asset('assets/images/services/2.webp'))}}" class="absolute circle mb-4 w-80px end-0 me-4 shadow-soft wow scaleIn" data-wow-delay=".4s" alt="">
                        {{-- <div class="fs-14 text-dark fw-500">Start from</div>
                        <div class="mb-3">
                            <h2 class="d-inline id-color-2">$1</h2><span class="fs-14">/session</span>
                        </div> --}}
                        <p><p>Our goal is to help couples navigate the complexities of their relationships, improve
                            communication, resolve conflicts, and foster a secure emotional connection..
                            We serve all couples, including:
                            
                            </p>

                        <ul class="ul-style-2 fw-600 text-dark mb-3">
                            <li>LGBTQIA+ couples</li>
                            <li>Pre-marital (dating or engaged) couples</li>
                            <li>Cohabiting couples (living together but not married)</li>
                            <li> Married couples (husbands, wives, etc.)</li>
                            
                        </ul>

                        <a class="btn-main btn-light-trans w-100" href="https://calendly.com/twwl" target="_blank">
                            Book an Appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="relative bg-white h-100 rounded-10px overflow-hidden wow fadeInUp" data-wow-delay=".4s">
                    <h4 class="bg-color text-light p-3">Individual Counseling</h4>
                    <div class="p-3 px-4 mb-4 relative">
                        <img src="{{(asset('assets/images/services/3.webp'))}}" class="absolute circle mb-4 w-80px end-0 me-4 shadow-soft wow scaleIn" data-wow-delay=".6s" alt="">
                        {{-- <div class="fs-14 text-dark fw-500">Start from</div>
                        <div class="mb-3">
                            <h2 class="d-inline id-color-2">$120</h2><span class="fs-14">/session</span>
                        </div> --}}
                        <p>We provide support for individuals dealing with:
                            <ul class="ul-style-2 fw-600 text-dark mb-3">
                         <li>Depression</li>
    <li>Anxiety</li>
    <li>PTSD and trauma-related challenges</li>
    <li>Stress management</li>
    <li>Relationship issues</li>
    <li>Grief and loss</li>
                        </ul>

                        <a class="btn-main btn-light-trans w-100" href="https://calendly.com/twwl" target="_blank">
                            Book an Appointment
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="relative bg-white h-100 rounded-10px overflow-hidden wow fadeInUp" data-wow-delay=".6s">
                    <h4 class="bg-color-2 text-light p-3">Group Counseling</h4>
                    <div class="p-3 px-4 mb-4 relative">
                        <img src="{{(asset('assets/images/services/4.webp'))}}" class="absolute circle mb-4 w-80px end-0 me-4 shadow-soft wow scaleIn" data-wow-delay=".8s" alt="">
                        {{-- <div class="fs-14 text-dark fw-500">Start from</div>
                        <div class="mb-3">
                            <h2 class="d-inline id-color-2">$1200</h2><span class="fs-14">/session</span>
                        </div> --}}
                        <p>We provide support for groups of people dealing with:
                            <ul class="ul-style-2 fw-600 text-dark mb-3">
                         <li>Stress</li>
                            <li>Anxiety</li>
                            <li>Depression</li>
                            <li>PTSD and trauma-related challenges</li>
                            <li>Stress management</li>
                            <li>Relationship issues</li>
                            <li>Grief and loss</li>
                                                </ul>

                        <a class="btn-main btn-light-trans w-100" href="https://calendly.com/twwl" target="_blank">
                            Book an Appointment
                        </a>
                    </div>
                </div>
            </div>
     


        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="subtitle s2 wow fadeInUp mb-3">Services Process</div>
                <h2 class="wow fadeInUp" data-wow-delay=".2s">How It Works</h2>
                {{-- <p class="lead wow fadeInUp">Qui culpa qui consequat officia cillum quis irure aliquip ut dolore sit eu culpa ut irure nisi occaecat dolore adipisicing do pariatur.</p> --}}
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row g-4 arrow-divider">
                <div class="col-lg-3 col-6 wow fadeInRight" data-wow-delay=".2s">
                    <div class="relative p-4">
                        <div class="subtitle bg-color text-light mb-2 wow fadeInRight" data-wow-delay=".2s">Step 1</div>
                        <h4>Orientation</h4>                    
                        {{-- <p class="fs-14">Qui culpa qui consequat officia cillum quis irure aliquip ut dolore sit eu culpa ut irure nisi occaecat.</p> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6 wow fadeInRight" data-wow-delay=".6s">
                    <div class="relative p-4">
                        <div class="subtitle bg-color text-light mb-2 fadeInRight" data-wow-delay=".6s">Step 2</div>
                        <h4>Indentification</h4>                    
                        {{-- <p class="fs-14">Qui culpa qui consequat officia cillum quis irure aliquip ut dolore sit eu culpa ut irure nisi occaecat.</p> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6 wow fadeInRight" data-wow-delay=".8s">
                    <div class="relative p-4">
                        <div class="subtitle bg-color text-light mb-2 wow fadeInRight" data-wow-delay=".8s">Step 3</div>
                        <h4>Exploration</h4>                    
                        {{-- <p class="fs-14">Qui culpa qui consequat officia cillum quis irure aliquip ut dolore sit eu culpa ut irure nisi occaecat.</p> --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6 wow fadeInRight" data-wow-delay="1s">
                    <div class="relative p-4">
                        <div class="subtitle bg-color text-light mb-2 wow fadeInRight" data-wow-delay="1s">Step 4</div>
                        <h4>Resolution</h4>                    
                        {{-- <p class="fs-14">Qui culpa qui consequat officia cillum quis irure aliquip ut dolore sit eu culpa ut irure nisi occaecat.</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">                            
                <div class="subtitle wow fadeInUp mb-3">FAQ</div>
                <h2 class="wow fadeInUp" data-wow-delay=".2s"></h2>
            </div>
        </div>

        <div class="row g-4 align-items-center">

            <div class="col-lg-12">
                <div class="accordion s2 wow fadeInUp">
                    <div class="accordion-section">
                        
                        @php
                        $sn=1;
                        @endphp

                        @foreach ($faqs as $faq)
                        <div class="accordion-section-title" data-tab="#accordion-a{{$sn}}">
                        <p>{{$faq->question}}
                        </div></p>   
                        <div class="accordion-section-content" id="accordion-a{{$sn}}">
                            <p>{{$faq->answer}}</p>
                        </div>
                        <div class="counter" style="display: none">{{ $sn++ }}</div>
                        @endforeach
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</div>
<!-- content close -->
@endsection
<!-- content close -->