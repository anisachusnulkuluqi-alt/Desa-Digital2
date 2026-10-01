<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();
        $this->get(route('admin.kantor.index'))->assertRedirect(route('login'));

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('home', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_admin_seeder_keeps_the_existing_account_password(): void
    {
        User::where('email', 'admin@desadigital.id')->delete();
        $this->seed(AdminSeeder::class);
        $admin = User::where('email', 'admin@desadigital.id')->firstOrFail();

        $this->post('/login', [
            'email' => 'admin@desadigital.id',
            'password' => 'admin1234',
        ])->assertRedirect(route('dashboard', absolute: false));
        $this->assertAuthenticatedAs($admin);

        $this->post('/logout');
        $admin->update(['password' => 'my-changed-password']);
        $this->seed(AdminSeeder::class);

        $this->post('/login', [
            'email' => 'admin@desadigital.id',
            'password' => 'my-changed-password',
        ])->assertRedirect(route('dashboard', absolute: false));
        $this->assertAuthenticatedAs($admin->fresh());
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect(route('login'));
    }
}
