<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Cart;

class CheckoutComponent extends Component
{

    public function removeProduct($rowId){
        Cart::instance('cart')->remove($rowId);
       $this->dispatch('refreshComponent')->to('guest.guest-navigation');
       $this->dispatch('feedback', feedback: "success");
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

    public function render()
    {
        return view('livewire.guest.checkout-component');
    }
}
