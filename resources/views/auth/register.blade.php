@extends('layout.mainlayout')
@section('title')
    Create Account to continue 
@endsection

@section('content')
    <!-- Breadcrumb --><br>
        <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
            <div class="container relative z-index-1000">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="mb-0">Create Account</h3>
                    </div>
    
                    <div class="col-lg-6 text-lg-end">
                        <ul class="crumb">
                            <li><a href="/">Home</a></li>
                            <li class="active">Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->
    
        
    
        <section class="relative overflow-hidden jarallax">
           {{-- <img src="{{asset('assets/images/background/4.webp')}}" class="jarallax-img" alt="">
             <div class="container">
                <div class="row"> --}}
        <div class="container">
            <div class="row">
                <!-- Blog Sidebar -->
                <div class="col-lg-6 col-md-12">
                    <div class="contact-img" align="center">
                        {{-- <img src="{{ asset('assets/images/login.png') }}" width="100%" class="" alt="about-img"> --}}
                        <img src="{{asset('assets/images/background/4.webp')}}" alt="jarallax-img" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="card new-comment clearfix">
                        <div class="card-header">
                            <h4 class="card-title"><b>Create Account</b></h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('register')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Surname <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ old('surname')}}" name="surname" class="form-control">
                                            @error('surname')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Othernames <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ old('othernames')}}" name="othernames" class="form-control">
                                            @error('othernames')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email Address <span class="text-danger">*</span></label>
                                    <input type="email" value="{{ old('email')}}" name="email" class="form-control">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('phoneno')}}" name="phoneno" class="form-control">
                                    @error('phoneno')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control">
                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password Confirmation <span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                            @error('password_confirmation')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn form-control mt-4"
                                        type="submit">Sign up</button>  Already have account?  <a href="{{ route('login')}}">Login </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
        
        
@endsection
