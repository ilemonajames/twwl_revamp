@extends('layout.mainlayout')
@section('title', 'Choose your service or program')
@section('content')
<section class="mt80 mt-sm-60 bg-grey">
    <div class="container" style="max-width:960px">
        <div class="subtitle mb-3">Welcome to The Way We Love</div>
        <h1>What would you like support with?</h1>
        <p>Choose one service or program to get started. This saves your interest; it does not book an appointment, collect payment, or confirm enrolment.</p>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">Please select an available service or program.</div>
        @endif
        @if($services->isEmpty() && $programs->isEmpty())
            <p>No services or programs are currently available. Please <a href="{{ route('contact') }}">contact our team</a> for help.</p>
        @else
        <form method="post" action="{{ route('client.enrolment.store') }}">
            @csrf
            @foreach(['service' => $services, 'program' => $programs] as $type => $items)
                @if($items->isNotEmpty())
                <fieldset class="mb-4">
                    <legend class="h3">{{ $type === 'service' ? 'Services' : 'Programs' }}</legend>
                    <div class="row g-3">
                        @foreach($items as $item)
                            <div class="col-md-6">
                                <label class="card p-3 h-100 d-flex flex-row align-items-center gap-3" for="choice-{{ $type }}-{{ $item->id }}">
                                    <input id="choice-{{ $type }}-{{ $item->id }}" type="radio" name="selection" value="{{ $type }}:{{ $item->id }}" required @checked(old('selection') === $type.':'.$item->id) style="accent-color:var(--site-green);width:20px;height:20px;flex-shrink:0">
                                    <span>{{ $type === 'service' ? $item->service_title : $item->program_title }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
                @endif
            @endforeach
            <button type="submit" class="btn-main border-0">Save and continue</button>
        </form>
        @endif
    </div>
</section>
@endsection
