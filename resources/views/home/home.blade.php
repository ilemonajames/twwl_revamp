
@extends('layout.mainlayout')
@section('content')

    <!-- Hero Section -->
    {{-- <div class="hero-section">
        <div class="slider-container">
            <div class="slider">
                <div class="slide" style="background-image: url({{ asset('assets/img/banner/01.png') }});">
                    <div class="slide-content">
                        <h2>Transform Your Relationships with Professional Counseling</h2>
                        <a href="#" class="action-button">Schedule Appointment</a>
                    </div>
                </div>
                <div class="slide" style="background-image: url({{ asset('assets/img/banner/02.png') }});">
                    <div class="slide-content">
                        <h2>Love is the Way, Healing is the Journey</h2>
                        <a href="#" class="action-button">Schedule Appointment</a>
                    </div>
                </div>
                <div class="slide" style="background-image: url({{ asset('assets/img/banner/03.png') }});">
                    <div class="slide-content">
                        <h2>Join Us and Let Love Guide Your Way</h2>
                        <a href="#" class="action-button">Schedule Appointment</a>
                    </div>
                </div>
            </div>
            <div class="slider-navigation">
                <div class="prev">&#10094;</div>
                <div class="next">&#10095;</div>
            </div>
        </div>
    </div> --}}
    <div class="hero-section fade-in mb-5">
        <div class="slider-container">
            <div class="slider">
                <div class="slide" style="background-image: url({{ asset('assets/img/banner/banner1.jpg') }});">
                    <div class="slide-content">
                        <h2>Unlock Your Potential with Expert Guidance</h2>
                        <a href="#" class="action-button">Book Your Free Consultation Today</a>
                    </div>
                </div>
                <div class="slide" style="background-image: url({{ asset('assets/img/banner/banner2.jpg') }});">
                    <div class="slide-content">
                        <h2>Rekindle Your Connection and Embrace Happiness</h2>
                        <a href="#" class="action-button">Start Your Journey to Healing Now</a>
                    </div>
                </div>
                <div class="slide" style="background-image: url({{ asset('assets/img/banner/banner3.jpg') }});">
                    <div class="slide-content">
                        <h2>Join a Supportive Community and Transform Your Life</h2>
                        <a href="#" class="action-button">Discover Your Path to Well-Being</a>
                    </div>
                </div>
            </div>
            <div class="slider-navigation">
                <div class="prev">&#10094;</div>
                <div class="next">&#10095;</div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
  <!-- Call to Action Section -->
{{-- <section class="section section-call-to-action fade-in mt-5">
    <div class="container">
        <div class="call-width">
            <h2>At The Way We Love, we offer personalized coaching and counseling services designed to meet your unique needs.</h2>
            <a href="/booking" class="btn btn-lg mt-3 action-button">Get Started</a>
        </div>
    </div>
</section> --}}
<!-- Services -->
   {{-- <section class="section section-services">
    <div class="container">
        <div class="section-header text-center">
            <h5>WE PROVIDE WHAT</h5>
            <h2>SERVICES</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Slider -->
                <div class="services-slider slider">
                    @foreach ($services as $service)
                    <div class="services-item text-center">
                        <div class="services-img">
                            <a href="map-list">
                                <img src="{{ asset('assets/img/services/' . $service->service_image) }}" class="img-fluid" alt="Services">
                            </a>
                            <div class="service-text">
                                <h6>{{ $service->service_title }}</h6>
                                <p>{{ $service->service_description }}</p>
                                <div class="button-group">
                                    <a href="booking" class="btn btn-primary">Book Now</a>
                                    <a href="learn-more" class="btn btn-secondary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                 </div>

            </div>
        </div>
    </div>
</section>	  --}}
<!-- Services Section -->
<!-- Services Section -->
<section class="section section-services">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h5 class="text-uppercase">We Provide What</h5>
            <h2 class="font-weight-bold">Services</h2>
        </div>
        <div class="row justify-content-center">
            @foreach ($services as $service)
                <div class="col-md-4"> <!-- Bootstrap column -->
                    <div class="services-item text-center mb-4">
                        <div class="service-content">
                            <h6 class="font-weight-bold">{{ $service->service_title }}</h6>
                            <p class="text-muted">{{ strlen(strip_tags($service->service_description)) > 100 ? substr(strip_tags($service->service_description), 0, 300) . '...' : strip_tags($service->service_description) }}</p> <!-- Strip HTML tags -->
                            <div class="button-group mt-3">
                                <a href="/booking" class="btn action-button btn-lg">Book a session</a>
                                <a href="learn-more" class="btn btn-outline-secondary btn-sm">Learn More</a>
                            </div>
                        </div>
                        <div class="services-img">
                            <img src="{{ asset('assets/img/services/' . $service->service_image) }}"
                                 class="img-fluid"
                                 alt="Service - {{ $service->service_title }}">
                        </div>
                    </div>
                </div> <!-- End of col-md-4 -->
            @endforeach
        </div>
    </div>
</section>



<!-- We Always -->
<section class="section section-we-always">
    <div class="row ml-5">
        {{-- <div class="col-sm-5 col-lg-7 p-0 sec-hide we-al-img"> --}}
            <div class="col-sm-5 col-lg-5 p-0 sec-hide we-al-img">

    {{-- <dotlottie-player src="https://lottie.host/d84e8303-61c2-4b2f-b6a7-7d9f654ee3b4/La5A65T3yD.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player> --}}
        </div>
        <div class="col-sm-12 col-lg-6 we-always-info">
            <h2>The Way We Love Relationship Counseling</h2>
                <p>The Way We Love Relationship Counseling is born out of a desire to serve and mend relationships. We strive to help individuals, couples, and families attain mental health through a lifestyle of self-care, identifying value systems that make them happy in their relationships</p>
            <aside class="achievements">
    <!--<h2>Our Achievements</h2>
    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-6 we-info">
            <h4>50+</h4>
            <hr>
            <h5>Successful Partnerships</h5>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-6 we-info">
            <h4>120+</h4>
            <hr>
            <h5>Events Hosted</h5>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-6 we-info">
            <h4>3000+</h4>
            <hr>
            <h5>Active Memberships</h5>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-6 we-info">
            <h4>95%</h4>
            <hr>
            <h5>Community Engagement</h5>
        </div>
    </div>
            </aside>

        </div>-->
    </div>
</section>
<!-- /We Always -->

<!-- Counsellors -->
{{-- <section class="section section-counsellors">
    <div class="container">
        <div class="section-header text-center">
            <h5>Our Programs</h5>
            {{-- <h2>Counsellors</h2> --
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Slider -->
                <div class="counsellors-slider slider">

                   <!-- Slider Item -->
                   @foreach ($programs as $program)
                    <div class="services-item text-center">
                        <div class="services-img">
                            <img src="assets/img/counsellor-01.png" class="img-fluid" alt="Services">

                            <div class="counsellors-widget" onclick="redirectDetail()">
                                <div class="counsellor-info">
                                    <div class="top-sec">
                                        <div class="star-rate">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p class="rating-rev">3.2</p>
                                    </div>
                                    <div class="bott-sec">
                                        <a href="councellor-profile">
                                            <h5>{{ $program->program_name }}</h5>
                                        </a>
                                        <h5>{{ $program->program_description }}</h5>
                                        {{-- <h6>Self-Esteem Issues</h6>
                                        <h4>$200 / Hr</h4> --
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="booking" class="btn btn-primary mt-4">Book Now</a>
                    </div>
                    @endforeach

            </div>
        </div>
    </div>
</section>
<!-- /Counsellors --> --}}

<!-- Reviews -->
<section class="section section-reviews">
    <div class="container">
        <div class="section-header text-center">
            <h5>Our Packages</h5>
            {{-- <h2>Reviews</h2> --}}
        </div>

        <div class="row mt-8">
            @foreach ($programs as $program)
            <div class="col-md-6 col-lg-4 mt-4 mb-4">
                <div class="card">
                    <div class="top-img">
                       <i class="{{ $program->icon_class }} fa-2x" ></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $program->program_title }}</h5>
                        <p class="card-text">{{ $program->program_description }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="">



                                <a href="/boking" class="btn action-button btn-block">Book Now</a>

                            </div>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>
    </div>
</section>
<!-- /Reviews -->

<!-- Call to Action -->
<section class="section section-call-to-action">
    <div class="container">
        <div class="call-width">
            <h2>“ If You are in Trouble Need our Help, Contact Us Immediately, We are Support 24/7 ”</h2>
            <a href="map-list" class="btn btn-lg mt-3 action-button">OUR SERVICES</a>
        </div>
    </div>
</section>
<!-- /Call to Action -->

<!-- Blog -->
<section class="section section-blog">
    <div class="container">
        <div class="section-header text-center">
            <h5>Latest News</h5>
            <h2>Blogs</h2>
        </div>

        <div class="row">
           <!-- <div class="col-md-7">
                <div class="media">
                    <a href="blog-details">
                        <img src="./assets/img/blog-01.png" alt="Blog">
                    </a>
                    <div class="media-body">
                        <h4 class="blog-date">21 jan 2021</h4>
                          <h5 class="mt-0 blog-heading"> <a href="blog-details"> How to Cope with Coronavirus-Caused Mental Health Concerns</a></h5>
                          <p class="blog-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Volutpat orci enim, mattis nibh aliquam dui, nibh faucibus aenean. Eget volu</p>
                    </div>
                </div>
                <div class="media mt-4">
                    <a href="blog-details">
                        <img src="./assets/img/blog-02.png" alt="Blog">
                    </a>
                    <div class="media-body">
                        <h4 class="blog-date">21 jan 2021</h4>
                          <h5 class="mt-0 blog-heading"><a href="blog-details"> Is It Important to Say “Please”?</a></h5>
                          <p class="blog-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Volutpat orci enim, mattis nibh aliquam dui, nibh faucibus aenean. Eget volu</p>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <a href="blog-details">
                        <img src="./assets/img/blog-03.png" alt="Blog">
                    </a>
                    <div class="card-body">
                        <h4 class="blog-date">19 jan 2021</h4>
                          <h5 class="card-title blog-heading"><a href="blog-details"> 10 Quarantine Activities That Don’t Involve Watching the News</a></h5>
                          <p class="blog-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Volutpat orci enim, mattis nibh aliquam dui, nibh faucibus aenean. Eget volu</p>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</section>
<!-- /Blog -->
</div>
@endsection
