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
    public function definition()
    {
        $name = fake()->unique()->streetName();
        return [
            'name' => $name,
            // 'slug' => Str($name)->slug(),
            'color' => fake()->colorName(),
            'image' => fake()->imageUrl(),
            'description' => fake()->text(),
            'price' => random_int(4000, 20000),
            'stock' => random_int(1, 8),
            'state_id' => 1,
            'category_id' => random_int(1, 3),
        ];
    }
}
