<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\UserAddress;
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

        $this->call(CategorySeeder::class);
        $this->command->info('Seeded the Categories!');

        $this->call(DiscountSeeder::class);
        $this->command->info('Seeded the Discounts!');

        $this->call(MedicineSeeder::class);
        $this->command->info('Seeded the Medicines!');

        $this->call(PharmacySeeder::class);
        $this->command->info('Seeded the Pharmacies!');

        $this->call(UserAddressSeeder::class);
        $this->command->info('Seeded the User Addresses');

        $this->call(DoctorSeeder::class);
        $this->command->info('Seeded the Doctors!');

        $this->call(OrderDetailsSeeder::class);
        $this->command->info('Seeded the Order Details!');
    }
}
