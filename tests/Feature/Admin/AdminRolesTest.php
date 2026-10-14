<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Tempat;
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

    public function test_contributor_dashboard_uses_sidebar_without_admin_only_links(): void
    {
        Kategori::create(['nama' => 'Lokasi Khusus']);
        $contributor = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_CONTRIBUTOR,
        ]);

        $this->actingAs($contributor)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Kontributor data')
            ->assertSee('WiFi Desa')
            ->assertSee(route('admin.tempat.kategori.detail', ['kategori' => 'Lokasi Khusus']))
            ->assertDontSee(route('admin.layanan.index'))
            ->assertDontSee('Spasial (Master)')
            ->assertDontSee(route('admin.kontributor.index'));
    }

    public function test_admin_dashboard_sidebar_includes_admin_management_links(): void
    {
        Kategori::create(['nama' => 'Lokasi Khusus']);
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        $this->actingAs($admin)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Admin pengelola data')
            ->assertSee(route('admin.layanan.index'))
            ->assertSee('Spasial (Master)')
            ->assertSee(route('admin.tempat.index'))
            ->assertSee(route('admin.kontributor.index'))
            ->assertSeeInOrder(['KKDMP', 'Lokasi Khusus', 'Survei Kepuasan', 'Layanan (Master)', 'Spasial (Master)']);
    }

    public function test_contributor_can_access_dynamic_category_but_not_spatial_master_configuration(): void
    {
        Kategori::create(['nama' => 'lokasi-uji']);
        $contributor = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_CONTRIBUTOR,
        ]);

        $this->actingAs($contributor)
            ->get(route('admin.tempat.index'))
            ->assertForbidden();

        $this->get(route('admin.tempat.kategori.detail', ['kategori' => 'lokasi-uji']))
            ->assertOk()
            ->assertSee('Tambah Data')
            ->assertDontSee('href="' . route('admin.tempat.index') . '"', false)
            ->assertDontSee('id="btnDeleteModal"', false);

        $this->get(route('admin.tempat.kategori.fields.json', ['kategori' => 'lokasi-uji']))
            ->assertForbidden();
        $this->postJson(route('admin.tempat.kategori.store'), ['nama' => 'lokasi-baru'])
            ->assertForbidden();
        $this->postJson(route('admin.tempat.field.store'), [
            'kategori_id' => Kategori::where('nama', 'lokasi-uji')->value('id'),
            'nama_field' => 'catatan',
            'tipe_field' => 'text',
        ])->assertForbidden();
    }

    public function test_contributor_can_create_and_edit_dynamic_location_data_but_cannot_delete_it(): void
    {
        Kategori::create(['nama' => 'lokasi-uji']);
        $contributor = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_CONTRIBUTOR,
        ]);

        $this->actingAs($contributor)
            ->postJson(route('admin.tempat.data.store'), [
                'kategori' => 'lokasi-uji',
                'nama' => 'Lokasi Baru',
                'latitude' => '-6.9',
                'longitude' => '111.8',
            ])
            ->assertOk()
            ->assertJsonPath('success', true);

        $tempat = Tempat::where('kategori', 'lokasi-uji')->firstOrFail();
        $this->putJson(route('admin.tempat.update', ['id' => $tempat->id]), [
            'nama' => 'Lokasi Diperbarui',
            'latitude' => '-6.8',
            'longitude' => '111.9',
        ])->assertOk()->assertJsonPath('success', true);

        $this->assertSame('Lokasi Diperbarui', $tempat->fresh()->nama);
        $this->deleteJson(route('admin.tempat.destroy', ['id' => $tempat->id]))
            ->assertForbidden();
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