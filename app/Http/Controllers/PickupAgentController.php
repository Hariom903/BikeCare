<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class PickupAgentController extends Controller
{
 public function index(){
    $bookings = Service::where('status','assigned_to_pickup')->get();
     return view('PickupAgent',compact('bookings'));
 }
}
