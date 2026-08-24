@extends('admin.layouts.app')

@section('page_title', 'Detail Karir')
@section('content')
    <div class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">Detail Lowongan</h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Pratinjau lowongan kerja sebagaimana tersimpan</p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.karir.index') }}" class="hover:text-brand-500 transition">Karir</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">Detail</span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="w-full rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div class="min-w-0">
                    <h2 class="text-xl sm:text-2xl font-bold text-[#052B35] dark:text-white">{{ $karir->nama_karir }}</h2>
                    <div class="mt-2 flex flex-wrap items-center gap-2 text-xs">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400 font-medium">
                            {{ $karir->departemen ?: 'Operations' }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400 font-medium">
                            {{ $karir->tipe_pekerjaan ?: 'Full-Time' }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-purple-50 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400 font-medium">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $karir->lokasi_lengkap }}
                        </span>
                    </div>
                </div>

                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium {{ $karir->status === 'Aktif' ? 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-400' : ($karir->status === 'Tutup' ? 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-400' : 'bg-amber-50 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400') }}">
                    <span class="h-1.5 w-1.5 rounded-full {{ $karir->status === 'Aktif' ? 'bg-green-500' : ($karir->status === 'Tutup' ? 'bg-red-500' : 'bg-amber-500') }}"></span>
                    {{ $karir->status }}
                </span>
            </div>

            <div class="mt-5 pt-5 border-t border-gray-100 dark:border-gray-800">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1 font-semibold uppercase tracking-wider">Alamat Lengkap</p>
                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">{{ $karir->alamat_detail }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <!-- Deskripsi & Kualifikasi -->
            <div class="lg:col-span-2 space-y-5">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Deskripsi Pekerjaan</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $karir->deskripsi ?: 'Belum ada deskripsi.' }}</p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Kualifikasi / Persyaratan</h3>
                    @forelse ($karir->kualifikasi_array ?? [] as $i => $k)
                        <div class="flex items-start gap-3 py-2 {{ !$loop->last ? 'border-b border-gray-50 dark:border-gray-800/60' : '' }}">
                            <span class="w-6 h-6 shrink-0 mt-0.5 rounded-full bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400 flex items-center justify-center text-xs font-bold">{{ $i + 1 }}</span>
                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $k }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 italic">Belum ada kualifikasi.</p>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-5">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Informasi</h3>
                    <dl class="space-y-2.5 text-sm">
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Total Pelamar</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200">{{ $karir->pelamars_count ?? 0 }} orang</dd>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Dibuat</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200 text-right">{{ $karir->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Terakhir Diubah</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200 text-right">{{ $karir->updated_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                @if ($pelamars->count())
                    <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Pelamar Terbaru</h3>
                        <ul class="space-y-2">
                            @foreach ($pelamars as $pl)
                                <li class="flex items-center justify-between gap-2 p-2.5 bg-gray-50 dark:bg-white/[0.03] rounded-xl border border-gray-100 dark:border-gray-800">
                                    <div class="min-w-0">
                                        <p class="text-xs font-medium text-gray-800 dark:text-gray-200 truncate">{{ $pl->nama }}</p>
                                        <p class="text-[10px] text-gray-500 dark:text-gray-400 truncate">{{ $pl->email }}</p>
                                    </div>
                                    <span class="text-[10px] font-medium px-2 py-0.5 rounded-md bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-300 shrink-0">{{ $pl->status }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between gap-3 flex-wrap pb-2">
            <a href="{{ route('admin.karir.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Kembali ke Daftar</a>
            <a href="{{ route('admin.karir.edit', ['karir' => $karir->id]) }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-all shadow-sm shadow-amber-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Lowongan Ini
            </a>
        </div>
    </div>
@endsection
