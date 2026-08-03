<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

    Route::get('/galeri', function () {
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
        return view('user.pages.career');
    })->name('career');
});
//     Route::get('/', function () {
//         return view('user.pages.index');
//     })->name('home');

//     Route::get('/about', function () {
//         return view('user.pages.about');
//     })->name('about');

//     Route::get('/services', function () {
//         return view('user.pages.services');
//     })->name('services');

//     Route::get('/blog', function () {
//         return view('user.pages.blog');
//     })->name('blog');

//     Route::get('/blog-details', function () {
//         return view('user.pages.blog-details');
//     })->name('blog-details');

//     Route::get('/contact', function () {
//         return view('user.pages.contact');
//     })->name('contact');

//     Route::get('/gallery', function () {
//         return view('user.pages.gallery');
//     })->name('gallery');

//     Route::get('/career', function () {
//         return view('user.pages.career');
//     })->name('career');


// Route::middleware('auth')->group(function () {

//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');

//     Route::post('/logout', [AuthController::class, 'logout'])
//         ->name('logout');
// });

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
