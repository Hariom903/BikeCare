<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ServicemanagerController extends Controller
{
  public function index(){
    $picupAgents = User::where('role','picupAgent')->get();
    // echo "<pre>";
    // print_r($picupAgents);
    // die();
   $bookings = Service::where('status','assigned')->with('user')->get();
    return view('servicemanager',compact('bookings','picupAgents'));
  }
}
