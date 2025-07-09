<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ManageBookingController extends Controller
{
  public function index($id)
  {
    // Fetch the booking details using the ID
    $booking = Service::with(['pickupAgent', 'technician'])
                      ->where('id', $id)
                      ->firstOrFail();


  $pickupAgents = User::where('role', 'picupAgent')->get();
  $technicians = User::where('role', 'technician')->get();

    // Pass the booking details to the view
    return view('admin.manageBooking', compact('booking', 'pickupAgents', 'technicians'));

  }

  public function assignPickupAgent(Request $request)
  {
    $request->validate([
      'assigned_pickup_id' => "required",
      'id' => "required",
    ]);


    $booking = Service::findOrFail($request->id);
    if ($booking) {
      $booking->assigned_pickup_id = $request->assigned_pickup_id;
      $booking->status = 'assigned_to_pickup';
      $booking->save();
      return back()->with(['success' => "Booking assigned to pickup agent"]);
    }
  }

    public function assignTechnician(Request $request)
    {

        $request->validate([
        'technician' => "required",
        'id' => "required",
        ]);

        $booking = Service::findOrFail($request->id);


        if($booking) {
        $booking->assigned_technician_id = $request->technician;
        $booking->status = 'assigned_to_technician';
        $booking->save();
        return back()->with(['success' => "Booking assigned to technician"]);
        }
    }

    public function bookingpickup($id)
    {
        $booking = Service::findOrFail($id);
        if ($booking) {
            $booking->status = 'picked_up';
            $booking->save();
            return back()->with(['success' => "Booking marked as picked up"]);
        }
    }
    public function bookingInProgress($id)
    {
        $booking = Service::findOrFail($id);
        if ($booking) {
            $booking->status = 'in_progress';
            $booking->save();
            return back()->with(['success' => "Booking marked as in progress"]);
        }
    }
    public function bookingcompleted($id)
    {
        $booking = Service::findOrFail($id);
        if ($booking) {
            $booking->status = 'completed';
            $booking->save();
            return back()->with(['success' => "Booking marked as completed"]);
        }

    }
    // generateBill
    public function generateBill($id)
    {
        $booking = Service::findOrFail($id);
        if ($booking) {
            // Logic to generate bill
            // This could involve calculating costs, taxes, etc.
            // For now, we'll just mark the booking as billed
            // $booking->status = 'billed';
            $booking->save();
            return back()->with(['success' => "Bill generated for booking"]);
        }
    }


}
