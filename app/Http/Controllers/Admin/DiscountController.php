<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $discount = new Discount();
        $discount->name = $request->name;
        $discount->amount = $request->price;
        $discount->save();

        return redirect()->route('admin.discounts.index')->with('success', 'Discount created successfully');
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
        $discount = Discount::find($id);
        return view('admin.discounts.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $discount = Discount::find($id);
        $discount->name = $request->name;
        $discount->amount = $request->price;
        $discount->save();
        return redirect()->route('admin.discounts.index')->with('success', 'Discount updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discount = Discount::find($id);
        if ($discount->delete()) {
            // toastr()->success('Data has been deleted successfully!');
            return redirect()->route('admin.discounts.index')->with('success', 'Data has been deleted successfully!');;
        }
    }
}
