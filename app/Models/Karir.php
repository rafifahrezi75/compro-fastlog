<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Karir extends Model
{
    use HasFactory;

    protected $table = 'karirs';

    protected $fillable = [
        'nama_karir',
        'slug',
        'kota',
        'provinsi',
        'negara',
        'alamat_detail',
        'tipe_pekerjaan',
        'departemen',
        'deskripsi',
        'kualifikasi',
        'status',
    ];

    protected $appends = ['lokasi_lengkap', 'formatted_date', 'time_ago', 'kualifikasi_array'];

    /**
     * Boot function for model events.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama_karir);
            }
            if (empty($model->negara)) {
                $model->negara = 'Indonesia';
            }
        });
    }

    /**
     * Get complete location string (e.g. Surabaya, Jawa Timur, Indonesia).
     */
    public function getLokasiLengkapAttribute(): string
    {
        $parts = array_filter([$this->kota, $this->provinsi, $this->negara]);
        return implode(', ', $parts);
    }

    /**
     * Get formatted created date in Indonesian locale format.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at ? $this->created_at->translatedFormat('d F Y') : '-';
    }

    /**
     * Get human readable diff for time ago.
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->created_at ? $this->created_at->diffForHumans() : '-';
    }

    /**
     * Get qualifications as clean array of strings.
     */
    public function getKualifikasiArrayAttribute(): array
    {
        if (empty($this->kualifikasi)) {
            return [];
        }

        // If stored as JSON array
        $trimmed = trim($this->kualifikasi);
        if (str_starts_with($trimmed, '[') && str_ends_with($trimmed, ']')) {
            $decoded = json_decode($trimmed, true);
            if (is_array($decoded)) {
                return array_values(array_filter(array_map('trim', $decoded)));
            }
        }

        // Split by newlines or bullets
        $lines = preg_split('/\r\n|\r|\n/', $this->kualifikasi);
        $cleaned = array_map(function ($line) {
            return trim(preg_replace('/^[\s\-\*\•\d\.\)]+/', '', $line));
        }, $lines);

        return array_values(array_filter($cleaned));
    }
}
