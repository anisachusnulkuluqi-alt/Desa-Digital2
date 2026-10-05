<?php

namespace Tests\Feature\Admin;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Tempat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_search_suggestions_include_matching_village_district_and_menu(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);
        $kecamatan = Kecamatan::create([
            'nama_kecamatan' => 'Kecamatan Uji',
            'kode_wilayah' => 'uji-001',
        ]);
        Desa::create([
            'kecamatan_id' => $kecamatan->id,
            'nama_desa' => 'Desa Uji',
            'kode_desa' => 'uji-001',
        ]);
        Tempat::create([
            'nama' => 'Kuliner Uji',
            'kategori' => 'kuliner',
        ]);

        $this->actingAs($admin)
            ->getJson(route('admin.search.suggestions', ['q' => 'Uji']))
            ->assertOk()
            ->assertJsonFragment([
                'title' => 'Desa Uji',
                'type' => 'Desa',
                'url' => route('admin.desa.index', ['search' => 'Desa Uji']),
            ])
            ->assertJsonFragment([
                'title' => 'Kecamatan Uji',
                'type' => 'Kecamatan',
                'url' => route('admin.kecamatan.index', ['search' => 'Kecamatan Uji']),
            ]);

        $this->actingAs($admin)
            ->getJson(route('admin.search.suggestions', ['q' => 'BUMDes']))
            ->assertOk()
            ->assertJsonFragment([
                'title' => 'BUMDes',
                'type' => 'Menu',
                'url' => route('admin.bumdes.index'),
            ]);

        $this->actingAs($admin)
            ->getJson(route('admin.search.suggestions', ['q' => 'Tempat']))
            ->assertOk()
            ->assertJsonFragment([
                'title' => 'Tempat',
                'type' => 'Menu',
                'url' => route('admin.tempat.index'),
            ]);

        $sidebarRoutes = [
            'dashboard',
            'admin.kecamatan.index',
            'admin.desa.index',
            'admin.wisata.index',
            'admin.pasar.index',
            'admin.kantor.index',
            'admin.wifi.index',
            'admin.bumdes.index',
            'admin.kkdmp.index',
            'admin.settings.index',
            'admin.kontributor.index',
            'admin.tempat.index',
            'admin.tempat.kategori',
        ];

        foreach ($sidebarRoutes as $routeName) {
            $routeParameters = match ($routeName) {
                'admin.tempat.kategori' => ['kategori' => 'kuliner'],
                default => [],
            };
            $response = $this->actingAs($admin)->get(route($routeName, $routeParameters));

            if (in_array($routeName, [
                'admin.pasar.index',
                'admin.kantor.index',
                'admin.wifi.index',
                'admin.bumdes.index',
                'admin.kkdmp.index',
            ], true)) {
                $response->assertSee('<body class="admin-location-module">', false);
            }

            $response->assertOk()
                ->assertSeeInOrder([
                    'Beranda</span>',
                    'Kecamatan</span>',
                    'Desa</span>',
                    'Wisata Desa</span>',
                    'Pasar Desa</span>',
                    'Kantor Desa</span>',
                    'WiFi Desa</span>',
                    'BUMDes</span>',
                    'KKDMP</span>',
                    'Kuliner</span>',
                    'Tempat (Master)</span>',
                    '<li class="sidebar-menu-divider" role="separator"></li>',
                    'Kontributor</span>',
                ], false)
                ->assertSee('id="adminSidebarCollapseToggle"', false)
                ->assertSee('js/admin-sidebar-toggle.js', false);
        }
    }
}
