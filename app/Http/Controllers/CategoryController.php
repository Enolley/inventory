<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if($request->search){

            $query->where('name', 'like', '%' . $request->search . '%');

        }

        $categories = $query->latest()->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|unique:categories'

        ]);

        Category::create([

            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status ?? 1

        ]);

        return redirect('/categories')
            ->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([

            'name' => 'required|unique:categories,name,' . $category->id

        ]);

        $category->update([

            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status ?? 1

        ]);

        return redirect('/categories')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/categories')
            ->with('success', 'Category deleted successfully');
    }
}