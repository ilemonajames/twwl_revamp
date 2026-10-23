<?php

namespace App\Livewire\Guest;

use App\Models\PaymentAttempt;
use App\Services\CheckoutService;
use App\Services\SquarePaymentService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Component;

class MainCheckout extends Component
{
    public $name = '';

    public $email = '';

    public $address = '';

    public $totalAmount = 0;

    #[Locked]
    public string $attemptId;

    public function mount(): void
    {
        // Kept in the session so a refresh does not create another charge after an uncertain response.
        $this->attemptId = session()->get('checkout_attempt_id', (string) Str::uuid());
        session()->put('checkout_attempt_id', $this->attemptId);
    }

    public function processPayment(string $token)
    {
        $billing = $this->validate([
            'name' => 'required|string|max:255', 'email' => 'required|email|max:255',
            'address' => 'required|string|max:2000',
        ]);
        $attempt = app(CheckoutService::class)->prepare($this->attemptId, $billing);
        $attempt = app(SquarePaymentService::class)->charge($attempt, $token);
        if ($attempt->status === 'completed') {
            return $this->finishOrder();
        }
        $this->addError('payment', 'Payment has not completed. Please check its status before trying again.');
    }

    public function finishOrder()
    {
        abort_unless(session('checkout_attempt_id') === $this->attemptId, 403);
        abort_unless(PaymentAttempt::whereKey($this->attemptId)->where('status', 'completed')->exists(), 422);
        Cart::instance('cart')->destroy();
        session()->forget('checkout_attempt_id');

        return redirect()->route('all-products')->with('feedback', 'Payment confirmed. Your order has been recorded.');
    }

    public function render()
    {
        $attempt = isset($this->attemptId) ? PaymentAttempt::with('order')->find($this->attemptId) : null;
        $quote = null;
        if (! $attempt) {
            try {
                $quote = app(CheckoutService::class)->quote();
            } catch (\Illuminate\Validation\ValidationException $e) {
                $this->addError('payment', $e->validator->errors()->first());
            }
        }

        return view('livewire.guest.main-checkout', compact('quote', 'attempt'))->layout('layout.mainlayout');
    }
}
