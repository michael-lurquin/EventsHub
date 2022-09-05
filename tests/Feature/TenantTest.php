<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TenantTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private User $auth;

    public function setUp() : void
    {
        parent::setUp();

        $this->auth = User::factory()->create();
    }

    /**
     * See Tenant index page
     */
    public function testTenantIndex()
    {
        $response = $this->actingAs($this->auth)->get(route('admin.tenants.index'));

        $response->assertStatus(200);
        $response->assertSee('Tenants');
    }
}
