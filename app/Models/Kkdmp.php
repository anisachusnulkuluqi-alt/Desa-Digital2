<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kkdmp extends Model
{
    use HasFactory;

    protected $table = 'kkdmp';

    protected $fillable = [
        'judul_dokumen',
        'desa_id',
        'tahun',
        'deskripsi',
        'file_url',
        'status',
    ];

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }
}