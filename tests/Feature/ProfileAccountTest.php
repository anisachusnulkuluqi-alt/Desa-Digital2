<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileAccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_uses_account_profile_presentation(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        $this->actingAs($user);

        $this->get(route('profile.show'))
            ->assertOk()
            ->assertSee('Profil Akun')
            ->assertSee('Informasi Akun')
            ->assertSee('Keamanan Akun');
    }
}