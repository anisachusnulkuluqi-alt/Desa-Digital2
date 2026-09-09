<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bumdes extends Model
{
    use HasFactory;

    protected $table = 'bumdes';

    protected $fillable = [
        'nama_bumdes',
        'desa_id',
        'jenis_usaha',
        'alamat',
        'telepon',
        'tahun_berdiri',
        'status',
    ];

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}