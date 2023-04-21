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
        $this->call(RoleSeeder::class);
        $this->command->info('Seeded the roles!');

        $this->call(UserSeeder::class);
        $this->command->info('Seeded the doctors, pharmacists and users!');

        $this->call(AdminSeeder::class);
        $this->command->info('Seeded the admins!');

        $this->call(CountriesSeeder::class);
        $this->command->info('Seeded the countries!');

        $this->call(AreaSeeder::class);
        $this->command->info('Seeded the Areas!');

        $this->call(PharmacySeeder::class);
        $this->command->info('Seeded the Pharmacies!');
    }
}
