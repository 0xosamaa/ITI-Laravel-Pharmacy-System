<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CountriesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Osama',
            'email' => 'osama@gmail.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Amr',
            'email' => 'amr@gmail.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Youssef',
            'email' => 'youssef@gmail.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Saber',
            'email' => 'saber@gmail.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'moustafa',
            'email' => 'moustafa@gmail.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'hassan',
            'email' => 'hassan@gmail.com',
        ]);

        $this->command->info('Seeded the users!');

        $this->call(CountriesSeeder::class);
        $this->command->info('Seeded the countries!');
    }
}
