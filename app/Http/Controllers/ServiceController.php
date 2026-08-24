<?php

namespace App\Http\Controllers;

use App\Models\Layanan;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Layanan::where('status', 'aktif')
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view('user.pages.services', compact('services'));
    }

    public function detail($slug)
    {
        $service = Layanan::where('slug', $slug)
            ->where('status', 'aktif')
            ->first();

        // Jika slug tidak ditemukan, tampilkan 404
        if (! $service) {
            abort(404);
        }

        $otherServices = Layanan::where('status', 'aktif')
            ->where('slug', '!=', $slug)
            ->orderBy('urutan')
            ->orderBy('id')
            ->get();

        return view('user.pages.detail-service', compact('service', 'otherServices', 'slug'));
    }
}
