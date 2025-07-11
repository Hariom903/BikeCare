<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partassigntechnician extends Model
{
    protected $table = 'partassigntechnicians';

     protected $fillable = [
        'technician_id',
        'product_variant_id',
        'quantity',
        'price',
        'booking_id',

     ];
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');

    }
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
    // public function booking()
    // {
    //     return $this->belongsTo(Service::class, 'booking_id');
    // }


}
