<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\oprationPart;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenrateBillContoller extends Controller
{
    public function index($id)
    {

        $booking = Service::findOrFail($id);

        $operationParts = oprationPart:: with('productVariant', 'productVariant.product')
                ->where('booking_id', $booking->id)->get();

        return view("genrateBill", compact('booking', 'operationParts'));
    }
    public function storeGenrateBill(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:services,id',
            'serviceCharge' => 'required|numeric|min:0',
            'laberCharge' => 'nullable|numeric|min:0',
            'payment_method'=>'required',
        ]);

        $booking = Service::findOrFail($request->booking_id);

         $operationParts = oprationPart::where('booking_id', $booking->id)->get();


         $total = $operationParts->sum('MRP');

         $total += $request->serviceCharge + $request->laberCharge;

        $bills = new Bill();

        $bills->laber_charge = $request->laberCharge;
        $bills->service_charge = $request->serviceCharge;
        $bills->total_amount = $total;
        $bills->booking_id = $booking->id;
        $bills->status = "unpaid";
        $bills->payment_method= $request->payment_method;
        $bills->create_by = Auth::user()->id;
        $bills->update_by = Auth::user()->id;
        $bills->save();

        $booking->bill_status = 1;
        $booking->update();

        foreach($operationParts as $part) {
            $part->bill_id = $bills->id;
            $part->update();

        }












        return redirect()->route('managebooking', ['id' => $booking->id])->with('success', 'Bill generated successfully.');
    }
}
