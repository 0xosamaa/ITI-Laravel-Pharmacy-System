<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }
    public function store()
    {
        $validated = request()->validate(['name' => 'required|max:50']);

        Role::create(['name' => $validated['name']]);

        return redirect()->route('admin.roles.index');
    }

    public function edit($role)
    {
        $role = Role::findOrFail($role);
        $permissions = Permission::all();
        return view('admin.roles.edit', compact(['role', 'permissions']));
    }
    public function update(Role $role)
    {
        $validated = request()->validate(['name' => 'required|max:50']);
        $role->update($validated);

        return redirect()->route('admin.roles.index');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index');
    }
}
