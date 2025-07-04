<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function index(){
    $users = User::count();
    $bookings =Service::limit(4)->get();
    return view("admin.index",compact('users','bookings'));
  }
}
