<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\oprationPart;
use App\Models\Partassigntechnician;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageBookingController extends Controller
{
  public function index($id)
  {
    // Fetch the booking details using the ID
    $booking = Service::with(['pickupAgent','bills', 'technician'])
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


function additionalOpretionParts(Request $request){
         $id = $request->input('booking_id');
        if (!$id) {
            return redirect()->back()->with('error', 'Please select a booking.');
        }
        $booking = Service::findOrFail($id);

       $technician_id = $booking->assigned_technician_id;

        if (!$technician_id) {
            return redirect()->back()->with('error', 'Please assign a technician to the booking.');
        }
        // Fetch the operation parts assing to technician  for the booking
      $technicianParts = Partassigntechnician::with('productVariant', 'productVariant.product')
            ->where('technician_id', $technician_id)
            ->get();
              $operationParts = oprationPart:: with('productVariant', 'productVariant.product')
                ->where('booking_id', $booking->id)->get();


        return view('AddaadditionalOpretionParts', compact('booking','technicianParts', 'operationParts'));


}
function storeAdditionalOpretionParts(Request $request){

    // Validate the request data
    $request->validate([
        'booking_id' => 'required|exists:services,id',
        'items' => 'required|array',
    ]);

    $booking = Service::findOrFail($request->booking_id);
    $items = $request->items;

    foreach ($items as $item) {
        $total = 0;
        $Partassigntechnician = Partassigntechnician::with('productVariant')
        ->findOrFail($item['variant_id']);
        $quantity = $item['quantity'];
        $SGST = $Partassigntechnician->productVariant->SGST;
        $CGST = $Partassigntechnician->productVariant->CGST;
       $Partassigntechnician->quantity -= $quantity;
        $Partassigntechnician->update();



        // Create a new operation part record
        $operationPart = new oprationPart();
        $operationPart->booking_id = $booking->id;
        $operationPart->product_variant_id = $Partassigntechnician->product_variant_id;
        $operationPart->quantity = $quantity;
        $operationPart->price = $Partassigntechnician->price;
        $operationPart->taxable = $Partassigntechnician->price * $quantity;
        $operationPart->MRP =$Partassigntechnician->price * $quantity + ( ($Partassigntechnician->price * $quantity)* $SGST /100 ) +(($Partassigntechnician->price * $quantity)* $CGST /100);

        $operationPart->created_by = Auth::user()->id;
        $operationPart->save();
    }

    return redirect()->back()->with('success', 'Additional operation parts added successfully.');

}

}
