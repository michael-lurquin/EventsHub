<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    private User $auth;

    public function setUp() : void
    {
        parent::setUp();

        $this->auth = User::factory()->create();
    }

    /**
     * See Login page
     */
    public function testSeeLogin()
    {
        $response = $this->get(route('login'));

        $response->assertSuccessful();
        $response->assertSee('Sign in to your account');
    }

    /**
     * See Dashboard page
     */
    public function testSeeDashboard()
    {
        $response = $this->actingAs($this->auth)->get(route('admin.dashboard'));

        $response->assertSuccessful();
        $response->assertSee('Dashboard');
    }
}
