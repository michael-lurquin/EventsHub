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
            'name' => 'Michaël Lurquin',
            'email' => 'michael.l@learnence.com',
            'password' => 'password',
        ]);

        $tenant = $tenantRepository->create([
            'name' => 'Learnence',
            'email' => 'info@learnence.com',
            'subdomain' => 'learnence',
            'owner_id' => $user->id,
        ]);

        $tenantRepository->addUser($tenant, $user);

        $userRepository->changeTenant($user, $tenant);
    }
}
