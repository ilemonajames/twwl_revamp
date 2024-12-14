@extends('layout.mainlayout')
@section('title')
Shopping Cart
@endsection
@section('content')
<!-- header close -->
<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-0">Shopping Cart</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Shopping Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
    @livewire('guest.checkout-component')
</div>
@endsection
