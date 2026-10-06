<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriField extends Model
{
    protected $fillable = ['kategori_id', 'nama_field', 'tipe_field', 'urutan'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}