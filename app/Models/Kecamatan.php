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

    // Relasi ke Desa
    public function desas()
    {
        return $this->hasMany(Desa::class, 'kecamatan_id');
    }

    public function getTotalDesaAttribute()
    {
        return $this->desas()->count();
    }
}