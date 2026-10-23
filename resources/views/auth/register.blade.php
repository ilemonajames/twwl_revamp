@extends('layout.mainlayout')
@section('title')
    Create Account to continue
@endsection

@section('content')
    <div class="site-auth" id="content">
        <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
            <div class="container relative z-index-1000">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="mb-0 fs-3">Create account</h1>
                    </div>

                    <div class="col-lg-6 text-lg-end">
                        <ul class="crumb">
                            <li><a href="/">Home</a></li>
                            <li class="active">Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->



        <section class="site-auth-section">
           {{-- <img src="{{asset('assets/images/background/4.webp')}}" class="jarallax-img" alt="">
             <div class="container">
                <div class="row"> --}}
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-center">
                <!-- Blog Sidebar -->
                <div class="col-lg-6 col-md-12">
                    <div class="site-auth-welcome">
                        <div class="subtitle mb-3">The Way We Love</div>
                        <h2>Your next chapter<br>starts with connection.</h2>
                        <p>Create an account to book appointments and find support for yourself and your relationships.</p>
                        {{-- <img src="{{ asset('assets/images/login.png') }}" width="100%" class="" alt="about-img"> --}}
                        <img src="{{asset('assets/images/background/4.webp')}}" alt="" class="site-auth-image" loading="lazy">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card site-auth-card">
                        <div class="card-header">
                            <h2 class="card-title">Let’s get you started</h2>
                            <p>All fields are required.</p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('register')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="register-surname">Surname</label>
                                            <input id="register-surname" type="text" value="{{ old('surname')}}" name="surname" class="form-control" autocomplete="family-name" required>
                                            @error('surname')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="register-othernames">Other names</label>
                                            <input id="register-othernames" type="text" value="{{ old('othernames')}}" name="othernames" class="form-control" autocomplete="given-name" required>
                                            @error('othernames')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="register-email">Email address</label>
                                    <input id="register-email" type="email" value="{{ old('email')}}" name="email" class="form-control" autocomplete="email" required>
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="register-phone">Phone number</label>
                                    <input id="register-phone" type="tel" value="{{ old('phoneno')}}" name="phoneno" class="form-control" autocomplete="tel" required>
                                    @error('phoneno')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="register-password">Password</label>
                                            <input id="register-password" type="password" name="password" class="form-control" autocomplete="new-password" minlength="8" aria-describedby="register-password-hint" required>
                                            <small id="register-password-hint">Use at least 8 characters.</small>
                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="register-password-confirmation">Confirm password</label>
                                            <input id="register-password-confirmation" type="password" name="password_confirmation" class="form-control" autocomplete="new-password" required>
                                            @error('password_confirmation')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- Google reCAPTCHA -->
                                <div class="form-group mt-4">
                                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="enableSubmitButton" data-expired-callback="disableSubmitButton" data-error-callback="disableSubmitButton"></div>
                                    @error('g-recaptcha-response')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="submit-section">
                                    <button class="btn-main w-100" type="submit" id="submit-btn" disabled>Create account</button>
                                    <p class="site-auth-switch">Already have an account? <a href="{{ route('login')}}">Sign in</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        // Enable submit button once reCAPTCHA is completed
        function enableSubmitButton() {
            document.getElementById('submit-btn').disabled = false;
        }
        function disableSubmitButton() {
            document.getElementById('submit-btn').disabled = true;
        }
    </script>

</div>
@endsection
