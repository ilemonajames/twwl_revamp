@extends('layout.mainlayout')
@section('title')
    Contact Us
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Contact Us</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="contact-img" align="center">
                        <img src="{{ asset('assets/images/contact/contact_bg1.jpg') }}" width="70%" class="" alt="about-img">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 sidebar-right theiaStickySidebar">
                    <br><br>
                    <div class="card new-comment clearfix">
                        <div class="card-body">
                            <div class="contact-info info-2">
                                <div class="section-title margin-bottom-50">
                                    <span class="sub-title theme-color text-uppercase"><b>Get In Touch</b></span>
                                    <h2 class="section-title margin-top-5"><b</b></h2>
                                    <hr>
                                </div>
<p>For booking consultations or sessions, please visit our <a href="{{ route('register') }}"> Booking link</a> or call
    +1804-721-0983 to arrange an appointment.</p>
                                <!-- Feature List -->
                                <div class="feature-box-wrap f-list-4">
                                    <div class="feature-box-details">
                                        <!-- Media -->
                                        <div class="media">
                                            <div class="feature-list-icon me-3">
                                                <span class="ti-location-pin"></span>
                                            </div>
                                            <div class="media-body">
                                                <div class="feature-content">
                                                    <div class="feature-title">
                                                        <h5><b>Our Address</b></h5>
                                                    </div>
                                                    <div class="feature-box-content">
                                                        <p>205 ½ E Broadway, Suite F & G Hopewell VA. 23860.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Media -->
                                    </div>
                                </div>
                                <!-- Feature List -->
                                <!-- Feature List -->
                                <div class="feature-box-wrap f-list-4">
                                    <div class="feature-box-details">
                                        <!-- Media -->
                                        <div class="media">
                                            <div class="feature-list-icon me-3">
                                                <span class="ti-headphone-alt"></span>
                                            </div>
                                            <div class="media-body">
                                                <div class="feature-content">
                                                    <div class="feature-title">
                                                        <h5><b>Phone Number</b></h5>
                                                    </div>
                                                    <div class="feature-box-content">
                                                        <p><a href="tel: +2348047210983">+234 804-721-0983</a>,</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Media -->
                                    </div>
                                </div>
                                <!-- Feature List -->
                                <!-- Feature List -->
                                <div class="feature-box-wrap f-list-4 mb-0">
                                    <div class="feature-box-details">
                                        <!-- Media -->
                                        <div class="media">
                                            <div class="feature-list-icon me-3">
                                                <span class="ti-email"></span>
                                            </div>
                                            <div class="media-body">
                                                <div class="feature-content">
                                                    <div class="feature-title">
                                                        <h5><b>Email Address</b></h5>
                                                    </div>
                                                    <div class="feature-box-content">
                                                        <p><a href="mailto:Thewayweloverelationshipcoun24tgmail.com">thewayweloverelationshipcoun24@gmail.com</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Media -->
                                    </div>
                                </div>
                                <!-- Feature List -->
                            </div>
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div class="row">
                <!-- Blog Sidebar -->
                <div class="col-lg-6 col-md-12 sidebar-right theiaStickySidebar">
                    <div class="card new-comment clearfix">
                        <div class="card-header">
                            <h4 class="card-title"><b>Send us a message</b></h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('sendMessage')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name')}}" class="form-control">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ old('email')}}" class="form-control">
                                    @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea rows="4" name="message" value="{{ old('message')}}" class="form-control"></textarea>
                                    @error('message')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn"
                                        type="submit">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact-img" align="center">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.433267471692!2d7.445025873547351!3d10.466470164837498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104d4b7b013af573%3A0x15c5e6c45a16f1d3!2sLIVINGWORD%20GLOBAL%20LEADERSHIP%20MISSION!5e0!3m2!1sen!2sng!4v1709131172543!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
