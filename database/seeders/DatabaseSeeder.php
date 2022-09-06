<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Address;
use Illuminate\Database\Seeder;
use App\Repositories\User\UserRepository;
use App\Repositories\Tenant\TenantRepository;

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
            'url' => 'https://learnence.com',
            'about' => implode("\r\n\r\n", fake()->paragraphs()),
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
        Tenant::factory()->state([
            'owner_id' => User::factory(),
        ])
            ->count(15)
            ->has(Address::factory(), 'address')
            ->create()
        ;

        Tenant::where('name', '!=', 'Learnence')->get()->each(function(Tenant $tenant) use($tenantRepository) {
            $tenantRepository->addUser($tenant, $tenant->owner);
        });
    }
}
