<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PasarLocationPhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_pasar_photo_is_uploaded_and_preserved_when_editing_without_a_new_file(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create(['email_verified_at' => now()]));

        $properties = ['kelurahan' => 'Bandungrejo'];
        $this->post(route('admin.pasar.store'), [
            'nama_lokasi' => 'Pasar Foto Test',
            'alamat' => 'Jalan Pasar',
            'latitude' => -6.9,
            'longitude' => 111.8,
            'properties' => json_encode($properties),
            'foto' => UploadedFile::fake()->image('pasar.jpg'),
        ])->assertRedirect(route('admin.pasar.index'));

        $location = DB::table('lokasi_pasar')->where('nama_lokasi', 'Pasar Foto Test')->first();
        $this->assertNotNull($location);

        $savedProperties = json_decode($location->properties, true);
        $photoUrl = $savedProperties['foto'];
        $photoPath = 'pasar/'.basename(parse_url($photoUrl, PHP_URL_PATH));
        Storage::disk('public')->assertExists($photoPath);

        $this->put(route('admin.pasar.update', $location->id), [
            'nama_lokasi' => 'Pasar Foto Test',
            'alamat' => 'Jalan Pasar Baru',
            'latitude' => -6.9,
            'longitude' => 111.8,
            'properties' => json_encode(['kelurahan' => 'Bandungrejo']),
        ])->assertRedirect(route('admin.pasar.index'));

        $updatedProperties = json_decode(
            DB::table('lokasi_pasar')->where('id', $location->id)->value('properties'),
            true
        );

        $this->assertSame($photoUrl, $updatedProperties['foto']);
        Storage::disk('public')->assertExists($photoPath);
    }

    public function test_balai_desa_map_link_and_photo_are_saved_and_preserved_when_editing(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create(['email_verified_at' => now()]));
        $mapLink = 'https://maps.app.goo.gl/example';

        $this->post(route('admin.kantor.store'), [
            'nama_lokasi' => 'Balai Desa Foto Test',
            'alamat' => 'Jalan Desa',
            'latitude' => -6.8,
            'longitude' => 111.6,
            'link_maps' => $mapLink,
            'properties' => '{}',
            'foto' => UploadedFile::fake()->image('balai.jpg'),
        ])->assertRedirect(route('admin.kantor.index'));

        $location = DB::table('lokasi_kantor')->where('nama_lokasi', 'Balai Desa Foto Test')->first();
        $this->assertNotNull($location);
        $savedProperties = json_decode($location->properties, true);
        $photoUrl = $savedProperties['foto'];
        $photoPath = 'kantor/'.basename(parse_url($photoUrl, PHP_URL_PATH));

        $this->assertSame($mapLink, $savedProperties['link_maps']);
        Storage::disk('public')->assertExists($photoPath);

        $this->put(route('admin.kantor.update', $location->id), [
            'nama_lokasi' => 'Balai Desa Foto Test',
            'alamat' => 'Jalan Desa Baru',
            'latitude' => -6.8,
            'longitude' => 111.6,
            'link_maps' => $mapLink,
            'properties' => '{}',
        ])->assertRedirect(route('admin.kantor.index'));

        $updatedProperties = json_decode(
            DB::table('lokasi_kantor')->where('id', $location->id)->value('properties'),
            true
        );

        $this->assertSame($mapLink, $updatedProperties['link_maps']);
        $this->assertSame($photoUrl, $updatedProperties['foto']);
        Storage::disk('public')->assertExists($photoPath);
    }
}