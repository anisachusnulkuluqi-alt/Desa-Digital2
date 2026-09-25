<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KantorDesa extends Model
{
    use HasFactory;

    protected $table = 'kantor_desa';

    protected $fillable = [
        'nama_kantor',
        'alamat',
        'link_maps',
        'latitude',
        'longitude',
        'desa_id',
        'foto',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
}