<!-- resources/views/services/index.blade.php -->
@extends('layout.mainlayout')

@section('title', 'Services')

@section('content')
   <!-- Breadcrumb -->
   <div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Services</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Services</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->
<div class="container">
    <h1>All Services</h1>

    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Add New Service</a>

    <div class="row">
        @foreach($services as $service)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->name }}">
                    @else
                        <img src="/images/default-service.jpg" class="card-img-top" alt="{{ $service->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->name }}</h5>
                        <p class="card-text">{{ Str::limit($service->description, 100) }}</p>
                        <p class="card-text"><strong>${{ $service->price }}</strong></p>
                        <a href="{{ route('services.show', $service->id) }}" class="btn btn-info">View Details</a>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-secondary">Edit</a>

                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
