@extends('layout.mainlayout')
@section('title')
    Contact Us
@endsection
@section('content')
<!-- header close -->
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            <!-- section begin -->
            <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
                <div class="container relative z-index-1000">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h3 class="mb-0">Contact</h3>
                        </div>

                        <div class="col-lg-6 text-lg-end">
                            <ul class="crumb">
                                <li><a href="/">Home</a></li>
                                <li class="active">Contact</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->

            <section>
                <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6">
                            <div class="subtitle wow fadeInUp mb-3">Contact Form</div>
                            <h2 class="wow fadeInUp">Get In Touch</h2>

                            <p>Whether you have a question, a suggestion, or just want to say hello, this is the place to do it. Please fill out the form below with your details and message, and we'll get back to you as soon as possible.</p>

                            <div class="spacer-single"></div>

                            <h4>Our Office</h4>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="img-with-cap mb20">
                                        {{-- <div class="d-title">Mon - Fri 08.00 - 18.00</div>  {{asset('asset/images/misc/5.webp')}}"--}}
                                        <div class="d-overlay"></div>
                                        <img src=" {{ asset('assets/images/contact/contact_bg1.jpg') }}" class="img-fullwidth rounded-1" alt="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="fw-bold text-dark"><i class="icofont-location-pin me-2 id-color-2"></i>Office Location</div>
                                    205 ½ E Broadway, Suite F & G <br>Hopewell VA. 23860.

                                    <div class="spacer-single"></div>

                                    <div class="fw-bold text-dark"><i class="icofont-envelope me-2 id-color-2"></i>Send a Message</div>
                                  info@thewaywelove.com

                                    <div class="spacer-single"></div>

                                    <div class="fw-bold text-dark"><i class="icofont-phone me-2 id-color-2"></i>Call Us Directly</div>
                                    (804) 721-0983
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="p-4">
                                
                                    <form name="contactForm"  class="contact-form" method="post"  action="{{ route('sendMessage')}}" id="contact-form">
                                        @csrf
                                    <div class="field-set mb-3">
                                        <input  type="text" name="name" value="{{ old('name')}}" id="name" class="form-control" placeholder="Your Name" required>
                                        @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="field-set mb-3">
                                        <input type="email" name="email" value="{{ old('email')}}"  id="email" class="form-control" placeholder="Your Email" required>
                                        @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror 
                                    </div>

                                    <div class="field-set mb-3">
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" required>
                                    </div>
                                    @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror 
                                    <div class="field-set mb20">
                                        <textarea rows="4" name="message" value="{{ old('message')}}" id="message" class="form-control" placeholder="Your Message" required></textarea>
                                        @error('message')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror 
                                    </div>
                                        
                                    
                                    {{-- captcha v2--}}
                                    <div class="form-group mb-3">
                                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                        @error('g-recaptcha-response')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div id='submit' class="mt20">
                                       
                                        <button class="btn btn-main submit-btn"
                                        type="submit">Send Message</button>
                                    </div>

                                    @if(Session::has('feedback'))
                                        <div class="alert alert-success mt-3">
                                            {{ Session::get('feedback') }}
                                        </div>
                                    @endif
                                    
                                    @if(Session::has('error'))
                                        <div class="alert alert-danger mt-3">
                                            {{ Session::get('error') }}
                                        </div>
                                    @endif
                                    
                              
                                    
                                    <!-- // Validation -->
                                </form>
                                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                            </div>
                        </div>
                        

                    </div>
                </div>
            </section>  

            <section class="no-top no-bottom">
                <div class="container-fluid">
                    <div class="row g-0">
                        <div class="col-lg-6 col-md-6">
                            <div class="relative p-5 text-center h-100 bg-color text-light">
                                <i class="d-block fs-40 mb-2 icofont-clock-time"></i>
                                <h3>Schedule Your Appointment Today!</h3>
                              {{--  Mon - Sat: 8AM - 9PM<br>
                                 Sunday: 10AM - 8PM<br> --}}
                                <a class="btn-main btn-light-trans text-light mt-3" href="https://calendly.com/thewaywelove24">Book an Appointment</a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="relative p-5 text-center h-100 bg-color-2 text-light">
                                <i class="d-block fs-40 mb-2 icofont-location-pin"></i>
                                <h3>Visit Our Clinic</h3>
                                1720 E Hundred Rd, Chester, Va 23836  Bldg C. (Middleville Common ) 
                                <br>
                                <a class="btn-main btn-light-trans text-light mt-3" href="https://maps.app.goo.gl/ctuz2C2hWQTdY7cj6" target="_blank">Get Direction</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>          

        </div>
        @endsection

