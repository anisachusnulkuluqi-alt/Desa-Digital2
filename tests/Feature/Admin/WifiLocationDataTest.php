<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WifiLocationDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_wifi_desa_ssid_facilitator_and_photo_are_saved_and_updated(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create(['email_verified_at' => now(), 'role' => User::ROLE_ADMIN]));

        $this->post(route('admin.wifi.store'), [
            'desa' => 'Desa Sumberagung',
            'nama_lokasi' => 'WiFi Balai Desa',
            'fasilitator' => 'pemerintah_desa',
            'alamat' => 'Jalan Desa Sumberagung',
            'latitude' => -6.8,
            'longitude' => 111.7,
            'properties' => '{}',
            'foto' => UploadedFile::fake()->image('wifi.jpg'),
        ])->assertRedirect(route('admin.wifi.index'));

        $location = DB::table('lokasi_wifi')->where('nama_lokasi', 'WiFi Balai Desa')->first();
        $this->assertNotNull($location);
        $properties = json_decode($location->properties, true);
        $photoUrl = $properties['foto'];
        $photoPath = 'wifi/'.basename(parse_url($photoUrl, PHP_URL_PATH));

        $this->assertSame('Desa Sumberagung', $properties['nama_desa']);
        $this->assertSame('pemerintah_desa', $properties['fasilitator']);
        $this->assertSame('Jalan Desa Sumberagung', $location->alamat);
        $this->assertSame('Jalan Desa Sumberagung', $properties['alamat']);
        Storage::disk('public')->assertExists($photoPath);

        $this->put(route('admin.wifi.update', $location->id), [
            'desa' => 'Desa Sumberagung',
            'nama_lokasi' => 'WiFi Balai Desa',
            'fasilitator' => 'pemerintah_kabupaten',
            'alamat' => 'Jalan Desa Sumberagung',
            'latitude' => -6.8,
            'longitude' => 111.7,
            'properties' => '{}',
        ])->assertRedirect(route('admin.wifi.index'));

        $updatedProperties = json_decode(
            DB::table('lokasi_wifi')->where('id', $location->id)->value('properties'),
            true
        );

        $this->assertSame('pemerintah_kabupaten', $updatedProperties['fasilitator']);
        $this->assertSame('Jalan Desa Sumberagung', $updatedProperties['alamat']);
        $this->assertSame($photoUrl, $updatedProperties['foto']);
        Storage::disk('public')->assertExists($photoPath);
    }
}