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
    // Route Halaman Utama (Index) -> resources/views/user/pages/index.blade.php
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route Halaman Tentang Kami -> resources/views/user/pages/about.blade.php
    Route::get('/tentang-kami', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');

    Route::get('/gallery', [\App\Http\Controllers\Admin\GalleryController::class, 'frontendIndex'])->name('gallery'); 

    Route::get('/destinasi', [\App\Http\Controllers\DestinationController::class, 'index'])->name('destination');

    // 2. Route Detail Destinasi (Sesuai nama file kamu: detail-destination)
    Route::get('/destinasi/{slug}', [\App\Http\Controllers\DestinationController::class, 'detail'])->name('destination.detail');

    Route::get('/berita', [\App\Http\Controllers\Admin\BeritaController::class, 'frontendIndex'])->name('berita');

    // 2. Route Detail Berita
    Route::get('/berita/{slug}', [\App\Http\Controllers\Admin\BeritaController::class, 'frontendDetail'])->name('berita.detail');

    // Route Halaman Layanan Utama (Daftar Semua Layanan)
    Route::get('/layanan', [\App\Http\Controllers\ServiceController::class, 'index'])->name('services');

    // Route Detail Layanan (Dynamic Slug)
    Route::get('/layanan/{slug}', [\App\Http\Controllers\ServiceController::class, 'detail'])->name('services.detail');

    Route::get('/karir', [\App\Http\Controllers\Admin\KarirController::class, 'frontendIndex'])->name('career');

    // Halaman Detail Lowongan Kerja
    Route::get('/karir/{slug}', [\App\Http\Controllers\Admin\KarirController::class, 'frontendDetail'])->name('career.detail');

    // Proses Submit Lamaran Kerja
    Route::post('/karir/apply', [\App\Http\Controllers\Admin\KarirController::class, 'apply'])->name('career.apply');

    Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');

    // Route Dummy untuk Simulasi Kirim Pesan Form
    Route::post('/contact/send', [\App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');
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
