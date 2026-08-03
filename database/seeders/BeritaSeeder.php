<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyBeritas = [
            [
                'judul' => 'Ekspansi Rute Logistik Maritim Indonesia Timur Terbaru 2026',
                'sumber' => 'Humas Fastlog Indonesia',
                'gambar' => 'images/cards/card-01.jpg',
                'isi' => '<p>Fastlog Indonesia secara resmi mengumumkan pembukaan <strong>jalur kargo maritim ekspres</strong> yang menghubungkan Pelabuhan Tanjung Perak Surabaya langsung ke Makassar, Sorong, dan Jayapura.</p><p>Langkah strategis ini diambil untuk memangkas waktu tunggu pengiriman logistik hingga 35% dan menurunkan disparitas harga komoditas pangan serta suku cadang industri manufaktur di wilayah timur Nusantara.</p>',
                'status' => 'published',
            ],
            [
                'judul' => 'Penerapan Teknologi Cold Chain Real-Time Monitoring untuk Kargo Farmasi',
                'sumber' => 'Logistik Today Media',
                'gambar' => 'images/cards/card-02.jpg',
                'isi' => '<p>Dalam upaya memperkuat standar keamanan pengiriman obat-obatan dan vaksin sensitif, Fastlog meluncurkan <em>Reefer Smart Fleet</em> berbasis IoT sensor suhu akurasi tinggi.</p><blockquote>"Transparansi temperatur sepanjang perjalanan kini dapat dipantau langsung oleh mitra klien melalui portal digital," ungkap Direktur Operasional Fastlog.</blockquote>',
                'status' => 'published',
            ],
            [
                'judul' => 'Digitalisasi Dokumen Kepabeanan Custom Clearance Kurangi Dwelling Time',
                'sumber' => 'Warta Bea Cukai & Ekspor Impor',
                'gambar' => 'images/cards/card-03.jpg',
                'isi' => '<p>Sinergi integrasi data elektronik PIB (Pemberitahuan Impor Barang) dan PEB (Pemberitahuan Ekspor Barang) menghasilkan percepatan verifikasi jalur hijau kepabeanan di pelabuhan utama.</p><p>Dengan proses otomatisasi ini, waktu clearance kargo kontainer dapat diselesaikan dalam waktu kurang dari 24 jam kerja.</p>',
                'status' => 'published',
            ],
            [
                'judul' => 'Rencana Penambahan 50 Unit Truk Trailer Euro 5 Ramah Lingkungan',
                'sumber' => 'Internal Corporate Fastlog',
                'gambar' => null,
                'isi' => '<p>Sebagai komitmen terhadap inisiatif <em>Green Logistics</em>, Fastlog bersiap mendatangkan 50 unit armada angkutan darat berspesifikasi standar emisi Euro 5 pada kuartal ketiga tahun ini.</p>',
                'status' => 'draft',
            ],
            [
                'judul' => 'Peningkatan Kapasitas Gudang Berikat Tanjung Priok Mencapai 25.000 Meter Persegi',
                'sumber' => 'Bisnis Logistik Daily',
                'gambar' => 'images/cards/card-01.jpg',
                'isi' => '<p>Fastlog meresmikan penambahan kapasitas gudang berikat modern di zona logistik Tanjung Priok Jakarta Utara guna memenuhi lonjakan volume kargo ekspor-impor.</p>',
                'status' => 'published',
            ],
            [
                'judul' => 'Kerjasama Strategis Maskapai Kargo Internasional Rute Surabaya - Singapura',
                'sumber' => 'Aviation Cargo News',
                'gambar' => 'images/cards/card-02.jpg',
                'isi' => '<p>Layanan Air Freight Fastlog kini memiliki slot penerbangan khusus harian dari Bandara Internasional Juanda menuju Changi Airport Singapore untuk pengiriman komoditas perishable dan e-commerce.</p>',
                'status' => 'published',
            ],
            [
                'judul' => 'Solusi Pengiriman Alat Berat Proyek Pembangkit Listrik Tenaga Surya Kalimantan',
                'sumber' => 'Humas Fastlog Indonesia',
                'gambar' => 'images/cards/card-03.jpg',
                'isi' => '<p>Tim Project Cargo Fastlog berhasil merampungkan mobilisasi 120 unit trafo dan panel surya raksasa menuju pedalaman Kalimantan Timur dengan selamat dan tepat waktu.</p>',
                'status' => 'published',
            ],
            [
                'judul' => 'Pelatihan Sertifikasi Keamanan Pengangkutan Dangerous Goods (DG) IMO & IATA',
                'sumber' => 'Internal Corporate Fastlog',
                'gambar' => null,
                'isi' => '<p>Sebanyak 40 personil staf operasional Fastlog telah resmi mengantongi sertifikat penanganan kargo berbahaya klasifikasi IMO Cat 3 dan 8.</p>',
                'status' => 'published',
            ],
            [
                'judul' => 'Tips Optimalisasi Biaya Kontainer FCL dan LCL untuk Pelaku UMKM Ekspor',
                'sumber' => 'Logistik Today Media',
                'gambar' => 'images/cards/card-01.jpg',
                'isi' => '<p>Panduan lengkap bagi para eksportir pemula dalam memilih metode konsolidasi LCL versus sewa kontainer penuh FCL agar profit margin tetap optimal.</p>',
                'status' => 'published',
            ],
            [
                'judul' => 'Inovasi Smart Tracking Kargo Berbasis GPS Satelit Bebas Blank Spot',
                'sumber' => 'Tech & Logistics Update',
                'gambar' => 'images/cards/card-02.jpg',
                'isi' => '<p>Pemasangan modul GPS satelit hibrida pada seluruh armada kontainer laut dan truk long-haul memastikan visibilitas posisi kargo secara presisi di seluruh kepulauan Indonesia.</p>',
                'status' => 'published',
            ],
            [
                'judul' => 'Evaluasi Kinerja Pengiriman Logistik Musim Puncak Ramadhan dan Lebaran 2026',
                'sumber' => 'Internal Corporate Fastlog',
                'gambar' => null,
                'isi' => '<p>Tingkat On-Time Delivery (OTD) Fastlog tercatat mencapai 98.4% selama periode high season distribusi pangan dan barang retail nasional.</p>',
                'status' => 'draft',
            ],
            [
                'judul' => 'Fastlog Raih Penghargaan Best Logistics Service Provider Indonesia 2026',
                'sumber' => 'Warta Ekonomi Nasional',
                'gambar' => 'images/cards/card-03.jpg',
                'isi' => '<p>Apresiasi bergengsi ini diraih berkat dedikasi Fastlog dalam menghadirkan rantai pasok terintegrasi, transparan, dan berdaya saing global.</p>',
                'status' => 'published',
            ],
        ];

        foreach ($dummyBeritas as $item) {
            Berita::updateOrCreate(
                ['slug' => Str::slug($item['judul'])],
                [
                    'judul' => $item['judul'],
                    'slug' => Str::slug($item['judul']),
                    'gambar' => $item['gambar'],
                    'isi' => $item['isi'],
                    'sumber' => $item['sumber'],
                    'status' => $item['status'],
                ]
            );
        }
    }
}
