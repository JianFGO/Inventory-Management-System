<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categories to be seeded into database
        $categories = [
            ['id' => 1, 'name' => 'Gummy Candy'],
            ['id' => 2, 'name' => 'Hard-Boiled Candy'],
            ['id' => 3, 'name' => 'Lollipops'],
            ['id' => 4, 'name' => 'Nerds Candy'],
            ['id' => 5, 'name' => 'Sour Candy']
        ];

        // Loop and insert each category into database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
