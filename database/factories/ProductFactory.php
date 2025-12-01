<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 200, 5000),
            'image' => 'products/default.jpg',
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
        ];
    }
}
