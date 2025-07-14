<?php

namespace App\Http\Controllers;

use App\Models\oprationPart;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddToBillController extends Controller
{
    public function index()
    {
        // Fetch the inventory items from the database

        $bookings = Service::where('status', 'in_progress')
            ->orWhere('status', 'assigned_to_technician')
            ->get();
        return view('add_to_bill', compact('bookings'));
    }

    public function additemformshow(Request $request)
    {
        // Fetch the booking details using the ID
        $id = $request->input('booking_id');
        if (!$id) {
            return redirect()->back()->with('error', 'Please select a booking.');
        }
        $booking = Service::findOrFail($id);
        // Fetch the inventory items from the database
        $inventories = Product::with('ProductVariant')->get();
        $operationParts = oprationPart:: with('productVariant', 'productVariant.product')
                ->where('booking_id', $booking->id)->get();

        return view('addOpretionParts', compact('booking', 'inventories', 'operationParts'));
    }

    public function addItems(Request $request){
        // Validate the request data
        $request->validate([
            'booking_id' => 'required|exists:services,id',
            'items'=> 'required|array',

        ]);

        $booking = Service::findOrFail($request->booking_id);
        $items = $request->items;
        foreach ($items as $item) {
            $total = 0;
            $taxable = 0;
            $productVariant = ProductVariant::findOrFail($item['variant_id']);
            $quantity = $item['quantity'];
            $CGST = $productVariant->CGST;
            $SGST = $productVariant->SGST;
            // update inventory
            $productVariant->quantity_in_stock -= $quantity;
            $productVariant->update();

            $price = $productVariant->unit_price;
            $taxable += $price * $quantity;
            $total += $taxable + ($taxable*$CGST/100) +( $taxable*$SGST/100 );

            // Create a new operation part record
            $operationPart = new oprationPart();
            $operationPart->booking_id = $booking->id;

            $operationPart->product_variant_id = $item['variant_id'];
            $operationPart->quantity = $quantity;
            $operationPart->price = $price;
            $operationPart->taxable = $taxable;
            $operationPart->MRP = $total;
            // $operationPart->
            $operationPart->created_by =Auth::user()->id;
            $operationPart->save();
        }


        return redirect()->back()->with('success', 'Item added to bill successfully.');

    }
}
