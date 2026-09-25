<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa'; // ✅ Nama tabel di database

    protected $fillable = [
        'kecamatan_id',
        'nama_desa',
        'kode_desa',
        'jenis',
        'website',
        'youtube',
        'instagram',
        'facebook',
        'tiktok',
        'whatsapp',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}