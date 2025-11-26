<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
    }

    public function test_admin_redirects_to_admin_dashboard()
    {
        $user = User::where('email', 'admin@barberia.com')->first();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'Admin1234',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_barber_redirects_to_barber_dashboard()
    {
        $user = User::where('email', 'barbero@barberia.com')->first();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'Barbero1234',
        ]);

        $response->assertRedirect(route('barbero.dashboard'));
    }

    public function test_client_redirects_to_client_dashboard()
    {
        $user = User::where('email', 'cliente@barberia.com')->first();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'Cliente1234',
        ]);

        $response->assertRedirect(route('cliente.dashboard'));
    }

    public function test_admin_can_access_admin_dashboard()
    {
        $user = User::where('email', 'admin@barberia.com')->first();
        $this->actingAs($user);

        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Panel de Administración');
    }

    public function test_client_cannot_access_admin_dashboard()
    {
        $user = User::where('email', 'cliente@barberia.com')->first();
        $this->actingAs($user);

        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(403);
    }
}
