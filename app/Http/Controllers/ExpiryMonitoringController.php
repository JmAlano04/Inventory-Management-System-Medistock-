<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batches;
use Carbon\Carbon;
class ExpiryMonitoringController extends Controller
{
    //
    public function index(Request $request){

         $perPage = $request->get('perPage', 10); // default to 10 if not provided
         $expiries = Batches::where('expiry_date', '<=' , carbon::today())
        
        ->orderBy('expiry_date', 'desc')
        ->paginate($perPage);



        foreach ($expiries as $Expirie)
            
            {
                $Expirie->days_diff = Carbon::parse($Expirie->expiry_date)->diffInDays(Carbon::today(), absolute: false);
            }
           
        return view('Expiry-Monitoring', compact ('expiries'));
    }

      
    }
      


