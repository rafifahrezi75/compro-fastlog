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
        $beritas = \App\Models\Berita::where('status', 'published')->latest()->take(2)->get();
        $galleries = \App\Models\Gallery::latest()->get();
        $testimonis = \App\Models\Testimoni::where('status', 'published')->latest()->get();
        $marketings = \App\Models\Marketing::where('status', 'online')->latest()->get();

        return view('user.pages.index', compact('beritas', 'galleries', 'testimonis', 'marketings'));
    })->name('home');

    // Route Halaman Tentang Kami -> resources/views/user/pages/about.blade.php
    Route::get('/tentang-kami', function () {
        return view('user.pages.about');
    })->name('about');

    Route::get('/gallery', function () {
        $galleries = \App\Models\Gallery::latest()->get();
        return view('user.pages.gallery', compact('galleries')); 
    })->name('gallery'); 

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
        $beritas = \App\Models\Berita::where('status', 'published')->latest()->get();
        return view('user.pages.berita', compact('beritas'));
    })->name('berita');

    // 2. Route Detail Berita
    Route::get('/berita/{slug}', function ($slug) {
        $berita = \App\Models\Berita::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $latest_beritas = \App\Models\Berita::where('id', '!=', $berita->id)->where('status', 'published')->latest()->take(3)->get();
        
        return view('user.pages.detail-berita', compact('berita', 'latest_beritas'));
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
        $careers = \App\Models\Karir::where('status', 'Aktif')->latest()->get();

        return view('user.pages.career', compact('careers'));
    })->name('career');

    // Halaman Detail Lowongan Kerja
    Route::get('/karir/{slug}', function ($slug) {
        $job = \App\Models\Karir::where('slug', $slug)->where('status', 'Aktif')->firstOrFail();

        return view('user.pages.detail-career', compact('job'));
    })->name('career.detail');

    // Proses Submit Lamaran Kerja
    Route::post('/karir/apply', function (\Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'karir_id' => 'nullable|exists:karirs,id',
            'job_title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'cv' => 'required|file|mimes:pdf|max:5120', // Max 5MB
            'message' => 'nullable|string|max:2000',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor WhatsApp / telepon wajib diisi.',
            'cv.required' => 'Berkas CV / Resume (PDF) wajib diunggah.',
            'cv.mimes' => 'Berkas CV harus dalam format PDF.',
            'cv.max' => 'Ukuran berkas CV maksimal 5MB.',
        ]);

        $cvPath = $request->file('cv')->store('pelamars', 'public');

        \App\Models\Pelamar::create([
            'karir_id' => $validated['karir_id'] ?? null,
            'posisi' => $validated['job_title'],
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'telepon' => $validated['phone'],
            'file_cv' => $cvPath,
            'pesan' => $validated['message'] ?? null,
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Lamaran Anda untuk posisi ' . $validated['job_title'] . ' berhasil dikirim! Tim HRD kami akan segera meninjau berkas Anda.');
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

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/master', function () {
        return view('admin.pages.master.index');
    })->name('master');

    // Master Berita, Karir, Pelamar, Testimoni & Marketing Admin Routes
    Route::resource('admin/berita', \App\Http\Controllers\Admin\BeritaController::class)->names('admin.berita');
    Route::resource('admin/gallery', \App\Http\Controllers\Admin\GalleryController::class)->names('admin.gallery');
    Route::resource('admin/karir', \App\Http\Controllers\Admin\KarirController::class)->names('admin.karir');
    Route::get('admin/pelamar/{id}/cv', [\App\Http\Controllers\Admin\PelamarController::class, 'downloadCv'])->name('admin.pelamar.cv');
    Route::resource('admin/pelamar', \App\Http\Controllers\Admin\PelamarController::class)->names('admin.pelamar');
    Route::resource('admin/testimoni', \App\Http\Controllers\Admin\TestimoniController::class)->names('admin.testimoni');
    Route::resource('admin/marketing', \App\Http\Controllers\Admin\MarketingController::class)->names('admin.marketing');

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
