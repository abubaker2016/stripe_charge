<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;

class ProductController extends Controller
{
     /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function checkout($id)
    {
        try {
            $productData = Product::find($id);    
        } catch (DecryptException $e) {
            return redirect()->route('product-list')->with('error','Invalid Product.');
        }
        
        return view('product.checkout', compact('productData'));
    }

    public function success(){
        return view('product.success');
    }
}
