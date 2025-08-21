<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $batches = Batch::with('medicine')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('inventory', compact('batches'));
    }

    public function store(Request $request)
    {
        // Add batch store logic here
        // This will be implemented when handling the Add Batch functionality
    }
}
