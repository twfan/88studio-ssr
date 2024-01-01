<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $pathImage = Storage::put('public/products', $request->file('image'), 'public');
        $product->category_id = $request->category;
        $imageUrl = asset(Storage::url($pathImage));
        $product->image = $imageUrl;
        $product->price = $request->price;
        if (!empty($request->youtube)) {
            $pathBgVtuber = Storage::put('public/products', $request->file('transparent_background'), 'public');
            $fullPathBgVtuber = asset(Storage::url($pathBgVtuber));
            $product->youtube_url = $request->youtube;
            $product->transparent_background = $fullPathBgVtuber;
        }
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
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
        $categories = Category::all();
        $product = Product::find($id);
        return view('admin.products.edit', compact('product', 'categories'));
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
        $product = Product::find($id);
        if($product->trasparent_background) {
            $url = $product->transparent_background;
            $filePath = public_path(str_replace(url('/storage'), 'storage', $url));
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        if($product->image) {
            $url = $product->image;
            $filePath = public_path(str_replace(url('/storage'), 'storage', $url));
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}
