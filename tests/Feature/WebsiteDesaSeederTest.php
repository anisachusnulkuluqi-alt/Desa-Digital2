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

    public function test_it_fills_social_media_fields_from_the_village_data_file(): void
    {
        $kecamatan = Kecamatan::create(['nama_kecamatan' => 'Jatirogo']);
        $desa = Desa::create([
            'nama_desa' => 'Demit',
            'kecamatan_id' => $kecamatan->id,
            'kode_desa' => '3523022015',
        ]);

        $this->seed(WebsiteDesaSeeder::class);

        $desa->refresh();
        $this->assertSame('https://www.youtube.com/@pemdesdemit3903', $desa->youtube);
        $this->assertSame('https://www.instagram.com/pemdesdemit', $desa->instagram);
        $this->assertSame('https://www.facebook.com/pemdes.demit.7', $desa->facebook);
    }

    public function test_it_does_not_overwrite_existing_social_media_links_or_clear_them_from_empty_source_values(): void
    {
        $kecamatan = Kecamatan::create(['nama_kecamatan' => 'Kenduruan']);
        $desa = Desa::create([
            'nama_desa' => 'Bendonglateng',
            'kecamatan_id' => $kecamatan->id,
            'kode_desa' => '3523012006',
            'instagram' => 'https://instagram.com/link-yang-sudah-ada',
        ]);

        $this->seed(WebsiteDesaSeeder::class);

        $this->assertSame('https://instagram.com/link-yang-sudah-ada', $desa->fresh()->instagram);
    }
}
