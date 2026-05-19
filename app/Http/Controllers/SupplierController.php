<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->get();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|unique:suppliers'

        ]);

        Supplier::create([

            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'contact_person' => $request->contact_person,
            'status' => $request->status ?? 1

        ]);

        return redirect('/suppliers')
            ->with('success', 'Supplier created successfully');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([

            'name' => 'required|unique:suppliers,name,' . $supplier->id

        ]);

        $supplier->update([

            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'contact_person' => $request->contact_person,
            'status' => $request->status ?? 1

        ]);

        return redirect('/suppliers')
            ->with('success', 'Supplier updated successfully');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect('/suppliers')
            ->with('success', 'Supplier deleted successfully');
    }
}