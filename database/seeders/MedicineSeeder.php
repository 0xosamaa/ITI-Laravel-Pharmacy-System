<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discounts = Discount::all()->pluck('id');
        $categories = Category::all()->pluck('id');


        for ($i = 0; $i < 100; $i++) {
            Medicine::create([
                'name' => fake()->name(),
                'description' => fake()->text(),
                'image' => 'site/images/product_0' . fake()->numberBetween(1, 6) . '.png',
                'SKU' => fake()->numberBetween(20000, 90000),
                'price' => fake()->numberBetween(5000, 100000),
                'discount_id' => $discounts->random(),
                'category_id' => $categories->random(),
            ]);
        }
    }
}
