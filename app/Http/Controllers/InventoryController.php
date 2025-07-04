<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(){
       $inventories = Inventory::all();
       $products = Product::all();
       $productsvariants = ProductVariant::with('product')->get();

        return view('admin.inventory',compact('inventories','products','productsvariants'));
    }
    public function store(Request $request){
      $validate =   $request->validate([
        'part_name' =>"required",
        'quantity' =>"required||numeric",
        'unit_price' =>"required||numeric",
        ]);
        $part = Inventory::where('part_name',$request->part_name)->first();
        if($part){
              $part->quantity = $request->quantity + $part->quantity;
              $part->update();
                return redirect()->back()->with(['success'=>"Part update inventory successfully  "]);
        }
        else{
     $inventory = Inventory::create($validate);
     if($inventory){
        return redirect()->back()->with(['success'=>"Part Add inventory successfully  "]);
     }
    }

    }
}
