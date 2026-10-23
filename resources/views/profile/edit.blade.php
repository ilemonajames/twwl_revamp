@extends('layout.mainlayout')
@section('title', 'Your profile')
@section('content')
<main id="content" class="container mt80 py-5">
    <h1>Your profile</h1>
    <x-feedback-alert />
    @if(session('status'))<p role="status">{{ session('status') }}</p>@endif
    <form method="post" action="{{ route('profile.update') }}">
        @csrf @method('patch')
        <label for="surname">Surname</label>
        <input id="surname" name="surname" value="{{ old('surname', $user->surname) }}" class="form-control" required>
        @error('surname')<p class="text-danger">{{ $message }}</p>@enderror
        <label for="othernames">Other names</label>
        <input id="othernames" name="othernames" value="{{ old('othernames', $user->othernames) }}" class="form-control" required>
        @error('othernames')<p class="text-danger">{{ $message }}</p>@enderror
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        @error('email')<p class="text-danger">{{ $message }}</p>@enderror
        <button class="btn btn-primary mt-3" type="submit">Save profile</button>
    </form>
    <h2 class="mt-5">Delete account</h2>
    <form method="post" action="{{ route('profile.destroy') }}">
        @csrf @method('delete')
        <label for="delete-password">Confirm your password</label>
        <input id="delete-password" type="password" name="password" class="form-control" required autocomplete="current-password">
        @error('password', 'userDeletion')<p class="text-danger">{{ $message }}</p>@enderror
        <button class="btn btn-danger mt-3" type="submit">Delete account</button>
    </form>
</main>
@endsection
