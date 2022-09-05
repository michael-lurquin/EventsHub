<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tenant;
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
        $company = fake()->unique()->company;

        return [
            'name' => $company,
            'email' => fake()->safeEmail(),
            'subdomain' => Str::slug($company),
            'logo_url' => null,
            'ends_at' => fake()->dateTimeBetween('-30 days', '+1 years')->format('Y-m-d'),
            'owner_id' => User::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Tenant $tenant) {
            $tenant->owner->update(['current_tenant_id' => $tenant->id]);
        });
    }
}
