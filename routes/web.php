<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::prefix('admin/')->group(function(){
    Route::get('/',[AdminController::class,'index'])->name('dashbord');
    Route::get('booking',[BookingController::class,'index'])->name('booking');
    Route::get('manageuser',[UserController::class,'index'])->name('manageuser');
    Route::post('addUser',[UserController::class,'adduser'])->name('adduser');
});

Route::post('/store',[ServiceController::class,'store'])->name('service.store');
