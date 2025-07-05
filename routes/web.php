<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoginController;
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

// Auth
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.user');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard group (with auth middleware)
Route::prefix('dashboard')->middleware('auth')->group(function () {

    // Dashboard home
    Route::get('/', [AdminController::class, 'index'])->name('dashboard')->middleware('role:admin');
    Route::get('booking', [BookingController::class, 'index'])->name('booking');
    Route::post('bookings/assign-ajax', [BookingController::class, 'assignAjax'])->name('bookings.assign.ajax');

    // Manage Users
    Route::get('manageuser', [UserController::class, 'index'])->name('manageuser');
    Route::post('addUser', [UserController::class, 'adduser'])->name('adduser');
    Route::get('manageuser/{id}', [UserController::class, 'manageuser'])->name('manageuser.edit');
    Route::post('updateuser/{id}', [UserController::class, 'update'])->name('updateuser');
    Route::get('deleteuser/{id}', [UserController::class, 'delete'])->name('deleteuser');

    // Inventory
    Route::get('inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::post('inventory/store', [InventoryController::class, 'store'])->name('inventory.store');

    // Product
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');

    // Product Variant
    Route::post('productvariant/store', [ProductVariantController::class, 'store'])->name('productvariant.store');
    Route::post('productvariant/update', [ProductVariantController::class, 'update'])->name('productvariant.update');

    // Service Manager
    Route::get('servicemanager', [ServicemanagerController::class, 'index'])->name('servicemanager');

    // Receptionist
    Route::get('receptionist', [ReceptionistController::class, 'index'])->name('receptionist');

    // Assign Booking
    Route::post('assignbooking/pickupagent', [BookingController::class, 'assingbookingpickupagent'])->name('assignbooking.pickupagent');
    Route::post('assignbooking/technician', [BookingController::class, 'assingbookingtechnician'])->name('assignbooking.technician');

    // Pickup Agent
    Route::get('pickupagent', [PickupAgentController::class, 'index'])->name('pickupagent');
    Route::post('booking/pickup/{id}', [BookingController::class, 'bookingpickup'])->name('booking.pickup');

    // Technician
    Route::get('technician', [TechnicianController::class, 'index'])->name('technician');
    Route::post('booking/in_progress/{id}', [BookingController::class, 'bookingInProgress'])->name('booking.in_progress');
    Route::post('booking/completed/{id}', [BookingController::class, 'bookingcompleted'])->name('booking.completed');
});

// Services (outside dashboard)
Route::post('/store', [ServiceController::class, 'store'])->name('service.store');
