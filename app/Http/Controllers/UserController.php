<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.ManageUsers',compact('users'));
    }
    public function adduser(Request $request){

        $validate =  $request->validate([
            'name'=>"required",
            'email'=>'required||email||unique:users,email',
            'role'=>"required",
          ]);

     $password =Hash::make("password");
     $validate['password'] = $password;

     try{
      $data = User::create($validate);
      if($data){
        return response()->json(["success"=>"User Data successfully"]);
        
      }

     }catch(Exception $e){
        dd("User Not Data Server ERRor ".$e);
     }


    }
}
