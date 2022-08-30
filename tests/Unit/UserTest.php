<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tenant;
use App\Notifications\UserInvitation;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Notification;

class UserTest extends TestCase
{
    protected User $user;
    protected UserRepository $repository;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->repository = new UserRepository();
    }

    /**
     * Création d'un utilisateur
     */
    public function testCreateUser()
    {
        $data = User::factory()->make()->toArray();
        $data['password'] = 'password';

        $user = $this->repository->create($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertModelExists($user);
    }

    /**
     * Modification d'un utilisateur
     */
    public function testEditUser()
    {
        $data['name'] = 'John Doe';

        $this->repository->update($this->user, $data);

        $this->assertEquals($data['name'], $this->user->name);
    }

    /**
     * Suppression d'un utilisateur
     */
    public function testDeleteUser()
    {
        $this->repository->delete($this->user);

        $this->assertSoftDeleted('users', ['id' => $this->user->id]);
    }

    /**
     * Suppression forcée d'un utilisateur
     */
    public function testDeleteForceUser()
    {
        $this->repository->deleteForce($this->user);

        $this->assertModelMissing($this->user);
    }

    /**
     * Restauration d'un utilisateur
     */
    public function testRestoreUser()
    {
        $this->repository->restore($this->user);

        $this->assertNotSoftDeleted($this->user);
    }

    /**
     * Modification du tenant actuel de l'utilisateur
     */
    public function testChangeTenant()
    {
        $tenants = Tenant::factory()->count(2)->state([
            'owner_id' => $this->user,
        ])->create();

        $this->repository->changeTenant($this->user, $tenants[0]);

        $this->assertEquals($tenants[0]->id, $this->user->current_tenant_id);

        $this->repository->changeTenant($this->user, $tenants[1]);

        $this->assertEquals($tenants[1]->id, $this->user->current_tenant_id);
    }

    /**
     * Envoi d'un mail d'invitation lors de la création d'un utilisateur
     */
    public function testNotificationSentWhenUserCreated()
    {
        Notification::fake();

        $this->repository->sendInvitation($this->user);

        Notification::assertSentTo($this->user, UserInvitation::class);
    }
}
