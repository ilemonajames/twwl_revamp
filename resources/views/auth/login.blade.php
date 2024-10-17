@extends('layout.mainlayout')
@section('title')
    Please login or create an account to continue on The Way we Love
@endsection

@section('content')
    <!-- Breadcrumb --><br>
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Authorized Access</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="content">
        <div class="container">
            <div class="row">
                <!-- Blog Sidebar -->
                <div class="col-lg-6 col-md-12">
                    <div class="contact-img" align="center">
                        <img src="{{ asset('assets/images/login.png') }}" width="70%" class="" alt="about-img">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="card new-comment clearfix">
                        <div class="card-header">
                            <h4 class="card-title"><b>Authorized Access</b></h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('login')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn"
                                        type="submit">Login</button>  or  <a href="{{ route('register')}}">Create Account </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
