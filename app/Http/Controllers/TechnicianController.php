<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function index(){
          $bookings = Service::where('status','assigned_to_technician')
          ->orWhere('status','in_progress')
          ->get();
        return view('technician',compact('bookings'));
    }
}
