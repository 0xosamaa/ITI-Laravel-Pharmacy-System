<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Governorate;

class PharmacyController extends Controller
{

    public function index(Request $request)
    {
        $allPharmacies = Pharmacy::join('users', 'pharmacies.owner_user_id', '=', 'users.id')
                                 ->select('pharmacies.*', 'users.name as owner_name')
                                 ->get();
        $users = User::all();
        return view('admin.pharmacies.index', ['pharmacies'=>$allPharmacies, 'users' => $users]);
    }


    public function create()
{
    $governorates = Governorate::all();
    $users = User::role('pharmacist')->get();
    return view('admin.pharmacies.create', ['users' => $users,'governorates' => $governorates]);
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'priority' => 'required',
        'owner_user_id' => 'required|exists:users,id',
        'governorate_id' => 'required|exists:governorates,id',
    ]);

    Pharmacy::create($validatedData);

    return redirect()->route('admin.pharmacies.index')->with('success', 'Pharmacy created successfully.');
}

public function edit(Request $request, $id)
{
    $governorates = Governorate::all();
    $users = User::role('pharmacist')->get();
    $pharmacy = Pharmacy::findOrFail($id);

    return view('admin.pharmacies.edit', ['pharmacy'=>$pharmacy, 'users' => $users,'governorates' => $governorates ]);
}

public function update(Request $request, $id)
{
    $pharmacy = Pharmacy::findOrFail($id);

    $validatedData = $request->validate([
        'priority' => 'required',
        'owner_user_id' => 'required',
        'governorate_id' => 'required',
        'name' => 'required|max:255',
    ]);

    $pharmacy->priority = $validatedData['priority'];
    $pharmacy->owner_user_id = $validatedData['owner_user_id'];
    $pharmacy->governorate_id = $validatedData['governorate_id'];
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
