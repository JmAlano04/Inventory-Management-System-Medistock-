<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Supplier;

class SupplierController extends Controller
{
    //
    public function index()
    {
        $batches = Batch::paginate(10);
        $suppliers = Supplier::all(); // Fetch all suppliers

        return view('supplier', compact('batches', 'suppliers'));
    }
}
