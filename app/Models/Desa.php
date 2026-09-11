<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa'; // Nama tabel

    protected $fillable = [
        'nama_desa',
        'kecamatan_id',
        'kode_desa',
        'luas_wilayah',
        'jumlah_penduduk',
        'jumlah_kk',
        'sejarah',
        'visi',
        'misi',
        'alamat_kantor',
        'telepon',
        'email',
        'latitude',
        'longitude',
        'foto_url',
        'status',
    ];

    protected $casts = [
        'luas_wilayah' => 'decimal:2',
        'jumlah_penduduk' => 'integer',
        'jumlah_kk' => 'integer',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($desa) {
            if (empty($desa->slug)) {
                $desa->slug = Str::slug($desa->nama_desa) . '-' . time();
            }
        });
    }

    // Relasi ke Kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    // Relasi ke Layanan
    public function layanans()
    {
        return $this->hasMany(Layanan::class);
    }

    // Relasi ke Berita
    public function beritas()
    {
        return $this->hasMany(Berita::class);
    }

    // Accessor untuk nama kecamatan
    public function getNamaKecamatanAttribute()
    {
        return $this->kecamatan ? $this->kecamatan->nama_kecamatan : '-';
    }
}