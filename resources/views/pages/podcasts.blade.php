
@extends('layout.mainlayout')

@section('title', 'Podcasts')

@section('content')
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-0">Our Podcasts</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Our Podcasts</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<div class="container mt-4">
    <h1 class="text-center mb-4"></h1>
    
    <div class="row">
        @if($podcasts->count())
            @foreach($podcasts as $podcast)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <i class="fa fa-podcast fa-3x card-img-top text-center text-secondary  ml-3"></i>
                        {{-- <img src="{{ asset('storage/' . $podcast->thumbnail) }}" alt="Podcast Thumbnail" class="card-img-top"> --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $podcast->title }}</h5>
                            <p class="card-text">{{ Str::limit($podcast->description, 50) }}</p>
                            <a href="{{ route('podcasts.details', $podcast->id) }}" class="btn btn-primary">Listen Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">No podcasts available at the moment.</p>
        @endif
    </div>
</div>
@endsection
