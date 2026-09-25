<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $fillable = [
        'nama_kecamatan',
    ];

    /**
     * Relasi ke tabel desa (hasMany)
     */
    public function desa()
    {
        return $this->hasMany(Desa::class, 'kecamatan_id');
    }
}