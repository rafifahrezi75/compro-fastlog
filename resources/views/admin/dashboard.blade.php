@extends('admin.layouts.app')

@section('content')
<div class="space-y-6 max-w-full overflow-x-hidden" x-data="dashboardAnalytics()">

  <!-- ========================================================================= -->
  <!-- WELCOME HEADER BANNER                                                     -->
  <!-- ========================================================================= -->
  <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#052B35] via-[#083C4A] to-[#0A4D5E] p-6 sm:p-8 text-white shadow-md">
    <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
      <div>
        <div class="flex items-center gap-2 mb-2">
          <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-white/10 backdrop-blur-md text-[#FF7A3D] border border-white/10">
            <span class="w-2 h-2 rounded-full bg-[#FF7A3D] animate-pulse"></span>
            Fastlog Executive Dashboard
          </span>
          <span class="text-xs text-white/70">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
          Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }}! 👋
        </h1>
        <p class="mt-1 text-xs sm:text-sm text-white/80 max-w-2xl leading-relaxed">
          Pantau ringkasan performa publikasi website, lamaran karir masuk, aktivitas tim marketing, dan interaksi klien secara real-time.
        </p>
      </div>

      <div class="flex items-center gap-3 shrink-0">
        <a href="{{ route('admin.pelamar.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#FF7A3D] hover:bg-orange-600 text-white text-xs sm:text-sm font-semibold transition-all shadow-lg hover:shadow-orange-500/25">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
          <span>Tinjau Pelamar Baru ({{ $metrics['pelamar']['pending'] }})</span>
        </a>
      </div>
    </div>

    <!-- Background Decorative Circles -->
    <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-[#FF7A3D]/10 pointer-events-none blur-2xl"></div>
    <div class="absolute right-40 -top-10 w-48 h-48 rounded-full bg-white/5 pointer-events-none blur-xl"></div>
  </div>

  <!-- ========================================================================= -->
  <!-- 6 ACTUAL KPI SUMMARY CARDS                                                -->
  <!-- ========================================================================= -->
  <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-3.5 sm:gap-4">
    
    <!-- Card 1: Total Pelamar -->
    <div class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:shadow-md transition">
      <div class="flex items-center justify-between">
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Pelamar Kerja</span>
        <div class="w-9 h-9 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </div>
      </div>
      <div class="mt-3">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $metrics['pelamar']['total'] }}</h3>
        <p class="text-[11px] text-amber-600 dark:text-amber-400 font-medium mt-0.5">
          {{ $metrics['pelamar']['pending'] }} menunggu review
        </p>
      </div>
    </div>

    <!-- Card 2: Lowongan Karir -->
    <div class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:shadow-md transition">
      <div class="flex items-center justify-between">
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Lowongan Karir</span>
        <div class="w-9 h-9 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7H4C2.89543 7 2 7.89543 2 9V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19V9C22 7.89543 21.1046 7 20 7Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 21V5C16 4.46957 15.7893 3.96086 15.4142 3.58579C15.0391 3.21071 14.5304 3 14 3H10C9.46957 3 8.96086 3.21071 8.58579 3.58579C8.21071 3.96086 8 4.46957 8 5V21"/>
          </svg>
        </div>
      </div>
      <div class="mt-3">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $metrics['karir']['total'] }}</h3>
        <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-medium mt-0.5">
          {{ $metrics['karir']['aktif'] }} posisi aktif
        </p>
      </div>
    </div>

    <!-- Card 3: Berita & Artikel -->
    <div class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:shadow-md transition">
      <div class="flex items-center justify-between">
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Berita Publikasi</span>
        <div class="w-9 h-9 rounded-xl bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5C3.89543 20 3 19.1046 3 18V6C3 4.89543 3.89543 4 5 4H15L21 10V18C21 19.1046 20.1046 20 19 20Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 4V10H21"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 13H13"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 17H17"/>
          </svg>
        </div>
      </div>
      <div class="mt-3">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $metrics['berita']['total'] }}</h3>
        <p class="text-[11px] text-purple-600 dark:text-purple-400 font-medium mt-0.5">
          {{ $metrics['berita']['published'] }} artikel terbit
        </p>
      </div>
    </div>

    <!-- Card 4: Marketing Team -->
    <div class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:shadow-md transition">
      <div class="flex items-center justify-between">
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Tim Marketing</span>
        <div class="w-9 h-9 rounded-xl bg-orange-50 dark:bg-orange-950/40 text-[#FF7A3D] flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 11c2.20914 0 4-1.79086 4-4s-1.79086-4-4-4-4 1.79086-4 4 1.79086 4 4 4zm0 2c-3.31371 0-10 1.68629-10 5v2h20v-2c0-3.31371-6.68629-5-10-5z"/>
          </svg>
        </div>
      </div>
      <div class="mt-3">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $metrics['marketing']['total'] }}</h3>
        <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-medium mt-0.5 flex items-center gap-1">
          <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
          {{ $metrics['marketing']['online'] }} online siap chat
        </p>
      </div>
    </div>

    <!-- Card 5: Testimoni Klien -->
    <div class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:shadow-md transition">
      <div class="flex items-center justify-between">
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Testimoni Klien</span>
        <div class="w-9 h-9 rounded-xl bg-teal-50 dark:bg-teal-950/40 text-teal-600 dark:text-teal-400 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
          </svg>
        </div>
      </div>
      <div class="mt-3">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $metrics['testimoni']['total'] }}</h3>
        <p class="text-[11px] text-teal-600 dark:text-teal-400 font-medium mt-0.5">
          {{ $metrics['testimoni']['published'] }} ulasan tayang
        </p>
      </div>
    </div>

    <!-- Card 6: Dokumentasi Galeri -->
    <div class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:shadow-md transition">
      <div class="flex items-center justify-between">
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Galeri Foto</span>
        <div class="w-9 h-9 rounded-xl bg-pink-50 dark:bg-pink-950/40 text-pink-600 dark:text-pink-400 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>
      </div>
      <div class="mt-3">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $metrics['gallery']['total'] }}</h3>
        <p class="text-[11px] text-pink-600 dark:text-pink-400 font-medium mt-0.5">
          Dokumentasi aktif
        </p>
      </div>
    </div>

  </div>

  <!-- ========================================================================= -->
  <!-- 2 CHARTS: MONTHLY TREND & STATUS SELEKSI PELAMAR                          -->
  <!-- ========================================================================= -->
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6">
    
    <!-- Chart 1: Tren Aktivitas Bulanan (7 Cols) -->
    <div class="lg:col-span-7 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-5 sm:p-6 shadow-sm flex flex-col justify-between">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div>
          <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-brand-500"></span>
            Tren Pelamar & Publikasi Berita {{ Carbon\Carbon::now()->year }}
          </h3>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
            Grafik data aktual pertumbuhan kandidat pelamar dan konten artikel sepanjang tahun
          </p>
        </div>

        <div class="flex items-center gap-2 text-xs">
          <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-400 font-semibold">
            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
            Pelamar
          </span>
          <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-purple-50 text-purple-700 dark:bg-purple-950/40 dark:text-purple-400 font-semibold">
            <span class="w-2 h-2 rounded-full bg-purple-600"></span>
            Berita
          </span>
        </div>
      </div>

      <div class="relative w-full h-[300px]">
        <div id="chartMonthlyTrend" class="w-full h-full"></div>
      </div>
    </div>

    <!-- Chart 2: Status Seleksi Kandidat (5 Cols) -->
    <div class="lg:col-span-5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-5 sm:p-6 shadow-sm flex flex-col justify-between">
      <div class="flex items-center justify-between mb-2">
        <div>
          <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
            Distribusi Status Pelamar
          </h3>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
            Tahapan seleksi berkas pelamar kerja yang masuk
          </p>
        </div>
        <a href="{{ route('admin.pelamar.index') }}" class="text-xs font-semibold text-brand-500 hover:underline">
          Lihat Semua
        </a>
      </div>

      <div class="relative w-full flex items-center justify-center my-2 h-[230px]">
        <div id="chartStatusPelamar" class="w-full h-full flex items-center justify-center"></div>
      </div>

      <!-- Quick Legend Badges -->
      <div class="grid grid-cols-3 gap-2 pt-3 border-t border-gray-100 dark:border-gray-800 text-[11px]">
        <div class="p-2 rounded-xl bg-amber-50 dark:bg-amber-950/30 text-amber-800 dark:text-amber-400 text-center">
          <span class="block font-semibold">Pending</span>
          <strong class="text-sm font-bold">{{ $statusPelamarCounts['Pending'] }}</strong>
        </div>
        <div class="p-2 rounded-xl bg-purple-50 dark:bg-purple-950/30 text-purple-800 dark:text-purple-400 text-center">
          <span class="block font-semibold">Wawancara</span>
          <strong class="text-sm font-bold">{{ $statusPelamarCounts['Wawancara'] + $statusPelamarCounts['Review'] }}</strong>
        </div>
        <div class="p-2 rounded-xl bg-emerald-50 dark:bg-emerald-950/30 text-emerald-800 dark:text-emerald-400 text-center">
          <span class="block font-semibold">Diterima</span>
          <strong class="text-sm font-bold">{{ $statusPelamarCounts['Diterima'] }}</strong>
        </div>
      </div>
    </div>

  </div>

  <!-- ========================================================================= -->
  <!-- 2 LIVE TABLES: PELAMAR TERBARU & LOWONGAN POPULER                         -->
  <!-- ========================================================================= -->
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6">
    
    <!-- Tabel 1: Berkas Lamaran Masuk Terbaru (7 Cols) -->
    <div class="lg:col-span-7 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden flex flex-col justify-between">
      <div class="p-4 sm:p-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-white/[0.01]">
        <div>
          <h3 class="text-base font-bold text-gray-900 dark:text-white">Lamaran Kerja Masuk Terbaru</h3>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">5 pendaftaran kandidat terbaru</p>
        </div>
        <a href="{{ route('admin.pelamar.index') }}" 
           class="inline-flex items-center gap-1 text-xs font-semibold text-brand-500 hover:text-brand-600 px-3 py-1.5 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-500/10 transition">
          <span>Buka Master Pelamar</span>
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b border-gray-100 dark:border-gray-800 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase bg-gray-50/30 dark:bg-white/[0.01]">
              <th class="py-3 px-4">Kandidat</th>
              <th class="py-3 px-3">Posisi</th>
              <th class="py-3 px-3 text-center">Status</th>
              <th class="py-3 px-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-xs">
            @forelse($recentPelamars as $pelamar)
              <tr class="hover:bg-gray-50/60 dark:hover:bg-gray-800/40 transition">
                <td class="py-3 px-4">
                  <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400 flex items-center justify-center font-bold text-xs shrink-0">
                      {{ strtoupper(substr($pelamar->nama, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                      <p class="font-semibold text-gray-900 dark:text-white truncate">{{ $pelamar->nama }}</p>
                      <p class="text-[11px] text-gray-400 truncate">{{ $pelamar->email }}</p>
                    </div>
                  </div>
                </td>
                <td class="py-3 px-3">
                  <span class="font-medium text-gray-800 dark:text-gray-200 block truncate max-w-[150px]">{{ $pelamar->posisi }}</span>
                  <span class="text-[10px] text-gray-400">{{ $pelamar->created_at->diffForHumans() }}</span>
                </td>
                <td class="py-3 px-3 text-center">
                  @php
                    $statusClass = match($pelamar->status) {
                        'Pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                        'Review' => 'bg-blue-50 text-blue-700 border-blue-200',
                        'Wawancara' => 'bg-purple-50 text-purple-700 border-purple-200',
                        'Diterima' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                        'Ditolak' => 'bg-rose-50 text-rose-700 border-rose-200',
                        default => 'bg-gray-50 text-gray-700 border-gray-200',
                    };
                  @endphp
                  <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold border {{ $statusClass }}">
                    {{ $pelamar->status }}
                  </span>
                </td>
                <td class="py-3 px-4 text-right">
                  <div class="flex items-center justify-end gap-1.5">
                    @if($pelamar->file_cv)
                      <a href="{{ route('admin.pelamar.cv', $pelamar->id) }}" target="_blank" title="Unduh CV"
                         class="p-1 rounded-lg text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                      </a>
                    @endif
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (str_starts_with($pelamar->telepon, '0') ? '62'.substr($pelamar->telepon, 1) : $pelamar->telepon)) }}" 
                       target="_blank" title="Chat WhatsApp"
                       class="p-1 rounded-lg text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 transition">
                      <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654z"/></svg>
                    </a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="py-6 text-center text-gray-400 text-xs">Belum ada data pelamar.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Tabel 2: Lowongan Karir Terpopuler & Peminat (5 Cols) -->
    <div class="lg:col-span-5 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden flex flex-col justify-between">
      <div class="p-4 sm:p-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-white/[0.01]">
        <div>
          <h3 class="text-base font-bold text-gray-900 dark:text-white">Lowongan Karir Terpopuler</h3>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Paling banyak diminati pelamar</p>
        </div>
        <a href="{{ route('admin.karir.index') }}" 
           class="inline-flex items-center gap-1 text-xs font-semibold text-brand-500 hover:text-brand-600 px-3 py-1.5 rounded-lg hover:bg-brand-50 dark:hover:bg-brand-500/10 transition">
          <span>Master Karir</span>
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
      </div>

      <div class="p-4 space-y-3">
        @forelse($popularKarirs as $job)
          <div class="p-3 rounded-xl bg-gray-50/75 dark:bg-gray-800/40 border border-gray-100 dark:border-gray-800 flex items-center justify-between gap-3 hover:border-brand-500/30 transition">
            <div class="min-w-0">
              <h4 class="font-semibold text-gray-900 dark:text-white text-xs sm:text-sm truncate">{{ $job->nama_karir }}</h4>
              <div class="flex items-center gap-2 text-[11px] text-gray-400 mt-0.5">
                <span>{{ $job->departemen ?? 'Operations' }}</span>
                <span>•</span>
                <span>{{ $job->kota }}</span>
              </div>
            </div>
            <a href="{{ route('admin.pelamar.index', ['posisi' => $job->nama_karir]) }}"
               class="shrink-0 inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400 hover:bg-brand-100 transition">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
              <span>{{ $job->pelamars_count }} Pelamar</span>
            </a>
          </div>
        @empty
          <div class="py-6 text-center text-gray-400 text-xs">Belum ada data lowongan karir.</div>
        @endforelse
      </div>

      <div class="p-3.5 bg-gray-50/40 dark:bg-white/[0.01] border-t border-gray-100 dark:border-gray-800 text-center">
        <a href="{{ route('admin.karir.create') }}" class="text-xs font-semibold text-brand-500 hover:underline">
          + Buat Lowongan Kerja Baru
        </a>
      </div>
    </div>

  </div>

  <!-- ========================================================================= -->
  <!-- ROW 4: STATUS MARKETING ONLINE & BERITA TERAKHIR                          -->
  <!-- ========================================================================= -->
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6">
    
    <!-- Kolom 1: Status Tim Marketing Real-Time (6 Cols) -->
    <div class="lg:col-span-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
      <div class="p-4 sm:p-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-white/[0.01]">
        <div>
          <h3 class="text-base font-bold text-gray-900 dark:text-white">Tim Marketing Fastlog</h3>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Status online & hotline WhatsApp customer</p>
        </div>
        <a href="{{ route('admin.marketing.index') }}" 
           class="text-xs font-semibold text-brand-500 hover:underline">
          Kelola Tim
        </a>
      </div>

      <div class="p-4 space-y-3">
        @forelse($marketings as $marketing)
          <div class="p-3 rounded-xl bg-gray-50/75 dark:bg-gray-800/40 border border-gray-100 dark:border-gray-800 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
              <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 border border-gray-200 dark:border-gray-700 bg-gray-100 flex items-center justify-center font-bold text-gray-700 dark:text-gray-300">
                @if($marketing->foto)
                  <img src="{{ asset('storage/' . $marketing->foto) }}" alt="{{ $marketing->nama }}" class="w-full h-full object-cover">
                @else
                  {{ strtoupper(substr($marketing->nama, 0, 1)) }}
                @endif
              </div>
              <div class="min-w-0">
                <h4 class="font-semibold text-gray-900 dark:text-white text-xs sm:text-sm truncate">{{ $marketing->nama }}</h4>
                <p class="text-[11px] text-gray-400 truncate">{{ $marketing->divisi ?? 'Marketing Executive' }}</p>
              </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
              @if($marketing->status === 'online')
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                  Online
                </span>
              @else
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400 border border-gray-200">
                  Offline
                </span>
              @endif

              <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (str_starts_with($marketing->no_wa, '0') ? '62'.substr($marketing->no_wa, 1) : $marketing->no_wa)) }}" 
                 target="_blank" title="Chat via WhatsApp"
                 class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center hover:bg-emerald-700 transition">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654z"/></svg>
              </a>
            </div>
          </div>
        @empty
          <div class="py-6 text-center text-gray-400 text-xs">Belum ada anggota marketing.</div>
        @endforelse
      </div>
    </div>

    <!-- Kolom 2: Berita & Publikasi Terkini (6 Cols) -->
    <div class="lg:col-span-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
      <div class="p-4 sm:p-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-white/[0.01]">
        <div>
          <h3 class="text-base font-bold text-gray-900 dark:text-white">Berita & Publikasi Terkini</h3>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Artikel dan pengumuman terbaru Fastlog</p>
        </div>
        <a href="{{ route('admin.berita.index') }}" 
           class="text-xs font-semibold text-brand-500 hover:underline">
          Master Berita
        </a>
      </div>

      <div class="p-4 space-y-3">
        @forelse($recentBeritas as $news)
          <div class="p-3 rounded-xl bg-gray-50/75 dark:bg-gray-800/40 border border-gray-100 dark:border-gray-800 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
              <div class="w-12 h-10 rounded-lg overflow-hidden shrink-0 bg-gray-200">
                @if($news->gambar)
                  <img src="{{ str_starts_with($news->gambar, 'uploads/') ? asset($news->gambar) : asset('storage/' . $news->gambar) }}" alt="{{ $news->judul }}" class="w-full h-full object-cover">
                @else
                  <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400 font-bold">NEWS</div>
                @endif
              </div>
              <div class="min-w-0">
                <h4 class="font-semibold text-gray-900 dark:text-white text-xs sm:text-sm truncate">{{ $news->judul }}</h4>
                <p class="text-[11px] text-gray-400 truncate">{{ $news->created_at ? $news->created_at->translatedFormat('d M Y') : '-' }}</p>
              </div>
            </div>

            <div class="shrink-0">
              @if($news->status === 'published')
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border border-emerald-200">
                  Published
                </span>
              @else
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400 border border-amber-200">
                  Draft
                </span>
              @endif
            </div>
          </div>
        @empty
          <div class="py-6 text-center text-gray-400 text-xs">Belum ada publikasi berita.</div>
        @endforelse
      </div>
    </div>

  </div>

</div>

<!-- ========================================================================= -->
<!-- APEXCHARTS INITIALIZATION SCRIPT WITH REAL DATABASE DATA                  -->
<!-- ========================================================================= -->
<script>
function dashboardAnalytics() {
  return {
    init() {
      this.$nextTick(() => {
        this.renderMonthlyTrendChart();
        this.renderStatusPelamarChart();
      });
    },

    renderMonthlyTrendChart() {
      const el = document.querySelector("#chartMonthlyTrend");
      if (!el || !window.ApexCharts) return;

      const options = {
        series: [
          {
            name: "Pelamar Masuk",
            data: @json($pelamarMonthly)
          },
          {
            name: "Berita Diterbitkan",
            data: @json($beritaMonthly)
          }
        ],
        chart: {
          type: "area",
          height: 290,
          toolbar: { show: false },
          fontFamily: "inherit"
        },
        colors: ["#2563EB", "#9333EA"],
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.45,
            opacityTo: 0.05,
            stops: [0, 95, 100]
          }
        },
        stroke: {
          curve: "smooth",
          width: 2.5
        },
        dataLabels: { enabled: false },
        xaxis: {
          categories: @json($months),
          axisBorder: { show: false },
          axisTicks: { show: false },
          labels: {
            style: {
              colors: "#94A3B8",
              fontSize: "11px"
            }
          }
        },
        yaxis: {
          labels: {
            style: {
              colors: "#94A3B8",
              fontSize: "11px"
            }
          }
        },
        grid: {
          borderColor: "#F1F5F9",
          strokeDashArray: 4
        },
        tooltip: {
          theme: "light",
          y: {
            formatter: (val) => val + " Data"
          }
        },
        legend: { show: false }
      };

      const chart = new ApexCharts(el, options);
      chart.render();
    },

    renderStatusPelamarChart() {
      const el = document.querySelector("#chartStatusPelamar");
      if (!el || !window.ApexCharts) return;

      const statusData = @json($statusPelamarCounts);
      const labels = Object.keys(statusData);
      const series = Object.values(statusData);

      // If all zero, provide baseline so donut chart always renders beautifully
      const totalSeries = series.reduce((a, b) => a + b, 0);
      const finalSeries = totalSeries > 0 ? series : [1, 0, 0, 0, 0];

      const options = {
        series: finalSeries,
        labels: labels,
        chart: {
          type: "donut",
          height: 220,
          fontFamily: "inherit"
        },
        colors: ["#F59E0B", "#3B82F6", "#8B5CF6", "#10B981", "#EF4444"],
        plotOptions: {
          pie: {
            donut: {
              size: "72%",
              labels: {
                show: true,
                total: {
                  show: true,
                  label: "Total Pelamar",
                  fontSize: "12px",
                  fontWeight: 600,
                  color: "#64748B",
                  formatter: () => "{{ $metrics['pelamar']['total'] }}"
                },
                value: {
                  fontSize: "20px",
                  fontWeight: 700,
                  color: "#0F172A"
                }
              }
            }
          }
        },
        dataLabels: { enabled: false },
        legend: { show: false },
        stroke: { width: 2, colors: ["#ffffff"] },
        tooltip: {
          y: {
            formatter: (val) => val + " Pelamar"
          }
        }
      };

      const chart = new ApexCharts(el, options);
      chart.render();
    }
  };
}
</script>
@endsection
