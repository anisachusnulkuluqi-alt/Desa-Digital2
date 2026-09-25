<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bumdes extends Model
{
    use HasFactory;

    protected $table = 'bumdes';

    protected $fillable = [
        'desa_id',
        'nama_bumdes',    
        'jenis_usaha',
        'nama_ketua',
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