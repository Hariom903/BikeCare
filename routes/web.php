<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::prefix('dashbord/')->group(function(){
    Route::get('/',[AdminController::class,'index'])->name('dashbord');
    Route::get('booking',[BookingController::class,'index'])->name('booking');
    Route::get('manageuser',[UserController::class,'index'])->name('manageuser');
    Route::post('addUser',[UserController::class,'adduser'])->name('adduser');
    Route::get("manageuser/{id}",[UserController::class,'manageuser'])->name('manageuser.edit');
    Route::post('updateuser/{id}',[UserController::class,"update"])->name('updateuser');
    Route::get('deleteuser/{id}',[UserController::class,"delete"])->name('deleteuser');

    //inventroy routes
    Route::get('inventory',[InventoryController::class,'index'])->name('inventory');
    Route::post('/inventory/store',[InventoryController::class,'store'])->name('inventory.store');
    //Booking

Route::post('bookings/assign-ajax', [BookingController::class,'assignAjax'])->name('bookings.assign.ajax');

//product add ;
Route::post("product/store",[ProductController::class,'store'])->name('product.store');

//productVariant

Route::post('productvariant/store',[ProductVariantController::class,'store'])->name('productvariant.store');
Route::post('productvariant/update',[ProductVariantController::class,'update'])->name('productvariant.update');

});

Route::post('/store',[ServiceController::class,'store'])->name('service.store');
