<?php

namespace Tests\Feature;

use App\Models\Desa;
use App\Models\Kecamatan;
use Database\Seeders\WebsiteDesaSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteDesaSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_fills_only_empty_websites_using_village_codes(): void
    {
        $kecamatan = Kecamatan::create(['nama_kecamatan' => 'Kenduruan']);

        $desaTanpaWebsite = Desa::create([
            'nama_desa' => 'Bendonglateng',
            'kecamatan_id' => $kecamatan->id,
            'kode_desa' => '3523012006',
        ]);
        $desaDenganWebsite = Desa::create([
            'nama_desa' => 'Jamprong',
            'kecamatan_id' => $kecamatan->id,
            'kode_desa' => '3523012003',
            'website' => 'https://website-yang-sudah-ada.example',
        ]);

        $this->seed(WebsiteDesaSeeder::class);

        $this->assertSame('https://bendonglateng.desa.id', $desaTanpaWebsite->fresh()->website);
        $this->assertSame('https://website-yang-sudah-ada.example', $desaDenganWebsite->fresh()->website);
    }
}
