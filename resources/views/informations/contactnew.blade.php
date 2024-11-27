 @extends('layout.mainlayout')
 @section('content')
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
                                <div class="d-title">Mon - Fri 08.00 - 19.00</div>
                                <div class="d-overlay"></div>
                                <img src="{{asset('assets/images/misc/5.webp')}}" class="img-fullwidth rounded-1" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="fw-bold text-dark"><i class="icofont-location-pin me-2 id-color-2"></i>Office Location</div>
                            205 ½ E Broadway, Suite F & G Hopewell VA. 23860.


                            <div class="spacer-single"></div>

                            <div class="fw-bold text-dark"><i class="icofont-envelope me-2 id-color-2"></i>Send a Message</div>
                            contact@thewaywelove.com

                            <div class="spacer-single"></div>

                            <div class="fw-bold text-dark"><i class="icofont-phone me-2 id-color-2"></i>Call Us Directly</div>
                            +1 804-721-0983
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">
                    <div class="p-4 bg-grey rounded-10px">
                        <form name="contactForm" id="contact_form" class="position-relative z1000" method="post" action="{{ route('sendMessage')}}">
                            
                            <div class="field-set">
                                <input type="text" name="Name" id="name" class="form-control no-border" placeholder="Your Name" required>
                            </div>

                            <div class="field-set">
                                <input type="text" name="Email" id="email" class="form-control no-border" placeholder="Your Email" required>
                            </div>

                            <div class="field-set">
                                <input type="text" name="phone" id="phone" class="form-control no-border" placeholder="Your Phone" required>
                            </div>

                            <div class="field-set mb20">
                                <textarea name="message" id="message" class="form-control no-border" placeholder="Your Message" required></textarea>
                            </div>
                                
                            
                            <div class="g-recaptcha" data-sitekey="6LdW03QgAAAAAJko8aINFd1eJUdHlpvT4vNKakj6"></div>
                            <div id='submit' class="mt20">
                                <input type='submit' id='send_message' value='Send Message' class="btn-main">
                            </div>

                            <div id="success_message" class='success'>
                                Your message has been sent successfully. Refresh this page if you want to send more messages.
                            </div>
                            <div id="error_message" class='error'>
                                Sorry there was an error sending your form.
                            </div>
                        </form>
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
                        {{-- Mon - Sat: 8AM - 9PM<br>
                        Sunday: 10AM - 8PM--}}<br> 
                        <a class="btn-main btn-light-trans text-light mt-3" href="https://calendly.com/thewaywelove24" target="_blank">Book an Appointment</a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="relative p-5 text-center h-100 bg-color-2 text-light">
                        <i class="d-block fs-40 mb-2 icofont-location-pin"></i>
                        <h3>Visit Our Clinic</h3>
                        205 ½ E Broadway, 
                        <br>
                        Suite F & G Hopewell VA. 23860.
                                                <a class="btn-main btn-light-trans text-light mt-3" href="/contact">Get Direction</a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>          

</div>
<!-- content close -->
@endsection