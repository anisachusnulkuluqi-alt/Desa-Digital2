<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama'];

    public function fields()
    {
        return $this->hasMany(KategoriField::class)->orderBy('urutan', 'asc');
    }

    public function tempats()
    {
        return $this->hasMany(Tempat::class, 'kategori', 'nama');
    }
}