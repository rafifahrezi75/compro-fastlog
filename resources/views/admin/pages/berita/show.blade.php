@extends('admin.layouts.app')

@section('page_title', 'Detail Berita')
@section('content')
    <div class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">Detail Berita</h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Pratinjau berita sebagaimana tersimpan</p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.berita.index') }}" class="hover:text-brand-500 transition">Berita</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">Detail</span>
            </div>
        </div>

        <!-- Header Card -->
        <div class="w-full rounded-2xl border border-gray-200 bg-white shadow-xs overflow-hidden dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="relative h-56 sm:h-72 bg-gray-200 dark:bg-gray-800">
                @if ($berita->gambar)
                    <img src="{{ asset($berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover" />
                @else
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1200&q=80" alt="{{ $berita->judul }}" class="w-full h-full object-cover" />
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/25 to-transparent"></div>
                <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-md text-[10px] sm:text-xs font-medium {{ $berita->status === 'published' ? 'bg-emerald-500/90 text-white' : ($berita->status === 'draft' ? 'bg-gray-700/90 text-white' : 'bg-amber-600/90 text-white') }}">
                    {{ ucfirst($berita->status) }}
                </span>
                <div class="absolute bottom-5 left-6 right-6">
                    <h2 class="text-lg sm:text-2xl font-bold text-white">{{ $berita->judul }}</h2>
                    <p class="text-xs text-white/80 font-mono mt-0.5">{{ $berita->sumber ? 'Sumber: ' . $berita->sumber . ' — ' : '' }}slug: {{ $berita->slug }}</p>
                </div>
            </div>
        </div>

        <!-- Konten -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Isi Berita</h3>
                    <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed space-y-3">{!! $berita->isi !!}</div>
                </div>
            </div>

            <div class="space-y-5">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Informasi</h3>
                    <dl class="space-y-2.5 text-sm">
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Dibuat</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200 text-right">{{ $berita->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Terakhir Diubah</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200 text-right">{{ $berita->updated_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between gap-3 flex-wrap pb-2">
            <a href="{{ route('admin.berita.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Kembali ke Daftar</a>
            <a href="{{ route('admin.berita.edit', ['beritum' => $berita->id]) }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-all shadow-sm shadow-amber-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Berita Ini
            </a>
        </div>
    </div>
@endsection
