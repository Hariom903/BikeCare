<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
       protected $fillable = [
        'part_name',
        'quantity',
        'unit_price'
    ];
}
