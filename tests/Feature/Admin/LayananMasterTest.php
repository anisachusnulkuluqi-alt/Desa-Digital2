<?php

namespace Tests\Feature\Admin;

use App\Models\Layanan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayananMasterTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_manage_services_and_public_gateway_reads_them_from_database(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin)
            ->get(route('admin.layanan.index'))
            ->assertOk()
            ->assertSee('Layanan (Master)')
            ->assertSee('Tambah Layanan')
            ->assertSee('name="nama"', false)
            ->assertSee('name="link"', false)
            ->assertSee('Website Desa');

        $this->post(route('admin.layanan.store'), [
            'nama' => 'Layanan Uji',
            'link' => 'https://layanan.example.test',
        ])->assertRedirect(route('admin.layanan.index'));

        $layanan = Layanan::where('nama', 'Layanan Uji')->firstOrFail();
        $this->assertSame('https://layanan.example.test', $layanan->link);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Layanan Uji')
            ->assertSee('href="https://layanan.example.test"', false)
            ->assertSee('target="_blank" rel="noopener noreferrer"', false);

        $this->put(route('admin.layanan.update', $layanan), [
            'nama' => 'Layanan Diperbarui',
            'link' => '/layanan-baru',
        ])->assertRedirect(route('admin.layanan.index'));

        $this->assertDatabaseHas('layanan', [
            'id' => $layanan->id,
            'nama' => 'Layanan Diperbarui',
            'link' => '/layanan-baru',
        ]);

        $this->delete(route('admin.layanan.destroy', $layanan))
            ->assertRedirect(route('admin.layanan.index'));
        $this->assertDatabaseMissing('layanan', ['id' => $layanan->id]);
    }

    public function test_service_link_validation_rejects_non_http_external_schemes(): void
    {
        $this->actingAs(User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
        ]));

        $this->from(route('admin.layanan.index'))
            ->post(route('admin.layanan.store'), [
                'nama' => 'Invalid Link',
                'link' => 'javascript:alert(1)',
            ])
            ->assertRedirect(route('admin.layanan.index'))
            ->assertSessionHasErrors('link');
    }
}
