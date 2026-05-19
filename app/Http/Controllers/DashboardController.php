<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InventoryItem;
use App\Models\Location;
use App\Models\StockMovement;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = InventoryItem::count();

        $lowStockItems = InventoryItem::where('stock_balance', '<=', 3)
            ->latest()
            ->take(5)
            ->get();

        $recentMovements = StockMovement::with('inventoryItem')
            ->latest()
            ->take(5)
            ->get();

        $totalInventoryValue = InventoryItem::sum('total_price');

        $totalCategories = Category::count();

        $totalAccounts = Location::count();

        $totalSuppliers = Supplier::count();

        $categoryLabels = Category::pluck('name');

        $categoryCounts = [];

        foreach(Category::withCount('inventoryItems')->get() as $cat){

            $categoryCounts[] = $cat->inventory_items_count;

        }

        return view('dashboard.index', compact(

            'totalItems',
            'lowStockItems',
            'recentMovements',
            'totalInventoryValue',
            'totalCategories',
            'totalAccounts',
            'totalSuppliers',
            'categoryLabels',
            'categoryCounts'

        ));
    }
}