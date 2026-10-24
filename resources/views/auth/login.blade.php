@extends('layout.mainlayout')
@section('title')
    Please login or create an account to continue on The Way we Love
@endsection


@section('content')
<div class="site-auth no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="mb-0 fs-3">Login</h1>
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



    <section class="site-auth-section">
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-center">
                <!-- Blog Sidebar -->
                <div class="col-lg-6 col-md-12">
                    <div class="site-auth-welcome">
                        <div class="subtitle mb-3">The Way We Love</div>
                        <h2>A little support.<br>A stronger connection.</h2>
                        <p>Welcome back. Sign in to manage your appointments and continue your journey with us.</p>
                        <img src="{{ asset('assets/images/login.png') }}" class="site-auth-image" alt="" loading="lazy">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card site-auth-card">
                        <div class="card-header">
                            <h2 class="card-title">Welcome back</h2>
                            <p>Sign in to your account.</p>
                        </div>
                        <div class="card-body">
                            <x-feedback-alert />
                            @if(session('status'))
                                <div class="alert alert-success" role="status">{{ session('status') }}</div>
                            @endif

                            <form method="post" class="position-relative z1000" action="{{ route('login')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="login-email">Email address</label>
                                    <input id="login-email" type="email" name="email" value="{{ old('email') }}" class="form-control" autocomplete="username" required @error('email') aria-invalid="true" aria-describedby="login-email-error" @enderror>
                                    @error('email')
                                        <p id="login-email-error" class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="login-password">Password</label>
                                    <input id="login-password" type="password" name="password" class="form-control" autocomplete="current-password" required @error('password') aria-invalid="true" aria-describedby="login-password-error" @enderror>
                                    @error('password')
                                        <p id="login-password-error" class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="rememberme" name="remember" value="1" @checked(old('remember'))>
                                        <label class="custom-control-label" for="rememberme">Remember me</label>
                                    </div>
                                </div>
                            <div class="form-group">
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>
                                <div class="submit-section form-group mt-4 mb-3 ">
                                    <button class="btn-main w-100" type="submit">Sign in</button>
                                    <p class="site-auth-switch">New here? <a href="{{ route('register')}}">Create an account</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
