<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WisataPhotoRemovalTest extends TestCase
{
    use RefreshDatabase;

    public function test_photo_can_be_removed_from_the_wisata_edit_modal(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]));

        $photoPath = 'wisata/current.jpg';
        Storage::disk('public')->put($photoPath, 'photo contents');
        $photoUrl = 'http://localhost/storage/'.$photoPath;
        $id = DB::table('lokasi_wisata')->insertGetId([
            'feature_key' => str_repeat('a', 64),
            'nama_lokasi' => 'Wisata Foto Test',
            'latitude' => -6.9,
            'longitude' => 111.8,
            'properties' => json_encode(['foto' => $photoUrl]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->get(route('admin.wisata.index'))
            ->assertOk()
            ->assertSee('Hapus foto')
            ->assertSee('Batalkan')
            ->assertSee('name="alamat"', false);

        $data = [
            'nama_lokasi' => 'Wisata Foto Test',
            'desa' => 'Desa Test',
            'alamat' => 'Jalan Wisata Nomor 1, Tuban',
            'jenis_wisata' => '',
            'jam_operasional' => '',
            'htm' => '',
            'reservasi' => '',
            'deskripsi' => '',
            'latitude' => '-6.9',
            'longitude' => '111.8',
        ];

        $this->put(route('admin.wisata.update', $id), $data)
            ->assertOk()
            ->assertJson(['success' => true]);
        $this->assertSame(
            'Jalan Wisata Nomor 1, Tuban',
            DB::table('lokasi_wisata')->where('id', $id)->value('alamat')
        );
        $this->getJson(route('data.spasial.locations', ['kategori' => 'wisata']))
            ->assertOk()
            ->assertJsonPath('features.0.properties.alamat', 'Jalan Wisata Nomor 1, Tuban');
        Storage::disk('public')->assertExists($photoPath);
        $this->assertSame(
            $photoUrl,
            json_decode(DB::table('lokasi_wisata')->where('id', $id)->value('properties'), true)['foto']
        );

        $this->put(route('admin.wisata.update', $id), $data + ['hapus_foto' => '1'])
            ->assertOk()
            ->assertJson(['success' => true]);

        Storage::disk('public')->assertMissing($photoPath);
        $properties = json_decode(DB::table('lokasi_wisata')->where('id', $id)->value('properties'), true);
        $this->assertNull($properties['foto']);
    }
}