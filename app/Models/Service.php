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
        'service_type',
        'bikenumber'

    ];
 public function user()
{
    return $this->belongsTo(User::class,'assigned_manager_id');
}
public function pickupAgent(){
    return $this->belongsTo(User::class,'assigned_pickup_id');
}
public function technician(){
    return $this->belongsTo(User::class,'assigned_technician_id');
}

public function bills(){
    return $this->hasOne(Bill::class,'booking_id');
}

public function opretionPart(){
   return $this->hasMany(oprationPart::class,'booking_id');
}
}
