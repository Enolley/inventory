<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Location;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with([
            'assignedLocation',
            'currentLocation'
        ])->latest()->get();

        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        $locations = Location::all();

        return view('assets.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'tag_number' => 'required|unique:assets',
            'buying_price' => 'required|numeric',
            'depreciation_rate' => 'required|numeric'

        ]);

        Asset::create([

            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'tag_number' => $request->tag_number,
            'buying_price' => $request->buying_price,
            'depreciation_rate' => $request->depreciation_rate,
            'assigned_location_id' => $request->assigned_location_id,
            'current_location_id' => $request->assigned_location_id ?? $request->assigned_location_id,
            'is_faulty' => $request->is_faulty ? 1 : 0,
            'status' => $request->status,
            'date_bought' => $request->date_bought

        ]);

        return redirect('/assets')
            ->with('success', 'Asset created successfully');
    }

    public function show(Asset $asset)
    {
        return view('assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        $locations = Location::all();

        return view('assets.edit', compact(
            'asset',
            'locations'
        ));
    }

    public function update(Request $request, Asset $asset)
    {
        $asset->update([

            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'tag_number' => $request->tag_number,
            'buying_price' => $request->buying_price,
            'depreciation_rate' => $request->depreciation_rate,
            'assigned_location_id' =>
                $request->assigned_location_id,
            'current_location_id' =>
                $request->current_location_id,
            'is_transferred' =>
                $request->is_transferred ? 1 : 0,
            'is_faulty' =>
                $request->is_faulty ? 1 : 0,
            'status' => $request->status,
            'date_bought' => $request->date_bought

        ]);

        return redirect('/assets')
            ->with('success', 'Asset updated successfully');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect('/assets')
            ->with('success', 'Asset deleted successfully');
    }
}