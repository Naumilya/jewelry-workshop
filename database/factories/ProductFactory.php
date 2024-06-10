<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

// use Faker\Generator as Faker;

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
        $images = [
            'ring1.png',
            'ring2.png',
            'ring3.png',
            'necklaces1.png',
            'necklaces1.png',
            'necklaces2.png',
            'bracelets1.png',
            'bracelets2.png'
            // add more image names here
        ];

        $faker = $this->faker;
        return [
            'name' => $faker->randomElement([ // Rings
                'Серебряное обручальное кольцо',
                'Золотое кольцо с бриллиантом',
                'Платиновое кольцо с изумрудом',
                'Кольцо с рубином и бриллиантами',
                // Earrings
                'Серебряные серьги с жемчугом',
                'Золотые серьги с бриллиантами',
                'Платиновые серьги с сапфиром',
                'Серьги с топазом и цирконом',
                // Chains
                'Золотая цепь с кулоном',
                'Серебряная цепь с бриллиантом',
                'Платиновая цепь с изумрудом',
                'Цепь с рубином и бриллиантами',
                // Brooches
                'Брошь с бриллиантом и жемчугом',
                'Серебряная брошь с изумрудом',
                'Золотая брошь с сапфиром',
                'Брошь с топазом и цирконом',
                // Pendants
                'Пендант с бриллиантом и жемчугом',
                'Серебряный пендант с изумрудом',
                'Золотой пендант с сапфиром',
                'Пендант с рубином и бриллиантами',
                // Bracelets
                'Серебряный браслет с бриллиантами',
                'Золотой браслет с изумрудом',
                'Платиновый браслет с сапфиром',
                'Браслет с топазом и цирконом',
                // Necklaces
                'Серебряное ожерелье с бриллиантами',
                'Золотое ожерелье с изумрудом',
                'Платиновое ожерелье с сапфиром',
                'Ожерелье с рубином и бриллиантами',
                // Religions
                'Нательный крест',
                'Серебряный крест с бриллиантами',
                'Золотой крест с изумрудом',
                'Платиновый крест с сапфиром',
                // Souvenirs
                'Сувенирное кольцо',
                'Сувенирная серьга',
                'Сувенирная цепь',
                'Сувенирный браслет',
                // Clocks
                'Часы с бриллиантами',
                'Часы с изумрудом',
                'Часы с сапфиром',
                'Часы с рубином и бриллиантами'
            ]),
            'cost' => $this->faker->randomFloat(1, 100, 2),
            'image_path' => '/images/products/' . $this->faker->randomElement($images),
            'detail' => $faker->paragraph,
        ];
    }
}
