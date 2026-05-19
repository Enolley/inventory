<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with([
            'inventoryItem',
            'issuer'
        ])->latest()->get();

        return view('stock-movements.index', compact('movements'));
    }

    public function create()
    {
        $items = InventoryItem::all();

        return view('stock-movements.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'inventory_item_id' => 'required',
            'quantity_issued' => 'required|integer|min:1',
            'issued_to' => 'required'

        ]);

        $item = InventoryItem::findOrFail($request->inventory_item_id);

        // PREVENT NEGATIVE STOCK
        if($request->quantity_issued > $item->stock_balance){

            return back()
                ->with('error', 'Insufficient stock available.');

        }

        // CREATE MOVEMENT
        StockMovement::create([

            'inventory_item_id' => $request->inventory_item_id,
            'quantity_issued' => $request->quantity_issued,
            'issued_to' => $request->issued_to,
            'issued_by' => auth()->id(),
            'purpose' => $request->purpose,
            'department' => $request->department,
            'issued_at' => now()

        ]);

        // DEDUCT STOCK
        $item->update([

            'stock_balance' =>
                $item->stock_balance - $request->quantity_issued

        ]);

        return redirect('/stock-movements')
            ->with('success', 'Stock issued successfully');

    }

    public function show(StockMovement $stockMovement)
    {
        return view('stock-movements.show', compact('stockMovement'));
    }

    public function destroy(StockMovement $stockMovement)
    {
        // RESTORE STOCK WHEN DELETED
        $item = $stockMovement->inventoryItem;

        $item->update([

            'stock_balance' =>
                $item->stock_balance + $stockMovement->quantity_issued

        ]);

        $stockMovement->delete();

        return redirect('/stock-movements')
            ->with('success', 'Movement deleted and stock restored');

    }
}