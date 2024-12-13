<div class="de-flex-col">
    <a href="/login" class="menu-item btn-success sm-hide btn-main "
        {{ Request::is('login') ? 'active' : '' }}>Login</a>
    <div class="menu_side_area">

        <a href="/register" class="btn-main">Appointment</a>
        <div class="h-phone sm-hide">
            {{-- <i class="icofont-headphone-alt"></i> --}}
            <a  href="{{ route('checkout')}}"><i class="id-color text-grey bg-hover-2 text-hover-white fa fa-cart-plus mt-4" tooltip="Add to cart" aria-hidden="true"></i></a>
            <div class="mt-3" id="quantity">{{ Cart::instance('cart')->count() }}</div>
            <div class="mb-4"><span>Phone</span>(804) 721-0983<div>
        </div>

    </div>
</div>
