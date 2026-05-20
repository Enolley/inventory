<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [

        'name',
        'serial_number',
        'tag_number',
        'buying_price',
        'depreciation_rate',
        'current_price',
        'assigned_location_id',
        'is_transferred',
        'current_location_id',
        'is_faulty',
        'status',
        'date_bought'

    ];

    public function assignedLocation()
    {
        return $this->belongsTo(
            Location::class,
            'assigned_location_id'
        );
    }

    public function currentLocation()
    {
        return $this->belongsTo(
            Location::class,
            'current_location_id'
        );
    }

    // AUTO CALCULATE CURRENT PRICE
    protected static function booted()
    {
        static::saving(function ($asset) {

            $asset->current_price =

                $asset->buying_price -

                (
                    $asset->buying_price *
                    ($asset->depreciation_rate / 100)
                );

        });
    }
}