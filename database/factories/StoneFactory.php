<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stone>
 */
class StoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;

        return [
            'name' => $faker->randomElement([
                'диамант',
                'нет',
                'сапфир',
                'рубин',
                'изумруд',
                'александрит',
                'харолит',
                'агат',
                'янтарь',
                'серпентинит',
                'родонит',
                'диопсид',
                'аметист',
                'аквамарин',
                'цитрин',
                'гранат',
                'опал',
                'малахит',
            ]),
        ];
    }
}
