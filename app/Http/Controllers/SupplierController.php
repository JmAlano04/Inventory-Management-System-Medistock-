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


        $suppliers = Supplier::paginate(10);

        return view('supplier', compact('batches', 'suppliers'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $suppliers = Supplier::where('supplier_name', 'like', "%{$query}%")
            ->orWhere('contact_person', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('address', 'like', "%{$query}%")
            ->orderBy('supplier_name')
            ->get();

        $html = view('profile.partials.supplier-table-body', compact('suppliers'))->render();

        return response()->json(['table' => $html]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
        ]);

        Supplier::create($validated);

        return redirect()->route('supplier')->with('success', 'Supplier added successfully.');
    }
    public function update(Request $request, $id){
        $supplier = Supplier::findOrFail($id);

        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
        ]);

        $supplier->update($validated);

        return redirect()->route('supplier')->with('success', 'Supplier updated successfully.');
    }
}
