<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $fillable = [
        'user_id',
        'store_id',
        'sku',
        'name',
        'slug',
        'unit',
        'kg',
        'price',
        'images',
        'status',
    ];


    public function stockProducts()
    {
        return $this->hasMany(StockProducts::class, 'product_id');
    }

    public function productCurrentStock()
    {
        return $this->hasOne(StockProducts::class, 'product_id')->orderBy('id', 'desc');
    }
}
