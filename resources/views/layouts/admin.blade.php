<!-- resources/views/layouts/admin.blade.php -->
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('layouts.partials.admin-sidebar')
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                @yield('admin-content')
            </div>
        </div>
    </div>
</div>
@endsection
