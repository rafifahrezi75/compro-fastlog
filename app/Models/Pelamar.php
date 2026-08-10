<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    protected $table = 'pelamars';

    protected $fillable = [
        'karir_id',
        'posisi',
        'nama',
        'email',
        'telepon',
        'file_cv',
        'pesan',
        'status',
        'catatan_admin',
    ];

    protected $appends = ['formatted_date', 'cv_url'];

    /**
     * Relationship to Karir (Job Position)
     */
    public function karir()
    {
        return $this->belongsTo(Karir::class, 'karir_id');
    }

    /**
     * Formatted created at date
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at ? $this->created_at->translatedFormat('d F Y, H:i') : '-';
    }

    /**
     * Public URL for CV File
     */
    public function getCvUrlAttribute(): string
    {
        if (empty($this->file_cv)) {
            return '';
        }

        if (str_starts_with($this->file_cv, 'http')) {
            return $this->file_cv;
        }

        if (str_starts_with($this->file_cv, 'uploads/')) {
            return asset($this->file_cv);
        }

        return asset('storage/' . $this->file_cv);
    }
}
