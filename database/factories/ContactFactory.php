<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
            'email' => fake()->email,
            'phone_number' => fake()->phoneNumber,
            'address' => fake()->address,
            'state' => fake()->state,
            'city' => fake()->city,
            'country' => fake()->country,
            'zip_code' => fake()->postcode,
            'lat' => fake()->latitude($min = -90, $max = 90),
            'long' => fake()->longitude($min = -180, $max = 180),
        ];
    }
}
