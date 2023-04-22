<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Discount::create([
                'name' => "Discount {$i}",
                'description' => fake()->text(),
                'discount_percent' => $i * 10
            ]);
        }
    }
}
