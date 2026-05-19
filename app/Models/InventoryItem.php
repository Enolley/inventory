<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [

        'item_name',
        'category_id',
        'brand_id',
        'unit_id',
        'location_id',
        'supplier_id',

        'quantity_bought',
        'unit_price',
        'total_price',

        'quantity_received',
        'received_by',
        'date_received',

        'stock_balance',

        'serial_numbers',
        'tag_numbers',

        'comments'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}