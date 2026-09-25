<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasarDesa extends Model
{
    use HasFactory;

    // ✅ WAJIB: Tentukan nama tabel secara eksplisit
    protected $table = 'pasar_desa';

    // ✅ WAJIB: Semua kolom yang bisa diisi massal
    protected $fillable = [
        'nama_pasar',
        'alamat',
        'desa_id',
        'latitude',
        'longitude',
        'foto',
        'status',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
}