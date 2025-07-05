<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function index(){
         $bookings = Service::with('user')->get();
         $pickupAgents = User::where('role','picupAgent')->get();
         $technicians = User::where('role','technician')->get();
        return view('receptionist',compact('bookings','pickupAgents','technicians'));
    }

}
