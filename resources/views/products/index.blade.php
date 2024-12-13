@extends('layout.mainlayout')
@section('title')
All Products
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
                    <h3 class="mb-0">Our Products</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Products</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <section>
        <div class="container">
            <div class="row g-4 align-items-center">
                @livewire('guest.products.guest-products-component',['page' => "Home"])
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
                        205 ½ E Broadway, Suite F & G Hopewell VA. 23860. <br>
                        <a class="btn-main btn-light-trans text-light mt-3" href="https://maps.app.goo.gl/ctuz2C2hWQTdY7cj6" target="_blank">Get Direction</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection
