@extends('layout.mainlayout')
@section('title')
Checkout
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
                    <h3 class="mb-0">Checkout</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-3">Billing Details</h4>
                            <form action="#" method="POST" class="ml-3">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                                </div>

                                <div class="form-group">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip') }}" required>
                                </div> --}}
                                <div class="form-group">
                                    <label for="Payment Method">Payment Method</label>
                                    <select class="form-control" id="payment-method" name="payment-method" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="credit-card">Credit Card</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="bank-transfer">Bank Transfer</option>
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="card-name">Card Name</label>
                                    <input type="text" class="form-control" id="card-name" name="card-name" value="{{ old('card-name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="card-number">Card Number</label>
                                    <input type="text" class="form-control" id="card-number" name="card-number" value="{{ old('card-number') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="card-expiry-month">Card Expiry Month</label>
                                    <input type="text" class="form-control" id="card-expiry-month" name="card-expiry-month" value="{{ old('card-expiry-month') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="card-expiry-year">Card Expiry Year</label>
                                    <input type="text" class="form-control" id="card-expiry-year" name="card-expiry-year" value="{{ old('card-expiry-year') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="card-cvv">Card CVV</label>
                                    <input type="text" class="form-control" id="card-cvv" name="card-cvv" value="{{ old('card-cvv') }}" required>
                                </div> --}}
                                <button type="submit" class="btn btn-primary">Place Order</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-3">Your Order</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Cart::content() as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->price * $item->qty }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Subtotal</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{ Cart::subtotal() }}</th>
                                    </tr>
                                    <tr>
                                        <th>Tax</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{ Cart::tax() }}</th>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                        <th>{{ Cart::total() }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white p-4 mb-4">
                        <h4 class="mb-3">Need Help?</h4>
                        <p>We are here to help you. Call us on 804) 721-0983 or email us at <EMAIL></p>
                    </div>
                    <div class="bg-white p-4 mb-4">
                        <h4 class="mb-3">Order Tracking</h4>
                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="order-id">Order ID</label>
                                <input type="text" class="form-control" id="order-id" name="order-id" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Track Order</button>
                        </form>
                    </div>
                    <div class="bg-white p-4 mb-4">
                        <h4 class="mb-3">Payment Method</h4>
                        <p>We accept the following payment methods:</p>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-cc-visa fa-lg text-primary mr-2"></i> Visa</li>
                            <li><i class="fa fa-cc-mastercard fa-lg text-primary mr-2"></i> Mastercard</li>
                            <li><i class="fa fa-cc-paypal fa-lg text-primary mr-2"></i> PayPal</li>
                            <li><i class="fa fa-money fa-lg text-primary mr-2"></i> Bank Transfer</li>

                        </ul>

                    </div>
                    <div class="bg-white p-4 mb-4">
                        <h4 class="mb-3">Delivery Information</h4>

                        <p>We also accept cash on delivery.</p>
                        <p>Please note that delivery times may vary depending on your location and order size.</p>
                        <p>Please allow 2-3 days for delivery.</p>


                    </div>







                    </div>
                    </div>
            </div>
        </div>
    </section>
</div>
<!-- content close -->
@endsection
