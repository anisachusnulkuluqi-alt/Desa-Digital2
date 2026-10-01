<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WilayahReadOnlyTest extends TestCase
{
    use RefreshDatabase;

    public function test_kecamatan_and_desa_pages_are_read_only(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        $this->actingAs($admin);

        $this->get(route('admin.kecamatan.index'))
            ->assertOk()
            ->assertDontSee('Tambah Kecamatan');

        $this->get(route('admin.desa.index'))
            ->assertOk()
            ->assertDontSee('Tambah Desa')
            ->assertDontSee('Import');

        foreach ([
            ['GET', '/admin/kecamatan/create'],
            ['POST', '/admin/kecamatan'],
            ['POST', '/admin/kecamatan/import'],
            ['PUT', '/admin/kecamatan/1'],
            ['DELETE', '/admin/kecamatan/1'],
            ['GET', '/admin/desa/create'],
            ['POST', '/admin/desa'],
            ['POST', '/admin/desa/import'],
            ['PUT', '/admin/desa/1'],
            ['DELETE', '/admin/desa/1'],
        ] as [$method, $uri]) {
            $response = $this->call($method, $uri);
            $this->assertContains($response->getStatusCode(), [404, 405], "Unexpected response for {$method} {$uri}");
        }
    }
}