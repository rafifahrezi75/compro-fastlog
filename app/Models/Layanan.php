<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $guarded = [];

    protected $appends = ['gambar_url'];

    protected $casts = [
        'fitur' => 'array',
    ];

    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && file_exists(public_path('storage/' . $this->gambar))) {
            return asset('storage/' . $this->gambar);
        }

        if ($this->gambar && file_exists(public_path('images/front-end/' . $this->gambar))) {
            return asset('images/front-end/' . $this->gambar);
        }

        return asset('images/front-end/fastlog1.png');
    }
}
