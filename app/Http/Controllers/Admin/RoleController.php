<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

use function PHPUnit\Framework\isEmpty;
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
        $permissions_ids = request('permissions');

        DB::transaction(function () use ($role, $permissions_ids, $validated) {
            foreach ($role->permissions as $permission) {
                $role->revokePermissionTo($role->$permission);
            }
            if (isset($permissions_ids)) {
                foreach ($permissions_ids as $permission_id) {
                    $permission = Permission::findOrFail($permission_id);
                    $role->givePermissionTo($permission);
                }
            }
            $role->update($validated);
        });
        return redirect()->route('admin.roles.index');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index');
    }
}
