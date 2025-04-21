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
                        <h3 class="mb-0">Password Reset</h3>
                    </div>

                    <div class="col-lg-6 text-lg-end">
                        <ul class="crumb">
                            <li><a href="/">Home</a></li>
                            <li class="active">Forgot Password</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->



        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="bg-white p-4">
                            <div class="mb-4 text-sm text-gray-600">
                                <h6> {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                </h6>
                            </div>
                            <x-feedback-alert />

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('guest.forget-password') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="email"> {{ __('Email') }}</label>
                                    <input id="email" type="email" name="email" class="form-control"
                                        :value="old('email')" required autofocus />
                                    <div class="text-error mt-2"> <span class="text"
                                            :messages="$errors -> get('email')"></span> </div>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Email Password Reset Link') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
