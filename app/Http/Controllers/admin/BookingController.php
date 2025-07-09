<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
 public function index(){
   $bookings = Service::with(['pickupAgent', 'technician'])->get();
    // echo "<pre>";
    // print_r($bookings); die();
    // $managers = User::where('role','serviceManager')
    // ->get();
    return view('admin.booking',compact('bookings'));
 }

 public function assignAjax(Request $request){
     $bookingIds = $request->input('booking_ids');
    $managerIds = $request->input('manager_ids');

    foreach ($bookingIds as $bookingId) {
        if (isset($managerIds[$bookingId])) {
                  Service::
                   where('booking_id', $bookingId)
                   ->update([
                    'assigned_manager_id' => $managerIds[$bookingId],
                    'status' => 'assigned'
                ]);
        }
    }

    return response()->json(['message' => 'Selected bookings assigned successfully.']);
}

function assingbookingpickupagent(Request $request){

    $request->validate([
        'assigned_pickup_id'=>"required",
        'id'=>"required",
    ]);

    $booking = Service::findOrFail($request->id);
    if($booking){
        $booking->assigned_pickup_id = $request->assigned_pickup_id;
        $booking->status = 'assigned_to_pickup';
        $booking->save();
        return response()->json(['success'=>"Booking assing to pickup "]);
    }

}

function  assingbookingtechnician(Request $request){
     $booking = Service::findOrFail($request->id);
    if($booking){
        $booking->assigned_technician_id = $request->assigned_technician_id;
        $booking->status = 'assigned_to_technician';
        $booking->save();
        return response()->json(['success'=>"Booking assing to Technicain "]);
    }
}

function bookingpickup($id){
   $booking = Service::findOrFail($id);
   if($booking){
     $booking->status = 'picked_up';
        $booking->save();

        return back();
   }

}
function bookingInProgress($id){
      $booking = Service::findOrFail($id);
     if($booking){
     $booking->status = 'in_progress';
        $booking->save();

        return back();
   }
}
function bookingcompleted($id){
     $booking = Service::findOrFail($id);
     if($booking){
     $booking->status = 'completed';
        $booking->save();

        return back();
   }
}

}
