<?php

namespace App\Http\Controllers;

use App\Models\Batches;

use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InventoryController extends Controller
{
    /**
     * Display a listing of batches with related medicine info.
     */
    public function index()
    {
        $perPage = request()->get('perPage', 10);
        $batches = Batches::with('supplier')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

            $suppliers = Supplier::all();
            $medicines = Medicine::all();
        
            foreach ($batches as $batch) {
            $isExpired = Carbon::parse($batch->expiry_date)->isPast();
            $isOutOfStock = $batch->quantity <= 50;
            $isAvailable = $batch->quantity > 50 && !$isExpired;
            $double = $isExpired && $isOutOfStock;
            
            if ($double && $batch->status !== 'Out of Stock and Expired') {
                $batch->status = 'Out of Stock and Expired';
                $batch->save();
            } elseif ($isAvailable && $batch->status !== 'Available') {
                $batch->status = 'Available';
                $batch->save();
            } elseif ($isExpired && $batch->status !== 'Expired' && !$double) {
                $batch->status = 'Expired';
                $batch->save();
            } elseif ($isOutOfStock && $batch->status !== 'Out of Stock' && !$double) {
                $batch->status = 'Out of Stock';
                $batch->save();
            }
        }
        

        return view('inventory', compact('batches', 'suppliers', 'medicines'));
    }

    /**
     * Store a new batch and create the medicine if it doesn't exist.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Batch fields
            'medicine_name' => 'required|string',
            'brand_name'    => 'required|string',
            'dosage'        => 'required|string',
            'category'      => 'required|string|in:Antibiotic,General,Antiviral,Vaccine',
            'batch_code'    => 'required|string|unique:batches,batch_code',
            'quantity'      => 'required|integer|min:1',
            'expiry_date'   => 'required|date|after:today',
            'unit_cost'     => 'required|numeric|min:0',
            'status'        => 'required|string|in:Available,Expired,Out of Stock,Out of Stock and Expired',
            'supplier_id'   => 'nullable|exists:suppliers,id',
        ]); 

        // Create or retrieve the medicine
        $Batches = Batches::firstOrCreate( [
            'medicine_name' => $validated['medicine_name'],
            'batch_code'  => $validated['batch_code'],
            'quantity'    => $validated['quantity'],
            'expiry_date' => $validated['expiry_date'],
            'unit_cost'   => $validated['unit_cost'],
            'status'      => $validated['status'],
            'supplier_id' => $validated['supplier_id'], // fixed here
        ]);

        $Batches->medicine()->create([
            'brand_name'    => $validated['brand_name'],
            'dosage'        => $validated['dosage'],
            'category'      => $validated['category'],
        ]);

        
        return redirect()->route('inventory')->with('success', 'Batch added successfully.');
        
    }

    /**
     * Update the specified batch.
     */
    public function update(Request $request, $id)
    {
        $batch = Batches::findOrFail($id);

        $validated = $request->validate([

            
            // 'brand_name'    => 'required|string',
            // 'dosage'        => 'required|string',
            // 'category'      => 'required|string|in:Antibiotic,General,Antiviral,Vaccine',
            'medicine_name' => 'required|string',
            'batch_code'  => 'required|string|unique:batches,batch_code,' . $batch->id,
            'quantity'    => 'required|integer|min:0',
            'expiry_date' => 'required|date',
            'unit_cost'   => 'required|numeric|min:0',
            // 'status'      => 'required|string|in:Available,Expired,Out of Stock,Out of Stock and Expired',
            'supplier_id'   => 'nullable|exists:suppliers,id',
            // 'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        // Update the batch including supplier_id safely
        $batch->update([
            'medicine_name' => $validated['medicine_name'],
            'batch_code'  => $validated['batch_code'],
            'quantity'    => $validated['quantity'],
            'expiry_date' => $validated['expiry_date'],
            'unit_cost'   => $validated['unit_cost'],
            // 'status'      => $validated['status'],
            // 'supplier_id' => $validated['supplier_id'] ?? null,
        ]);

        return redirect()->route('inventory')->with('success', 'Batch updated successfully.');
    }

    /**
     * Delete a batch.
     */
    public function destroy($id)
    {
        $batch = Batches::findOrFail($id);
        $batch->delete();

        return response()->json(['message' => 'Batch deleted successfully.']);
    }

    /**
     * Search batches by batch code or related medicine fields.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $batches = Batches::where('batch_code', 'like', "%{$query}%")
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

    /**
     * Dispense medicine from a batch, updating quantity and status accordingly.
     */
    public function dispense(Request $request)
    {
        $request->validate([
            'batch_code' => 'required|exists:batches,batch_code',
            'quantity'   => 'required|integer|min:1',
        ]);

        $batch = Batches::where('batch_code', $request->batch_code)->first();

        if (!$batch) {
            return back()->withErrors(['batch_code' => 'Batch not found.']);
        }

        if ($batch->quantity < $request->quantity) {
            return back()->withErrors(['quantity' => 'Not enough stock to dispense.']);
        }

        $batch->quantity -= $request->quantity;

        // Update status if quantity falls below threshold
        if ($batch->quantity <= 50) {
            $batch->status = 'Out of Stock';
        }

        $batch->save();

        return back()->with('success', 'Medicine dispensed successfully.');
    }
}
