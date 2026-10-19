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
        'device',
        'browser',
        'user_agent',
        'message',
        'feedback_removed_at',
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'feedback_removed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (SurveiKepuasan $survei): void {
            if (empty($survei->device) && function_exists('request') && request()) {
                $ua = request()->userAgent();
                $detected = static::detectDevice($ua);
                $survei->device = $detected['device'];
                $survei->browser = $detected['browser'];
                if (empty($survei->user_agent) && $ua) {
                    $survei->user_agent = substr($ua, 0, 500);
                }
            }
        });
    }

    /**
     * Deteksi jenis perangkat dan browser berdasarkan User Agent string.
     */
    public static function detectDevice(?string $userAgent): array
    {
        $ua = (string) $userAgent;

        if (empty(trim($ua))) {
            return [
                'device' => 'Perangkat Web',
                'device_type' => 'desktop',
                'browser' => 'Browser Web',
                'icon' => 'bi-laptop',
            ];
        }

        // 1. Device & OS Detection
        $device = 'Perangkat Web';
        $deviceType = 'desktop';
        $icon = 'bi-laptop';

        if (preg_match('/ipad/i', $ua)) {
            $device = 'iPad (Tablet)';
            $deviceType = 'tablet';
            $icon = 'bi-tablet';
        } elseif (preg_match('/iphone/i', $ua)) {
            $device = 'iPhone (iOS)';
            $deviceType = 'mobile';
            $icon = 'bi-phone';
        } elseif (preg_match('/android/i', $ua)) {
            if (preg_match('/mobile/i', $ua)) {
                $device = 'Android Smartphone';
                $deviceType = 'mobile';
                $icon = 'bi-phone';
            } else {
                $device = 'Android Tablet';
                $deviceType = 'tablet';
                $icon = 'bi-tablet';
            }
        } elseif (preg_match('/windows phone/i', $ua)) {
            $device = 'Windows Phone';
            $deviceType = 'mobile';
            $icon = 'bi-phone';
        } elseif (preg_match('/windows nt|windows/i', $ua)) {
            $device = 'Windows PC';
            $deviceType = 'desktop';
            $icon = 'bi-laptop';
        } elseif (preg_match('/macintosh|mac os x/i', $ua)) {
            $device = 'Mac / macOS';
            $deviceType = 'desktop';
            $icon = 'bi-laptop';
        } elseif (preg_match('/linux/i', $ua)) {
            $device = 'Linux PC';
            $deviceType = 'desktop';
            $icon = 'bi-pc-display';
        } elseif (preg_match('/mobile|tablet|touch/i', $ua)) {
            $device = 'Perangkat Mobile';
            $deviceType = 'mobile';
            $icon = 'bi-phone';
        }

        // 2. Browser Detection
        $browser = 'Browser Web';
        if (preg_match('/edg\/|edge\//i', $ua)) {
            $browser = 'Microsoft Edge';
        } elseif (preg_match('/samsungbrowser/i', $ua)) {
            $browser = 'Samsung Internet';
        } elseif (preg_match('/opr\/|opera\//i', $ua)) {
            $browser = 'Opera';
        } elseif (preg_match('/chrome\/|crios\//i', $ua)) {
            $browser = 'Google Chrome';
        } elseif (preg_match('/firefox\/|fxios\//i', $ua)) {
            $browser = 'Mozilla Firefox';
        } elseif (preg_match('/safari\//i', $ua)) {
            $browser = 'Apple Safari';
        }

        return [
            'device' => $device,
            'device_type' => $deviceType,
            'browser' => $browser,
            'icon' => $icon,
        ];
    }

    /**
     * Label perangkat yang terdeteksi.
     */
    public function getDeviceLabelAttribute(): string
    {
        if (!empty($this->device)) {
            return $this->device;
        }

        if (!empty($this->user_agent)) {
            return static::detectDevice($this->user_agent)['device'];
        }

        return 'Windows PC';
    }

    /**
     * Label browser yang terdeteksi.
     */
    public function getBrowserLabelAttribute(): string
    {
        if (!empty($this->browser)) {
            return $this->browser;
        }

        if (!empty($this->user_agent)) {
            return static::detectDevice($this->user_agent)['browser'];
        }

        return 'Google Chrome';
    }

    /**
     * Icon bootstrap untuk perangkat.
     */
    public function getDeviceIconAttribute(): string
    {
        $label = strtolower($this->device_label);
        if (str_contains($label, 'phone') || str_contains($label, 'android') || str_contains($label, 'iphone') || str_contains($label, 'mobile')) {
            return 'bi-phone';
        }
        if (str_contains($label, 'tablet') || str_contains($label, 'ipad')) {
            return 'bi-tablet';
        }
        if (str_contains($label, 'linux')) {
            return 'bi-pc-display';
        }
        return 'bi-laptop';
    }

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
