<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryCollection;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin/categories/index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->tos = $request->input('content');
        if ($category->save()) {
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
        } else {
            return back()->withInput()->with('error', 'Something went wrong!');
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
        $category = Category::find($id);
        $categoryCollection = CategoryCollection::where('category_id', $category->id)->latest()->get();
        return view('admin.categories.edit', compact('category', 'categoryCollection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->tos = $request->input('tos');
        if ($category->save()) {
            return response()->json(['message' => 'Category updated successfully'], 200);
        } else {
            return back()->withInput()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category->delete()) {
            // toastr()->success('Data has been deleted successfully!');
            return redirect()->route('admin.categories.index')->with('success', 'Data has been deleted successfully!');;
        }
    }


    public function addCollection(Request $request)
    {
        $category = Category::find($request->input('category_id'));
        $collection = new CategoryCollection();
        if (!empty($category)) {
            $collection->category_id = $category->id;
            $collection->name = $request->input('collection');
        }
        $collection->save();
        return redirect()->route('admin.categories.edit', $request->input('category_id'))->with('success', 'Collection created successfully');
    }

    public function removeCollection(String $id, Request $request)
    {
        $categoryCollection = CategoryCollection::find($id);
        $categoryCollection->delete();
        return redirect()->route('admin.categories.edit', $request->categoryId)->with('success', 'Collection deleted successfully');
    }

    public function showCollection(Request $request)
    {
        $collection = CategoryCollection::where('category_id', $request->categoryId)->get();
        return $collection;
    }
}
