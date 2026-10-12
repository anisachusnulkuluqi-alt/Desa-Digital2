<?php

namespace Database\Seeders;

use App\Models\Wisata;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class WisataSeeder extends Seeder
{
    /**
     * Nama tabel tujuan: lokasi_wisata
     * Kolom fisik: nama_lokasi, desa, alamat, jenis_wisata, jam_operasional, htm, reservasi, deskripsi, foto, latitude, longitude, properties
     */
    public function run(): void
    {
        // 1. Lokasi file data sumber
        $candidatePaths = [
            database_path('seeders/wisata.json'),
            base_path('wisata.json'),
            public_path('json/wisata.json'),
        ];

        $jsonPath = null;
        foreach ($candidatePaths as $path) {
            if (File::exists($path)) {
                $jsonPath = $path;
                break;
            }
        }

        if (!$jsonPath) {
            $this->command?->error('File data wisata.json tidak ditemukan.');
            return;
        }

        $rawContent = File::get($jsonPath);
        $items = json_decode($rawContent, true);

        if (!is_array($items) || empty($items)) {
            $this->command?->error("Data wisata pada file {$jsonPath} kosong atau tidak valid.");
            return;
        }

        $this->command?->info("Menghubungkan data dari " . basename($jsonPath) . " ke tabel lokasi_wisata...");

        $count = 0;
        foreach ($items as $item) {
            $nama = trim($item['nama_wisata'] ?? $item['nama_lokasi'] ?? '');
            if ($nama === '') {
                continue;
            }

            $id = $item['id'] ?? null;
            $featureId = $id !== null ? (string) $id : null;
            $featureKey = 'wisata_' . ($id !== null ? $id : md5($nama));

            $latitude = isset($item['latitude']) && is_numeric($item['latitude']) ? (float) $item['latitude'] : null;
            $longitude = isset($item['longitude']) && is_numeric($item['longitude']) ? (float) $item['longitude'] : null;

            // Normalisasi jam operasional agar tidak ada karakter encoding rusak (seperti \x96 / unprintable dash)
            $jamOperasional = trim((string) ($item['jam_operasional'] ?? ''));
            if ($jamOperasional !== '') {
                $jamOperasional = str_replace(["\x96", "\u{0096}", "\u{2013}", "\u{2014}", 'â€“', 'â€”', '–', '—'], ' - ', $jamOperasional);
                $jamOperasional = preg_replace('/\s+-\s+/', ' - ', $jamOperasional);
            }

            $desa = $item['desa'] ?? null;
            $alamat = $item['alamat'] ?? (!empty($desa) ? 'Desa ' . $desa : null);
            $jenisWisata = $item['jenis_wisata'] ?? $item['jenis'] ?? null;
            $htm = isset($item['htm']) ? (string) $item['htm'] : '0';
            $reservasi = $item['reservasi'] ?? null;
            $deskripsi = $item['deskripsi'] ?? null;
            $foto = $item['foto'] ?? null;

            // Properties JSON untuk kompatibilitas layer GeoJSON / WebGIS
            $properties = [
                'FID' => $id,
                'nama_wisat' => $nama,
                'nama_wisata' => $nama,
                'desa' => $desa,
                'jenis' => $jenisWisata,
                'jenis_wisata' => $jenisWisata,
                'jam_operasional' => $jamOperasional ?: null,
                'jam_operas' => $jamOperasional ?: null,
                'htm' => $htm,
                'reservasi' => $reservasi,
                'deskripsi' => $deskripsi,
                'foto' => $foto,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ];

            // Cari record yang sudah ada berdasarkan feature_id atau nama_lokasi
            $wisata = null;
            if ($featureId !== null) {
                $wisata = Wisata::where('feature_id', $featureId)->first();
            }
            if (!$wisata) {
                $wisata = Wisata::where('nama_lokasi', $nama)->first();
            }
            if (!$wisata) {
                $wisata = new Wisata();
                $wisata->feature_id = $featureId;
                $wisata->feature_key = $featureKey;
            }

            // Menyambungkan semua data ke setiap kolom fisik tabel lokasi_wisata
            $wisata->nama_lokasi = $nama;
            $wisata->desa = $desa;
            $wisata->alamat = $alamat;
            $wisata->jenis_wisata = $jenisWisata;
            $wisata->jam_operasional = $jamOperasional ?: null;
            $wisata->htm = $htm;
            $wisata->reservasi = $reservasi;
            $wisata->deskripsi = $deskripsi;
            $wisata->foto = $foto;
            $wisata->latitude = $latitude;
            $wisata->longitude = $longitude;
            $wisata->properties = json_encode($properties, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $wisata->save();

            $count++;
        }

        $this->command?->info("Sukses! Sebanyak {$count} data wisata terhubung dan tersimpan lengkap di tabel lokasi_wisata.");
    }
}
