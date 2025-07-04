<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
 public function index(){
    $bookings = Service::with('user')->get();
    // echo "<pre>";
    // print_r($bookings); die();
    $managers = User::where('role','serviceManager')->get();
    return view('admin.booking',compact('bookings','managers'));
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

}
