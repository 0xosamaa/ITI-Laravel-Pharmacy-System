<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Osama',
            'email' => 'osama@doctor.com',
        ])->assignRole('doctor');

        User::factory()->create([
            'name' => 'Amr',
            'email' => 'amr@doctor.com',
        ])->assignRole('doctor');
        User::factory()->create([
            'name' => 'Youssef',
            'email' => 'youssef@doctor.com',
        ])->assignRole('doctor');
        User::factory()->create([
            'name' => 'Saber',
            'email' => 'saber@doctor.com',
        ])->assignRole('doctor');
        User::factory()->create([
            'name' => 'moustafa',
            'email' => 'moustafa@doctor.com',
        ])->assignRole('doctor');
        User::factory()->create([
            'name' => 'hassan',
            'email' => 'hassan@doctor.com',
        ])->assignRole('doctor');

        User::factory()->create([
            'name' => 'Osama',
            'email' => 'osama@pharmacist.com',
        ])->assignRole('pharmacist');
        User::factory()->create([
            'name' => 'Amr',
            'email' => 'amr@pharmacist.com',
        ])->assignRole('pharmacist');
        User::factory()->create([
            'name' => 'Youssef',
            'email' => 'youssef@pharmacist.com',
        ])->assignRole('pharmacist');
        User::factory()->create([
            'name' => 'Saber',
            'email' => 'saber@pharmacist.com',
        ])->assignRole('pharmacist');
        User::factory()->create([
            'name' => 'moustafa',
            'email' => 'moustafa@pharmacist.com',
        ])->assignRole('pharmacist');
        User::factory()->create([
            'name' => 'hassan',
            'email' => 'hassan@pharmacist.com',
        ])->assignRole('pharmacist');


        User::factory()->create([
            'name' => 'Osama',
            'email' => 'osama@user.com',
        ])->assignRole('user');
        User::factory()->create([
            'name' => 'Amr',
            'email' => 'amr@user.com',
        ])->assignRole('user');
        User::factory()->create([
            'name' => 'Youssef',
            'email' => 'youssef@user.com',
        ])->assignRole('user');
        User::factory()->create([
            'name' => 'Saber',
            'email' => 'saber@user.com',
        ])->assignRole('user');
        User::factory()->create([
            'name' => 'moustafa',
            'email' => 'moustafa@user.com',
        ])->assignRole('user');
        User::factory()->create([
            'name' => 'hassan',
            'email' => 'hassan@user.com',
        ])->assignRole('user');
        User::factory()->create([
            'name' => 'Youssef',
            'email' => 'ZeroCrashOverride097@gmail.com'
        ])->assignRole('user');
    }
}
