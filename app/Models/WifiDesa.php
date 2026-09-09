<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WifiDesa extends Model
{
    use HasFactory;

    protected $table = 'wifi_desa';

    protected $fillable = [
        'nama_lokasi',
        'desa_id',
        'alamat',
        'latitude',
        'longitude',
        'kecepatan_mbps',
        'status',
    ];

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}