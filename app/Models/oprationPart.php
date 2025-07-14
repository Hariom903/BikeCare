<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OprationPart extends Model
{
     protected $table = 'opration_parts';
     protected $fillable = [
         'booking_id',
         'product_variant_id',
         'quantity',
         'price',
         'total',
         'created_by',
         'updated_by',
     ];

        public function productVariant()
        {
            return $this->belongsTo(ProductVariant::class, 'product_variant_id');
        }

}
