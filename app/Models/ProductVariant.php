<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'size_or_type',
        'unit',
        'quantity_in_stock',
        'unit_price',

    ];

     public function product()
{
    return $this->belongsTo(Product::class,'product_id');
}

}
