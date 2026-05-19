<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [

        'name',
        'phone',
        'email',
        'address',
        'contact_person',
        'status'

    ];

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class);
    }
}