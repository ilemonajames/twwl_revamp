@extends('layout.mainlayout')
@section('logo'){{ asset('/guest/images/uploads/' . $program->program_image) }}@endsection
@section('descirption'){!! Str::limit(strip_tags($program->program_description), 100) !!}@endsection
@section('title') {{ $program->program_title }}@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Program</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Program Details</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-view">
                        <div class="blog blog-single-post">
                            <div class="blog-image">
                                <a href="javascript:void(0);"><img alt=""
                                        src="{{ asset('/guest/images/uploads/' . $program->program_image) }}"
                                        class="img-fluid"></a>
                            </div>
                            <h3 class="blog-title">{{ $program->program_title }}</h3>

                            <div class="blog-content">
                                <p>{!! $program->program_description !!}</p>
                            </div>

                            <div class="row">
                                @foreach($program->fees as $fee)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body" style="background-color: rgba(128, 128, 128, 0.051); border-radius: 10px">
                                            <h4 class="card-title mb-1"><b>{{ $fee->service->service_title}}</b></h4><hr>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div>
                                                        <p class="mb-2">Program Fee</p>
                                                        <h6>${{$fee->program_fees  }}</h6>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div>
                                                        <p class="mb-2">Session Fee</p>
                                                        <h6>${{$fee->session_fees  }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div>
                                                        <p class="mb-2">Consultation Fee</p>
                                                        <h6>${{$fee->consultation_fees  }}</h6>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div>
                                                        <p class="mb-2">Duration</p>
                                                        <h6>{{$fee->duration  }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3 ml-2">
                                                <a class="btn btn-primary btn-sm"
                                                href="{{ route('client.book')}}">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blog Sidebar -->
                <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

                    <!-- Search -->
                    <div class="card search-widget">
                        <div class="card-body">
                            <form class="search-form">
                                <div class="input-group">
                                    <input type="text" placeholder="Search..." class="form-control">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Search -->

                    <!-- Latest Posts -->
                    <div class="card post-widget">
                        <div class="card-header">
                            <h4 class="card-title">Other Services</h4>
                        </div>
                        <div class="card-body">
                            <ul class="latest-posts">
                                @foreach($programs as $program)
                                <li>
                                    <div class="post-thumb">
                                        <a href="blog-details">
                                            <img class="img-fluid" src="{{ asset('/guest/images/uploads/' . $program->program_image) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4>
                                            <a href="{{ route('programs.details',$program->id)}}">{{ $program->program_title}}</a>
                                        </h4>
                                        <p>{!! Str::limit(strip_tags($program->program_description),70) !!}</p>
                                    </div>
                                </li>
                            @endforeach
                            </ul>
                        </div>

                    </div>
                    <!-- /Latest Posts -->


                </div>
                <!-- /Blog Sidebar -->

            </div>
        </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
