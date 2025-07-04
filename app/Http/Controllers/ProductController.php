<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => "required",
            'category' => "required",
            'brand' => "required",
        ]);

        $res = Product::create($validate);
        if($res){
            return  redirect()->back()->with(["success"=>"Product Add succesfully "]);
        }

    }
}
