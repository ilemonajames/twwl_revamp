<div>
    <section class="relative overflow-hidden">
        <img src="images/misc/flowers-crop-2.webp" class="w-30 absolute top-0 end-0 sw-anim" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <div class="subtitle wow fadeInUp mb-3">Collections</div>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Our <span class="alt-font fw-500 fs-64 id-color-2">Products</span></h2>
                    {{-- <p class="lead">.</p> --}}
                    <div class="spacer-single"></div>
                </div>
            </div>

            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-lg-4 col-sm-6">
                        <img src="{{ asset('guest/images/uploads/'.$product->photo)}}" class="img-fluid rounded-10px" alt="">
                        <div class="p-3 text-center bg-color-3 rounded-10px mx-3 mt-30 relative z-1000">
                            <h4 class="mb-0">{{ $product->product_name}}</h4>
                            <p class="mb-2 text-white">{!! Str::limit($product->description,50) !!}</p>
                            <div class="social-icons">
                                <a  wire:click="buyProduct({{$product}})"><i class="bg-white id-color bg-hover-2 text-hover-white fa fa-shopping-cart" tooltip="Buy" aria-hidden="true"></i></a>
                                <a  wire:click="addToCart({{$product}})"><i class="bg-white id-color bg-hover-2 text-hover-white fa fa-cart-plus" tooltip="Add to cart" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if(request()->is('/'))
            <div class="section-header text-center">
                <a  class="btn-main wow fadeInUp mt-3" href="{{ route('all-products')}}">All Products</a>
            </div>
            @endif
        </div>
    </section>
</div>
