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
}
