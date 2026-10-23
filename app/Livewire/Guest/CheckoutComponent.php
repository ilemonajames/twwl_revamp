<?php

namespace App\Livewire\Guest;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public function removeProduct($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->dispatch('refreshComponent')->to('guest.guest-navigation');
    }

    public function increaseQuantity($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        if ($item->qty < 99) {
            Cart::instance('cart')->update($rowId, $item->qty + 1);
        }
        $this->dispatch('refreshComponent')->to('guest.guest-navigation');
    }

    public function decreaseQuantity($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        if ($item->qty > 1) {
            Cart::instance('cart')->update($rowId, $item->qty - 1);
        }
        $this->dispatch('refreshComponent')->to('guest.guest-navigation');
    }

    public function processPayment()
    {
        return redirect()->route('product.checkout');
    }

    public function render()
    {
        $cartItems = Cart::instance('cart')->content();
        $subtotal = Cart::instance('cart')->subtotal();

        return view('livewire.guest.checkout-component', compact('cartItems', 'subtotal'));
    }
}
