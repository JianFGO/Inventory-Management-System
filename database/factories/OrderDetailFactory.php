<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetails>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => fake()->randomElement([1, 2, 3]),
            'category_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'product_id' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
            'order_quantity' => fake()->numberBetween(1, 500),
            'unit_price' => fake()->randomFloat(2, 1, 100),
        ];
    }
}
