<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Cart;

class CheckoutComponent extends Component
{
    public $name, $email, $address, $paymentToken;

    public function removeProduct($rowId){
        Cart::instance('cart')->remove($rowId);
       $this->dispatch('refreshComponent')->to('guest.guest-navigation');
       $this->dispatch('feedback', feedback: "Product removed from cart");
    }

    //increment product quantity in cart
    public function increaseQuantity($rowId){
        $proudct = Cart::instance('cart')->get($rowId);
        $qty = $proudct->qty + 1;
        Cart::update($rowId, $qty);
       $this->dispatch('refreshComponent')->to('guest.guest-navigation');

    }

    //decrement product quantity from cart
    public function decreaseQuantity($rowId){
        $proudct = Cart::instance('cart')->get($rowId);
        $qty = $proudct->qty - 1;
        Cart::update($rowId, $qty);
       $this->dispatch('refreshComponent')->to('guest.guest-navigation');

    }


    public function processPayment()
    {
        // Validate input fields
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
        ]);

        // Initialize Square Client
        $client = new SquareClient([
            'accessToken' => config('services.square.access_token'),
            'environment' => config('services.square.environment'),
        ]);

        // Create Payment
        try {
            if (is_null($this->paymentToken)) {
                throw new \Exception('Payment token is missing. Please try again.');
            }

            $subtotal = Cart::instance('cart')->subtotal(); // Get the subtotal
            $subtotalNumeric = floatval(str_replace(',', '', $subtotal)); // Remove commas and convert to float
            $totalAmount = intval($subtotalNumeric * 100); // Convert to cents as an integer

            // Create Money object
            $money = new Money();
            $money->setAmount($totalAmount);
            $money->setCurrency('USD');

            // Create the payment request
            $createPaymentRequest = new CreatePaymentRequest(
                $this->paymentToken, // source_id
                uniqid(), // idempotency_key
                $money
            );
            $createPaymentRequest->setAutocomplete(true);
            $createPaymentRequest->setNote('Cart Checkout Payment');
            $createPaymentRequest->setLocationId(config('services.square.location_id'));

            // Execute the payment
            $paymentResponse = $client->getPaymentsApi()->createPayment($createPaymentRequest);

            if ($paymentResponse->isSuccess()) {
                // Clear Cart
                Cart::instance('cart')->destroy();

                // Dispatch success message
                $this->dispatch('feedback', feedback: 'Payment successful!');
            } else {
                // Handle payment errors
                $errors = $paymentResponse->getErrors();
                throw new \Exception(implode(', ', $errors));
            }
        } catch (\Exception $e) {
            $this->dispatch('errorfeedback', errorfeedback: 'Payment failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $cartItems = Cart::instance('cart')->content();
        $subtotal = Cart::instance('cart')->subtotal();
        return view('livewire.guest.checkout-component',compact('cartItems', 'subtotal'));
    }
}
