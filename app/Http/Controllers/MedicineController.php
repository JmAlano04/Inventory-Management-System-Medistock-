<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineController extends Controller
{
  public function index(Request $request)
    {
        $perPage = $request->get('perPage', 10); // default to 10 if not provided
        $medicines = Medicine::orderBy('created_at', 'desc')->paginate($perPage);
        return view('medicine', compact('medicines'));
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'medicine_name' => 'required|string|max:255',
        'brand_name' => 'required|string|max:255',
        'dosage' => 'required|string|max:255',
        'category' => 'required|string|max:255',
    ]);

    Medicine::create($validated);

    return redirect()->route('medicine')->with('success', 'Medicine added successfully.');
}
   
public function search(Request $request)
{
    $query = $request->input('query');

    $medicines = Medicine::where('medicine_name', 'like', "%{$query}%")
        ->orWhere('brand_name', 'like', "%{$query}%")
        ->orWhere('dosage', 'like', "%{$query}%")
        ->orWhere('catergory', 'like', "%{$query}%")
        ->orderBy('medicine_name')
        ->get();

    $html = view('profile.partials.medicine-table-body', compact('medicines'))->render();

    return response()->json(['table' => $html]);
}
public function destroy($id)
{
    $medicine = Medicine::findOrFail($id);
    $medicine->delete();

  return response()->json(['success' => true, 'message' => 'Medicine deleted successfully.']);
}

public function update(Request $request, $id)
{
    $medicine = Medicine::findOrFail($id);

    $validated = $request->validate([
        'medicine_name' => 'required|string|max:255',
        'brand_name' => 'nullable|string|max:255',
        'dosage' => 'nullable|string|max:255',
        'category' => 'nullable|string|max:255',
    ]);

    $medicine->update($validated);

    return redirect()->back()->with('success', 'Medicine updated successfully!');
}
}