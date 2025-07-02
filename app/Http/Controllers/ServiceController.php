<?php

namespace App\Http\Controllers;

use App\Mail\wellComeMail;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;

class ServiceController extends Controller
{
    public function store(Request $request)
    {

       $validate = $request->validate([
            'customerName'=>"required ",
            'phone'=>"required ||numeric",
            'email'=>"required ||email",
            'address'=>"required ",
            'bikeType'=>"required ",
            'bikeBrand'=>"required ",
            'bikeModel'=>"required ",
            'year'=>"required ",
            'preferredDate'=>"required ",
            'preferredTime'=>"required ",
            'urgency'=>"required ",
            'issues'=>"required ",
            'service'=>'required',

        ]);

        try{
            $booking_id = "BPC-" . uniqid();
            $validate['booking_id'] = $booking_id;
             $data = Service::create($validate);
             if($data){
                Mail::to($request->email)->send( new wellComeMail() );
                return back()->with("success","you booking is submit ");
             }
        }catch(Exception $e){
              dd($e);
        }
    }
}
