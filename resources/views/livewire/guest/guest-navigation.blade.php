<div class="de-flex-col site-header-actions">
    <a href="{{ route('login') }}" class="btn-main sm-hide">Login</a>
    <a href="{{ route('booking.form') }}" class="btn-main">Appointment</a>
    <a href="{{ route('cart') }}" class="site-cart-link" aria-label="Shopping cart, {{ Cart::instance('cart')->count() }} items">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        <span>{{ Cart::instance('cart')->count() }}</span>
    </a>
</div>
