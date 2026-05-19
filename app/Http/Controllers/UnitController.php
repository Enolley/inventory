<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::latest()->get();

        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|unique:units'

        ]);

        Unit::create([

            'name' => $request->name,
            'short_name' => $request->short_name,
            'status' => $request->status ?? 1

        ]);

        return redirect('/units')
            ->with('success', 'Unit created successfully');
    }

    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([

            'name' => 'required|unique:units,name,' . $unit->id

        ]);

        $unit->update([

            'name' => $request->name,
            'short_name' => $request->short_name,
            'status' => $request->status ?? 1

        ]);

        return redirect('/units')
            ->with('success', 'Unit updated successfully');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect('/units')
            ->with('success', 'Unit deleted successfully');
    }
}