<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Master;
use App\Models\Material;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;
use App\Models\Product_Category;
use App\Models\Product_Material;
use App\Models\Product_Stone;
use App\Models\Stone;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory()->count(5)->create();
        Product::factory()->count(5)->create();
        Category::factory()->count(10)->create();
        Master::factory()->count(5)->create();
        Material::factory()->count(4)->create();
        News::factory()->count(15)->create();
        Stone::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        Order::factory()->count(5)->create();
        Product_Category::factory()->count(10)->create();
        Product_Material::factory()->count(10)->create();
        Product_Stone::factory()->count(10)->create();
    }
}
