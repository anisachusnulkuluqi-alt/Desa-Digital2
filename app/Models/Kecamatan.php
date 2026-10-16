<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $fillable = [
        'nama_kecamatan',
        'kode_kecamatan',
    ];

    /**
     * Accessor agar pemanggilan kode_wilayah otomatis merujuk ke kode_kecamatan
     */
    public function getKodeWilayahAttribute()
    {
        return $this->kode_kecamatan;
    }

    /**
     * Relasi ke tabel desa (hasMany)
     */
    public function desa()
    {
        return $this->hasMany(Desa::class, 'kecamatan_id');
    }
}