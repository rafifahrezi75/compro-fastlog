<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Seed konten layanan sesuai data front end saat ini.
     */
    public function run(): void
    {
        $layanans = [
            [
                'nama'              => 'Custom Clearance',
                'slug'              => 'custom-clearance',
                // dari services.blade.php (kartu)
                'deskripsi_singkat' => 'Layanan pengurusan dokumen ekspor dan impor cepat serta tepat waktu, memastikan seluruh aturan kepabeanan terpenuhi tanpa kendala.',
                // dari ServiceController::detail() (halaman detail)
                'deskripsi_lengkap' => 'Pengurusan dokumen ekspor dan impor secara cepat, terpercaya, dan patuh terhadap regulasi kepabeanan yang berlaku.',
                // dari detail-service.blade.php
                'fitur' => [
                    'Pengurusan Dokumen PIB/PEB',
                    'Pemeriksaan Fisik & Dokumen',
                    'Konsultasi Tarif & HS Code',
                    'Izin Importir Spesialis',
                ],
                'ikon'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />',
                'gambar' => 'fastlog1.png', // dari public/images/front-end/
                'status' => 'aktif',
                'urutan' => 1,
            ],
            [
                'nama'              => 'Reefer Logistic',
                'slug'              => 'reefer-logistic',
                'deskripsi_singkat' => 'Spesialis penanganan kargo berpendingin seperti komoditas frozen food, ikan, dan buah dengan kontrol suhu yang ketat.',
                'deskripsi_lengkap' => 'Layanan pengiriman kontainer pendingin dengan kontrol suhu presisi untuk produk segar, daging, dan hasil laut.',
                'fitur' => [
                    'Monitoring Suhu Real-time',
                    'Genset & Support Plug-in',
                    'Gudang Cold Storage',
                    'Standar Kebersihan Internasional',
                ],
                'ikon'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM19 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5h1.5m0 0V7a1 1 0 011-1h9.5a1 1 0 011 1v2m-11.5 7.5h8m0 0V9m0 7.5h3m2.5 0H17m2.5 0V11a1 1 0 00-1-1h-3" />',
                'gambar' => 'fastlog2.jpg',
                'status' => 'aktif',
                'urutan' => 2,
            ],
            [
                'nama'              => 'Freight Forwarding',
                'slug'              => 'freight-forwarding',
                'deskripsi_singkat' => 'Pengiriman barang internasional via Laut (Sea Freight) dan Udara (Air Freight) dengan opsi FCL maupun LCL secara efisien.',
                'deskripsi_lengkap' => 'Solusi pengiriman kargo antar negara melalui jalur laut (Ocean Freight) dan udara (Air Freight) dengan jaringan global.',
                'fitur' => [
                    'FCL (Full Container Load)',
                    'LCL (Less Container Load)',
                    'Air Freight Express',
                    'Asuransi & Pelacakan Kargo',
                ],
                'ikon'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 15.75l1.5-4.5h16.5l1.5 4.5m-19.5 0v3a1.5 1.5 0 001.5 1.5h16.5a1.5 1.5 0 001.5-1.5v-3m-19.5 0h19.5M6 11.25V6a1.5 1.5 0 011.5-1.5h9A1.5 1.5 0 0118 6v5.25" />',
                'gambar' => 'fastlog3.png',
                'status' => 'aktif',
                'urutan' => 3,
            ],
            [
                'nama'              => 'Inland Transport',
                'slug'              => 'inland-transport',
                'deskripsi_singkat' => 'Pengangkutan darat door-to-door menggunakan berbagai jenis armada truk pendukung pengiriman kargo Anda ke seluruh pelosok tanah air.',
                'deskripsi_lengkap' => 'Armada transportasi darat lengkap (Truk Trailer, Tronton, Box) untuk pengiriman kargo domestik yang aman dan tepat waktu.',
                'fitur' => [
                    'Pengiriman Door-to-Door',
                    'Armada Truk Beragam',
                    'Tracking GPS 24/7',
                    'Pengemudi Berpengalaman',
                ],
                'ikon'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />',
                'gambar' => 'fastlog1.png',
                'status' => 'aktif',
                'urutan' => 4,
            ],
        ];

        foreach ($layanans as $layanan) {
            Layanan::updateOrCreate(
                ['slug' => $layanan['slug']],
                $layanan
            );
        }
    }
}
