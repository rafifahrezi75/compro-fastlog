<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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
    // dashboard pages
    // Route Halaman Utama (Index) -> resources/views/user/pages/index.blade.php
    Route::get('/', function () {
        return view('user.pages.index');
    })->name('home');

    // Route Halaman Tentang Kami -> resources/views/user/pages/about.blade.php
    Route::get('/tentang-kami', function () {
        return view('user.pages.about');
    })->name('about');

    Route::get('/gallery', function () {
        return view('user.pages.gallery'); // Mengarah ke resources/views/user/pages/gallery.blade.php
    })->name('gallery'); // Beri nama 'gallery' untuk link di navbar

    Route::get('/destinasi', function () {
        return view('user.pages.destination');
    })->name('destination');

    // 2. Route Detail Destinasi (Sesuai nama file kamu: detail-destination)
    Route::get('/destinasi/{slug}', function ($slug) {
        // Ubah slug 'surabaya' / 'united-states' menjadi 'Surabaya' / 'United States'
        $countryName = ucwords(str_replace('-', ' ', $slug));

        // Panggil file user/pages/detail-destination.blade.php
        return view('user.pages.detail-destination', compact('countryName'));
    })->name('destination.detail');

    Route::get('/berita', function () {
        return view('user.pages.berita');
    })->name('berita');

    // 2. Route Detail Berita
    Route::get('/berita/{slug}', function ($slug) {
        // Simulasi data berdasarkan slug
        if ($slug === 'handling-reefer-container-surabaya-ke-los-angeles') {
            $title = 'HANDLING REEFER COUNTAINER DARI SURABAYA KE LOS ANGELES, USA KOMODITY FROZEN YELLOWFIN TUNA GROUND MEAT';
            $date = 'Wed, 15 Nov 2023';
            $image = 'news-reefer.jpg';
        } else {
            $title = 'Penerapan NLE Picu Penurunan Biaya Logistik hingga 50 Persen';
            $date = 'Tue, 05 Jul 2022';
            $image = 'news-nle.jpg';
        }

        return view('user.pages.detail-berita', compact('title', 'date', 'image', 'slug'));
    })->name('berita.detail');

    // Route Halaman Layanan Utama (Daftar Semua Layanan)
    Route::get('/layanan', function () {
        return view('user.pages.services');
    })->name('services');

    // Route Detail Layanan (Dynamic Slug)
    Route::get('/layanan/{slug}', function ($slug) {
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
    })->name('services.detail');

    Route::get('/karir', function () {
        $dbCareers = \App\Models\Karir::where('status', 'Aktif')->latest()->get();

        $careers = $dbCareers->map(function ($karir) {
            return [
                'id' => $karir->id,
                'slug' => $karir->slug,
                'title' => $karir->nama_karir,
                'department' => $karir->departemen ?? 'Operations',
                'location' => $karir->lokasi_lengkap,
                'type' => $karir->tipe_pekerjaan ?? 'Full-Time',
                'posted_at' => $karir->time_ago,
                'description' => $karir->deskripsi,
                'requirements' => $karir->kualifikasi_array,
            ];
        });

        return view('user.pages.career', compact('careers'));
    })->name('career');

    // Halaman Detail Lowongan Kerja (Frontend Only Dummy)
    Route::get('/karir/{slug}', function ($slug) {
        // Data dummy tunggal untuk simulasi detail
        $job = [
            'title' => 'Logistics Operational Staff',
            'department' => 'Operations',
            'location' => 'Surabaya, Indonesia',
            'type' => 'Full-Time',
            'posted_at' => '2 Hari yang lalu',
            'slug' => $slug,
            'description' => 'Kami mencari Logistics Operational Staff yang dinamis untuk bergabung dengan tim operasional PT Fastlog Era Mandiri. Anda akan bertanggung jawab untuk memastikan proses distribusi dan logistik berjalan lancar dari titik asal hingga tujuan.',
            'responsibilities' => [
                'Mengkoordinasikan jadwal pengiriman barang dengan driver dan tim terkait.',
                'Melakukan pemantauan posisi armada dan pengiriman secara real-time.',
                'Menyiapkan dokumen operasional pengiriman (Surat Jalan, Manifest, dll).',
                'Menangani kendala operasional di lapangan dengan cepat dan tepat.'
            ],
            'requirements' => [
                'Pendidikan minimal D3/S1 semua jurusan (diutamakan Manajemen Logistik/Transportasi).',
                'Pengalaman kerja minimal 1-2 tahun di perusahaan logistik atau ekspedisi.',
                'Memahami alur proses distribusi darat dan kepabeanan dasar.',
                'Mahir menggunakan Microsoft Office (terutama MS Excel).',
                'Siap bekerja dalam sistem shift jika diperlukan.'
            ]
        ];

        return view('user.pages.detail-career', compact('job'));
    })->name('career.detail');

    // Route Dummy untuk Simulasi Tombol Submit Form (Hanya menampilkan flash message sukses)
    Route::post('/karir/apply', function (Request $request) {
        return back()->with('success', 'Simulasi: Lamaran Anda berhasil dikirim! (Mode Frontend Only)');
    })->name('career.apply');

    Route::get('/contact', function () {
        return view('user.pages.contact');
    })->name('contact');

    // Route Dummy untuk Simulasi Kirim Pesan Form
    Route::post('/contact/send', function (Request $request) {
        return back()->with('success', 'Pesan Anda berhasil terkirim! Tim kami akan segera menghubungi Anda.');
    })->name('contact.send');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/master', function () {
        return view('admin.pages.master.index');
    })->name('master');

    // Master Berita & Karir Admin Routes
    Route::resource('admin/berita', \App\Http\Controllers\Admin\BeritaController::class)->names('admin.berita');
    Route::resource('admin/gallery', \App\Http\Controllers\Admin\GalleryController::class)->names('admin.gallery');
    Route::resource('admin/karir', \App\Http\Controllers\Admin\KarirController::class)->names('admin.karir');

    // API Wilayah Indonesia (Provinsi, Kota/Kabupaten, Kecamatan, Pencarian)
    Route::prefix('api/wilayah')->group(function () {
        Route::get('/provinsi', [\App\Http\Controllers\Api\WilayahController::class, 'getProvinsi'])->name('api.wilayah.provinsi');
        Route::get('/kabupaten/{provinsiKode}', [\App\Http\Controllers\Api\WilayahController::class, 'getKabupatenKota'])->name('api.wilayah.kabupaten');
        Route::get('/kecamatan/{kabupatenKode}', [\App\Http\Controllers\Api\WilayahController::class, 'getKecamatan'])->name('api.wilayah.kecamatan');
        Route::get('/search', [\App\Http\Controllers\Api\WilayahController::class, 'search'])->name('api.wilayah.search');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

// // dashboard pages
// Route::get('/', function () {
//     return view('pages.dashboard.ecommerce', ['title' => 'E-commerce Dashboard']);
// })->name('dashboard');

// // calender pages
// Route::get('/calendar', function () {
//     return view('pages.calender', ['title' => 'Calendar']);
// })->name('calendar');

// // profile pages
// Route::get('/profile', function () {
//     return view('pages.profile', ['title' => 'Profile']);
// })->name('profile');

// // form pages
// Route::get('/form-elements', function () {
//     return view('pages.form.form-elements', ['title' => 'Form Elements']);
// })->name('form-elements');

// // tables pages
// Route::get('/basic-tables', function () {
//     return view('pages.tables.basic-tables', ['title' => 'Basic Tables']);
// })->name('basic-tables');

// // pages

// Route::get('/blank', function () {
//     return view('pages.blank', ['title' => 'Blank']);
// })->name('blank');

// // error pages
// Route::get('/error-404', function () {
//     return view('pages.errors.error-404', ['title' => 'Error 404']);
// })->name('error-404');

// // chart pages
// Route::get('/line-chart', function () {
//     return view('pages.chart.line-chart', ['title' => 'Line Chart']);
// })->name('line-chart');

// Route::get('/bar-chart', function () {
//     return view('pages.chart.bar-chart', ['title' => 'Bar Chart']);
// })->name('bar-chart');


// // authentication pages
// Route::get('/signin', function () {
//     return view('pages.auth.signin', ['title' => 'Sign In']);
// })->name('signin');

// Route::get('/signup', function () {
//     return view('pages.auth.signup', ['title' => 'Sign Up']);
// })->name('signup');

// // ui elements pages
// Route::get('/alerts', function () {
//     return view('pages.ui-elements.alerts', ['title' => 'Alerts']);
// })->name('alerts');

// Route::get('/avatars', function () {
//     return view('pages.ui-elements.avatars', ['title' => 'Avatars']);
// })->name('avatars');

// Route::get('/badge', function () {
//     return view('pages.ui-elements.badges', ['title' => 'Badges']);
// })->name('badges');

// Route::get('/buttons', function () {
//     return view('pages.ui-elements.buttons', ['title' => 'Buttons']);
// })->name('buttons');

// Route::get('/image', function () {
//     return view('pages.ui-elements.images', ['title' => 'Images']);
// })->name('images');

// Route::get('/videos', function () {
//     return view('pages.ui-elements.videos', ['title' => 'Videos']);
// })->name('videos');

// Route::get('/', function () {
//     if (Auth::check()) {
//         return redirect()->route('dashboard');
//     }

//     return redirect()->route('login');
// });

//TEMPLATE

// dashboard pages
// Route::get('/', function () {
//     return view('pages.dashboard.ecommerce', ['title' => 'E-commerce Dashboard']);
// })->name('dashboard');

// calender pages
Route::get('/calendar', function () {
    return view('pages.calender', ['title' => 'Calendar']);
})->name('calendar');

// profile pages
Route::get('/profile', function () {
    return view('pages.profile', ['title' => 'Profile']);
})->name('profile');

// form pages
Route::get('/form-elements', function () {
    return view('pages.form.form-elements', ['title' => 'Form Elements']);
})->name('form-elements');

// tables pages
Route::get('/basic-tables', function () {
    return view('pages.tables.basic-tables', ['title' => 'Basic Tables']);
})->name('basic-tables');

// pages

Route::get('/blank', function () {
    return view('pages.blank', ['title' => 'Blank']);
})->name('blank');

// error pages
Route::get('/error-404', function () {
    return view('pages.errors.error-404', ['title' => 'Error 404']);
})->name('error-404');

// chart pages
Route::get('/line-chart', function () {
    return view('pages.chart.line-chart', ['title' => 'Line Chart']);
})->name('line-chart');

Route::get('/bar-chart', function () {
    return view('pages.chart.bar-chart', ['title' => 'Bar Chart']);
})->name('bar-chart');


// authentication pages
Route::get('/signin', function () {
    return view('pages.auth.signin', ['title' => 'Sign In']);
})->name('signin');

Route::get('/signup', function () {
    return view('pages.auth.signup', ['title' => 'Sign Up']);
})->name('signup');

// ui elements pages
Route::get('/alerts', function () {
    return view('pages.ui-elements.alerts', ['title' => 'Alerts']);
})->name('alerts');

Route::get('/avatars', function () {
    return view('pages.ui-elements.avatars', ['title' => 'Avatars']);
})->name('avatars');

Route::get('/badge', function () {
    return view('pages.ui-elements.badges', ['title' => 'Badges']);
})->name('badges');

Route::get('/buttons', function () {
    return view('pages.ui-elements.buttons', ['title' => 'Buttons']);
})->name('buttons');

Route::get('/image', function () {
    return view('pages.ui-elements.images', ['title' => 'Images']);
})->name('images');

Route::get('/videos', function () {
    return view('pages.ui-elements.videos', ['title' => 'Videos']);
})->name('videos');
