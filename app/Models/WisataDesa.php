<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WisataDesa extends Model
{
    use HasFactory;

    protected $table = 'wisata_desa';

    protected $fillable = [
        'nama_wisata',
        'desa_id',
        'kategori',
        'deskripsi',
        'harga_tiket',
        'latitude',
        'longitude',
        'foto_url',
        'status',
    ];

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}