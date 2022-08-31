<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class DashboardTest extends TestCase
{
    private User $auth;

    public function setUp() : void
    {
        parent::setUp();

        $this->auth = User::factory()->create();
    }

    /**
     * See dashboard page
     */
    public function testSeeDashboard()
    {
        $response = $this->actingAs($this->auth)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }
}
