<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
 public function index(){
    $bookings = Service::all();
    return view('admin.booking',compact('bookings'));
 }
}
