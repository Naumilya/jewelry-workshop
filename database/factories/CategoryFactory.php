<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;

        $names = ['rings', 'earrings', 'chains', 'brooches', 'pendants', 'bracelets', 'necklaces', 'religions', 'souvenirs', 'clocks'];
        $name = $faker->unique()->randomElement($names);

        return [
            'name' => $name,
            'description' => $faker->paragraph,
        ];
    }
}
