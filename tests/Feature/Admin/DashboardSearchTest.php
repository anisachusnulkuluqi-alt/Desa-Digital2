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

        $this->actingAs($admin)
            ->getJson(route('admin.search.suggestions', ['q' => 'Spasial']))
            ->assertOk()
            ->assertJsonFragment([
                'title' => 'Spasial (Master)',
                'type' => 'Menu',
                'url' => route('admin.tempat.index'),
            ]);

        $this->actingAs($admin)
            ->getJson(route('admin.search.suggestions', ['q' => 'Survei']))
            ->assertOk()
            ->assertJsonFragment([
                'title' => 'Survei Kepuasan',
                'type' => 'Menu',
                'url' => route('admin.survei.index'),
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
            'admin.survei.index',
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
                    'Spasial (Master)</span>',
                    '<li class="sidebar-menu-divider" role="separator"></li>',
                    'Survei Kepuasan</span>',
                    'User</span>',
                ], false)
                ->assertSee('id="adminSidebarCollapseToggle"', false)
                ->assertSee('js/admin-sidebar-toggle.js', false);
        }
    }

    public function test_dashboard_renders_search_form_targeting_all_attributes_search(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        $response->assertOk()
            ->assertSee('action="' . route('admin.search') . '"', false)
            ->assertSee('name="q"', false)
            ->assertSee('id="dashboardSearchInput"', false)
            ->assertSee('id="dashboardSearchSuggestions"', false)
            ->assertSee('placeholder="Cari semua data & atribut', false);
    }

    public function test_search_page_displays_grouped_results_across_all_attributes(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Utama',
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        $kecamatan = Kecamatan::create([
            'nama_kecamatan' => 'Kerek Indah',
            'kode_wilayah' => 'krk-01',
        ]);

        Desa::create([
            'kecamatan_id' => $kecamatan->id,
            'nama_desa' => 'Desa Margomulyo',
            'kode_desa' => 'mgm-01',
            'alamat_kantor' => 'Jl. Raya Margomulyo No. 1',
        ]);

        Tempat::create([
            'nama' => 'Sendang Asri Margomulyo',
            'kategori' => 'wisata alam',
            'desa' => 'Margomulyo',
            'deskripsi' => 'Mata air alami desa',
        ]);

        // Wisata
        if (\Illuminate\Support\Facades\Schema::hasTable('lokasi_wisata')) {
            \App\Models\Wisata::create([
                'feature_key' => 'wisata-margomulyo-01',
                'nama_lokasi' => 'Pantai Margomulyo Indah',
                'desa' => 'Margomulyo',
                'jenis_wisata' => 'Wisata Bahari',
                'alamat' => 'Pesisir Utara',
            ]);
        }

        // Empty search redirects to dashboard
        $this->actingAs($admin)
            ->get(route('admin.search', ['q' => '   ']))
            ->assertRedirect(route('dashboard'));

        // Search by term matching multiple modules and attributes
        $response = $this->actingAs($admin)
            ->get(route('admin.search', ['q' => 'Margomulyo']));

        $response->assertOk()
            ->assertSee('Hasil Pencarian')
            ->assertSee('Margomulyo')
            ->assertSee('Desa Margomulyo')
            ->assertSee('Sendang Asri Margomulyo');

        if (\Illuminate\Support\Facades\Schema::hasTable('lokasi_wisata')) {
            $response->assertSee('Pantai Margomulyo Indah');
        }
    }

    public function test_search_finds_records_by_various_attributes(): void
    {
        $admin = User::factory()->create([
            'name' => 'Koordinator Digital',
            'role' => User::ROLE_ADMIN,
        ]);

        $kec = Kecamatan::create([
            'nama_kecamatan' => 'Rengel Barat',
            'kode_wilayah' => 'rng-01',
        ]);

        Desa::create([
            'kecamatan_id' => $kec->id,
            'nama_desa' => 'Desa Kanorejo',
            'kode_desa' => 'knr-09',
            'alamat_kantor' => 'Jalan Pahlawan Nomor 10',
            'telepon' => '081234567890',
        ]);

        Tempat::create([
            'nama' => 'Pusat Kerajinan Anyaman',
            'kategori' => 'kerajinan',
            'desa' => 'Desa Kanorejo',
            'alamat' => 'Dusun Krajan',
            'deskripsi' => 'Sentra pembuatan kerajinan bambu tradisional',
        ]);

        // Search by category attribute ("kerajinan")
        $responseKat = $this->actingAs($admin)
            ->get(route('admin.search', ['q' => 'kerajinan']));
        $responseKat->assertOk()
            ->assertSee('Pusat Kerajinan Anyaman');

        // Search by office address attribute ("Pahlawan")
        $responseAlamat = $this->actingAs($admin)
            ->get(route('admin.search', ['q' => 'Pahlawan']));
        $responseAlamat->assertOk()
            ->assertSee('Desa Kanorejo');
    }
}


