<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineBatchController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('welcome');
});


//  Routes admin DEFAULD PAGE
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');

Route::get('/medicine', [MedicineController::class, 'index'])->middleware(['auth', 'role:admin'])->name('medicine');

Route::get('/inventory', [InventoryController::class, 'index'])->middleware(['auth', 'role:admin'])->name('inventory');

Route::get('/supplier', [SupplierController::class, 'index'])->middleware(['auth', 'role:admin'])->name('supplier');


Route::get('/expiry-monitoring', function (){
    return view('Expiry-Monitoring');
})->middleware(['auth', 'verified'])->name('expiry-monitoring');
Route::get('/low-stock-alert', function (){
    return view('low-stock-alert');
})->middleware(['auth', 'verified'])->name('low-stock-alert');
Route::get('/report', function (){
    return view('report');
})->middleware(['auth', 'verified'])->name('report');

Route::middleware('auth')->group(function () { 
    // PROFILE CRUD
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // MEDICINE CRUD
    Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
    Route::put('/medicines/{id}', [MedicineController::class, 'update'])->name('medicines.update');
    Route::get('/medicines/search', [MedicineController::class, 'search'])->name('medicines.search');
    Route::delete('/medicines/{id}', [MedicineController::class, 'destroy'])->name('medicines.destroy');

    // INVENTORY CRUD
   Route::post('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
   Route::put('/inventory/update/{id}', [InventoryController::class, 'update'])->name('inventory.update');
   Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
   Route::get('/inventory/search', [InventoryController::class, 'search'])->name('inventory.search');
    Route::get('/inventory/dispense', [InventoryController::class, 'dispense'])->name('inventory.dispense');

    // SUPPLIER CRUD
    Route::put('/supplier/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    
});



// Route::get('/inventory', [MedicineBatchController::class, 'index'])->name('inventory');
// Route::get('/inventory', [MedicineBatchController::class,'store'])->name('inventory.store');



// Routes user
Route::get('/user/dashboard', function () {
    return view('user');
})->middleware(['auth', 'role:user'])->name('user.dashboard');

require __DIR__.'/auth.php';
