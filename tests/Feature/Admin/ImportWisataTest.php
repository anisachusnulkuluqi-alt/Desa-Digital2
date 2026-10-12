<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Wisata;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportWisataTest extends TestCase
{
    use RefreshDatabase;

    public function test_artisan_command_imports_wisata_from_json(): void
    {
        $this->artisan('wisata:import')
            ->assertSuccessful()
            ->expectsOutputToContain('35 data wisata berhasil diimpor');

        $this->assertDatabaseHas('lokasi_wisata', [
            'nama_lokasi' => 'Wisata Pelang',
        ]);
        $this->assertDatabaseHas('lokasi_wisata', [
            'nama_lokasi' => 'Pantai Kelapa',
        ]);
    }

    public function test_admin_can_trigger_import_via_post_endpoint(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        $response = $this->actingAs($admin)
            ->postJson(route('admin.wisata.import-json'));

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('count', 35);

        $this->assertDatabaseCount('lokasi_wisata', 35);
    }

    public function test_unauthenticated_user_cannot_trigger_import(): void
    {
        $this->postJson(route('admin.wisata.import-json'))
            ->assertUnauthorized();
    }

    public function test_admin_wisata_page_renders_table_with_imported_data(): void
    {
        Wisata::importFromJson();

        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        $response = $this->actingAs($admin)
            ->get(route('admin.wisata.index'));

        $response->assertOk()
            ->assertDontSee('Sinkronkan wisata.json')
            ->assertSee('Agro Wisata Durian');
    }
}

