<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'lokasi_wisata';

    protected $fillable = [
        'feature_id',
        'feature_key',
        'nama_lokasi',
        'desa',
        'jenis_wisata',
        'jam_operasional',
        'htm',
        'reservasi',
        'deskripsi',
        'foto',
        'alamat',
        'latitude',
        'longitude',
        'properties',
    ];

    // Helper untuk parse JSON properties
    public function getPropertiesAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    // Alias nama_wisata <=> nama_lokasi
    public function getNamaWisataAttribute()
    {
        return $this->nama_lokasi;
    }

    public function setNamaWisataAttribute($value)
    {
        $this->attributes['nama_lokasi'] = $value;
    }

    // Helper untuk mendapatkan jenis wisata
    public function getJenisAttribute()
    {
        if (!empty($this->attributes['jenis_wisata'])) {
            return $this->attributes['jenis_wisata'];
        }
        $props = $this->properties;
        return $props['jenis'] ?? $props['jenis_wisata'] ?? $props['Jenis'] ?? '-';
    }

    // Helper untuk mendapatkan HTM
    public function getHtmAttribute()
    {
        if (isset($this->attributes['htm']) && $this->attributes['htm'] !== '') {
            return (string) $this->attributes['htm'];
        }
        $props = $this->properties;
        return $props['htm'] ?? $props['HTM'] ?? $props['Harga'] ?? '-';
    }

    // Helper untuk mendapatkan jam operasional
    public function getJamOperasionalAttribute()
    {
        if (!empty($this->attributes['jam_operasional'])) {
            return $this->attributes['jam_operasional'];
        }
        $props = $this->properties;
        return $props['jam_operasional'] ?? $props['jam_operas'] ?? $props['Jam'] ?? $props['Jam Operasional'] ?? '-';
    }

    // Helper untuk mendapatkan desa
    public function getDesaAttribute()
    {
        if (!empty($this->attributes['desa'])) {
            return $this->attributes['desa'];
        }
        $props = $this->properties;
        return $props['desa'] ?? $props['Desa'] ?? $props['nama_desa'] ?? '-';
    }

    // Helper untuk mendapatkan URL foto yang valid
    public function getFotoUrlAttribute()
    {
        $foto = !empty($this->attributes['foto']) ? $this->attributes['foto'] : null;
        if (!$foto) {
            $props = $this->properties;
            $foto = $props['foto'] ?? $props['Foto'] ?? $props['image'] ?? null;
        }

        if (!$foto || trim($foto) === '') {
            return null;
        }

        $foto = trim($foto);
        if (str_starts_with($foto, 'http://') || str_starts_with($foto, 'https://')) {
            return $foto;
        }
        if (str_starts_with($foto, '/')) {
            return asset(ltrim($foto, '/'));
        }
        if (file_exists(public_path('images/wisata/' . $foto))) {
            return asset('images/wisata/' . $foto);
        }
        if (file_exists(public_path('images/' . $foto))) {
            return asset('images/' . $foto);
        }
        if (file_exists(storage_path('app/public/wisata/' . $foto))) {
            return asset('storage/wisata/' . $foto);
        }
        return asset('storage/wisata/' . $foto);
    }

    /**
     * Mengimpor data wisata dari file wisata.json ke tabel lokasi_wisata.
     */
    public static function importFromJson(?string $filePath = null): int
    {
        $candidatePaths = array_filter([
            $filePath,
            database_path('seeders/data/json/wisata.json'),
        ]);

        $resolvedPath = null;
        foreach ($candidatePaths as $candidate) {
            if ($candidate && file_exists($candidate)) {
                $resolvedPath = $candidate;
                break;
            }
        }

        if (!$resolvedPath) {
            throw new \RuntimeException('File wisata.json tidak ditemukan.');
        }

        $raw = file_get_contents($resolvedPath);
        $items = json_decode($raw, true);

        if (!is_array($items)) {
            throw new \RuntimeException('Format JSON pada file wisata.json tidak valid.');
        }

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

            $jamOperasional = trim((string) ($item['jam_operasional'] ?? ''));
            if ($jamOperasional !== '') {
                $jamOperasional = str_replace(["\x96", "\u{0096}", "\u{2013}", "\u{2014}", 'â€“', 'â€”', '–', '—'], ' - ', $jamOperasional);
                $jamOperasional = preg_replace('/\s+-\s+/', ' - ', $jamOperasional);
            }

            $properties = [
                'FID' => $id,
                'nama_wisat' => $nama,
                'nama_wisata' => $nama,
                'desa' => $item['desa'] ?? null,
                'jenis' => $item['jenis_wisata'] ?? $item['jenis'] ?? null,
                'jenis_wisata' => $item['jenis_wisata'] ?? $item['jenis'] ?? null,
                'jam_operasional' => $jamOperasional ?: null,
                'jam_operas' => $jamOperasional ?: null,
                'htm' => (string) ($item['htm'] ?? '0'),
                'reservasi' => $item['reservasi'] ?? null,
                'deskripsi' => $item['deskripsi'] ?? null,
                'foto' => $item['foto'] ?? null,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ];

            // Cari record yang ada berdasarkan feature_id atau nama_lokasi
            $wisata = null;
            if ($featureId !== null) {
                $wisata = static::where('feature_id', $featureId)->first();
            }
            if (!$wisata) {
                $wisata = static::where('nama_lokasi', $nama)->first();
            }
            if (!$wisata) {
                $wisata = new static();
                $wisata->feature_id = $featureId;
                $wisata->feature_key = $featureKey;
            }

            $wisata->nama_lokasi = $nama;
            $wisata->desa = $item['desa'] ?? null;
            $wisata->alamat = $item['alamat'] ?? (!empty($item['desa']) ? 'Desa ' . $item['desa'] : null);
            $wisata->jenis_wisata = $item['jenis_wisata'] ?? $item['jenis'] ?? null;
            $wisata->jam_operasional = $jamOperasional ?: null;
            $wisata->htm = isset($item['htm']) ? (string) $item['htm'] : null;
            $wisata->reservasi = $item['reservasi'] ?? null;
            $wisata->deskripsi = $item['deskripsi'] ?? null;
            $wisata->foto = $item['foto'] ?? null;
            $wisata->latitude = $latitude;
            $wisata->longitude = $longitude;
            $wisata->properties = json_encode($properties, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $wisata->save();

            $count++;
        }

        return $count;
    }
}