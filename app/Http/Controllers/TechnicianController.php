<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{
    public function index(){
          $bookings = Service::where('status','assigned_to_technician')
          ->orWhere('status','in_progress')
          ->where('assigned_technician_id',Auth::user()->id)
          ->get();
        return view('technician',compact('bookings'));
    }


public function markInProgress(Service $booking)
{

    $booking->update(['status' => 'in_progress']);
    return back()->with('success', 'Booking marked as In Progress');
}

public function markCompleted(Service $booking)
{
    $booking->update(['status' => 'completed']);
    return back()->with('success', 'Booking marked as Completed');
}
}

