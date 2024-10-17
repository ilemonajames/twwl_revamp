<!-- resources/views/services/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="container">
    <h1>Edit Service</h1>

    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Service Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $service->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $service->price) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Service Image</label>
            <input type="file" name="image" class="form-control-file">
            @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" class="img-thumbnail mt-2" alt="{{ $service->name }}">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Service</button>
    </form>
</div>
@endsection
