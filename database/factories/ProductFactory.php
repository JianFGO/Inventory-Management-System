<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'category_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'branch_id' => fake()->randomElement([1, 2, 3]),
            'price' => fake()->randomFloat(2, 1, 100),
            'quantity' => fake()->numberBetween(1, 100),
        ];
    }
}
