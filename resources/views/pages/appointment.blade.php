@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Book an Appointment</h2>
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <label for="service">Select Service:</label>
        <select name="service_id" id="service">
            @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
        </select>
        <label for="date">Appointment Date:</label>
        <input type="datetime-local" name="appointment_date" required>
        <button type="submit">Book Now</button>
    </form>
</div>
@endsection
