<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tempat extends Model
{
    use HasFactory;

    protected $table = 'tempat';

    protected $fillable = [
        'nama', 'kategori', 'desa', 'alamat', 'latitude', 'longitude',
        'foto', 'deskripsi', 'info_tambahan',
    ];

    public function getInfoTambahanAttribute($value)
    {
        return is_string($value) ? json_decode($value, true) ?? [] : ($value ?? []);
    }

    public function getKategoriLabelAttribute()
    {
        return ucfirst($this->kategori);
    }

    public function getKategoriColorAttribute()
    {
        $colors = [
            'wisata' => '#dbeafe', 'kuliner' => '#fef3c7', 'hotel' => '#fce7f3',
            'umkm' => '#dcfce7', 'ibadah' => '#e0e7ff', 'pendidikan' => '#ffedd5',
            'kesehatan' => '#fee2e2', 'olahraga' => '#d1fae5', 'lainnya' => '#f1f5f9',
        ];
        if (isset($colors[strtolower($this->kategori)])) return $colors[strtolower($this->kategori)];
        
        $hash = crc32(strtolower($this->kategori));
        return "hsl(" . ($hash % 360) . ", 70%, 90%)";
    }

    public function getKategoriTextColorAttribute()
    {
        $colors = [
            'wisata' => '#1e40af', 'kuliner' => '#92400e', 'hotel' => '#9d174d',
            'umkm' => '#166534', 'ibadah' => '#3730a3', 'pendidikan' => '#9a3412',
            'kesehatan' => '#991b1b', 'olahraga' => '#065f46', 'lainnya' => '#475569',
        ];
        if (isset($colors[strtolower($this->kategori)])) return $colors[strtolower($this->kategori)];
        
        $hash = crc32(strtolower($this->kategori));
        return "hsl(" . ($hash % 360) . ", 70%, 30%)";
    }

    public static function getExistingKategori()
    {
        return self::select('kategori')->distinct()->pluck('kategori')->filter()->values()->toArray();
    }
}