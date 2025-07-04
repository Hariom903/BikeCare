<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'brand',
    ];

     public function ProductVariant()
{
    return $this->hasMany(ProductVariant::class);
}
}

