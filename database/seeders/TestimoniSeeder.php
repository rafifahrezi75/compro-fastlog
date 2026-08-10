<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Testimoni::truncate();

        $testimonis = [
            [
                'nama' => 'Budi Santoso',
                'perusahaan' => 'PT Maju Jaya Abadi',
                'testimoni' => 'Layanan Fastlog sangat memuaskan, pengiriman kargo laut kami dari Surabaya ke Jakarta sampai tepat waktu tanpa kendala.',
                'foto' => 'testimonis/testimoni1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Aminah',
                'perusahaan' => 'CV Makmur Sentosa',
                'testimoni' => 'Sangat merekomendasikan Fastlog untuk urusan custom clearance. Timnya profesional dan responsif terhadap pertanyaan kami.',
                'foto' => 'testimonis/testimoni2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'John Doe',
                'perusahaan' => 'Global Export Import Inc.',
                'testimoni' => 'The inland transport service provided by Fastlog is top-notch. Our goods were delivered safely and efficiently.',
                'foto' => 'testimonis/testimoni3.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \App\Models\Testimoni::insert($testimonis);
    }
}
