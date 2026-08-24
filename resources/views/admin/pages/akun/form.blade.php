@extends('admin.layouts.app')

@section('page_title', $mode === 'edit' ? 'Ubah Akun' : 'Tambah Akun')
@section('content')
    <div class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">
                    {{ $mode === 'edit' ? 'Ubah Akun: ' . $user->name : 'Tambah Akun Baru' }}
                </h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                    Kelola data pengguna/akun yang memiliki akses ke sistem admin.
                </p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.akun.index') }}" class="hover:text-brand-500 transition">Akun</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $mode === 'edit' ? 'Ubah' : 'Tambah' }}</span>
            </div>
        </div>

        @if($errors->any())
        <div class="p-4 text-sm text-red-800 rounded-xl bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-200" role="alert">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form Card -->
        <div class="w-full rounded-2xl border border-gray-200 bg-white shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
            <form action="{{ $mode === 'edit' ? route('admin.akun.update', ['akun' => $user->id]) : route('admin.akun.store') }}" method="POST" class="p-5 sm:p-6 space-y-5 max-w-xl">
                @csrf
                @if ($mode === 'edit')
                    @method('PUT')
                @endif

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">Email <span class="text-rose-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">
                        {{ $mode === 'edit' ? 'Password Baru (opsional)' : 'Password' }} {{ $mode === 'create' ? '<span class="text-rose-500">*</span>' : '' }}
                    </label>
                    <input type="password" name="password" minlength="8" {{ $mode === 'create' ? 'required' : '' }}
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none" />
                    <p class="text-[10px] text-gray-400 mt-1">{{ $mode === 'edit' ? 'Kosongkan jika tidak ingin mengubah password.' : 'Password minimal 8 karakter.' }}</p>
                </div>

                <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between flex-wrap gap-3">
                    <a href="{{ route('admin.akun.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Batal</a>
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all">
                        {{ $mode === 'edit' ? 'Simpan Perubahan' : 'Simpan Akun' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
