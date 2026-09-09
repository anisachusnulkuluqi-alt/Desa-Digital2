<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasarDesa extends Model
{
    use HasFactory;

    protected $table = 'pasar_desa';

    protected $fillable = [
        'nama_pasar',
        'desa_id',
        'alamat',
        'hari_operasional',
        'komoditas_utama',
        'jumlah_pedagang',
    ];

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}