@extends('layout.mainlayout')
@section('title')
    Please login or create an account to continue on The Way we Love
@endsection


@section('content')
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-0">Authorized Access</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Reset password</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->



    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Sidebar -->
                <div class="col-lg-6 col-md-12">
                    <div class="contact-img" align="center">
                        <img src="{{ asset('assets/images/login.png') }}" width="100%" class="" alt="about-img">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card new-comment clearfix">
                        <div class="card-header">
                            <h4 class="card-title"><b>Reset Password</b></h4>
                        </div>
                        <div class="p-4 bg-grey rounded-10px">
                            <x-feedback-alert />

                            <form method="post" class="position-relative z1000" action="{{ route('guest.change-password')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address <span class="text-danger">*</span></label>
                                    <input type="email" readonly value="{{ $checkToken->email }}" name="email" class="form-control">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label>Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control">
                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label>Password Confirmation <span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                            @error('password_confirmation')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="submit-section form-group mt-4 mb-3 ">
                                    <button class="form-control btn btn-primary submit-btn"
                                        type="submit">Change password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
