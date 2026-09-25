<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisata_desa';

    protected $fillable = [
        'nama_wisata',
        'desa_id',
        'jenis',
        'jam_operasional',
        'htm',
        'reservasi',
        'deskripsi',
        'latitude',
        'longitude',
        'foto',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
}