@extends('admin.layouts.app')

@section('page_title', 'Detail Marketing')
@section('content')
    <div class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">Detail Profil Marketing</h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Profil tim marketing dan kontak WhatsApp</p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.marketing.index') }}" class="hover:text-brand-500 transition">Marketing</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">Detail</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <!-- Profil -->
            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 text-center sm:text-left">
                        @if ($marketing->foto)
                            <img src="{{ asset('storage/' . $marketing->foto) }}" alt="{{ $marketing->nama }}"
                                class="h-28 w-28 rounded-full object-cover border-4 border-brand-100 dark:border-brand-800 shadow-md" />
                        @else
                            <div class="h-28 w-28 rounded-full bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400 flex items-center justify-center font-bold text-4xl border-4 border-brand-100 dark:border-brand-800">
                                {{ strtoupper(substr($marketing->nama, 0, 1)) }}
                            </div>
                        @endif

                        <div class="min-w-0">
                            <div class="flex items-center justify-center sm:justify-start gap-2 mb-1">
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">{{ $marketing->nama }}</h2>
                                <span class="w-3 h-3 rounded-full {{ $marketing->status === 'online' ? 'bg-emerald-500' : 'bg-gray-400' }} ring-2 ring-white dark:ring-gray-900"></span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $marketing->divisi ?: '-' }}</p>

                            <a href="https://wa.me/{{ $marketing->no_wa }}" target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 text-sm font-mono font-medium hover:bg-emerald-100 dark:hover:bg-emerald-500/20 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.599-.187-.968-.306-1.877-.604-3.093-2.514-3.187-2.639-.092-.125-.761-1.015-.761-1.936 0-.922.477-1.376.64-1.554.163-.178.354-.223.473-.223.118 0 .237.004.342.008.109.004.256-.042.4.306.148.356.505 1.231.551 1.324.045.094.075.203.015.324-.06.12-.09.195-.18.293-.09.098-.19.213-.27.298-.09.085-.183.18-.08.357.103.177.458.756 1.015 1.25.719.638 1.285.836 1.464.928.179.093.284.078.389-.041.106-.118.455-.53.578-.711.122-.182.245-.152.408-.091.163.06 1.026.483 1.202.571.177.088.295.132.338.204.043.073.043.424-.101.829z" />
                                </svg>
                                +{{ $marketing->no_wa }}
                            </a>
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
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] sm:text-xs font-medium {{ $marketing->status === 'online' ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200/50 dark:border-emerald-500/20' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 border border-gray-200/50 dark:border-gray-700' }}">
                                    {{ ucfirst($marketing->status) }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Dibuat</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200 text-right">{{ $marketing->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Terakhir Diubah</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200 text-right">{{ $marketing->updated_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between gap-3 flex-wrap pb-2">
            <a href="{{ route('admin.marketing.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Kembali ke Daftar</a>
            <a href="{{ route('admin.marketing.edit', $marketing) }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-all shadow-sm shadow-amber-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Profil Ini
            </a>
        </div>
    </div>
@endsection
