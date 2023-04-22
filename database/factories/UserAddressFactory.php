<?php

namespace Database\Factories;

use App\Models\Governorate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'flat_number' => rand(1, 100),
            'floor_number' => rand(1, 100),
            'building_number' => rand(1, 100),
            'street_name' => fake()->word(),
            'area_id' => fake()->randomLetter().fake()->randomNumber(3),
            'is_main' => false,
            'user_id' => User::all()->random()->id,
            'governorate_id' => Governorate::all()->random()->id
        ];
    }
}
