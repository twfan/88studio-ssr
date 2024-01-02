<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(?string $category = 'static' )
    {
        $products = Product::with('category');
        
        switch ($category) {
            case 'static':
                $products = $products->where('category_id', 23);
            break;
            case 'animated':
                $products = $products->where('category_id', 24);
            break;
        }
        $products = $products->get();
        $user = null;
        $cartItemTotal = 0;
        $cartTotalPrice = 0;
        $addedProduct = [];

        if(Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id);
            $addedProduct = $cart->pluck('product_id');
            $cartItemTotal = $cart->count();
            $cartTotalPrice = $cart->sum('price');
        }
        return view('ych-comission')->with(['products' => $products , 'user' => $user, 'cartItemTotal' => $cartItemTotal, 'cartTotalPrice' => $cartTotalPrice, 'addedProduct' => $addedProduct]);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
