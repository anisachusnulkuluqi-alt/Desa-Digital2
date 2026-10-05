<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SharedKantorWifiPhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_adding_a_photo_at_a_matching_location_can_apply_it_to_both_points(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create(['email_verified_at' => now(), 'role' => User::ROLE_ADMIN]));
        $kantorId = $this->createLocation('lokasi_kantor', 'Balai Desa', -6.8, 111.6);
        $data = [
            'nama_lokasi' => 'WiFi Balai Desa',
            'desa' => 'Kedungrejo',
            'fasilitator' => 'pemerintah_desa',
            'alamat' => 'Jalan Desa',
            'latitude' => -6.8,
            'longitude' => 111.6,
            'properties' => '{}',
            'foto' => UploadedFile::fake()->image('wifi.jpg'),
        ];

        $this->post(route('admin.wifi.store'), $data, ['Accept' => 'application/json'])
            ->assertStatus(409)
            ->assertJson([
                'requires_confirmation' => true,
                'counterpart_category' => 'Kantor Desa',
            ]);

        $this->post(route('admin.wifi.store'), array_merge($data, ['apply_foto_kantor_wifi' => '1']), ['Accept' => 'application/json'])
            ->assertRedirect(route('admin.wifi.index'));

        $kantorProperties = json_decode(DB::table('lokasi_kantor')->where('id', $kantorId)->value('properties'), true);
        $wifiProperties = json_decode(DB::table('lokasi_wifi')->where('nama_lokasi', 'WiFi Balai Desa')->value('properties'), true);

        $this->assertSame($kantorProperties['foto'], $wifiProperties['foto']);
        Storage::disk('public')->assertExists('kantor_dan_wifi/'.basename(parse_url($wifiProperties['foto'], PHP_URL_PATH)));
    }

    public function test_removing_a_photo_at_a_matching_location_can_remove_it_from_both_points(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create(['email_verified_at' => now(), 'role' => User::ROLE_ADMIN]));
        $photoPath = 'kantor_dan_wifi/shared.jpg';
        Storage::disk('public')->put($photoPath, 'photo');
        $photoUrl = asset('storage/'.$photoPath);
        $kantorId = $this->createLocation('lokasi_kantor', 'Balai Desa', -6.8, 111.6, ['foto' => $photoUrl]);
        $this->createLocation('lokasi_wifi', 'WiFi Balai Desa', -6.8, 111.6, ['foto' => $photoUrl]);
        $data = [
            '_method' => 'PUT',
            'nama_lokasi' => 'Balai Desa',
            'desa' => 'Kedungrejo',
            'alamat' => 'Jalan Desa',
            'latitude' => -6.8,
            'longitude' => 111.6,
            'link_maps' => '',
            'properties' => '{}',
            'remove_foto' => '1',
        ];

        $this->postJson(route('admin.kantor.update', $kantorId), $data)
            ->assertStatus(409)
            ->assertJson(['requires_confirmation' => true]);

        $this->postJson(route('admin.kantor.update', $kantorId), array_merge($data, ['apply_foto_kantor_wifi' => '1']))
            ->assertRedirect(route('admin.kantor.index'));

        foreach (['lokasi_kantor', 'lokasi_wifi'] as $table) {
            $properties = json_decode(DB::table($table)->value('properties'), true);
            $this->assertArrayNotHasKey('foto', $properties);
        }
        Storage::disk('public')->assertMissing($photoPath);
    }

    private function createLocation(string $table, string $name, float $latitude, float $longitude, array $properties = []): int
    {
        return DB::table($table)->insertGetId([
            'feature_key' => hash('sha256', $table.$name),
            'nama_lokasi' => $name,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'properties' => json_encode($properties),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
