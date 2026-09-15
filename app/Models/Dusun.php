<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    use HasFactory;

    // PENTING: Nama tabel sesuai database
    protected $table = 'dusun';

    protected $fillable = [
        'nama_dusun',
        'desa_id',
        'kepala_dusun',
        'jumlah_rt',
        'jumlah_rw',
        'jumlah_kk',
        'jumlah_penduduk',
        'alamat',
    ];

    protected $casts = [
        'jumlah_rt' => 'integer',
        'jumlah_rw' => 'integer',
        'jumlah_kk' => 'integer',
        'jumlah_penduduk' => 'integer',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
}