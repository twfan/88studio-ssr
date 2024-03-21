<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\LikeProduct;
use App\Models\Product;
use App\Models\ProductLike;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(?string $category = 'static' )
    {
        $products = Product::with(['category', 'likes']);
        $reviews = Review::with(['user', 'transaction'])->orderBy('created_at', 'desc')->paginate(10);
        switch ($category) {
            case 'static':
                $products = $products->where('category_id', Category::STATIC);
                $category = Category::find(Category::STATIC);
            break;
            case 'animated':
                $products = $products->where('category_id', Category::ANIMATED);
                $category = Category::find(Category::ANIMATED);
            break;
            default:
            return abort(Response::HTTP_NOT_FOUND);
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
        return view('ych-comission')->with([ 'reviews' => $reviews, 'category' => $category ,'products' => $products , 'user' => $user, 'cartItemTotal' => $cartItemTotal, 'cartTotalPrice' => $cartTotalPrice, 'addedProduct' => $addedProduct]);    
    }

    public function likeProduct(Request $request) {
        $user = Auth::user();
        $product = $request->product;
        $checkLike = ProductLike::where('user_id', $user->id)->where('product_id', $product['id'])->first();
        if (!empty($checkLike)) {
            $checkLike->delete();
            return response()->json([
                'message' => 'Unlike product success',
                'action' => 'unlike'
            ], 200);
        } else {
            if (!empty($user) && !empty($product)) {
                $productLike = new ProductLike();
                $productLike->user_id = $user->id;
                $productLike->product_id = $product['id'];
                $productLike->save();
                return response()->json([
                    'message' => 'Like product success',
                    'action' => 'like'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Like product failed',
                    'action' => 'unlike'
                ], 404);
            }
        }
    }

    public function adoptVtuber($vtuber) 
    {
        $product = Product::find($vtuber);
        $user = Auth::user();
        if (!empty($product->user_id)) {
            if ($product->user_id != $user->id) {
                return abort(Response::HTTP_FORBIDDEN);
            } else {
                return view('member.adopt-vtuber', compact('product', 'user'));
            }
        } else {
            return abort(Response::HTTP_FORBIDDEN);
        }
    }

    public function downloadVtuber($vtuber)
    {
        $product = Product::find($vtuber);
        $user = Auth::user();
        if ($product->user_id != $user->id) {
            return abort(Response::HTTP_FORBIDDEN);
        } else {
            return Storage::download($product->downloadable_product);
        }
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
