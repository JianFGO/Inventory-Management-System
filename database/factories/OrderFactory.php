<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_no' => fake()->unique()->numerify('ORD_###'),
            'branch_id' => fake()->randomElement([1, 2, 3]),
            'paid_amount' => fake()->randomFloat(2, 100, 250),
            'total_amount' => fake()->randomFloat(2, 200, 500),
            'delivery_date' => fake()->date(),
        ];
    }
}
