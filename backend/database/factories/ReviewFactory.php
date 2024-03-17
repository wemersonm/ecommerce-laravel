<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product_id = Product::inRandomOrder()->first()->id;
        return [
            'product_id' => $product_id,
            'user_id' => User::inRandomOrder()->first()->id,
            'description' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(1,5),
            'likes' => $this->faker->numberBetween(0,20),
        ];
    }
}
