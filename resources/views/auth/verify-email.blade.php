@extends('layout.mainlayout')
@section('title', 'Verify your email | The Way We Love')
@section('content')
<div class="site-auth">
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color">
        <div class="container"><h1 class="mb-0 fs-3">Verify your email</h1></div>
    </section>
    <section class="site-auth-section">
        <div class="container">
            <div class="card site-auth-card">
                <div class="card-header">
                    <div class="subtitle mb-3">One more step</div>
                    <h2 class="card-title">Check your inbox</h2>
                    <p>Please verify your email address before continuing.</p>
                </div>
                <div class="card-body">
                    <p>Open the verification link sent to <strong>{{ auth()->user()->email }}</strong>. If it has not arrived, check your spam folder or request a new link below.</p>
                    @if(session('status') === 'verification-link-sent')
                        <div class="alert alert-success" role="status">A new verification email has been sent. Please check your inbox.</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
                    @endif
                    <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                        @csrf
                        <button type="submit" class="btn-main w-100">Resend verification email</button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-main btn-light-trans w-100">Log out</button>
                    </form>
                    <p class="mt-3 mb-0">Need help? <a href="{{ route('contact') }}">Contact our team</a>.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
