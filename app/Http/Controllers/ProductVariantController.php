<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
   public function store(Request $request){


    $validate = $request->validate([
        'product_id'=>"required||exists:products,id",
        'size_or_type'=>"required",
        'unit'=>"required",
        'quantity_in_stock'=>"required||numeric",
        'unit_price'=>"required||numeric",
    ]);

    $res = ProductVariant::create($validate);
    if($res){

         return  redirect()->back()->with(["success"=>"Product Add succesfully "]);
    }
   }

   public function update(Request $request){

       $request->validate([
        'quantity_in_stock'=>"numeric||nullable",
        'unit_price'=>"nullable||numeric",
        'id'=>"required"
       ]);

       $product = ProductVariant::findOrFail($request->id);
       if($product){
        $product->quantity_in_stock = $product->quantity_in_stock+$request->quantity_in_stock ??$product->quantity_in_stock;
        $product->unit_price =  $request->unit_price ??  $product->unit_price ;
        $product->update();
        return response()->json(['success'=>"Update Product Varinant Stock "]);
       }



   }
}
