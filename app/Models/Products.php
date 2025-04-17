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



}
