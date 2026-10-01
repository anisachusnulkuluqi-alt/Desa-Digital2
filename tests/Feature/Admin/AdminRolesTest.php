<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminRolesTest extends TestCase
{
    use RefreshDatabase;

    public function test_contributor_can_access_crud_interface(): void
    {
        $contributor = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_CONTRIBUTOR,
        ]);

        $this->actingAs($contributor)
            ->get(route('admin.kantor.index'))
            ->assertOk();
    }

    public function test_contributor_login_does_not_return_to_admin_only_user_management(): void
    {
        $contributor = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_CONTRIBUTOR,
        ]);

        $this->get(route('admin.kontributor.index'))->assertRedirect(route('login'));

        $this->post('/login', [
            'email' => $contributor->email,
            'password' => 'password',
        ])->assertRedirect(route('dashboard'));
    }

    public function test_regular_user_cannot_access_admin_interface(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_USER,
        ]);

        $this->actingAs($user)
            ->get(route('admin.kantor.index'))
            ->assertForbidden();

        $this->get(route('dashboard'))->assertForbidden();
    }

    public function test_admin_can_create_contributor_but_contributor_cannot(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.kontributor.index'))
            ->assertOk()
            ->assertSee('Tambah akun kontributor');

        $this->post(route('admin.kontributor.store'), [
            'name' => 'Operator Uji',
            'email' => 'operator-uji@example.test',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => User::ROLE_ADMIN,
        ])->assertRedirect(route('admin.kontributor.index'));

        $contributor = User::where('email', 'operator-uji@example.test')->firstOrFail();
        $this->assertSame(User::ROLE_CONTRIBUTOR, $contributor->role);
        $this->assertTrue(Hash::check('password123', $contributor->password));
        $this->assertNotNull($contributor->email_verified_at);

        $this->actingAs($contributor)
            ->get(route('admin.kontributor.index'))
            ->assertForbidden();
    }

    public function test_admin_can_edit_contributor_and_change_password(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);
        $contributor = User::factory()->create([
            'name' => 'Operator Lama',
            'email_verified_at' => now(),
            'role' => User::ROLE_CONTRIBUTOR,
        ]);
        $oldPassword = $contributor->password;

        $this->actingAs($admin)
            ->get(route('admin.kontributor.edit', $contributor->id))
            ->assertOk()
            ->assertSee('Password baru');

        $this->put(route('admin.kontributor.update', $contributor->id), [
            'name' => 'Operator Baru',
            'email' => 'operator-baru@example.test',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ])->assertRedirect(route('admin.kontributor.index'));

        $contributor->refresh();
        $this->assertSame('Operator Baru', $contributor->name);
        $this->assertSame('operator-baru@example.test', $contributor->email);
        $this->assertSame(User::ROLE_CONTRIBUTOR, $contributor->role);
        $this->assertTrue(Hash::check('newpassword123', $contributor->password));

        $this->put(route('admin.kontributor.update', $contributor->id), [
            'name' => 'Operator Baru',
            'email' => 'operator-baru@example.test',
            'password' => '',
            'password_confirmation' => '',
        ])->assertRedirect(route('admin.kontributor.index'));

        $this->assertSame($contributor->password, $contributor->fresh()->password);
        $this->assertNotSame($oldPassword, $contributor->fresh()->password);
    }

    public function test_admin_can_delete_contributor_but_cannot_target_admin_account(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);
        $contributor = User::factory()->create(['role' => User::ROLE_CONTRIBUTOR]);

        $this->actingAs($admin)
            ->delete(route('admin.kontributor.destroy', $admin->id))
            ->assertNotFound();

        $this->delete(route('admin.kontributor.destroy', $contributor->id))
            ->assertRedirect(route('admin.kontributor.index'));

        $this->assertDatabaseMissing('users', ['id' => $contributor->id]);
    }
}