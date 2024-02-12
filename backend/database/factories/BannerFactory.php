<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => 'https://via.placeholder.com/800/f' . $this->faker->randomNumber(4),
            'link' => '/OFERTA-Y',
            'order' => $this->faker->unique()->randomDigit(),
            'active' => true,
            'section' => 'slider',
        ];
    }
}
