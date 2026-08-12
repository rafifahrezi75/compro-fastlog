<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('user.pages.services');
    }

    public function detail($slug)
    {
        // Data simulasi layanan
        $services = [
            'custom-clearance' => [
                'title' => 'Custom Clearance',
                'desc' => 'Pengurusan dokumen ekspor dan impor secara cepat, terpercaya, dan patuh terhadap regulasi kepabeanan yang berlaku.',
                'image' => 'custom-clearance.jpg',
                'features' => ['Pengurusan Dokumen PIB/PEB', 'Pemeriksaan Fisik & Dokumen', 'Konsultasi Tarif & HS Code', 'Izin Importir Spesialis']
            ],
            'reefer-logistic' => [
                'title' => 'Reefer Logistic',
                'desc' => 'Layanan pengiriman kontainer pendingin dengan kontrol suhu presisi untuk produk segar, daging, dan hasil laut.',
                'image' => 'reefer-logistic.jpg',
                'features' => ['Monitoring Suhu Real-time', 'Genset & Support Plug-in', 'Gudang Cold Storage', 'Standar Kebersihan Internasional']
            ],
            'freight-forwarding' => [
                'title' => 'Freight Forwarding',
                'desc' => 'Solusi pengiriman kargo antar negara melalui jalur laut (Ocean Freight) dan udara (Air Freight) dengan jaringan global.',
                'image' => 'freight-forwarding.jpg',
                'features' => ['FCL (Full Container Load)', 'LCL (Less Container Load)', 'Air Freight Express', 'Asuransi & Pelacakan Kargo']
            ],
            'inland-transport' => [
                'title' => 'Inland Transport',
                'desc' => 'Armada transportasi darat lengkap (Truk Trailer, Tronton, Box) untuk pengiriman kargo domestik yang aman dan tepat waktu.',
                'image' => 'inland-transport.jpg',
                'features' => ['Pengiriman Door-to-Door', 'Armada Truk Beragam', 'Tracking GPS 24/7', 'Pengemudi Berpengalaman']
            ],
        ];

        // Jika slug tidak ditemukan, tampilkan 404
        if (!array_key_exists($slug, $services)) {
            abort(404);
        }

        $service = $services[$slug];

        return view('user.pages.detail-service', compact('service', 'slug'));
    }
}
