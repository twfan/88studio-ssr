<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $banner = new Banner();
        $banner->name = $request->name;
        if ($request->file('image')) {
            $pathImage = Storage::put('public/banners/', $request->file('image'), 'public');
            $imageUrl = asset(Storage::url($pathImage));
            $banner->image = $imageUrl;
        }
        $banner->status = $request->status;
        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully');

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
        $banner = Banner::find($id);
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, string $id)
    {
        $banner = Banner::find($id);
        $banner->name = $request->name;
        if ($request->file('image')) {
            $pathImage = Storage::put('public/banners/', $request->file('image'), 'public');
            $imageUrl = asset(Storage::url($pathImage));
            $banner->image = $imageUrl;
        }
        $banner->status = $request->status;
        $banner->save();
        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully');
    }
}
