<!-- resources/views/layouts/counselor.blade.php -->
@extends('layouts.app')

@section('title', 'Counselor Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('layouts.partials.counselor-sidebar')
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                @yield('counselor-content')
            </div>
        </div>
    </div>
</div>
@endsection
