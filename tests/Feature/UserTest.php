<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    private User $auth;

    public function setUp() : void
    {
        parent::setUp();

        $this->auth = User::factory()->create();
    }

    /**
     * See Tenant index page
     */
    public function testUserIndex()
    {
        $response = $this->actingAs($this->auth)->get(route('admin.users.index'));

        $response->assertStatus(200);
        $response->assertSee('Users');
    }
}
