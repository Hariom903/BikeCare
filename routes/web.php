<?php

use App\Http\Controllers\addToBillController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\ManageBookingController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartassigntechnicianController;
use App\Http\Controllers\PickupAgentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServicemanagerController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', fn () => view('index'));
Route::post('/store', [ServiceController::class, 'store'])->name('service.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.user');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::prefix('admin/')->middleware('role:admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('manageuser', [UserController::class, 'index'])->name('manageuser');
    Route::post('addUser', [UserController::class, 'adduser'])->name('adduser');
    Route::get('manageuser/{id}', [UserController::class, 'manageuser'])->name('manageuser.edit');
    Route::post('updateuser/{id}', [UserController::class, 'update'])->name('updateuser');
    Route::get('deleteuser/{id}', [UserController::class, 'delete'])->name('deleteuser');
});

Route::get('booking', [BookingController::class, 'index'])->name('booking');
Route::post('bookings/assign-ajax', [BookingController::class, 'assignAjax'])->name('bookings.assign.ajax');
Route::get('managebooking/{id}', [ManageBookingController::class, 'index'])->name('managebooking');
Route::post('managebooking/assignpickupagent', [ManageBookingController::class, 'assignPickupAgent'])->name('managebooking.assignpickupagent');
Route::post('managebooking/assigntechnician', [ManageBookingController::class, 'assignTechnician'])->name('managebooking.assigntechnician');
// Mark as Picked Up
Route::post('booking/pickup/{id}', [ManageBookingController::class, 'bookingpickup'])->name('booking.pickup');
// Mark as In Progress
Route::post('booking/in_progress/{id}', [ManageBookingController::class, 'bookingInProgress'])->name('booking.in_progress');
// Mark as Completed
Route::post('booking/completed/{id}', [ManageBookingController::class, 'bookingcompleted'])->name('booking.completed');
///Generate Bill
Route::post('booking/generatebill/{id}', [BillController::class, 'index'])->name('booking.generatebill');
Route::GET('additionalOpretionParts',[ManageBookingController::class, 'additionalOpretionParts'])->name('booking.additionalOpretionParts');
Route::post('additionalOpretionParts/store',[ManageBookingController::class, 'storeAdditionalOpretionParts'])->name('booking.additionalOpretionParts.store');





    // Inventory / products both are same
    Route::get('inventory', [InventoryController::class, 'index'])->name('inventory');
     Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
     Route::get('/add-item-show', [AddToBillController::class, 'index'])->name('addItemBill');
     Route::get('add-item/formshow', [AddToBillController::class, 'additemformshow'])->name('add-item-bill');
     Route::post('bill/additems',[AddToBillController::class, 'addItems'])->name('bill.addItems');

    Route::get('partassignaechnician', [ PartassigntechnicianController::class, 'index'])->name('partassignaechnician');
    Route::post('partassignaechnician/store', [PartassigntechnicianController::class, 'store'])->name('partassignaechnician.store');

    // Product Variant
    Route::post('productvariant/store', [ProductVariantController::class, 'store'])->name('productvariant.store');
    Route::post('productvariant/update', [ProductVariantController::class, 'update'])->name('productvariant.update');

    // Service Manager
    Route::get('servicemanager', [ServicemanagerController::class, 'index'])->name('servicemanager');

    // Receptionist
    Route::prefix('receptionist/')->middleware('role:receptionist')->group(function() {
    Route::get('receptionist', [BookingController::class, 'index'])->name('receptionist');
    });
    // Assign Booking
    Route::post('assignbooking/pickupagent', [BookingController::class, 'assingbookingpickupagent'])->name('assignbooking.pickupagent');
    Route::post('assignbooking/technician', [BookingController::class, 'assingbookingtechnician'])->name('assignbooking.technician');

    // Pickup Agent
    Route::middleware('role:picupAgent')->group(function() {
    Route::get('pickupagent', [PickupAgentController::class, 'index'])->name('pickupagent');
    Route::post('/pickup/picked-up/{booking}', [PickupAgentController::class, 'markPickedUp'])->name('pickup.markPickedUp');
});


    // Technician
    Route::get('technician', [TechnicianController::class, 'index'])->name('technician');
    Route::get('/technician/bookings', [TechnicianController::class, 'index'])->name('technician.bookings');
     Route::post('/technician/bookings/{booking}/in-progress', [TechnicianController::class, 'markInProgress'])->name('technician.in_progress');
     Route::post('/technician/bookings/{booking}/completed', [TechnicianController::class, 'markCompleted'])->name('technician.completed');

    Route::post('booking/in_progress/{id}', [BookingController::class, 'bookingInProgress'])->name('booking.in_progress');
    Route::post('booking/completed/{id}', [BookingController::class, 'bookingcompleted'])->name('booking.completed');
});



