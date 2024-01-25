<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('product');
        $cartTotalPrice = $cart->sum('price');
        $carts = $cart->get();
        return view('member.cart')->with(['user' => $user, 'carts'=> $carts, 'totalPrice' => $cartTotalPrice]);
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
        if(Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->where('product_id', $request->product['id'])->first();
            
            if (!empty($cart)) {
                $cart = Cart::find($cart->id);
                $cart->delete();
                $response['action'] = 'remove';
            } else {
                $cart = new Cart;
                $cart->user_id = $user->id;
                $cart->product_id = $request->product['id'];
                $cart->price = $request->product['price'];
                $cart->save();
                $response['action'] = 'add';
            }

            $cart = Cart::where('user_id', $user->id);
            $response['cartItemTotal'] = $cart->count();
            $response['cartTotalPrice'] = $cart->sum('price');
            return response()->json($response);
        }
    }

    public function checkout()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('product')->get();
        try {
            DB::beginTransaction();
            
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->save();
            foreach($cart as $cartItem) {
                
                $transaction->sub_total += $cartItem->product->price;
                $transaction->grand_total += $cartItem->product->price;
                
                $transactionDetail = new TransactionDetails();
                $transactionDetail->transaction_id = $transaction->id;
                $transactionDetail->product_id = $cartItem->product->id;
                $transactionDetail->price = $cartItem->product->price;
                $transactionDetail->save();

                $this->destroy($cartItem->id);
            }
            $transaction->save();

            DB::commit();

            return redirect(route('member.transaction.index'));

        } catch (Exception $e) {
            DB::rollBack();
        }
        
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
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
}
