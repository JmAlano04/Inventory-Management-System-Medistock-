<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InventoryController extends Controller
{
    /**
     * Display a listing of batches with related medicine info.
     */
    public function index()
    {
        $batches = Batch::with('medicine')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        foreach ($batches as $batch) {
        $isExpired = Carbon::parse($batch->expiry_date)->isPast();
        $isOutOfStock = $batch->quantity <= 50;
        $isAvailable = $batch->quantity > 50 && !$isExpired;

         if ($isAvailable && $batch->status !== 'Available') {
            $batch->status = 'Available';
            $batch->save();
        } elseif ($isExpired && $batch->status !== 'Expired') {
            $batch->status = 'Expired';
            $batch->save();
        } elseif ($isOutOfStock && $batch->status !== 'Out of Stock') {
            $batch->status = 'Out of Stock';
            $batch->save();
        }
    }
      return view('inventory', compact('batches'));
    }

    /**
     * Store a new batch and create the medicine if it doesn't exist.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Medicine fields
            'medicine_name' => 'required|string|max:255',
            'brand_name'    => 'required|string|max:255',
            'dosage'        => 'required|string|max:255',
            'category'      => 'required|string|max:255',

            // Batch fields
            'batch_code'    => 'required|string|unique:batches,batch_code',
            'quantity'      => 'required|integer|min:1',
            'expiry_date'   => 'required|date|after:today',
            'unit_cost'     => 'required|numeric|min:0',
            'status'        => 'required|string|in:Available,Expired,Out of Stock',
        ]);

        // Create or retrieve the medicine
        $medicine = Medicine::firstOrCreate(
            [
                'medicine_name' => $validated['medicine_name'],
                'brand_name'    => $validated['brand_name'],
                'dosage'        => $validated['dosage'],
                'category'      => $validated['category'],
            ]
        );

        // Create the batch and associate it with the medicine
        $medicine->batches()->create([
            'batch_code'  => $validated['batch_code'],
            'quantity'    => $validated['quantity'],
            'expiry_date' => $validated['expiry_date'],
            'unit_cost'   => $validated['unit_cost'],
            'status'      => $validated['status'],
        ]);

        return redirect()->route('inventory')->with('success', 'Batch added successfully.');
    }

    /**
     * Update the specified batch.
     */
    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);

        $validated = $request->validate([
            'batch_code'  => 'required|string|unique:batches,batch_code,' . $batch->id,
            'quantity'    => 'required|integer|min:0',
            'expiry_date' => 'required|date|after:today',
            'unit_cost'   => 'required|numeric|min:0',
            'status'      => 'required|string|in:Available,Expired,Out of Stock',
        ]);

        $batch->update($validated);

        return redirect()->route('inventory')->with('success', 'Batch updated successfully.');
    }
        public function destroy($id)
        {
            $batch = Batch::findOrFail($id);
            $batch->delete();

            return response()->json(['message' => 'Batch deleted successfully.']);
        }
    public function search(Request $request)
    {
    $query = $request->input('query');

    $batches = Batch::where('batch_code', 'like', "%{$query}%")
        ->orWhereHas('medicine', function ($q) use ($query) {
            $q->where('medicine_name', 'like', "%{$query}%")
              ->orWhere('brand_name', 'like', "%{$query}%")
              ->orWhere('dosage', 'like', "%{$query}%")
              ->orWhere('category', 'like', "%{$query}%");
        })
        ->get();

    $html = view('profile.partials.batch-table-body', compact('batches'))->render();

    return response()->json(['table' => $html]);
    }
}
