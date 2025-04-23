<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'address',
        'number',
        'images',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'store_id');
    }
}
