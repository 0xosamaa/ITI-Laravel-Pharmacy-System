<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use DataTables;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {
        $allPharmacies = Pharmacy::all();
        return view('admin.Pharmacy.index', ['pharmacies'=>$allPharmacies]);
    }


    public function create()
{
    return view('admin.Pharmacy.create');
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'priority' => 'required',
        'owner_user_id' => 'required|exists:users,id',
        'area_id' => 'required|exists:areas,id',
    ]);

    Pharmacy::create($validatedData);

    return redirect()->route('admin.pharmacies.index')->with('success', 'Pharmacy created successfully.');
}

public function edit(Request $request, $id)
{
    $pharmacy = Pharmacy::findOrFail($id);
    return view('admin.Pharmacy.edit', ['pharmacy'=>$pharmacy]);
}

public function update(Request $request, $id)
{
    $pharmacy = Pharmacy::findOrFail($id);

    $validatedData = $request->validate([
        'priority' => 'required',
        'owner_user_id' => 'required',
        'area_id' => 'required',
        'name' => 'required|max:255',
    ]);

    $pharmacy->priority = $validatedData['priority'];
    $pharmacy->owner_user_id = $validatedData['owner_user_id'];
    $pharmacy->area_id = $validatedData['area_id'];
    $pharmacy->name = $validatedData['name'];
    $pharmacy->save();

    return redirect()->route('admin.pharmacies.index')
                     ->with('success', 'Pharmacy updated successfully.');
}
public function destroy($id)
{
    $pharmacy = Pharmacy::findOrFail($id);
    $pharmacy->delete();

    return redirect()->route('admin.pharmacies.index')->with('success', 'Pharmacy deleted successfully');
}

}
