@extends('layout.mainlayout')
@section('title', 'Resources')
@section('content')
<main id="content" class="container mt80 py-5">
    <h1>Resources</h1>
    <p>Explore our videos, podcasts, and books.</p>
    <ul>
        <li><a href="{{ route('resources.videos') }}">Videos</a></li>
        <li><a href="{{ route('resources.podcasts') }}">Podcasts</a></li>
        <li><a href="{{ route('resources.books') }}">Books</a></li>
    </ul>
</main>
@endsection
