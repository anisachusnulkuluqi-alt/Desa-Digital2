<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $fillable = [
        'nama_kecamatan',
        'kode_wilayah',
    ];

    // Satu kecamatan punya banyak desa
    public function desa(): HasMany
    {
        return $this->hasMany(Desa::class);
    }
}