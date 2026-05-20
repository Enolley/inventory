<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {

    return redirect('/login');

});

Route::get('/login', [AuthController::class, 'login']);

Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware('auth')->group(function(){

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('locations', App\Http\Controllers\LocationController::class);

    Route::resource('categories', App\Http\Controllers\CategoryController::class);

    Route::resource('brands', App\Http\Controllers\BrandController::class);

    Route::resource('units', App\Http\Controllers\UnitController::class);

    Route::resource('suppliers', App\Http\Controllers\SupplierController::class);

    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::middleware(['auth', 'role:admin,storekeeper'])
    ->group(function () {

        Route::resource(
            'inventory',
            App\Http\Controllers\InventoryItemController::class
        );

        Route::resource(
            'stock-movements',
            App\Http\Controllers\StockMovementController::class
        );

        Route::get('/inventory-report',
            [App\Http\Controllers\InventoryItemController::class, 'report']
        )->name('inventory.report');

        Route::get('/inventory-export-csv',
            [App\Http\Controllers\InventoryItemController::class, 'exportCsv']
        )->name('inventory.export.csv');

        Route::get('/inventory-pdf-report',
            [App\Http\Controllers\InventoryItemController::class, 'pdfReport']
        )->name('inventory.pdf.report');

        Route::resource('assets', App\Http\Controllers\AssetController::class);

    });

    Route::middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::resource('users', App\Http\Controllers\UserController::class);

    });

