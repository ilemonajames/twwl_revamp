{{-- @extends('layouts.app')

@section('content') --}}
<div class="container">
    <h2>Our Services</h2>
    <ul>
        @foreach($services as $service)
            <li>{{ $service->name }} - ${{ $service->price }}</li>
        @endforeach
    </ul>
</div>
{{-- @endsection --}}
