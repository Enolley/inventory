<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Location;
use App\Models\Supplier;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function index(Request $request)
    {
        $query = InventoryItem::with([
            'category',
            'brand',
            'unit',
            'location'
        ]);

        // SEARCH
        if($request->search){

            $query->where('item_name', 'like', '%' . $request->search . '%');

        }

        // LOW STOCK FILTER
        if($request->low_stock){

            $query->where('stock_balance', '<=', 3);

        }

        $items = $query->latest()->get();

        return view('inventory.index', compact('items'));
    }

    public function create()
    {
        return view('inventory.create', [
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'units' => Unit::all(),
            'locations' => Location::all(),
            'suppliers' => Supplier::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required'
        ]);

        // AUTO CALCULATIONS
        $totalPrice = $request->quantity_bought * $request->unit_price;

        $stockBalance = $request->quantity_received ?? 0;

        InventoryItem::create([
            'item_name' => $request->item_name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'unit_id' => $request->unit_id,
            'location_id' => $request->location_id,
            'supplier_id' => $request->supplier_id,

            'quantity_bought' => $request->quantity_bought,
            'unit_price' => $request->unit_price,
            'total_price' => $totalPrice,

            'quantity_received' => $request->quantity_received,
            'received_by' => auth()->id(),
            'date_received' => now(),

            'stock_balance' => $stockBalance,

            'serial_numbers' => $request->serial_numbers,
            'tag_numbers' => $request->tag_numbers,

            'comments' => $request->comments
        ]);

        return redirect('/inventory')
            ->with('success', 'Inventory item added successfully');
    }

    public function show(InventoryItem $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    public function edit(InventoryItem $inventory)
    {
        return view('inventory.edit', [
            'inventory' => $inventory,
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'units' => Unit::all(),
            'locations' => Location::all(),
            'suppliers' => Supplier::all()
        ]);
    }

    public function update(Request $request, InventoryItem $inventory)
    {
        $request->validate([
            'item_name' => 'required'
        ]);

        $totalPrice = $request->quantity_bought * $request->unit_price;

        $inventory->update([
            'item_name' => $request->item_name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'unit_id' => $request->unit_id,
            'location_id' => $request->location_id,
            'supplier_id' => $request->supplier_id,

            'quantity_bought' => $request->quantity_bought,
            'unit_price' => $request->unit_price,
            'total_price' => $totalPrice,

            'quantity_received' => $request->quantity_received,
            'received_by' => auth()->id(),

            'stock_balance' => $request->quantity_received,

            'serial_numbers' => $request->serial_numbers,
            'tag_numbers' => $request->tag_numbers,

            'comments' => $request->comments
        ]);

        return redirect('/inventory')
            ->with('success', 'Inventory updated successfully');
    }

    public function destroy(InventoryItem $inventory)
    {
        $inventory->delete();

        return redirect('/inventory')
            ->with('success', 'Inventory deleted successfully');
    }

    public function report()
    {
        $items = InventoryItem::with([
            'category',
            'brand',
            'location'
        ])->get();

        return view('inventory.report', compact('items'));
    }

    public function exportCsv()
    {
        $fileName = 'inventory-report.csv';

        $items = InventoryItem::with([
            'category',
            'brand',
            'location'
        ])->get();

        $headers = [

            'Content-Type' => 'text/csv',
            'Content-Disposition' =>
                'attachment; filename="'.$fileName.'"',

        ];

        $callback = function () use ($items) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [

                'Item',
                'Category',
                'Brand',
                'Location',
                'Quantity',
                'Balance',
                'Unit Price',
                'Total Price'

            ]);

            foreach ($items as $item) {

                fputcsv($file, [

                    $item->item_name,
                    $item->category->name ?? '',
                    $item->brand->name ?? '',
                    $item->location->name ?? '',
                    $item->quantity_received,
                    $item->stock_balance,
                    $item->unit_price,
                    $item->total_price

                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function pdfReport()
    {
        $items = InventoryItem::with([
            'category',
            'brand',
            'location'
        ])->get();

        return view('inventory.pdf-report', compact('items'));
    }
}