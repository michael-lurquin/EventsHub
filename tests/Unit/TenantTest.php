<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tenant;
use App\Notifications\TenantInvitation;
use Illuminate\Support\Facades\Notification;
use App\Repositories\Tenant\TenantRepository;

class TenantTest extends TestCase
{
    private Tenant $tenant;
    private TenantRepository $repository;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->tenant = Tenant::factory()->state([
            'owner_id' => $this->user,
        ])->create();
        $this->repository = new TenantRepository();
    }

    /**
     * Création d'un tenant
     */
    public function testCreateTenant()
    {
        $data = Tenant::factory()->make([
            'owner_id' => $this->user,
        ])->toArray();

        $tenant = $this->repository->create($data);

        $this->assertInstanceOf(Tenant::class, $tenant);
        $this->assertModelExists($tenant);
    }

    /**
     * Modification d'un tenant
     */
    public function testEditTenant()
    {
        $data['name'] = 'My Company';

        $this->repository->update($this->tenant, $data);

        $this->assertEquals($data['name'], $this->tenant->name);
    }

    /**
     * Suppression d'un tenant
     */
    public function testDeleteTenant()
    {
        $this->repository->delete($this->tenant);

        $this->assertSoftDeleted('tenants', ['id' => $this->tenant->id]);
    }

    /**
     * Suppression forcée d'un tenant
     */
    public function testDeleteForceTenant()
    {
        $this->repository->deleteForce($this->tenant);

        $this->assertModelMissing($this->tenant);
    }

    /**
     * Restauration d'un tenant
     */
    public function testRestoreTenant()
    {
        $this->repository->restore($this->tenant);

        $this->assertNotSoftDeleted($this->tenant);
    }

    /**
     * Ajoute un utilisateur à un tenant
     */
    public function testAddUserOfTenant()
    {
        $user = User::factory()->create();

        $this->assertCount(0, $this->tenant->users);

        $this->repository->addUser($this->tenant, $user);

        $this->assertCount(1, $this->tenant->fresh()->users);
        $this->assertTrue($this->tenant->users()->first()->is($user));
    }

    /**
     * Supprime un utilisateur d'un tenant
     */
    public function testRemoveUserOfTenant()
    {
        $user = User::factory()->create();

        $this->repository->addUser($this->tenant, $user);

        $this->assertCount(1, $this->tenant->users);

        $this->repository->removeUser($this->tenant, $user);

        $this->assertCount(0, $this->tenant->fresh()->users);
    }

    /**
     * Suppression d'un tenant avec ses utilisateurs
     */
    public function testDeleteTenantWithUsers()
    {
        $user = User::factory()->create();

        $this->repository->addUser($this->tenant, $user);

        $this->assertDatabaseHas('tenant_user', [
            'tenant_id' => $this->tenant->id,
            'user_id' => $user->id,
        ]);

        $this->repository->deleteForce($this->tenant);

        $this->assertDatabaseMissing('tenant_user', [
            'tenant_id' => $this->tenant->id,
            'user_id' => $user->id,
        ]);
    }

    /**
     * Envoi d'un mail d'invitation lors de la création d'un tenant
     */
    public function testNotificationSentWhenTenantCreated()
    {
        Notification::fake();

        $this->repository->sendInvitation($this->tenant);

        Notification::assertSentTo($this->tenant, TenantInvitation::class);
    }
}
