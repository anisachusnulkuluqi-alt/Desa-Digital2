<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $fillable = [
        'nama_kecamatan',
        'slug',
        'kode_wilayah',
        'kabupaten',
        'deskripsi',
        'telepon',
        'email',
        'alamat',
        'jumlah_desa',
    ];

    protected $casts = [
        'jumlah_desa' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($kecamatan) {
            if (empty($kecamatan->slug)) {
                $kecamatan->slug = Str::slug($kecamatan->nama_kecamatan) . '-' . time();
            }
        });
    }

    // Relasi ke Desa
    public function desas()
    {
        return $this->hasMany(Desa::class, 'kecamatan_id');
    }

    // Accessor untuk nama kecamatan (huruf kapital)
    public function getNamaKecamatanAttribute($value)
    {
        return ucfirst($value);
    }
}