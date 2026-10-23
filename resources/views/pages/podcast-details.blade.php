@extends('layout.mainlayout')
@section('title', $podcast->title)
@section('content')
<main id="content" class="container mt80 py-5">
    <h1>{{ $podcast->title }}</h1>
    <p>{{ strip_tags($podcast->description) }}</p>
    @if(filter_var($podcast->audio_url, FILTER_VALIDATE_URL) && in_array(parse_url($podcast->audio_url, PHP_URL_SCHEME), ['http', 'https'], true))
        <a href="{{ $podcast->audio_url }}" target="_blank" rel="noopener noreferrer">Open {{ $podcast->category === 'Videos' ? 'video' : 'podcast' }}</a>
    @endif
</main>
@endsection
