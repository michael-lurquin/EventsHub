<?php

namespace Tests\Feature;

use Tests\TestCase;

class WelcomeTest extends TestCase
{
    /**
     * See Welcome page
     */
    public function testSeeWelcome()
    {
        $response = $this->get(route('welcome'));

        $response->assertSuccessful();
        $response->assertSee('EventsHub');
    }
}
