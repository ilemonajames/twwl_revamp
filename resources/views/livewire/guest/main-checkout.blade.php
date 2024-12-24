<div>
    @section('title')
        Checkout
    @endsection

    @section('content')
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>

            <!-- Checkout Content -->
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

            <section class="bg-light">
                <div class="container">
                    <div class="row">
                        <!-- Billing Details -->
                        <div class="col-lg-8 mb-5 mb-lg-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-3">Billing Details</h4>
                                    <form wire:submit.prevent="processPayment">
                                        @csrf
                                        <div>
                                            <label for="name">Name</label>
                                            <input type="text" id="name" wire:model="name" class="form-control" required />
                                        </div>
                                        <div>
                                            <label for="email">Email</label>
                                            <input type="email" id="email" wire:model="email" class="form-control" required />
                                        </div>
                                        <div>
                                            <label for="address">Address</label>
                                            <textarea id="address" wire:model="address" class="form-control" required></textarea>
                                        </div>

                                        <!-- Square Card Form Container -->
                                        <div id="card-container" class="mt-3"></div>
                                        <!-- Pay Now Button -->
                                        <button type="submit" id="card-button" class="btn btn-primary mt-3">Pay Now</button>
                                    </form>
                                </div>

                                <!-- Order Summary -->
                                <div class="col-md-6">
                                    <h4 class="mb-3">Your Order</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
                                                <th>Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(Cart::instance('cart')->content() as $cart)
                                                <tr>
                                                    <td>{{ $cart->model->product_name }}</td>
                                                    <td>{{ number_format($cart->price) }}</td>
                                                    <td>{{ $cart->qty }}</td>
                                                    <td>{{ number_format($cart->subtotal) }}</td>
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

                        <!-- Sidebar -->
                        <div class="col-lg-4">
                            <div class="bg-white p-4 mb-4">
                                <h4 class="mb-3">Need Help?</h4>
                                <p>We are here to help you. Call us on 804) 721-0983 or email us at <EMAIL></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
        @push('scripts')

        <script>
            // console.log('Initializing Square Payments...');
            // const payments = window.Square.payments("{{ env('SQUARE_ACCESS_TOKEN') }}", "{{ env('SQUARE_LOCATION_ID') }}");
            // console.log('Payments object:', payments);

            document.addEventListener('livewire:load', async () => {
                try {
                    // Initialize Square Payments
                    const payments = window.Square.payments("{{ env('SQUARE_ACCESS_TOKEN') }}", "{{ env('SQUARE_LOCATION_ID') }}");
                    if (!payments) {
                        throw new Error('Failed to initialize Square payments object. Check your environment variables.');
                    }

                    // Initialize Card Payment Method
                    const card = await payments.card();
                    if (!card) {
                        throw new Error('Failed to initialize card payment method.');
                    }

                    // Attach the card to the container
                    await card.attach('#card-container');

                    // Enable the Pay Now button after successful attachment
                    const button = document.getElementById('card-button');
                    button.disabled = false;

                    // Handle Pay Now button click
                    button.addEventListener('click', async (event) => {
                        event.preventDefault();

                        // Tokenize the card
                        const { token, errors } = await card.tokenize();
                        if (errors) {
                            console.error('Card tokenization errors:', errors);
                            alert('Failed to process payment. Please check your card details and try again.');
                            return;
                        }

                        // Pass the token to Livewire for processing
                        console.log('Payment Token:', token); // Debugging
                        @this.set('paymentToken', token);
                        @this.processPayment();
                    });
                } catch (error) {
                    // Log and display errors
                    console.error('Square Payment Initialization Error:', error);
                    alert('Failed to initialize payment system. Please refresh the page and try again.');
                }
            });
        </script>
        @endpush

    @endsection
</div>
