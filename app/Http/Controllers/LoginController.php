<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){
      $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
              $role = Auth::user()->role;

    switch ($role) {
        case 'admin':  return redirect()->intended('dashboard');
        case 'serviceManager':
            return redirect()->intended('/dashboard/servicemanager');
        case 'technician':
            return redirect()->intended('/dashboard/technician');
        case 'receptionist':
            return redirect()->intended('/dashboard/receptionist');
        case 'inventoryManager':
            return redirect()->intended('/dashboard/inventorymanager');
        case 'picupAgent':
            return redirect()->intended('/dashboard/pickupagent');
        case 'accountant':
            return redirect()->intended('/dashboard/accountant');
        default:
            return redirect()->intended('/');
    }


        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

public function logout(){
         Auth::logout();
         return redirect()->route('login');

}
}
