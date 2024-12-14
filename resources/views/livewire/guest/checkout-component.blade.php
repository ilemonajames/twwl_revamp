<div>
    <section>
        <style>
            .quantity-container {
                display: flex;
                align-items: center;
                gap: 10px;
                }

                .quantity-btn {
                width: 40px;
                height: 40px;
                background-color: #4caf50;
                color: white;
                text-align: center;
                border: none;
                border-radius: 5px;
                font-size: 18px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                }

                .quantity-btn:hover {
                background-color: #45a049;
                }

                #quantity {
                width: 50px;
                text-align: center;
                font-size: 16px;
                border: 1px solid #ddd;
                border-radius: 5px;
                }

        </style>
        <div class="container">
            @if(Cart::instance('cart')->count()>0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">PRODUCT NAME</th>
                      <th scope="col">QUANTITY</th>
                      <th scope="col">UNIT PRICE</th>
                      <th scope="col">SUB TOTAL</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach(Cart::instance('cart')->content() as $cart)
                    <tr>
                      <th scope="row"><img src="{{ asset('guest/images/uploads/'.$cart->model->photo)}}" width="50"/></th>
                      <td>{{ $cart->model->product_name }}</td>
                      <td><div class="quantity-container">
                        <button  @if($cart->qty==1) disabled @endif wire:click.prevent="decreaseQuantity('{{ $cart->rowId }}')" class="quantity-btn" id="decrement">-</button>
                        <input type="text" id="quantity" value="{{ $cart->qty}}" readonly />
                        <button class="quantity-btn" wire:click.prevent="increaseQuantity('{{ $cart->rowId }}')" id="increment">+</button>
                      </div></td>
                      <td>{{ number_format($cart->price) }}</td>
                      <td>{{ number_format($cart->subtotal) }}</td>
                      <td><a href="#" wire:click="removeProduct('{{ $cart->rowId }}')" ><i class="fa fa-times"  aria-hidden="true"></i></a></td>
                    </tr>
                    @endforeach
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td>TOTAL</td>
                        <td>{{ Cart::instance('cart')->subtotal }}</td>
                      </tr>
                  </tbody>
              </table>
              <a href="{{ route('all-products')}}" class="btn-main mt-3">Continue Shopping</a>
              <a href="{{ route('checkout')}}" class="btn-main mt-3">checkout</a>
              @else
              <div class="section-header text-center">
                <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                alt="No results found" style="width: 150px; height: 100px;">
                <p class="mt-2 text-danger">No product added to cart, click <a href="{{ route('all-products')}}">here</a> to shop</p>

            </div>

              @endif



        </div>
    </section>

</div>
