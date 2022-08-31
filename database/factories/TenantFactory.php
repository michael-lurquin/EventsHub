<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company = fake()->company;

        return [
            'name' => $company,
            'email' => fake()->safeEmail(),
            'subdomain' => Str::slug($company),
            'ends_at' => fake()->dateTimeBetween('-30 days', '+1 years')->format('Y-m-d'),
        ];
    }
}
