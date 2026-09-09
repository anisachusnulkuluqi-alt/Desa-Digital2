<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dusun extends Model
{
    use HasFactory;

    protected $table = 'dusun';

    protected $fillable = [
        'nama_dusun',
        'desa_id',
        'jumlah_rt',
        'jumlah_penduduk',
    ];

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}