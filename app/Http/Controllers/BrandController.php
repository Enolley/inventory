<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::with('category')
            ->latest()
            ->get();

        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();

        return view('brands.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:brands'
        ]);

        Brand::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status ?? 1
        ]);

        return redirect('/brands')
            ->with('success', 'Brand created successfully');
    }

    public function edit(Brand $brand)
    {
        $categories = Category::where('status', 1)->get();

        return view('brands.edit', compact('brand', 'categories'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:brands,name,' . $brand->id
        ]);

        $brand->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status ?? 1
        ]);

        return redirect('/brands')
            ->with('success', 'Brand updated successfully');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect('/brands')
            ->with('success', 'Brand deleted successfully');
    }
}