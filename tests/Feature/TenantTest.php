<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TenantTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private User $auth;

    public function setUp() : void
    {
        parent::setUp();

        $this->auth = User::factory()->create();

        $this->actingAs($this->auth);
    }

    /**
     * Tenant : Index
     */
    public function testTenantIndex()
    {
        $response = $this->get(route('admin.tenants.index'));

        $response->assertSuccessful();
        $response->assertSee('Tenants');

        $this->assertDatabaseCount('tenants', 0);
    }

    /**
     * Tenant : Create
     */
    public function testTenantCreate()
    {
        $response = $this->get(route('admin.tenants.create'));

        $response->assertSuccessful();
        $response->assertSee('New Tenant');
    }

    /**
     * Tenant : Store
     */
    public function testTenantStore()
    {
        $data = Tenant::factory()->make()->toArray();
        $data['ends_at'] = fake()->dateTimeBetween('now', '+1 years')->format('Y-m-d');
        $data['owner_id'] = $this->auth->id;

        $this->assertDatabaseCount('tenants', 0);

        $response = $this->post(route('admin.tenants.store', $data));

        $this->assertDatabaseCount('tenants', 1);
        $this->assertDatabaseHas('tenants', [
            'name' => $data['name'],
            'subdomain' => $data['subdomain'],
            'email' => $data['email'],
            'ends_at' => now()->parse($data['ends_at'])->format('Y-m-d H:i:s'),
        ]);

        $tenant = Tenant::whereSubdomain($data['subdomain'])->firstOrFail();

        $response->assertSessionHas('success', "Tenant \"{$tenant->name}\" created!");
        $response->assertRedirect(route('admin.tenants.index'));
    }
}
