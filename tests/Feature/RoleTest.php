<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\RoleSeeder::class);
    }

    public function test_new_user_has_client_role()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => \Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature() ? 'on' : '',
        ]);

        $this->assertAuthenticated();
        $user = User::where('email', 'test@example.com')->first();
        $this->assertTrue($user->hasRole('client'));
    }

    public function test_admin_redirects_to_admin_dashboard()
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $user = User::factory()->create();
        $user->roles()->attach($adminRole);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_client_redirects_to_client_dashboard()
    {
        $clientRole = Role::where('slug', 'client')->first();
        $user = User::factory()->create();
        $user->roles()->attach($clientRole);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect(route('client.dashboard'));
    }

    public function test_client_cannot_access_admin_dashboard()
    {
        $clientRole = Role::where('slug', 'client')->first();
        $user = User::factory()->create();
        $user->roles()->attach($clientRole);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard()
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $user = User::factory()->create();
        $user->roles()->attach($adminRole);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }
}
