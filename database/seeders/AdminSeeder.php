<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Osama',
            'email' => 'osama@admin.com',
        ])->assignRole('admin');
        User::factory()->create([
            'name' => 'Amr',
            'email' => 'amr@admin.com',
        ])->assignRole('admin');
        User::factory()->create([
            'name' => 'Youssef',
            'email' => 'youssef@admin.com',
        ])->assignRole('admin');
        User::factory()->create([
            'name' => 'Saber',
            'email' => 'saber@admin.com',
        ])->assignRole('admin');
        User::factory()->create([
            'name' => 'moustafa',
            'email' => 'moustafa@admin.com',
        ])->assignRole('admin');
        User::factory()->create([
            'name' => 'hassan',
            'email' => 'hassan@admin.com',
        ])->assignRole('admin');
    }
}
