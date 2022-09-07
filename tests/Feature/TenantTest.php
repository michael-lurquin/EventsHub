<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Address;
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
     * Tenant : Index (tab "All")
     */
    public function testTenantIndexForAllTab()
    {
        $response = $this->get(route('admin.tenants.index', ['currentTab' => 'all']));

        $response->assertSuccessful();
        $response->assertSee('Tenants');

        $this->assertDatabaseCount('tenants', 0);
    }

    /**
     * Tenant : Index (tab "Expired")
     */
    public function testTenantIndexForAllExpired()
    {
        $response = $this->get(route('admin.tenants.index', ['currentTab' => 'expired']));

        $response->assertSuccessful();
        $response->assertSee('Tenants');

        $this->assertDatabaseCount('tenants', 0);
    }

    /**
     * Tenant : Index (tab "Trash")
     */
    public function testTenantIndexForAllTrash()
    {
        $response = $this->get(route('admin.tenants.index', ['currentTab' => 'trash']));

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
        $data['ends_at'] = now()->parse($data['ends_at'])->format('Y-m-d');

        $this->assertDatabaseCount('tenants', 0);

        $response = $this->post(route('admin.tenants.store', $data));

        $this->assertDatabaseCount('tenants', 1);
        $this->assertDatabaseHas('tenants', [
            'name' => $data['name'],
        ]);

        $tenant = Tenant::whereSubdomain($data['subdomain'])->firstOrFail();

        $response->assertSessionHas('success', "Tenant \"{$tenant->name}\" created!");
        $response->assertRedirect(route('admin.tenants.edit', ['tenant' => $tenant, 'currentTab' => 'address']));
    }

    /**
     * Tenant : Edit (tab "Main")
     */
    public function testTenantEditMainTab()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->get(route('admin.tenants.edit', $tenant));
        $response->assertSuccessful();
        $response->assertSee("Edit \"{$tenant->name}\" tenant");
    }

    /**
     * Tenant : Update (tab "Main")
     */
    public function testTenantUpdateMainTab()
    {
        $tenant = Tenant::factory()->create();
        $data = $tenant->withoutRelations(['owner'])->toArray();
        $data['name'] = 'Updated';
        $data['ends_at'] = now()->parse($data['ends_at'])->format('Y-m-d');

        $response = $this->put(route('admin.tenants.update', ['tenant' => $tenant, 'currentTab' => 'main']), $data);

        $tenant->refresh();

        $this->assertDatabaseCount('tenants', 1);
        $this->assertDatabaseHas('tenants', [
            'name' => $tenant->name,
        ]);

        $response->assertRedirect(route('admin.tenants.edit', ['tenant' => $tenant, 'currentTab' => 'address']));
    }

    /**
     * Tenant : Update (tab "Address")
     */
    public function testTenantUpdateAddressTab()
    {
        $tenant = Tenant::factory()->has(Address::factory(), 'address')->create();

        $this->assertDatabaseCount('addresses', 1);

        $data = $tenant->address->toArray();
        $data['street'] = 'Updated';

        $response = $this->put(route('admin.tenants.update', ['tenant' => $tenant, 'currentTab' => 'address']), $data);

        $this->assertDatabaseCount('addresses', 1);
        $this->assertDatabaseHas('addresses', [
            'addressable_id' => $tenant->id,
            'addressable_type' => Tenant::class,
            'street' => $tenant->fresh()->address->street,
        ]);

        $response->assertRedirect(route('admin.tenants.edit', ['tenant' => $tenant, 'currentTab' => 'owner']));
    }

    /**
     * Tenant : Update (tab "Owner")
     */
    public function testTenantUpdateOwnerTab()
    {
        $tenant = Tenant::factory()->create();

        $this->assertDatabaseHas('tenants', [
            'id' => $tenant->id,
            'owner_id' => $tenant->owner_id,
        ]);

        $response = $this->put(route('admin.tenants.update', ['tenant' => $tenant, 'currentTab' => 'owner']), [
            'owner_id' => $this->auth->id,
        ]);

        $this->assertDatabaseHas('tenants', [
            'id' => $tenant->id,
            'owner_id' => $tenant->fresh()->owner_id,
        ]);

        $response->assertSessionHas('success', "Tenant \"{$tenant->name}\" updated!");
        $response->assertRedirect(route('admin.tenants.index', ['currentTab' => 'all']));
    }

    /**
     * Tenant : Confirm delete
     */
    public function testTenantConfirmDelete()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->get(route('admin.tenants.destroy.confirm', $tenant));

        $response->assertSee('Confirm delete tenant');
    }

    /**
     * Tenant : Delete
     */
    public function testTenantDelete()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->delete(route('admin.tenants.destroy', $tenant));

        $this->assertDatabaseCount('tenants', 1);
        $this->assertSoftDeleted('tenants', [
            'id' => $tenant->id,
        ]);

        $response->assertSessionHas('success', "Tenant \"{$tenant->name}\" deleted!");
        $response->assertRedirect(route('admin.tenants.index', ['currentTab' => 'all']));
    }

    /**
     * Tenant : Restore
     */
    public function testTenantRestore()
    {
        $tenant = Tenant::factory()->create();
        $tenant->delete();

        $response = $this->get(route('admin.tenants.restore', $tenant));

        $this->assertDatabaseCount('tenants', 1);
        $this->assertNotSoftDeleted($tenant->fresh());

        $response->assertSessionHas('success', "Tenant \"{$tenant->name}\" restored!");
        $response->assertRedirect(route('admin.tenants.index', ['currentTab' => 'all']));
    }

    /**
     * Tenant : ForceDelete
     */
    public function testTenantForceDelete()
    {
        $tenant = Tenant::factory()->create();
        $tenant->delete();

        $this->assertDatabaseCount('tenants', 1);
        $this->assertSoftDeleted('tenants', [
            'id' => $tenant->id,
        ]);

        $response = $this->get(route('admin.tenants.destroy.force', $tenant));

        $this->assertDatabaseCount('tenants', 0);

        $response->assertSessionHas('success', "Tenant \"{$tenant->name}\" deleted definitly!");
        $response->assertRedirect(route('admin.tenants.index', ['currentTab' => 'all']));
    }
}
