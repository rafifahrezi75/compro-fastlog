<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::truncate();

        $galleries = [
            ['judul' => 'Komisaris & Direksi', 'gambar' => 'galleries/komisaris.png'],
            ['judul' => '1st Anniversary', 'gambar' => 'galleries/anniv1.jpg'],
            ['judul' => '2nd Anniversary', 'gambar' => 'galleries/anniv2.png'],
            ['judul' => 'Outbond 2022', 'gambar' => 'galleries/outbond 22.png'],
        ];

        foreach ($galleries as $item) {
            $slug = Str::slug($item['judul']);
            Gallery::create([
                'judul' => $item['judul'],
                'slug' => $slug,
                'gambar' => $item['gambar'],
                'deskripsi' => 'Deskripsi untuk ' . $item['judul'],
                'status' => 'published',
            ]);
        }
    }
}
