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

    public function addMaterial(Product $product)
    {
        $cartItem = Cart::instance('cart')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($cartItem->isNotEmpty()) {
            $this->dispatch('errorfeedback', errorfeedback: "Product already in cart!");
            return;
        }
        Cart::instance('cart')->add($product->id, $product->product_name, 1, $product->price)->associate(Product::class);

        $this->dispatch('refreshComponent')->to('guest.guest-navigation');
        $this->dispatch('feedback', feedback: "Product added to cart!");
    }

    public function buyProduct(Product $product)
    {
        Cart::instance('cart')->add([
            'id'       => $product->id,
            'name'     => $product->product_name,
            'qty'      => 1,
            'price'    => $product->price,
        ])->associate(Product::class);
        $this->dispatch('refreshComponent')->to('guest.guest-navigation');
        return redirect()->route('product.checkout')->with('success', 'Product added to cart successfully!');
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
