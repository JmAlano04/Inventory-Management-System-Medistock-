<?php

namespace App\Http\Controllers;


use App\Models\Batches;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalInventory = Batches::sum('quantity'); 
        $totalOutOfStock = Batches::where('status', 'Out of Stock')->count();
        $totalExpiringSoon = Batches::where('status', 'Expired')->count();
        return view('dashboard' , compact('totalInventory' , 'totalOutOfStock', 'totalExpiringSoon'));
    }

}
