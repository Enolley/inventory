<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::latest()->get();

        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'code' => 'required|unique:locations'

        ]);

        Location::create([

            'name' => $request->name,
            'code' => $request->code,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'manager_name' => $request->manager_name,
            'status' => $request->status ?? 1

        ]);

        return redirect('/locations')
            ->with('success', 'Location added successfully');
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([

            'name' => 'required',

            'code' => 'required|unique:locations,code,' . $location->id

        ]);

        $location->update([

            'name' => $request->name,
            'code' => $request->code,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'manager_name' => $request->manager_name,
            'status' => $request->status ?? 1

        ]);

        return redirect('/locations')
            ->with('success', 'Location updated successfully');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect('/locations')
            ->with('success', 'Location deleted successfully');
    }
}