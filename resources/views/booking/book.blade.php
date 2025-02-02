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
                    <h3 class="mb-0">Appointment</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Appointment</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <section class="relative overflow-hidden jarallax">
        <img src="{{asset('assets/images/background/4.webp')}}" class="jarallax-img" alt="">
        <img src="images/misc/flowers-crop-2.webp" class="w-30 absolute top-0 end-0 sw-anim" alt="">
        <div class="container relative z-1">
            <div class="row g-4 align-items-center">

                <div class="col-lg-8 offset-lg-4">
                    <div class="p-4 bg-white rounded-10px">
                        <form name="appointment_form" id="appointment_form" class="position-relative z1000" method="post" action="/booking">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Select Service</h5>
                                    <div class="relative">
                                        <select name="service" id="service" value="" class="form-control bg-grey no-border">
                                            <option selected disabled>Select service</option>
                                           @foreach ($services as $service)
                                               <option value="{{ $service->id }}">{{ $service->service_title }}</option>
                                               
                                           @endforeach
                                        </select>
                                        <i class="absolute top-0 end-0 id-color pt-3 pe-3 icofont-simple-down"></i>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <h5>Select Date</h5>
                                    <div id="date" class="relative input-group date" data-date-format="mm-dd-yyyy">
                                        <i class="absolute top-0 end-0 id-color pt-3 pe-3 icofont-calendar"></i>
                                        <input name="date" class="form-control bg-grey no-border" type="text" readonly />
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <h5>Select Time</h5>
                                    <div class="relative">
                                        <select name="time" id="time" value="" class="form-control bg-grey no-border">
                                            <option selected disabled>Select time</option>
                                            <option value="10:00">10:00</option>
                                            <option value="11:00">11:00</option>
                                            <option value="12:00">12:00</option>
                                            <option value="13:00">13:00</option>
                                            <option value="14:00">14:00</option>
                                            <option value="15:00">15:00</option>
                                            <option value="16:00">16:00</option>
                                            <option value="17:00">17:00</option>
                                            <option value="18:00">18:00</option>
                                            <option value="19:00">19:00</option>
                                            <option value="20:00">20:00</option>
                                        </select>
                                        <i class="absolute top-0 end-0 id-color pt-3 pe-3 icofont-simple-down"></i>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <h5>Name</h5>
                                    <input type="text" name="name" id="name" class="form-control bg-grey no-border" placeholder="" required>
                                </div>

                                <div class="col-lg-4">
                                    <h5>Email</h5>
                                    <input type="text" name="email" id="email" class="form-control bg-grey no-border" placeholder="" required>
                                </div>

                                <div class="col-lg-4">
                                    <h5>Phone</h5>
                                    <input type="text" name="phone" id="phone" class="form-control bg-grey no-border" placeholder="" required>
                                </div>
                            </div> 

                            <div class="field-set mb20">
                                <h5>Have Any Message?</h5>
                                <textarea name="message" id="message" class="form-control bg-grey no-border" placeholder="Your Message"></textarea>
                            </div>
                                
                            
                            <div class="g-recaptcha" data-sitekey="6LdW03QgAAAAAJko8aINFd1eJUdHlpvT4vNKakj6"></div>
                            <div id="appointment_form" class="mt20 form-group">
                                <input type='submit'  value='Book Appointment' class="btn-main"> 
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
                        Sunday: 10AM - 8PM<br> --}}
                        <a class="btn-main btn-light-trans text-light mt-3" href="https://calendly.com/thewaywelove24 target="_blank"">Book an Appointment</a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="relative p-5 text-center h-100 bg-color-2 text-light">
                        <i class="d-block fs-40 mb-2 icofont-location-pin"></i>
                        <h3>Visit Our Clinic</h3>
                        205 ½ E Broadway,
<br>Suite F & G Hopewell VA. 23860<br>
                        <a class="btn-main btn-light-trans text-light mt-3" href="#">Get Direction</a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>          

</div>
 <!-- datepicker begin -->

<!-- content close -->
@endsection