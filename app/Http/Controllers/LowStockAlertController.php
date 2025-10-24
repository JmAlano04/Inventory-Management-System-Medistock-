<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batches;
use App\Models\Supplier;
use Carbon\Carbon;

class LowStockAlertController extends Controller
{
    //
       public function index(Request $request){

         $perPage = request()->get('perPage', 10);
         $lowStockAlert = Batches::with('supplier')
            ->where( 'quantity' , '<=' , '50')
            
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    
            $suppliers = Supplier::all();

            
          
           
        return view('low-stock' , compact('lowStockAlert' , 'suppliers'));
    }
}