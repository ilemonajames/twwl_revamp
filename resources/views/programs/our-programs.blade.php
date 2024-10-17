@extends('layout.mainlayout')
@section('title') Our Programs @endsection

@section('content')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Programs</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Programs</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <!-- Blog -->
    <section class="section section-blog">
        <div class="container">
            <div class="row">
                @if(count($programs)>0)
                @foreach ($programs as $program)
                <div class="col-md-4 col-sm-12">

                    <!-- Blog Post -->
                    <div class="blog grid-blog">
                        <div class="blog-image">
                            <a href="blog-details"><img class="img-fluid" src="{{ asset('/guest/images/uploads/' . $program->program_image) }}" alt="Post Image"></a>
                        </div>
                        <div class="blog-content">
                            <ul class="entry-meta meta-item">

                                <li><i class="far fa-clock"></i> {{ $program->created_at->format('d M Y')}}</li>
                            </ul>
                            <h3 class="blog-title"><a href="blog-details">{{ $program->program_title }}</a></h3>
                            <p class="mb-0">{!! Str::limit(strip_tags($program->program_description), 100) !!}</p>
                            <div class="row mt-3 ml-2">
                                <a class="btn btn-primary btn-sm"
                                href="{{ route('client.book')}}">Book Now</a> || <a class="btn btn-success btn-sm"
                                    href="{{ route('programs.details', $program->id) }}">Learn more</a>
                            </div>
                            {{-- <br><a href="{{ route('blogs.details', $blog->id) }}">Learn more</a></p> --}}
                        </div>
                    </div>
                    <!-- /Blog Post -->

                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
