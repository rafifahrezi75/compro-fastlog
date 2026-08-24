@extends('admin.layouts.app')

@section('page_title', 'Detail Testimoni')
@section('content')
    <div class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">Detail Testimoni</h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Ulasan pelanggan sebagaimana tersimpan</p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.testimoni.index') }}" class="hover:text-brand-500 transition">Testimoni</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">Detail</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <!-- Isi Testimoni -->
            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <svg class="w-10 h-10 text-brand-500/30 mb-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zM24 3v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/>
                    </svg>
                    <p class="text-base sm:text-lg text-gray-700 dark:text-gray-300 leading-relaxed italic mb-6">
                        &ldquo;{{ $testimoni->testimoni }}&rdquo;
                    </p>
                    <div class="flex items-center gap-4 pt-5 border-t border-gray-100 dark:border-gray-800">
                        @if ($testimoni->foto)
                            <img src="{{ asset('storage/' . $testimoni->foto) }}" alt="{{ $testimoni->nama }}"
                                class="h-14 w-14 rounded-full object-cover border-2 border-brand-100 dark:border-brand-800" />
                        @else
                            <div class="h-14 w-14 rounded-full bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400 flex items-center justify-center font-bold text-lg">
                                {{ strtoupper(substr($testimoni->nama, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ $testimoni->nama }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $testimoni->perusahaan ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Meta -->
            <div class="space-y-5">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Informasi</h3>
                    <dl class="space-y-2.5 text-sm">
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Status</dt>
                            <dd>
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] sm:text-xs font-medium {{ $testimoni->status === 'published' ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200/50 dark:border-emerald-500/20' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 border border-gray-200/50 dark:border-gray-700' }}">
                                    {{ ucfirst($testimoni->status) }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Dibuat</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200 text-right">{{ $testimoni->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Terakhir Diubah</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200 text-right">{{ $testimoni->updated_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between gap-3 flex-wrap pb-2">
            <a href="{{ route('admin.testimoni.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Kembali ke Daftar</a>
            <a href="{{ route('admin.testimoni.edit', $testimoni) }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-all shadow-sm shadow-amber-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Testimoni Ini
            </a>
        </div>
    </div>
@endsection
