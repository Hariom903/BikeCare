<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable =[
        'customerName',
        'phone',
        'email',
        'address',
        'bikeType',
        'bikeBrand',
        'bikeModel',
        'year',
        'preferredDate',
        'preferredTime',
        'urgency',
        'issues',
        'status',
        'cost',
        'booking_id',
        'service',

    ];
}
