<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'booking_id',
        'service_charge',
        'laber_charge',
        'total_amount',
        'status',
        'payment_method',
    ];

    public function booking()
    {
        return $this->belongsTo(Service::class, 'booking_id');
    }
}

