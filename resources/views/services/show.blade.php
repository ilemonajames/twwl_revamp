<!-- resources/views/services/show.blade.php -->
@extends('layouts.app')

@section('title', 'Service Details')

@section('content')
<div class="container">
    <h1>{{ $service->name }}</h1>

    @if($service->image)
        <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid mb-4" alt="{{ $service->name }}">
    @else
        <img src="/images/default-service.jpg" class="img-fluid mb-4" alt="{{ $service->name }}">
    @endif

    <p><strong>Description:</strong> {{ $service->description }}</p>
    <p><strong>Price:</strong> ${{ $service->price }}</p>

    <a href="{{ route('services.index') }}" class="btn btn-secondary">Back to Services</a>
</div>
@endsection
