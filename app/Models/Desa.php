<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';

    protected $fillable = [
        'nama_desa',
        'kecamatan_id',
        'kode_desa',
        'jenis',
        'website',
        'youtube',
        'instagram',
        'facebook',
        'tiktok',
        'whatsapp',
        'deskripsi',
    ];

    public $timestamps = true;

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}