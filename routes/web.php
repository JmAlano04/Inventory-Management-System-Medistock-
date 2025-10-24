<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\LowStockAlertController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineBatchController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpiryMonitoringController;


Route::get('/', function () {
    return view('welcome');
});

// DEFAULT AUTHENTICATION ROUTE
Route::middleware('auth')->group(function () { 
    // PROFILE CRUD
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
    // ACCOUNT MANAGEMENT ROUTE;
    Route::get('/account', [AccountController::class, 'index'])->name('profile.account');
     Route::post('/account/store/' , [AccountController::class, 'store'])->name('account.store');
    Route::put('/account/update/{id}' , [AccountController::class, 'update'])->name('account.update');
});


// Administrator and Staff ROUTE
Route::group(['middleware' => ['auth']], function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Medicine
    Route::get('/medicine', [MedicineController::class, 'index'])
        ->name('medicine');
 
    Route::get('/medicines/search', [MedicineController::class, 'search'])
        ->name('medicines.search');
    

    // Inventory
    Route::get('/inventory', [InventoryController::class, 'index'])
        ->name('inventory');
    Route::post('/inventory/store', [InventoryController::class, 'store'])
        ->name('inventory.store');
    Route::put('/inventory/update/{id}', [InventoryController::class, 'update'])
        ->name('inventory.update');
    Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])
        ->name('inventory.destroy');
    Route::get('/inventory/search', [InventoryController::class, 'search'])
        ->name('inventory.search');
    Route::get('/inventory/dispense', [InventoryController::class, 'dispense'])
        ->name('inventory.dispense');

    // Supplier
    Route::get('/supplier', [SupplierController::class, 'index'])
        ->name('supplier');
    Route::put('/supplier/update/{id}', [SupplierController::class, 'update'])
        ->name('supplier.update');
    Route::get('/supplier/search', [SupplierController::class, 'search'])
        ->name('supplier.search');
    Route::post('/supplier/store', [SupplierController::class, 'store'])
        ->name('supplier.store');

    // Expiry Monitoring
     Route::get('/expiry-monitoring', [ExpiryMonitoringController::class, 'index'])
        ->name('expiry-monitoring');



    // Low Stock Alert
    Route::get('/low-stock-alert', [LowStockAlertController::class, 'index'])->name('low-stock-alert');

    // Report
    Route::get('/report', function () {
        return view('report');
    })->name('report');
});


// USER ROUTE


require __DIR__.'/auth.php';
