@extends('layout.mainlayout')
@section('title', 'Appointment request received')
@section('content')
<main id="content" class="container mt80 py-5">
    <h1>Appointment request received</h1>
    @if($confirmation = session('booking_confirmation'))
        <p>Your requested appointment is {{ $confirmation['date'] }} at {{ $confirmation['time'] }}.</p>
        <p>Amount due: {{ config('services.square.currency', 'USD') }} {{ number_format($confirmation['amount'], 2) }}.</p>
        <p>Your request has been received. Your appointment date will be confirmed once payment has been received and verified. Payment has not been collected on this form.</p>
    @else
        <p>Please contact us if you need help with an existing appointment request.</p>
    @endif
    <a href="{{ route('contact') }}">Contact us</a>
</main>
@endsection
