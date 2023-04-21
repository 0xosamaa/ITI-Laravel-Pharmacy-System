<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use DataTables;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::all();

        return view('admin.Area.index',['areas'=>$areas]);
    }

    public function create()
{
    return view('admin.Area.create');
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'address' => 'required',
    ]);

    $area = Area::create($validatedData);

    return redirect()->route('admin.areas.index')
                     ->with('success', 'Area created successfully.');
}

public function edit($id)
{
    $area = Area::findOrFail($id);
    return view('admin.Area.edit', compact('area'));
}

public function update(Request $request, $id)
{
    $area = Area::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
    ]);

    $area->name = $request->name;
    $area->address = $request->address;
    $area->save();

    return redirect()->route('admin.areas.index')->with('success', 'Area updated successfully!');
}


}
