<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BumdesLocationDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_bumdes_business_details_and_photo_are_saved_and_updated(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create(['email_verified_at' => now()]));

        $this->post(route('admin.bumdes.store'), [
            'nama_lokasi' => 'BUMDes Maju Test',
            'desa' => 'Merkawang',
            'jenis_usaha' => 'Perdagangan dan jasa',
            'nama_ketua' => 'Siti Aminah',
            'alamat' => 'Jalan Desa',
            'latitude' => -6.8,
            'longitude' => 111.7,
            'properties' => '{}',
            'foto' => UploadedFile::fake()->image('bumdes.jpg'),
        ])->assertRedirect(route('admin.bumdes.index'));

        $location = DB::table('lokasi_bumdes')->where('nama_lokasi', 'BUMDes Maju Test')->first();
        $this->assertNotNull($location);
        $properties = json_decode($location->properties, true);
        $photoUrl = $properties['foto'];
        $photoPath = 'bumdes/'.basename(parse_url($photoUrl, PHP_URL_PATH));

        $this->assertSame('Perdagangan dan jasa', $properties['jenis_usaha']);
        $this->assertSame('Merkawang', $properties['nama_desa']);
        $this->assertSame('Siti Aminah', $properties['nama_ketua']);
        $this->get(route('admin.bumdes.index'))->assertOk()->assertSee('Merkawang');
        Storage::disk('public')->assertExists($photoPath);

        $this->put(route('admin.bumdes.update', $location->id), [
            'nama_lokasi' => 'BUMDes Maju Test',
            'desa' => 'Merkawang',
            'jenis_usaha' => 'Perdagangan, jasa, dan pertanian',
            'nama_ketua' => 'Siti Aminah',
            'alamat' => 'Jalan Desa Baru',
            'latitude' => -6.8,
            'longitude' => 111.7,
            'properties' => '{}',
        ])->assertRedirect(route('admin.bumdes.index'));

        $updatedProperties = json_decode(
            DB::table('lokasi_bumdes')->where('id', $location->id)->value('properties'),
            true
        );

        $this->assertSame('Perdagangan, jasa, dan pertanian', $updatedProperties['jenis_usaha']);
        $this->assertSame('Siti Aminah', $updatedProperties['nama_ketua']);
        $this->assertSame($photoUrl, $updatedProperties['foto']);
        Storage::disk('public')->assertExists($photoPath);
    }
}