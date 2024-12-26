<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Square\SquareClient;
use Square\Environment;
use Square\Exceptions\ApiException;
use Square\Models\CreatePaymentRequest;
use Square\Models\Money;
use Gloudemans\Shoppingcart\Facades\Cart;

class MainCheckout extends Component
{
    protected $listeners = ['processPayment'];

    public $name;
    public $email;
    public $address;
    public $totalAmount;
    public $paymentToken;

    public function mount()
    {
        $this->totalAmount = (float) str_replace(',', '', Cart::instance('cart')->subtotal());
    }

    public function processPayment($token)
    {
        $client = app(SquareClient::class);

        $paymentsApi = $client->getPaymentsApi();
        try {
            $response = $paymentsApi->createPayment([
                'source_id' => $token,
                'amount_money' => [
                    'amount' => $this->totalAmount * 100, // Amount in cents
                    'currency' => 'USD',
                ],
                'idempotency_key' => uniqid(), // Unique key for this transaction
            ]);

            if ($response->isSuccess()) {
                session()->flash('success', 'Payment successful!');
                $this->dispatch('feedback', feedback: 'Payment successful!');
                return redirect()->route('all-products');
            } else {
                $this->dispatch('errorfeedback', errorfeedback: 'Payment failed: ' . $response->getErrors()[0]->getDetail());
            }
        } catch (\Exception $e) {
            $this->dispatch('errorfeedback', errorfeedback: 'Error processing payment: ' . $e->getMessage());
        }
    }

    // public function processPayment()
    // {
    //     if ($this->paymentToken) {
    //         $response = $this->processSquarePayment($this->paymentToken);

    //         if ($response['success']) {
    //             Cart::instance('cart')->destroy(); // Clear the cart after successful payment
    //             $this->dispatch('feedback', feedback: "Payment processed successfully!");
    //             return redirect()->route('all-products');
    //         } else {
    //             $this->dispatch('errorfeedback', errorfeedback: 'Payment failed: ' . $response['error']);
    //         }
    //     } else {
    //         $this->dispatch('errorfeedback', errorfeedback: 'Payment token is missing.');
    //     }
    // }

    // private function processSquarePayment($token)
    // {
    //     // Initialize Square API client
    //     $client = new SquareClient([
    //         'accessToken' => env('SQUARE_ACCESS_TOKEN'),
    //         'environment' => env('SQUARE_ENVIRONMENT') === 'production'
    //                             ? Environment::PRODUCTION
    //                             : Environment::SANDBOX,
    //     ]);

    //     $paymentsApi = $client->getPaymentsApi();

    //     // Convert totalAmount to cents (Square API expects the smallest currency unit)
    //     $amountInCents = (int) ($this->totalAmount * 100);

    //     // Create a payment request
    //     $requestBody = new CreatePaymentRequest(
    //         $token,
    //         uniqid('PAY_', true), // Unique ID with prefix
    //         new Money($amountInCents, 'USD') // Amount and currency
    //     );

    //     try {
    //         // Make the API call to process the payment
    //         $response = $paymentsApi->createPayment($requestBody);

    //         if ($response->isSuccess()) {
    //             return ['success' => true];
    //         } else {
    //             $errors = $response->getErrors();
    //             $errorDetails = collect($errors)->pluck('detail')->join('; ');
    //             return ['success' => false, 'error' => $errorDetails];
    //         }
    //     } catch (ApiException $e) {
    //         return ['success' => false, 'error' => $e->getMessage()];
    //     }
    // }

    public function render()
    {
        return view('livewire.guest.main-checkout')->layout('layout.mainlayout');
    }
}
