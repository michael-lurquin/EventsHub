<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        Config::set('app.name', 'EventsHub');
    }

    /**
     * See Welcome page
     */
    public function testSeeWelcome()
    {
        $response = $this->get(route('welcome'));

        $response->assertSuccessful();
        $response->assertSee(config('app.name'));
    }

    /**
     * See Login page
     */
    public function testLogin()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertSee('Sign in to your account');
    }

    /**
     * See Submit login page
     */
    public function testSubmitLogin()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
