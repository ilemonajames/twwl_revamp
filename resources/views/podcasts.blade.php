
@extends('layouts.app')

@section('title', 'Podcasts')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Our Podcasts</h1>
    
    <div class="row">
        @if($podcasts->count())
            @foreach($podcasts as $podcast)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $podcast->thumbnail) }}" alt="Podcast Thumbnail" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $podcast->title }}</h5>
                            <p class="card-text">{{ Str::limit($podcast->description, 100) }}</p>
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
