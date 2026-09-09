<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';

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
    ];

    // Desa milik satu kecamatan
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    // Satu desa punya banyak dusun
    public function dusun(): HasMany
    {
        return $this->hasMany(Dusun::class);
    }

    // Satu desa punya banyak wisata
    public function wisata(): HasMany
    {
        return $this->hasMany(WisataDesa::class);
    }

    // Satu desa punya banyak pasar
    public function pasar(): HasMany
    {
        return $this->hasMany(PasarDesa::class);
    }

    // Satu desa punya banyak WiFi
    public function wifi(): HasMany
    {
        return $this->hasMany(WifiDesa::class);
    }

    // Satu desa punya banyak BUMDes
    public function bumdes(): HasMany
    {
        return $this->hasMany(Bumdes::class);
    }

    // Satu desa punya banyak KKDMP
    public function kkdmp(): HasMany
    {
        return $this->hasMany(Kkdmp::class);
    }
}