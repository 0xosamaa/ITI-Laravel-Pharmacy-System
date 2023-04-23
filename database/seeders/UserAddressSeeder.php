<?php

namespace Database\Seeders;

use App\Models\Governorate;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //UserAddress::factory()->count(30)->create();
        foreach (User::all() as $user) {
            $user->user_addresses()->create([
                'flat_number' => rand(1, 100),
                'floor_number' => rand(1, 100),
                'building_number' => rand(1, 100),
                'street_name' => fake()->word(),
                'area_id' => fake()->randomLetter().fake()->randomNumber(3),
                'is_main' => true,
                'user_id' => $user->id,
                'governorate_id' => Governorate::all()->random()->id
            ]);
        }
    }
}
