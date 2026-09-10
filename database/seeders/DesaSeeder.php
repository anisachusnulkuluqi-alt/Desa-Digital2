<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Layanan;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DesaSeeder extends Seeder
{
    public function run(): void
    {
        // ===== 1. BUAT ADMIN USER =====
        $user = User::updateOrCreate(
            ['email' => 'admin@desadigital.tuban.go.id'],
            [
                'name' => 'Admin Desa',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        echo "✅ User Admin berhasil dibuat!\n";
        echo "   Email: admin@desadigital.tuban.go.id\n";
        echo "   Password: password\n\n";

        // ===== 2. BUAT DATA DESA (Opsional - untuk testing) =====
        $desaList = [
            ['nama' => 'Kebonsari', 'kecamatan' => 'Tuban'],
            ['nama' => 'Kembangbilo', 'kecamatan' => 'Tuban'],
            ['nama' => 'Mondokan', 'kecamatan' => 'Tuban'],
            ['nama' => 'Banyubang', 'kecamatan' => 'Tuban'],
            ['nama' => 'Menyunyur', 'kecamatan' => 'Tuban'],
        ];

        foreach ($desaList as $index => $desaData) {
            Desa::updateOrCreate(
                ['nama_desa' => $desaData['nama'], 'kecamatan' => $desaData['kecamatan']],
                [
                    'slug' => Str::slug($desaData['nama']) . '-' . ($index + 1),
                    'kabupaten' => 'Tuban',
                    'provinsi' => 'Jawa Timur',
                    'status' => 'aktif',
                ]
            );
        }

        echo "✅ Data Desa berhasil dibuat: " . Desa::count() . " desa\n\n";

        // ===== 3. BUAT LAYANAN (Opsional) =====
        $layanans = [
            ['nama' => 'Surat Keterangan', 'kategori' => 'surat', 'icon' => 'file-earmark-text'],
            ['nama' => 'Portal UMKM', 'kategori' => 'umkm', 'icon' => 'shop'],
            ['nama' => 'Pengaduan Warga', 'kategori' => 'pengaduan', 'icon' => 'exclamation-circle'],
            ['nama' => 'Bantuan Sosial', 'kategori' => 'bansos', 'icon' => 'heart'],
        ];

        $firstDesa = Desa::first();
        if ($firstDesa) {
            foreach ($layanans as $layanan) {
                Layanan::updateOrCreate(
                    ['nama_layanan' => $layanan['nama']],
                    [
                        'deskripsi' => 'Layanan ' . $layanan['nama'] . ' untuk masyarakat.',
                        'kategori' => $layanan['kategori'],
                        'icon' => $layanan['icon'],
                        'desa_id' => $firstDesa->id,
                    ]
                );
            }
            echo "✅ Data Layanan berhasil dibuat: " . Layanan::count() . " layanan\n\n";
        }

        echo "🎉 Seeder selesai! Silakan login dengan kredensial di atas.\n";
    }
}