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
    public function definition(): array
    {
        $name = fake()->sentence(fake()->numberBetween(8, 16));
        $rating = fake()->randomFloat(1, 3, 5);
        return [
            'name' => $name,
            'stock' => fake()->numberBetween(10, 100),
            'price' => fake()->randomFloat(2, 40, 2000),
            'slug' => fake()->slug($name),
            'weight' => fake()->randomFloat(2, 100, 5000),
            'height' => fake()->randomFloat(1, 10, 120),
            'width' => fake()->randomFloat(1, 10, 120),
            'lenght' => fake()->randomFloat(1, 10, 120),
            'image' => 'https://via.placeholder.com/500/f' . fake()->randomNumber(4),
            'rating' => $rating,
            'reviews' => fake()->numberBetween(10, 100),
        ];
    }
}
