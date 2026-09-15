<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';

    protected $fillable = [
        'nama_desa',
        'slug',
        'kecamatan_id',
        'kode_desa',
        'kepala_desa',
        'jumlah_penduduk',
        'jumlah_kk',
        'luas_wilayah',
        'alamat',
        'telepon',
        'email',
        'kode_pos',
    ];

    protected $casts = [
        'jumlah_penduduk' => 'integer',
        'jumlah_kk' => 'integer',
        'luas_wilayah' => 'decimal:2',
    ];

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
}