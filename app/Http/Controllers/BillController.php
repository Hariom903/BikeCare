<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index($id){
        // Fetch the booking details using the ID
        $booking = Service::findOrFail($id);
        // Fetch the inventory items from the database
      $inventories = Product::with('ProductVariant')->get();
//    echo "<pre>";
//     print_r($inventories);
//     die();

      return view('genratebill' , compact('booking','inventories'));
    }

    
    public function addItemBill(){

        $inventories = Product::with('ProductVariant')->get();

        return view('add_to_bill', compact('inventories'));
    }

}
