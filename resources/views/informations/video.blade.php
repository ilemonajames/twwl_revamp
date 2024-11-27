@extends('layout.mainlayout')
@section('content')

  <!-- Breadcrumb -->
  <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
  <div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Video</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Our Videos</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<div class="content">
    <div class="container">

    </div>
</div>
</section>
@endsection