<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tenant;
use App\Models\Address;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    private Tenant $tenant;

    public function setUp() : void
    {
        parent::setUp();

        $this->tenant = Tenant::factory()
            ->has(Address::factory(), 'address')
            ->create()
        ;
    }

    /**
     * See Profile/Account page
     */
    public function testSeeProfileAccount()
    {
        $response = $this->actingAs($this->tenant->owner)->get(route('admin.profile.account'));

        $response->assertSuccessful();
        $response->assertSee('Profile / Account');
    }

    /**
     * Enregistrement de la section "Profile/Account"
     */
    public function testSaveProfileAccount()
    {
        Storage::fake('s3');

        $file = UploadedFile::fake()->image('photo1.jpg');
        $path = "cdn/tenants/avatars/{$file->hashName()}";

        $data = [
            'last_name' => 'Doe',
            'first_name' => 'John',
            'email' => 'john.doe@my-company.com',
            'photo_url' => $file,
        ];

        $response = $this->actingAs($this->tenant->owner)->put(route('admin.profile.update-account'), $data);

        $response->assertRedirect(route('welcome'));

        $response->assertSessionHas('success', 'Personal information updated!');

        $this->assertEquals($data['last_name'], $this->tenant->owner->last_name);
        $this->assertEquals($path, $this->tenant->owner->photo_url);

        $this->assertFileExists("public/{$path}");
    }

    /**
     * See Profile/Company page
     */
    public function testSeeProfileCompany()
    {
        $response = $this->actingAs($this->tenant->owner)->get(route('admin.profile.company'));

        $response->assertSuccessful();
        $response->assertSee('Profile / Company');
    }

    /**
     * Enregistrement de la section "Profile/Company"
     */
    public function testSaveProfileCompany()
    {
        Storage::fake('s3');

        $file = UploadedFile::fake()->image('photo1.jpg');
        $path = "cdn/tenants/logos/{$file->hashName()}";

        $data = [
            'name' => 'My company',
            'subdomain' => 'my-company',
            'email' => 'john.doe@my-company.com',
            'about' => 'About my company',
            'logo_url' => $file,
            'address' => [
                'street' => 'Chaussée de Tirlemont 75',
                'city' => 'Gembloux',
                'state' => 'Namur',
                'post_code' => '5300',
                'country_code' => 'BEL',
            ],
        ];

        $response = $this->actingAs($this->tenant->owner)->put(route('admin.profile.company'), $data);

        $response->assertRedirect(route('welcome'));

        $response->assertSessionHas('success', 'Profile updated!');

        $this->tenant = $this->tenant->fresh();

        $this->assertEquals($data['name'], $this->tenant->name);
        $this->assertEquals($data['address']['street'], $this->tenant->address->street);
        $this->assertEquals($path, $this->tenant->logo_url);

        $this->assertFileExists("public/{$path}");
    }

    /**
     * See Profile/Password page
     */
    public function testSeeProfilePassword()
    {
        $response = $this->actingAs($this->tenant->owner)->get(route('admin.profile.password'));

        $response->assertSuccessful();
        $response->assertSee('Profile / Password');
    }

    /**
     * Changement de mot de passe "Profile/Password"
     */
    public function testUpdatePassword()
    {
        $currentPassword = $this->tenant->owner->password;

        $response = $this->actingAs($this->tenant->owner)->put(route('admin.profile.update-password'), [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertRedirect(route('welcome'));

        $response->assertSessionHas('success', 'Password updated!');

        $this->assertNotEquals($currentPassword, $this->tenant->owner->password);
    }
}