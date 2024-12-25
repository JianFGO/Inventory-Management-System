<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default products to be seeded into database
        $products = [
            // Gummy Candy
            ['branch_id' => 1, 'category_id' => 1, 'name' => 'Berry Gummies', 'price' => 2.50, 'quantity' => 100],
            ['branch_id' => 2, 'category_id' => 1, 'name' => 'Fruity Bears', 'price' => 3.00, 'quantity' => 150],
            ['branch_id' => 3, 'category_id' => 1, 'name' => 'Rainbow Worms', 'price' => 1.75, 'quantity' => 200],

            // Hard-Boiled Candy
            ['branch_id' => 1, 'category_id' => 2, 'name' => 'Classic Butterscotch', 'price' => 1.20, 'quantity' => 300],
            ['branch_id' => 2, 'category_id' => 2, 'name' => 'Minty Fresh Drops', 'price' => 0.99, 'quantity' => 250],

            // Lollipops
            ['branch_id' => 3, 'category_id' => 3, 'name' => 'Cherry Pops', 'price' => 1.50, 'quantity' => 180],
            ['branch_id' => 1, 'category_id' => 3, 'name' => 'Rainbow Swirl Lollipops', 'price' => 2.20, 'quantity' => 100],

            // Nerds Candy
            ['branch_id' => 2, 'category_id' => 4, 'name' => 'Original Nerds', 'price' => 1.75, 'quantity' => 300],
            ['branch_id' => 3, 'category_id' => 4, 'name' => 'Nerds Rope', 'price' => 2.50, 'quantity' => 200],

            // Sour Candy
            ['branch_id' => 1, 'category_id' => 5, 'name' => 'Sour Swirls', 'price' => 1.99, 'quantity' => 150],
            ['branch_id' => 2, 'category_id' => 5, 'name' => 'Extreme Sour Drops', 'price' => 2.50, 'quantity' => 120],
        ];

        // Loop and insert each product into database
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
