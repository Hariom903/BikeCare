<?php

namespace App\Http\Controllers;

use App\Models\Franchise;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        $franchises = Franchise::all();

        return view('admin.ManageUsers',compact('users','franchises'));
    }
    public function adduser(Request $request){

        $validate =  $request->validate([
            'name'=>"required||",
            'email'=>'required||email||unique:users,email',
            'role'=>"required||string",
            'franchises_id'=>'required||exists:franchises,id',
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

    public function manageuser($id){
        $user = User::find($id);
        $roles = User::getRoleOptions();
        $franchises = Franchise::all();
     return view('admin.edituser',compact('user','roles','franchises'));
    }
    public function update(Request $request , $id){
       $user = User::findOrFail($id);
       $user->name = $request->name ?? $user->name;
       $user->role = $request->role ?? $user->role;
       $user->franchises_id = $request->franchises ?? $user->franchises_id;
       $user->update();
       return redirect()->route('manageuser')->with(['success'=>"User update now!"]);
    }
    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('manageuser')->with(['success'=>"User Delete  now!"]);
    }
}
