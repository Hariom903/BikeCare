<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(){
    //    $inventories = Inventory::all();
       $products = Product::all();
       $productsvariants = ProductVariant::with('product')->get();

        return view('admin.inventory',compact('products','productsvariants'));
    }


}
