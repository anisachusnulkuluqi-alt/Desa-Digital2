<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kkdmp extends Model
{
    use HasFactory;

    protected $table = 'kkdmp';

    protected $fillable = [
        'desa_id',
        'nama_desa',
        'jenis',
        'nama_ketua',
        'no_ahu',
        'alamat',
        'latitude',
        'longitude',
        'foto',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
}