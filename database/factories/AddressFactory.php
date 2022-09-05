<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $countries = array_keys(listOfCountries());

        return [
            'street' => fake()->streetAddress,
            'city' => fake()->city,
            'state' => fake()->state,
            'post_code' => fake()->postcode,
            'country_code' => fake()->randomElement($countries),
        ];
    }
}
