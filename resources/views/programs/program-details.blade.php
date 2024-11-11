@extends('layout.mainlayout')
@section('logo'){{ asset('/guest/images/uploads/' . $program->program_image) }}@endsection
@section('descirption'){!! Str::limit(strip_tags($program->program_description), 100) !!}@endsection
@section('title') {{ $program->program_title }}@endsection

@section('content')
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-0">{{ $program->program_title }}</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="{{ route('home')}}">Home</a></li>
                        <li class="active">Programs</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="">
        <div class="container">
            <div class="row g-4 gx-5">
                <div class="col-lg-8">
                    <div class="p-4 bg-grey rounded-10px">
                        <div class="row g-4">
                            <div class="col-lg-12">                                        
                                <h3 class="fs-32 id-color">{{ $program->program_title }}</h3>
                            </div>
                            <div class="col-lg-4">
                                <h5>Details</h5>
                            </div>
                            <div class="col-lg-8">
                                <p>{!! $program->program_description !!}.</p>
                            </div>
                        </div>
                        {{-- <div class="row g-4">
                            <div class="col-lg-4">
                                <h5>Background Information</h5>
                            </div>
                            <div class="col-lg-8">
                                <p>John has a history of chronic stress related to high-pressure deadlines and perfectionistic tendencies in his job. He also recently went through a divorce, further exacerbating his symptoms of depression.</p>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-lg-4">
                                <h5>Assessment</h5>
                            </div>
                            <div class="col-lg-8">
                                <p>John has a history of chronic stress related to high-pressure deadlines and perfectionistic tendencies in his job. He also recently went through a divorce, further exacerbating his symptoms of depression.</p>
                            </div>
                        </div> --}}
                    </div>

                    <div class="spacer-double"></div>

                    <div class="p-4 bg-grey rounded-10px">
                        {{-- <div class="row g-4">
                            <div class="col-lg-12">                                        
                                <h3 class="fs-32 id-color">Treatment Plan</h3>
                            </div>
                            <div class="col-lg-4">
                                <h5>Goals</h5>
                            </div>
                            <div class="col-lg-8">
                                <ol class="ul-style-2">
                                    <li>Alleviate symptoms of depression and burnout.</li>
                                    <li>Enhance coping skills for managing work-related stressors and life transitions.</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-4">
                                <h5>Intervention Strategies</h5>
                            </div>
                            <div class="col-lg-8">
                                <ol class="ul-style-2">
                                    <li>Cognitive-behavioral therapy (CBT) to challenge negative thought patterns and develop adaptive coping strategies.</li>
                                    <li>Career counseling to explore work-life balance and identify sources of fulfillment outside of work.</li>
                                </ol>
                            </div>
                        </div> --}}

                        {{-- <div class="row g-4">
                            <div class="col-lg-4">
                                <h5>Frequency and Duration</h5>
                            </div>
                            <div class="col-lg-8">
                                <p>Initially, weekly therapy sessions for 12 weeks, followed by bi-weekly sessions as symptoms improve.</p>
                            </div>
                        </div> --}}
                    </div>

                    <div class="spacer-double"></div>

                    <div class="p-4 bg-grey rounded-10px">
                        <div class="row g-4">
                            {{-- <div class="col-lg-12">                                        
                                <h3 class="fs-32 id-color mb-4">Results</h3>

                                <ol class="ol-style-1">
                                    <li>John successfully transitioned from feeling overwhelmed and hopeless to experiencing a renewed sense of purpose and fulfillment in both his personal and professional life.</li>
                                    <li>He developed effective coping strategies to manage stressors and maintain his mental health, leading to improved productivity and job satisfaction.</li>
                                    <li>John's case highlights the transformative power of therapy in promoting resilience and well-being, ultimately enhancing his overall quality of life.</li>
                                </ol>
                            </div> --}}
                        </div>
                    </div>

                    <div class="spacer-double"></div>

                    {{-- <div class="p-5 bg-color text-light rounded-10px">
                        <div class="row align-items-center g-4 gx-5 relative z-index-1000">
                            <div class="col-lg-4 text-center">
                                <img src="images/team/2.webp" class="img-fluid circle wow scaleIn" alt="">
                                <h5 class="mt-3 mb-0">John Graziosi</h5>
                                <p class="small mb-2">Customer</p>
                            </div>
                            <div class="col-lg-8">
                                <p class="mb20 wow fadeInUp fs-24 fw-600 lh-1-3" data-wow-delay=".2s">Mindthera is exceptional! Their psychologists are highly professional and caring. The atmosphere is welcoming and calming, and the staff provides outstanding support. Thank you, Mindthera, for your excellent service!</p>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="col-lg-4">
                    <div class="relative rounded-10px overflow-hidden shadow-soft">
                        {{-- <a class="de-video-play-button popup-youtube" href="http://www.youtube.com/watch?v=RFTUZqXZN6M">
                            <span></span>
                        </a> --}}
                        <img class="img-fluid" src="{{ asset('/guest/images/uploads/' . $program->program_image) }}" alt="">
                    </div>

                    <div class="spacer-double"></div>

                    <div class="padding30 rounded-10px bg-color-3">
                        @foreach($program->fees as $fee)
                        <h4>{{ $fee->service->service_title}}</h4>

                        <div class="mb-3">
                            <div class="">Program Fee</div>
                            <div class="fw-bold">${{$fee->program_fees  }}</div>
                        </div>
                       
                        <div class="mb-3">
                            <div class="">Session Fee</div>
                            <div class="fw-bold">${{$fee->session_fees  }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="">Consultation Fee</div>
                            <div class="fw-bold">${{$fee->consultation_fees  }}</div>
                        </div> 
                        <div class="mb-3">
                            <div class="">Duration</div>
                            <div class="fw-bold">{{ $fee->duration  }}</div>   
                        </div>

                        <a class="btn btn-primary btn-sm"
                                                href="{{ route('client.book')}}">Book Now</a>
                        @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>
    <!-- Breadcrumb -->

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
                                                        <h6></h6>
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
