<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupAgentController extends Controller
{
 public function index(){
    $bookings = Service::where('status','assigned_to_pickup')->get();
     return view('PickupAgent',compact('bookings'));
 }
 public function markPickedUp($booking)
{
    // Find the booking by ID
    $booking = Service::findOrFail($booking);
    // Check if the booking is already picked up
    if ($booking->status === 'picked_up') {
        return back()->with('error', 'Booking is already marked as picked up.');
    }
    $booking->update(['status' => 'picked_up']);

    return back()->with('success', 'Booking marked as picked up.');
}
}
