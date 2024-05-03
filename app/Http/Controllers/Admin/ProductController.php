<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryCollection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::where('product_type', Product::TYPE_YCH_COMISSION)->with('category')->orderBy('created_at', 'desc')->paginate(100);
        return view('admin.products.index', compact('products','categories'));
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

        $manager = new ImageManager(new Driver());
        $webp = $manager->read(($request->file('image')));
        $webp = $webp->resizeDown(320, 320);
        $webp = $webp->setLoops(0);
        $encoded = $webp->encodeByExtension('gif');

        // Generate a unique filename
        $filename = uniqid('product_') . '.webp';

        // Save the file to the storage
        Storage::put('public/products/' . $filename, (string)$encoded);

        // Set public visibility for the saved file
        Storage::setVisibility('public/products/' . $filename, 'public');

        // Retrieve the URL of the saved file
        $imageUrl = asset(Storage::url('public/products/' . $filename));

        $product->category_id = $request->category;
        $product->image = $imageUrl;
        $product->price = $request->price;
        $product->id_product = $request->id_product;

        if (!empty($request->categoryCollection)) {
            $collection = CategoryCollection::find($request->categoryCollection);
            if (!empty($collection)) {
                $product->category_collection_id = $collection->id;
                $product->collection_name = $collection->name;
            }
        }

        if (!empty($request->youtube)) {
            $pathBgVtuber = Storage::put('public/products', $request->file('transparent_background'), 'public');
            $fullPathBgVtuber = asset(Storage::url($pathBgVtuber));
            $product->product_name = $request->name_product;
            $product->youtube_url = $request->youtube;
            $product->transparent_background = $fullPathBgVtuber;
        }

        if (!empty($request->downloadable_product)) {
            $file = $request->file('downloadable_product');
            $path = $file->store('private-files');
            $product->downloadable_product = $path;
            Storage::setVisibility($path, 'private');
        }
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function bulkUpload(Request $request) 
    {
        if ($request->hasFile('products')) {
            foreach ($request->file('products') as $image) {
                $product = new Product();
                $idProduct = $image->getClientOriginalName();
                $fileNameWithoutExtension = pathinfo($idProduct, PATHINFO_FILENAME);
                $path = $image->storeAs('public/products', $idProduct);
                $product->category_id = $request->category;
                $imageUrl = asset(Storage::url($path));
                $product->image = $imageUrl;
                $product->price = "10";
                $product->id_product = $fileNameWithoutExtension;
                $product->save();
            }
        }

        return back()->with('success', 'Files uploaded successfully!');
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
        $product = Product::find($id);
        if ($request->file('image')) {
            $pathImage = Storage::put('public/products', $request->file('image'), 'public');
            $imageUrl = asset(Storage::url($pathImage));
            $product->image = $imageUrl;
        }
        $product->category_id = $request->category;
        $product->price = $request->price;

        if(!empty($request->name_product)) {
            $product->product_name = $request->name_product;
        }

        if (!empty($request->categoryCollection)) {
            $collection = CategoryCollection::find($request->categoryCollection);
            if (!empty($collection)) {
                $product->category_collection_id = $collection->id;
                $product->collection_name = $collection->name;
            }
        }
        
        if (!empty($request->file('transparent_background'))) {
            $pathBgVtuber = Storage::put('public/products', $request->file('transparent_background'), 'public');
            $fullPathBgVtuber = asset(Storage::url($pathBgVtuber));
            $product->transparent_background = $fullPathBgVtuber;
        }
        
        if (!empty($request->bestSelling)) {
            $product->best_selling = $request->bestSelling;
        }
        
        if (!empty($request->newSeller)) {
            $product->new_seller = $request->newSeller;
        }

        if (!empty($request->downloadable_product)) {
            $file = $request->file('downloadable_product');
            $path = $file->store('private-files');
            $product->downloadable_product = $path;
            Storage::setVisibility($path, 'private');
        }

        $product->id_product = $request->id_product;
        $product->youtube_url = $request->youtube;
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
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


    public function indexVtubers()
    {
        $products = Product::where('product_type', Product::TYPE_VTUBER)->get();
        return view('admin.products.vtuber.index', compact('products'));
    }


    public function storeVtuber(Request $request)
    {
        $product = new Product();
        $pathImage = Storage::put('public/products', $request->file('image'), 'public');
        $imageUrl = asset(Storage::url($pathImage));
        $product->image = $imageUrl;
        if (!empty($request->youtube)) {
            $pathBgVtuber = Storage::put('public/products', $request->file('transparent_background'), 'public');
            $fullPathBgVtuber = asset(Storage::url($pathBgVtuber));
            $product->product_name = $request->name_product;
            $product->youtube_url = $request->youtube;
            $product->transparent_background = $fullPathBgVtuber;
        }

        if (!empty($request->downloadable_product)) {
            $file = $request->file('downloadable_product');
            $path = $file->store('private-files');
            $product->downloadable_product = $path;
            Storage::setVisibility($path, 'private');
        }
        $product->price = $request->price;
        $product->id_product = $request->id_product;
        $product->product_name = $request->name_product;
        $product->product_type = Product::TYPE_VTUBER;
        $product->save();

        return redirect()->route('admin.vtubers.index')->with('success', 'Product vtuber created successfully');
    }

    public function editVtuber ($id) 
    {
        $product = Product::find($id);
        return view('admin.products.vtuber.edit', compact('product'));
    }

    public function updateVtuber(Request $request, string $id)
    {
        $product = Product::find($id);
        if ($request->file('image')) {
            $pathImage = Storage::put('public/products', $request->file('image'), 'public');
            $imageUrl = asset(Storage::url($pathImage));
            $product->image = $imageUrl;
        }
        $product->category_id = $request->category;
        $product->price = $request->price;

        if(!empty($request->name_product)) {
            $product->product_name = $request->name_product;
        }
        
        if (!empty($request->file('transparent_background'))) {
            $pathBgVtuber = Storage::put('public/products', $request->file('transparent_background'), 'public');
            $fullPathBgVtuber = asset(Storage::url($pathBgVtuber));
            $product->transparent_background = $fullPathBgVtuber;
        }
        
        if (!empty($request->soldOut)) {
            $product->sold_out = $request->soldOut;
        }

        if (!empty($request->downloadable_product)) {
            $file = $request->file('downloadable_product');
            $path = $file->store('private-files');
            $product->downloadable_product = $path;
            Storage::setVisibility($path, 'private');
        }

        $product->id_product = $request->id_product;
        $product->youtube_url = $request->youtube;
        $product->save();
        return redirect()->route('admin.vtubers.index')->with('success', 'Product vtuber updated successfully');
    }


    public function createVtuber()
    {
        return view('admin.products.vtuber.create');
    }

    public function destroyVtuber(string $id)
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
       
       
        return redirect()->route('admin.vtubers.index')->with('success', 'Product vtuber deleted successfully');
    }
}
