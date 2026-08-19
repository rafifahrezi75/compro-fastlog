<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\KarirController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\PelamarController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\WilayahController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');

    // WEB USER
    // Route Halaman Utama (Index) -> resources/views/user/pages/index.blade.php
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Route Halaman Tentang Kami -> resources/views/user/pages/about.blade.php
    Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

    Route::get('/gallery', [GalleryController::class, 'frontendIndex'])->name('gallery');

    Route::get('/destinasi', [DestinationController::class, 'index'])->name('destination');

    // 2. Route Detail Destinasi (Sesuai nama file kamu: detail-destination)
    Route::get('/destinasi/{slug}', [DestinationController::class, 'detail'])->name('destination.detail');

    Route::get('/berita', [BeritaController::class, 'frontendIndex'])->name('berita');

    // 2. Route Detail Berita
    Route::get('/berita/{slug}', [BeritaController::class, 'frontendDetail'])->name('berita.detail');

    // Route Halaman Layanan Utama (Daftar Semua Layanan)
    Route::get('/layanan', [ServiceController::class, 'index'])->name('services');

    // Route Detail Layanan (Dynamic Slug)
    Route::get('/layanan/{slug}', [ServiceController::class, 'detail'])->name('services.detail');

    Route::get('/karir', [KarirController::class, 'frontendIndex'])->name('career');

    // Halaman Detail Lowongan Kerja
    Route::get('/karir/{slug}', [KarirController::class, 'frontendDetail'])->name('career.detail');

    // Proses Submit Lamaran Kerja
    Route::post('/karir/apply', [KarirController::class, 'apply'])->name('career.apply');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    // Route Dummy untuk Simulasi Kirim Pesan Form
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/master', function () {
        return view('admin.pages.master.index');
    })->name('master');

    // Master Berita, Karir, Pelamar, Testimoni & Marketing Admin Routes
    Route::resource('admin/berita', BeritaController::class)->names('admin.berita');
    Route::resource('admin/gallery', GalleryController::class)->names('admin.gallery');
    Route::resource('admin/karir', KarirController::class)->names('admin.karir');
    Route::get('admin/pelamar/{id}/cv', [PelamarController::class, 'downloadCv'])->name('admin.pelamar.cv');
    Route::resource('admin/pelamar', PelamarController::class)->names('admin.pelamar');
    Route::resource('admin/testimoni', TestimoniController::class)->names('admin.testimoni');
    Route::resource('admin/marketing', MarketingController::class)->names('admin.marketing');
    Route::resource('admin/infos', InfoController::class)->names('admin.infos');
    Route::resource('admin/akun', UserController::class)->names('admin.akun');

    // API Wilayah Indonesia (Provinsi, Kota/Kabupaten, Kecamatan, Pencarian)
    Route::prefix('api/wilayah')->group(function () {
        Route::get('/provinsi', [WilayahController::class, 'getProvinsi'])->name('api.wilayah.provinsi');
        Route::get('/kabupaten/{provinsiKode}', [WilayahController::class, 'getKabupatenKota'])->name('api.wilayah.kabupaten');
        Route::get('/kecamatan/{kabupatenKode}', [WilayahController::class, 'getKecamatan'])->name('api.wilayah.kecamatan');
        Route::get('/search', [WilayahController::class, 'search'])->name('api.wilayah.search');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
