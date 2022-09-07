<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
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
     * Users : Index (tab "All")
     */
    public function testUserIndexForAllTab()
    {
        $response = $this->get(route('admin.users.index', ['currentTab' => 'all']));

        $response->assertSuccessful();
        $response->assertSee('Users');

        $this->assertDatabaseCount('users', 1);
    }

    /**
     * Users : Index (tab "Trash")
     */
    public function testUserIndexForTrashTab()
    {
        $response = $this->get(route('admin.users.index', ['currentTab' => 'trash']));

        $response->assertSuccessful();
        $response->assertSee('Users');

        $this->assertDatabaseCount('users', 1);
    }

    /**
     * User : Create
     */
    public function testUserCreate()
    {
        $response = $this->get(route('admin.users.create'));

        $response->assertSuccessful();
        $response->assertSee('New User');
    }

    /**
     * User : Store
     */
    public function testUserStore()
    {
        $data = User::factory()->make()->toArray();

        $this->assertDatabaseCount('users', 1);

        $response = $this->post(route('admin.users.store', $data));

        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('users', [
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'email' => $data['email'],
        ]);

        $user = User::whereEmail($data['email'])->firstOrFail();

        $response->assertSessionHas('success', "User \"{$user->fullname}\" created!");
        $response->assertRedirect(route('admin.users.index', ['currentTab' => 'all']));
    }


    /**
     * User : Edit
     */
    public function testUserEdit()
    {
        $user = User::factory()->create();

        $response = $this->get(route('admin.users.edit', $user));

        $response->assertSuccessful();
        $response->assertSee("Edit \"{$user->fullname}\" user");
    }

    /**
     * User : Update
     */
    public function testUserUpdate()
    {
        $user = User::factory()->create();

        $data = $user->toArray();
        $data['first_name'] = 'John';
        $data['last_name'] = 'Doe';

        $this->assertDatabaseCount('users', 2);

        $response = $this->put(route('admin.users.update', $user), $data);

        $user->refresh();

        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('users', [
            'last_name' => $user->last_name,
            'first_name' => $user->first_name,
            'email' => $user->email,
        ]);

        $response->assertSessionHas('success', "User \"{$user->fullname}\" updated!");
        $response->assertRedirect(route('admin.users.index', ['currentTab' => 'all']));
    }

    /**
     * User : Confirm delete
     */
    public function testUserConfirmDelete()
    {
        $user = User::factory()->create();

        $response = $this->get(route('admin.users.destroy.confirm', $user));

        $response->assertSee('Confirm delete user');
    }

    /**
     * User : Delete
     */
    public function testUserDelete()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('admin.users.destroy', $user));

        $this->assertDatabaseCount('users', 2);
        $this->assertSoftDeleted('users', [
            'id' => $user->id,
        ]);

        $response->assertSessionHas('success', "User \"{$user->fullname}\" deleted!");
        $response->assertRedirect(route('admin.users.index', ['currentTab' => 'all']));
    }

    /**
     * User : Restore
     */
    public function testUserRestore()
    {
        $user = User::factory()->create();
        $user->delete();

        $response = $this->get(route('admin.users.restore', $user));

        $this->assertDatabaseCount('users', 2);
        $this->assertNotSoftDeleted($user->fresh());

        $response->assertSessionHas('success', "User \"{$user->fullname}\" restored!");
        $response->assertRedirect(route('admin.users.index', ['currentTab' => 'all']));
    }

    /**
     * User : ForceDelete
     */
    public function testUserForceDelete()
    {
        $user = User::factory()->create();
        $user->delete();

        $this->assertDatabaseCount('users', 2);
        $this->assertSoftDeleted('users', [
            'id' => $user->id,
        ]);

        $response = $this->get(route('admin.users.destroy.force', $user));

        $this->assertDatabaseCount('users', 1);

        $response->assertSessionHas('success', "User \"{$user->fullname}\" deleted definitly!");
        $response->assertRedirect(route('admin.users.index', ['currentTab' => 'all']));
    }
}
