<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'General Sales List',
                'description' => fake()->text()
            ],
            [
                'name' => 'Pharmacy Medicines',
                'description' => fake()->text()
            ],
            [
                'name' => 'Prescription Only',
                'description' => fake()->text()
            ],
            [
                'name' => 'Controlled Drugs',
                'description' => fake()->text()
            ],
        ]);
    }
}
