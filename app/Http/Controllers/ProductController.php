<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function cart(){
        return view('products.shopping-cart');
    }

    public function checkout(){
        return view('products.checkout');
    }
}
