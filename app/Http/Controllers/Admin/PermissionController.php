<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }
    public function store()
    {
        $validated = request()->validate(['name' => 'required|max:50']);

        permission::create(['name' => $validated['name']]);

        return redirect()->route('admin.permissions.index');
    }

    public function edit($permission)
    {
        $permission = permission::findOrFail($permission);
        return view('admin.permissions.edit', compact('permission'));
    }
    public function update(permission $permission)
    {
        $validated = request()->validate(['name' => 'required|max:50']);
        $permission->update($validated);

        return redirect()->route('admin.permissions.index');
    }
    public function destroy(permission $permission)
    {
        $permission->delete();
    }
}
