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
            ['name' => 'Gummy Candy'],
            ['name' => 'Hard-Boiled Candy'],
            ['name' => 'Lollipops'],
            ['name' => 'Nerds Candy'],
            ['name' => 'Sour Candy']
        ];

        // Loop and insert each category into database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
