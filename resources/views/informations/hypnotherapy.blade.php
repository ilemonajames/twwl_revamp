@extends('layout.mainlayout')
@section('title', 'Hypnotherapy')
@section('content')
<main id="content" class="container mt80 py-5">
    <h1>Hypnotherapy</h1>
    <p>Contact our team to discuss available sessions and whether this service fits your needs.</p>
    <a href="{{ route('contact') }}" class="btn-main">Contact our team</a>
</main>
@endsection
