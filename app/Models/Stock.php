<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $fillable = [
        'user_id',
        'store_id',
        'vehicle_number',
        'issue_date',
        'issue_time',
        'type'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function stockProducts()
    {
        return $this->hasMany(StockProducts::class, 'stock_id');
    }

}