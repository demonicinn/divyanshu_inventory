<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockProducts extends Model
{
    //
    protected $fillable = [
        'store_id',
        'stock_id',
        'product_id',
        'units',
        'kg',
        'price',
        'new_stock'
    ];


    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}
