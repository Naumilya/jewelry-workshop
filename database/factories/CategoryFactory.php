<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    private $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;

        $names = [
            'rings' => 'кольца',
            'earrings' => 'серьги',
            'chains' => 'цепи',
            'brooches' => 'броши',
            'pendants' => 'подвески',
            'bracelets' => 'браслеты',
            'necklaces' => 'ожерелья',
            'religions' => 'религии',
            'souvenirs' => 'сувениры',
            'clocks' => 'часы',
        ];

        $key = array_keys($names)[$this->index];
        $this->index++;

        return [
            'name' => $key,
            'name_ru' => $names[$key],
            'description' => $faker->paragraph,
        ];
    }
}
