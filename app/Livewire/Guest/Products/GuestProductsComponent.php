<?php

namespace App\Livewire\Guest\Products;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class GuestProductsComponent extends Component
{

    public $page;

    public function mount($page){
        $this->page = $page;
    }

    public function addToCart(Product $product){
        Cart::instance('cart')->add($product->id,$product->product_name, 1, $product->price)->associate(Product::class);
        $this->dispatch('refreshComponent')->to('guest.guest-navigation');
        $this->dispatch('feedback', feedback: "success");
    }

    public function render()
    {
        $products;
        if($this->page=="Home"){
            $products = Product::limit(3)->get();
        }else{
            $products = App\Models\Product::paginate(12);
        }
        return view('livewire.guest.products.guest-products-component',compact('products'));
    }
}
