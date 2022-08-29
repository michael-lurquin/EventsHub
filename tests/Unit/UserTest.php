<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

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
     *
     * @return User
     */
    public function testCreateUser()
    {
        $data = [
            'name' => fake()->name,
            'email' => fake()->safeEmail,
            'password' => 'password',
        ];

        $user = $this->repository->create($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertModelExists($user);
    }

    /**
     * Récupération d'un utilisateur
     *
     * @return User
     */
    public function testFindUser()
    {
        $this->repository->find($this->user->id);

        $this->assertInstanceOf(User::class, $this->user);
        $this->assertModelExists($this->user);
    }

    /**
     * Modifiation d'un utilisateur
     *
     * @return User
     */
    public function testEditUser()
    {
        $data['name'] = 'John Doe';

        $this->repository->update($this->user, $data);

        $this->assertEquals($data['name'], $this->user->name);
    }

    /**
     * Suppression d'un utilisateur
     *
     * @return User
     */
    public function testDeleteUser()
    {
        $this->repository->delete($this->user);

        $this->assertSoftDeleted('users', ['id' => $this->user->id]);
    }

    /**
     * Suppression forcée d'un utilisateur
     *
     * @return User
     */
    public function testDeleteForceUser()
    {
        $this->repository->deleteForce($this->user);

        $this->assertModelMissing($this->user);
    }

    /**
     * Restauration d'un utilisateur
     *
     * @return User
     */
    public function testRestoreUser()
    {
        $this->repository->restore($this->user);

        $this->assertNotSoftDeleted($this->user);
    }
}
