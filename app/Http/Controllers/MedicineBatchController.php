<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;

class MedicineBatchController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 10); // default 10 per page
        $batches = Batch::with('medicine')->paginate($perPage); // make sure relation is loaded

        return view('inventory', compact('batches'));
    }
}