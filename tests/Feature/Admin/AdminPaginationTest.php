<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminPaginationTest extends TestCase
{
    use RefreshDatabase;

    public function test_desa_index_paginates_and_continues_row_numbers(): void
    {
        $this->actingAs(User::factory()->create());

        $now = now();
        $kecamatanId = DB::table('kecamatan')->insertGetId([
            'nama_kecamatan' => 'Kecamatan Uji',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        foreach (range(1, 11) as $number) {
            DB::table('desa')->insert([
                'nama_desa' => sprintf('Desa %02d', $number),
                'kecamatan_id' => $kecamatanId,
                'kode_desa' => sprintf('352300000%02d', $number),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->get(route('admin.desa.index', ['page' => 2]))
            ->assertOk()
            ->assertSee('Showing 11 to 11 of 11 results')
            ->assertSee('class="admin-row-number">11</td>', false);
    }

    public function test_location_list_has_a_number_column(): void
    {
        $this->actingAs(User::factory()->create());

        DB::table('lokasi_kantor')->insert([
            'feature_key' => hash('sha256', 'numbered-office-location'),
            'nama_lokasi' => 'BALAI DESA BADER',
            'alamat' => null,
            'latitude' => null,
            'longitude' => null,
            'properties' => '{}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->get(route('admin.kantor.index'))
            ->assertOk()
            ->assertSee('<th style="width: 50px;">NO</th>', false)
            ->assertSee('<td class="row-number">1</td>', false);
    }
}