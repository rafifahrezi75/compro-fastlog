@extends('admin.layouts.app')

@section('page_title', 'Detail Akun')
@section('content')
    <div class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">Detail Akun</h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Informasi pengguna sistem admin</p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.akun.index') }}" class="hover:text-brand-500 transition">Akun</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">Detail</span>
            </div>
        </div>

        <div class="w-full rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-center gap-5 flex-wrap">
                <div class="h-20 w-20 rounded-full bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400 flex items-center justify-center font-bold text-2xl uppercase">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1.5 mt-1">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $user->email }}
                    </p>
                    @if (auth()->id() === $user->id)
                        <span class="inline-flex items-center px-2 py-0.5 mt-2 rounded-md text-[10px] font-semibold bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">Akun Anda</span>
                    @endif
                </div>
            </div>

            <dl class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-800 space-y-2.5 text-sm max-w-md">
                <div class="flex items-start justify-between gap-3">
                    <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Terdaftar Sejak</dt>
                    <dd class="font-medium text-gray-800 dark:text-gray-200">{{ $user->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                </div>
                <div class="flex items-start justify-between gap-3">
                    <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Terakhir Diubah</dt>
                    <dd class="font-medium text-gray-800 dark:text-gray-200">{{ $user->updated_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                </div>
            </dl>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between gap-3 flex-wrap pb-2">
            <a href="{{ route('admin.akun.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Kembali ke Daftar</a>
            <a href="{{ route('admin.akun.edit', ['akun' => $user->id]) }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-all shadow-sm shadow-amber-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Akun Ini
            </a>
        </div>
    </div>
@endsection
