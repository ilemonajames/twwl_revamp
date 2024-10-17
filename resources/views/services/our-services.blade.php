@extends('layout.mainlayout')
@section('title') Our Services @endsection

@section('content')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Services</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Our Services</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <!-- Blog -->
    <section class="section section-blog">
        <div class="container">
            <div class="section-header text-center">
                <h5>What we do</h5>
                <h2>Services</h2>
                <p>At The Way we love, we offer personalized coaching and counseling services designed to meet the unique
                    needs of each client. Our areas of expertise include:</p>
            </div>

            <div class="row">
                @foreach ($services as $service)
                    <div class="col-md-4">
                        <div class="card">
                            <a href="blog-details">
                                <img src="{{ asset('/guest/images/uploads/' . $service->service_image) }}" style="width: 100%"
                                    alt="Blog">
                            </a>
                            <div class="card-body">
                                <h2 class="card-title blog-heading"><a href="blog-details">
                                        {{ $service->service_title }}</a></h2>
                                <p class="blog-para">{!! Str::limit(strip_tags($service->service_description), 100) !!} </p>
                                    <div class="row mt-3 ml-2">
                                        <a class="btn btn-primary btn-sm"
                                        href="{{ route('client.book')}}">Book Now</a> || <a class="btn btn-success btn-sm"
                                            href="{{ route('services.details', $service->id) }}">Learn more</a>
                                    </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
