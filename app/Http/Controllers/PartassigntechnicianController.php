<?php

namespace App\Http\Controllers;

use App\Models\Partassigntechnician;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartassigntechnicianController extends Controller
{
    public function index()
    {
       $inventories = Product::with('ProductVariant')->get();
       $technicians = User::where('role', 'technician')->get();
        return view('Partassigntechnician' , compact('inventories', 'technicians'));
    }

    public function store(Request $request){
        // Validate the request data

        $request->validate([
            'items' => 'required|array',
            'items.*.variant_id' => 'required|exists:product_variants,id',
            'items.*.technician_id' => 'required|exists:users,id',
            'items.*.quantity' => 'required|integer|min:1',

        ]);
//  echo"<pre>";
//         print_r($request->items);
//         echo"</pre>";
//         die;
        foreach ($request->items as $item) {
            $variantId = $item['variant_id'];
            $technicianId = $item['technician_id'];
            $quantity = $item['quantity'];

            // Check if the product variant exists
            $productVariant = ProductVariant::find($variantId);
            if (!$productVariant) {
                return redirect()->back()->with('error', 'Invalid product variant selected.');
            }

            // Check if the technician exists
            $technician = User::find($technicianId);
            if (!$technician || $technician->role !== 'technician') {
                return redirect()->back()->with('error', 'Invalid technician selected.');
            }

          $price =  $productVariant->unit_price;
          $productVariant->quantity_in_stock -= $quantity;
          $productVariant->update();

            // Create a new part assignment record
            $partAssignment =  new Partassigntechnician();
            $partAssignment->technician_id = $technicianId;
            $partAssignment->product_variant_id = $variantId;
            $partAssignment->quantity = $quantity;
            $partAssignment->price = $price;
            $partAssignment->created_by = Auth::user()->id;
            $partAssignment->save();




        }

        return redirect()->back()->with('success', 'Items assigned to technician successfully.');
    }
}
