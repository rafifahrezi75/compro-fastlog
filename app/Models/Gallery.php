<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallerys';

    protected $fillable = [
        'judul',
        'slug',
        'gambar',
        'deskripsi',
        'status',
    ];

    protected $appends = ['gambar_url', 'formatted_date', 'excerpt'];

    /**
     * Boot function for model events.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    /**
     * Accessor for full image URL.
     */
    public function getGambarUrlAttribute(): string
    {
        if (empty($this->gambar)) {
            return asset('images/blog/blog-01.jpg');
        }

        if (Str::startsWith($this->gambar, ['http://', 'https://'])) {
            return $this->gambar;
        }

        if (file_exists(public_path($this->gambar))) {
            return asset($this->gambar);
        }

        if (file_exists(public_path('uploads/gallery/' . basename($this->gambar)))) {
            return asset('uploads/gallery/' . basename($this->gambar));
        }

        return asset($this->gambar);
    }

    /**
     * Accessor for formatted publication date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at ? $this->created_at->translatedFormat('d M Y, H:i') : '-';
    }

    /**
     * Accessor for short text excerpt stripped of HTML tags.
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->deskripsi ?? ''), 120);
    }
}
