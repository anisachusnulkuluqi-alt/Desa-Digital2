<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class KkdmpLocationDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_kkdmp_details_and_photo_are_saved_and_updated(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create(['email_verified_at' => now()]));

        $this->post(route('admin.kkdmp.store'), [
            'nama_lokasi' => 'KKDMP Merkawang Test',
            'desa_kelur' => 'Merkawang',
            'jenis' => 'desa',
            'nama_ketua' => 'Supriyono',
            'no_ahu' => 'AHU-TEST-2026',
            'alamat' => 'Jalan Raya Merkawang',
            'latitude' => -6.8,
            'longitude' => 111.7,
            'properties' => '{}',
            'foto' => UploadedFile::fake()->image('kkdmp.jpg'),
        ])->assertRedirect(route('admin.kkdmp.index'));

        $location = DB::table('lokasi_kkdmp')->where('nama_lokasi', 'KKDMP Merkawang Test')->first();
        $this->assertNotNull($location);
        $properties = json_decode($location->properties, true);
        $photoUrl = $properties['foto'];
        $photoPath = 'kkdmp/'.basename(parse_url($photoUrl, PHP_URL_PATH));

        $this->assertSame('Merkawang', $properties['desa_kelur']);
        $this->assertSame('desa', $properties['jenis']);
        $this->assertSame('Supriyono', $properties['ketua']);
        $this->assertSame('AHU-TEST-2026', $properties['no_ahu']);
        Storage::disk('public')->assertExists($photoPath);

        $this->put(route('admin.kkdmp.update', $location->id), [
            'nama_lokasi' => 'KKDMP Merkawang Test',
            'desa_kelur' => 'Merkawang',
            'jenis' => 'kelurahan',
            'nama_ketua' => 'Supriyono Baru',
            'no_ahu' => 'AHU-TEST-2027',
            'alamat' => 'Jalan Raya Merkawang Baru',
            'latitude' => -6.8,
            'longitude' => 111.7,
            'properties' => '{}',
        ])->assertRedirect(route('admin.kkdmp.index'));

        $updatedProperties = json_decode(
            DB::table('lokasi_kkdmp')->where('id', $location->id)->value('properties'),
            true
        );

        $this->assertSame('kelurahan', $updatedProperties['jenis']);
        $this->assertSame('Supriyono Baru', $updatedProperties['ketua']);
        $this->assertSame('AHU-TEST-2027', $updatedProperties['no_ahu']);
        $this->assertSame($photoUrl, $updatedProperties['foto']);
        Storage::disk('public')->assertExists($photoPath);
    }
}