<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::select('id')->inRandomOrder()->first(),
            'name' => $this->faker->name,
            'address_type' => $this->faker->numberBetween(0, 1),
            'recipient' => $this->faker->name,
            'cep' => $this->faker->postcode,
            'street' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'complement' => $this->faker->boolean(50) ? $this->faker->secondaryAddress : null,
            'neighborhood' => $this->faker->citySuffix,
            'city' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
            'reference' => $this->faker->boolean(30) ? $this->faker->sentence : null,
            'main' => $this->faker->boolean(10),
        ];
    }
}
