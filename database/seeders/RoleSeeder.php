<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::create(['name' => 'add medicines']);

        $role = Role::create(['name' => 'admin']);
        Role::create(['name' => 'pharmacist']);
        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'user']);

        $role->givePermissionTo($permission);
    }
}
