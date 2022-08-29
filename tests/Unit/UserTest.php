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

    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
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

        $user = (new UserRepository(new User))->create($data);

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
        $user = (new UserRepository(new User))->find($this->user->id);

        $this->assertInstanceOf(User::class, $user);
        $this->assertModelExists($user);
    }

    /**
     * Modifiation d'un utilisateur
     *
     * @return User
     */
    public function testEditUser()
    {
        $data['name'] = 'John Doe';

        (new UserRepository($this->user))->update($data);

        $this->assertEquals($data['name'], $this->user->name);
    }

    /**
     * Suppression d'un utilisateur
     *
     * @return User
     */
    public function testDeleteUser()
    {
        (new UserRepository($this->user))->delete();

        $this->assertSoftDeleted('users', ['id' => $this->user->id]);
    }

    /**
     * Suppression forcée d'un utilisateur
     *
     * @return User
     */
    public function testDeleteForceUser()
    {
        (new UserRepository($this->user))->deleteForce();

        $this->assertModelMissing($this->user);
    }

    /**
     * Restauration d'un utilisateur
     *
     * @return User
     */
    public function testRestoreUser()
    {
        (new UserRepository($this->user))->restore();

        $this->assertNotSoftDeleted($this->user);
    }
}
