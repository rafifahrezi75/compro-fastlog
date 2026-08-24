@extends('admin.layouts.app')

@section('page_title', $mode === 'edit' ? 'Ubah Info Perusahaan' : 'Tambah Info Perusahaan')
@section('content')
    <div class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">
                    {{ $mode === 'edit' ? 'Ubah Info: ' . $info->nama : 'Tambah Info Perusahaan' }}
                </h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                    Informasi perusahaan dipakai di seluruh halaman website (kontak, footer, dsb).
                </p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.infos.index') }}" class="hover:text-brand-500 transition">Info</a>
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
            <form action="{{ $mode === 'edit' ? route('admin.infos.update', ['info' => $info->id]) : route('admin.infos.store') }}"
                method="POST" enctype="multipart/form-data" class="p-5 sm:p-6 space-y-5">
                @csrf
                @if ($mode === 'edit')
                    @method('PUT')
                @endif

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">Nama Perusahaan <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $info->nama ?? '') }}" required
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">Email <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $info->email ?? '') }}" required
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">No Telp <span class="text-rose-500">*</span></label>
                        <input type="text" name="notelp" value="{{ old('notelp', $info->notelp ?? '') }}" required
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">Kota <span class="text-rose-500">*</span></label>
                        <input type="text" name="kota" value="{{ old('kota', $info->kota ?? '') }}" required
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">
                            {{ $mode === 'edit' ? 'Logo Baru (opsional)' : 'Logo' }}
                        </label>
                        <input type="file" name="logo" accept="image/*"
                            class="w-full px-3.5 py-2 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white" />
                        @if ($mode === 'edit')
                            <p class="text-[10px] text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah logo.</p>
                        @endif
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">Alamat Lengkap <span class="text-rose-500">*</span></label>
                    <textarea name="alamatLengkap" required rows="2"
                        class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none">{{ old('alamatLengkap', $info->alamatLengkap ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">Link Facebook</label>
                        <input type="url" name="linkFacebook" value="{{ old('linkFacebook', $info->linkFacebook ?? '') }}"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">Link Instagram</label>
                        <input type="url" name="linkInstagram" value="{{ old('linkInstagram', $info->linkInstagram ?? '') }}"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">Link X (Twitter)</label>
                        <input type="url" name="linkX" value="{{ old('linkX', $info->linkX ?? '') }}"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase mb-1.5">Link LinkedIn</label>
                        <input type="url" name="linkLinkedin" value="{{ old('linkLinkedin', $info->linkLinkedin ?? '') }}"
                            class="w-full px-3.5 py-2.5 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl text-gray-900 dark:text-white focus:ring-brand-500 focus:border-brand-500 outline-none" />
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between flex-wrap gap-3">
                    <a href="{{ route('admin.infos.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Batal</a>
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all">
                        {{ $mode === 'edit' ? 'Simpan Perubahan' : 'Simpan Info' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
