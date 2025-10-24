<?php

namespace App\Http\Controllers;


use App\Models\Batches;
use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Db;


class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalInventory = Batches::sum('quantity'); 

        $totalOutOfStockAndExpired = Batches::where('status'  , '=', 'Out of Stock and Expired' )->count();
        $totalOutOfStock = Batches::where('status'  , '=', 'Out of Stock' )->count();

        $sumOfOutOfStock = $totalOutOfStockAndExpired + $totalOutOfStock ;

        $totalExpiringSoon = Batches::whereBetween('expiry_date', [now(), now()->addDays(60)])->count();
        $totalCategories = Medicine::select('category')->groupBy('category')->get()->count();


          $suppliers = Supplier::all();
          $medicines = Medicine::all();
          $Batches = Batches::all();
        
        return view('dashboard' , compact('totalInventory' , 'sumOfOutOfStock', 'totalExpiringSoon', 'totalCategories', 'suppliers', 'medicines', 'Batches'));
    }

}
