<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveiKepuasan extends Model
{
    use HasFactory;

    protected $table = 'website_feedback';

    protected $fillable = [
        'visitor_hash',
        'rating',
        'nama',
        'pekerjaan',
        'message',
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Label representatif untuk nilai rating 1-5.
     */
    public function getRatingLabelAttribute(): string
    {
        return match ($this->rating) {
            1 => 'Sangat Kurang',
            2 => 'Kurang / Cukup',
            3 => 'Baik / Cukup Puas',
            4 => 'Puas',
            5 => 'Sangat Puas / Hebat',
            default => 'Tidak Diketahui',
        };
    }

    /**
     * Emoji representatif untuk nilai rating.
     */
    public function getRatingEmojiAttribute(): string
    {
        return match ($this->rating) {
            1 => '😞',
            2 => '😐',
            3 => '😊',
            4 => '😃',
            5 => '🤩',
            default => '⭐',
        };
    }

    /**
     * Nama tampilan responden.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->nama ?: 'Pengunjung Website (Anonim)';
    }

    /**
     * Pekerjaan / kategori responden tampilan.
     */
    public function getDisplayPekerjaanAttribute(): string
    {
        return $this->pekerjaan ?: 'Masyarakat / Umum';
    }
}

