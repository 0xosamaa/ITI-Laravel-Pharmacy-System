<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(GovernorateSeeder::class);
        $this->command->info('Seeded the Governorates!');
        
        $this->call(RoleSeeder::class);
        $this->command->info('Seeded the Roles!');

        $this->call(UserSeeder::class);
        $this->command->info('Seeded the Doctors, Pharmacists and Users!');

        $this->call(AdminSeeder::class);
        $this->command->info('Seeded the Admins!');

        $this->call(AreaSeeder::class);
        $this->command->info('Seeded the Areas!');

        $this->call(PharmacySeeder::class);
        $this->command->info('Seeded the Pharmacies!');
    }
}
