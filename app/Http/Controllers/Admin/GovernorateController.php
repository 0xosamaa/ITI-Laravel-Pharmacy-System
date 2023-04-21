<?php

namespace App\Http\Controllers\Admin;

use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GovernorateController extends Controller
{
    public function index(Request $request)
    {
        $governorates = Governorate::all();

        return view('admin.governorates.index', ['governorates' => $governorates]);
    }

    public function create()
    {
        return view('admin.governorates.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        Governorate::create($validatedData);

        return redirect()->route('admin.governorates.index')
            ->with('success', 'Governorate created successfully.');
    }

    public function edit($id)
    {
        $governorate = Governorate::findOrFail($id);
        return view('admin.governorates.edit', compact('governorate'));
    }

    public function update(Request $request, $id)
    {
        $governorate = Governorate::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $governorate->name = $request->name;
        $governorate->save();
        return redirect()->route('admin.governorates.index')->with('success', 'Governorate updated successfully!');
    }

    public function destroy($id)
    {
        $governorate = Governorate::findOrFail($id);
        $governorate->delete();

        return redirect()->route('admin.governorates.index')
            ->with('success', 'Governorate deleted successfully');
    }
}
