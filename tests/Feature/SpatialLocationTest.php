<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SpatialLocationTest extends TestCase
{
    use RefreshDatabase;

    public function test_spatial_map_uses_the_wisata_database_endpoint(): void
    {
        $this->get(route('data.spasial'))
            ->assertOk()
            ->assertSee('id="layerKabupaten" checked', false)
            ->assertDontSee('id="layerKecamatan" checked', false)
            ->assertDontSee('id="layerDesa" checked', false)
            ->assertSee("document.getElementById('layerKabupaten').checked = true;", false)
            ->assertSee("document.querySelectorAll('.category-chips-row input[type=\"checkbox\"]').forEach(input => {\n                input.checked = false;", false)
            ->assertSee(route('data.spasial.locations', ['kategori' => 'wisata']))
            ->assertSee('districtColors')
            ->assertSee('window.setInterval(refreshSpatialData, 30000)', false)
            ->assertSee('${detailFieldsHtml}', false)
            ->assertSee('${descriptionHtml}', false)
            ->assertSee('properties.jenis_wisata', false)
            ->assertSee('properties.jam_operasional', false)
            ->assertSee('properties.reservasi', false)
            ->assertSee('buildSpatialPopup(item)', false)
            ->assertDontSee('item.address ||');
    }

    public function test_wisata_spatial_endpoint_returns_database_records_as_geojson(): void
    {
        DB::table('lokasi_wisata')->insert([
            'feature_id' => 'wisata-test-1',
            'feature_key' => str_repeat('a', 64),
            'nama_lokasi' => 'Wisata Uji',
            'latitude' => -6.9,
            'longitude' => 111.8,
            'alamat' => 'Desa Uji, Kecamatan Tuban',
            'properties' => json_encode([
                'jenis' => 'Alam',
                'htm' => '0',
                'jam_operasional' => '08.00-17.00',
                'reservasi' => '081234567890',
                'desa' => 'Desa Uji',
                'deskripsi' => 'Deskripsi wisata dari tabel.',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->getJson(route('data.spasial.locations', ['kategori' => 'wisata']))
            ->assertOk()
            ->assertHeader('Cache-Control', 'no-store, private')
            ->assertJsonPath('type', 'FeatureCollection')
            ->assertJsonPath('features.0.type', 'Feature')
            ->assertJsonPath('features.0.id', 'wisata-test-1')
            ->assertJsonPath('features.0.geometry.type', 'Point')
            ->assertJsonPath('features.0.geometry.coordinates', [111.8, -6.9])
            ->assertJsonPath('features.0.properties.nama_wisat', 'Wisata Uji')
            ->assertJsonPath('features.0.properties.jenis', 'Alam')
            ->assertJsonPath('features.0.properties.htm', '0')
            ->assertJsonPath('features.0.properties.jam_operasional', '08.00-17.00')
            ->assertJsonPath('features.0.properties.desa', 'Desa Uji')
            ->assertJsonPath('features.0.properties.deskripsi', 'Deskripsi wisata dari tabel.')
            ->assertJsonPath('features.0.properties.alamat', 'Desa Uji, Kecamatan Tuban');

        DB::table('lokasi_wisata')->where('feature_id', 'wisata-test-1')->update([
            'nama_lokasi' => 'Wisata Uji Diperbarui',
            'properties' => json_encode(['jenis' => 'Budaya']),
            'updated_at' => now(),
        ]);

        $this->getJson(route('data.spasial.locations', ['kategori' => 'wisata']))
            ->assertOk()
            ->assertJsonPath('features.0.properties.nama_wisat', 'Wisata Uji Diperbarui')
            ->assertJsonPath('features.0.properties.jenis', 'Budaya');
    }

    public function test_each_spatial_category_reads_address_from_its_own_database_table(): void
    {
        $categories = [
            'wifi' => 'lokasi_wifi',
            'kantor' => 'lokasi_kantor',
            'pasar' => 'lokasi_pasar',
            'wisata' => 'lokasi_wisata',
            'bumdes' => 'lokasi_bumdes',
            'kkdmp' => 'lokasi_kkdmp',
        ];

        foreach ($categories as $category => $table) {
            DB::table($table)->insert([
                'feature_key' => hash('sha256', $category),
                'nama_lokasi' => "Lokasi {$category}",
                'alamat' => "Alamat {$category}",
                'latitude' => -6.9,
                'longitude' => 111.8,
                'properties' => json_encode(['alamat' => "Alamat JSON {$category}"]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->getJson(route('data.spasial.locations', ['kategori' => $category]))
                ->assertOk()
                ->assertJsonPath('features.0.properties.alamat', "Alamat {$category}");
        }
    }

    public function test_spatial_endpoint_falls_back_to_json_address_without_using_village_as_address(): void
    {
        DB::table('lokasi_wifi')->insert([
            'feature_key' => str_repeat('b', 64),
            'nama_lokasi' => 'WiFi Uji',
            'latitude' => -6.9,
            'longitude' => 111.8,
            'properties' => json_encode([
                'alamat' => '',
                'Address' => 'Alamat JSON WiFi',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('lokasi_wisata')->insert([
            'feature_key' => str_repeat('c', 64),
            'nama_lokasi' => 'Wisata Uji',
            'latitude' => -6.9,
            'longitude' => 111.8,
            'properties' => json_encode(['desa' => 'Desa Uji']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->getJson(route('data.spasial.locations', ['kategori' => 'wifi']))
            ->assertOk()
            ->assertJsonPath('features.0.properties.alamat', 'Alamat JSON WiFi');
        $this->getJson(route('data.spasial.locations', ['kategori' => 'wisata']))
            ->assertOk()
            ->assertJsonPath('features.0.properties.alamat', '');
    }
}
