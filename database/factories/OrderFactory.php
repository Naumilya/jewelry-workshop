<?php

namespace Database\Factories;

use App\Models\Master;
use App\Models\Product;
use App\Models\User;
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
            'user_id' => User::all()->random()->id,
            'master_id' => Master::all()->random()->id,
            'product_id' => Product::all()->random()->id,
            'order_date' => $this->faker->date,
            'delivery_date' => $this->faker->date,
            'total_cost' => $this->faker->randomFloat(1, 100, 2),
        ];
    }
}
