<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Repositories\Tenant\TenantRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Default Tenant and User
        $tenantRepository = new TenantRepository();
        $userRepository = new UserRepository();

        $user = $userRepository->create([
            'last_name' => 'Lurquin',
            'first_name' => 'Michaël',
            'email' => 'michael.l@learnence.com',
            'password' => 'password',
        ]);

        $user->markEmailAsVerified();

        $tenant = $tenantRepository->create([
            'name' => 'Learnence',
            'email' => 'info@learnence.com',
            'subdomain' => 'learnence',
            'owner_id' => $user->id,
        ]);

        $tenantRepository->addUser($tenant, $user);

        $tenantRepository->updateAddress($tenant, [
            'street' => 'Chaussée de Tirlemont 75',
            'city' => 'Gembloux',
            'post_code' => '5300',
            'state' => 'Namur',
            'country_code' => 'BEL',
        ]);

        $userRepository->changeTenant($user, $tenant);

        // For test
        \App\Models\Tenant::factory()->state([
            'owner_id' => $user->id,
        ])->count(25)->create();
    }
}
