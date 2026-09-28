<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'lokasi_wisata';

    protected $fillable = [
        'feature_id',
        'feature_key',
        'nama_lokasi',
        'latitude',
        'longitude',
        'properties',
    ];

    // Helper untuk parse JSON properties
    public function getPropertiesAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    // Helper untuk mendapatkan jenis wisata dari properties
    public function getJenisAttribute()
    {
        $props = $this->properties;
        return $props['jenis'] ?? $props['Jenis'] ?? '-';
    }

    // Helper untuk mendapatkan HTM dari properties
    public function getHtmAttribute()
    {
        $props = $this->properties;
        return $props['htm'] ?? $props['HTM'] ?? $props['Harga'] ?? '-';
    }

    // Helper untuk mendapatkan jam operasional dari properties
    public function getJamOperasionalAttribute()
    {
        $props = $this->properties;
        return $props['jam_operasional'] ?? $props['Jam'] ?? $props['Jam Operasional'] ?? '-';
    }
}