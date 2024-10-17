<!-- resources/views/layouts/user.blade.php -->
@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('layouts.partials.user-sidebar')
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                @yield('user-content')
            </div>
        </div>
    </div>
</div>
@endsection
