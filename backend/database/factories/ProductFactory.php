<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
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
        $name = fake()->unique()->sentence(fake()->numberBetween(8, 16));
        return [
            'name' => $name,
            'category_id' => Category::select('id')->inRandomOrder()->first(),
            'brand_id' => Brand::select('id')->inRandomOrder()->first(),
            'stock' => fake()->numberBetween(10, 100),
            'price' => fake()->randomFloat(2, 40, 2000),
            'slug' => str()->slug($name),
            'weight' => fake()->randomFloat(2, 100, 5000),
            'height' => fake()->randomFloat(1, 10, 120),
            'width' => fake()->randomFloat(1, 10, 120),
            'length' => fake()->randomFloat(1, 10, 120),
            'image' => 'https://via.placeholder.com/500/f' . fake()->randomNumber(4),
            'rating' => fake()->randomFloat(1, 3, 5),
            'reviews' => fake()->numberBetween(10, 100),
            'discount' => $this->faker->numberBetween(0, 12),
            'is_flash_sale' => $this->faker->boolean,
            'max_quantity' => $this->faker->numberBetween(1, 15),
            'sold' => $this->faker->numberBetween(22,150),
        ];
    }
}
