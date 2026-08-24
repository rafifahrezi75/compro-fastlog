@extends('admin.layouts.app')

@section('page_title', 'Detail Layanan')
@section('content')
    <div class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">Detail Layanan</h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Pratinjau konten layanan sebagaimana tampil di website</p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.layanan.index') }}" class="hover:text-brand-500 transition">Layanan</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">Detail</span>
            </div>
        </div>

        <!-- Header Card: Gambar + Identitas -->
        <div class="w-full rounded-2xl border border-gray-200 bg-white shadow-xs overflow-hidden dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="relative h-48 sm:h-64 bg-gray-200 dark:bg-gray-800">
                <img src="{{ $layanan->gambar_url }}" alt="{{ $layanan->nama }}" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/25 to-transparent"></div>
                <span class="absolute top-4 right-4 inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium {{ $layanan->status === 'aktif' ? 'bg-green-500/90 text-white' : 'bg-red-500/90 text-white' }}">
                    <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                    <span class="capitalize">{{ $layanan->status }}</span>
                </span>
                <div class="absolute bottom-5 left-6 right-6 flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/15 backdrop-blur-sm text-white border border-white/25">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">{!! $layanan->ikon !!}</svg>
                    </div>
                    <div class="min-w-0">
                        <h2 class="text-lg sm:text-2xl font-bold text-white truncate">{{ __($layanan->nama) }}</h2>
                        <a href="{{ route('services.detail', $layanan->slug) }}" target="_blank"
                            class="text-xs text-white/80 font-mono hover:text-[#FF7A3D] transition inline-flex items-center gap-1">
                            /layanan/{{ $layanan->slug }}
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Detail -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <!-- Deskripsi -->
            <div class="lg:col-span-2 space-y-5">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Deskripsi Singkat</h3>
                    <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed space-y-3 [&_p]:m-0">{!! $layanan->deskripsi_singkat !!}</div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Deskripsi Lengkap</h3>
                    <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed space-y-3">{!! $layanan->deskripsi_lengkap !!}</div>
                </div>
            </div>

            <!-- Sidebar: Fitur + Meta -->
            <div class="space-y-5">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Fitur Keunggulan</h3>
                    <ul class="space-y-2">
                        @forelse ($layanan->fitur ?? [] as $fitur)
                            <li class="flex items-start gap-2 p-2.5 bg-gray-50 dark:bg-white/[0.03] rounded-xl border border-gray-100 dark:border-gray-800">
                                <svg class="w-4 h-4 mt-0.5 shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-xs text-gray-700 dark:text-gray-300">{{ $fitur }}</span>
                            </li>
                        @empty
                            <li class="text-xs text-gray-400 italic">Belum ada fitur.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Informasi</h3>
                    <dl class="space-y-2.5 text-sm">
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Urutan Tampil</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200">{{ $layanan->urutan }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Dibuat</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200 text-right">{{ $layanan->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Terakhir Diubah</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200 text-right">{{ $layanan->updated_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Jumlah Fitur</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200">{{ count($layanan->fitur ?? []) }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between gap-3 flex-wrap pb-2">
            <a href="{{ route('admin.layanan.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Kembali ke Daftar</a>
            <a href="{{ route('admin.layanan.edit', $layanan) }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-all shadow-sm shadow-amber-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Layanan Ini
            </a>
        </div>
    </div>
@endsection
