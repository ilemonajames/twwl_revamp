@extends('layout.mainlayout')

@section('title', 'Videos')

@section('content')
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-0">Our Videos</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Our Videos</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container mt-4">
        <h1 class="text-center mb-4"></h1>

        <div class="row">
            @if($videos->count())
                @foreach($videos as $video)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" 
                                    src="{{ $video->url }}" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $video->title }}</h5>
                                <p class="card-text">{{ Str::limit($video->description, 50) }}</p>
                                <a href="{{ route('videos.details', $video->id) }}" class="btn btn-primary">Watch Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">No videos available at the moment.</p>
            @endif
        </div>
    </div>
</div>
@endsection
