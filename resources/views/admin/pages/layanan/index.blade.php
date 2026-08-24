@extends('admin.layouts.app')

@section('page_title', 'Layanan')
@section('content')
    <div x-data="layananManager()" x-init="init()" class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">Layanan</h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                    Kelola konten layanan yang tampil di website (homepage, halaman layanan & detail layanan)
                </p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">Layanan</span>
            </div>
        </div>

        <!-- Banner Sukses -->
        <div x-data="{
                show: false,
                msg: '',
                init() {
                    const p = new URLSearchParams(window.location.search);
                    if (p.get('saved') === '1') { this.msg = 'Layanan baru berhasil disimpan.'; }
                    else if (p.get('updated') === '1') { this.msg = 'Perubahan layanan berhasil disimpan.'; }
                    else return;
                    this.show = true;
                    setTimeout(() => {
                        this.show = false;
                        window.history.replaceState({}, '', '{{ route('admin.layanan.index') }}');
                    }, 5000);
                }
            }"
            x-show="show" x-cloak
            x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700 dark:border-green-800/40 dark:bg-green-500/10 dark:text-green-400">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span x-text="msg"></span>
            <button @click="show = false" class="ml-auto text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- KPI Cards -->
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 lg:grid-cols-4 sm:gap-4">
            <!-- Total Layanan -->
            <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 dark:border-gray-800 dark:bg-white/[0.03] shadow-xs">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Layanan</span>
                        <h3 class="mt-1.5 text-xl sm:text-2xl font-bold text-gray-900 dark:text-white" x-text="layanans.length">0</h3>
                    </div>
                    <div class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-xl bg-brand-50 text-brand-500 dark:bg-brand-500/10">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2.5 text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 truncate">
                    <span>Seluruh master data layanan</span>
                </div>
            </div>

            <!-- Aktif -->
            <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 dark:border-gray-800 dark:bg-white/[0.03] shadow-xs">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Aktif</span>
                        <h3 class="mt-1.5 text-xl sm:text-2xl font-bold text-green-600 dark:text-green-400" x-text="activeCount">0</h3>
                    </div>
                    <div class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-xl bg-green-50 text-green-600 dark:bg-green-500/10">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2.5 text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 truncate">
                    <span>Tampil di front end website</span>
                </div>
            </div>

            <!-- Nonaktif -->
            <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 dark:border-gray-800 dark:bg-white/[0.03] shadow-xs">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Nonaktif</span>
                        <h3 class="mt-1.5 text-xl sm:text-2xl font-bold text-red-600 dark:text-red-400" x-text="inactiveCount">0</h3>
                    </div>
                    <div class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-xl bg-red-50 text-red-600 dark:bg-red-500/10">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2.5 text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 truncate">
                    <span>Disembunyikan dari front end</span>
                </div>
            </div>

            <!-- Total Fitur -->
            <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 dark:border-gray-800 dark:bg-white/[0.03] shadow-xs">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Fitur Keunggulan</span>
                        <h3 class="mt-1.5 text-xl sm:text-2xl font-bold text-blue-600 dark:text-blue-400" x-text="featureCount">0</h3>
                    </div>
                    <div class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2.5 text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 truncate">
                    <span>Total poin keunggulan layanan</span>
                </div>
            </div>
        </div>

        <!-- Main Table Card -->
        <div class="w-full rounded-2xl border border-gray-200 bg-white shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">

            <!-- Table Toolbar -->
            <div class="p-4 sm:p-5 border-b border-gray-100 dark:border-gray-800 flex flex-col gap-3.5 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-white/90">Daftar Layanan</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                        Menampilkan <span class="font-semibold text-gray-800 dark:text-white" x-text="filteredLayanans.length"></span> dari
                        <span x-text="layanans.length"></span> layanan
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-2.5 sm:gap-3">
                    <!-- Search Input -->
                    <div class="relative flex-1 min-w-[180px] sm:w-56 sm:flex-initial">
                        <input type="text" x-model="searchQuery" placeholder="Cari nama atau slug..."
                            class="h-9.5 w-full rounded-xl border border-gray-300 bg-gray-50/50 pl-9 pr-7 text-xs sm:text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500" />
                        <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <button x-show="searchQuery" @click="searchQuery = ''"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <!-- Status Filter -->
                    <select x-model="selectedStatus"
                        class="h-9.5 rounded-xl border border-gray-300 bg-white px-3 pr-7 text-xs sm:text-sm text-gray-700 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                        <option value="Semua">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>

                    <!-- Tambah Data Button -->
                    <a href="{{ route('admin.layanan.create') }}"
                        class="inline-flex h-9.5 items-center justify-center gap-1.5 rounded-xl bg-brand-500 px-3.5 text-xs sm:text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/50 transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Tambah Data</span>
                    </a>
                </div>
            </div>

            <!-- Fluid Table -->
            <div class="w-full overflow-hidden">
                <table class="w-full table-auto text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/75 dark:border-gray-800 dark:bg-white/[0.02] text-[11px] sm:text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            <th class="py-3.5 pl-4 pr-2 sm:pl-6 sm:pr-3 w-[30%]">Layanan & Slug</th>
                            <th class="py-3.5 px-3 hidden md:table-cell">Deskripsi Singkat</th>
                            <th class="py-3.5 px-3 w-20 text-center">Urutan</th>
                            <th class="py-3.5 px-3 w-28 text-center">Status</th>
                            <th class="py-3.5 pl-2 pr-4 sm:pl-3 sm:pr-6 text-right w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-xs sm:text-sm">
                        <template x-for="item in paginatedLayanans" :key="item.id">
                            <tr class="hover:bg-gray-50/70 dark:hover:bg-white/[0.02] transition">

                                <!-- Nama & Slug -->
                                <td class="py-3.5 pl-4 pr-2 sm:pl-6 sm:pr-3 align-middle">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="hidden sm:flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-500 dark:bg-brand-500/10">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4.5 w-4.5" x-html="item.ikon || ''"></svg>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-medium text-gray-900 dark:text-white leading-snug truncate" x-text="item.nama"></h4>
                                            <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400 font-mono truncate" x-text="'/layanan/' + item.slug"></p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Deskripsi Singkat -->
                                <td class="py-3.5 px-3 align-middle hidden md:table-cell">
                                    <div class="text-gray-600 dark:text-gray-400 line-clamp-2 max-w-md prose-sm [&_p]:m-0" x-html="item.deskripsi_singkat"></div>
                                </td>

                                <!-- Urutan -->
                                <td class="py-3.5 px-3 align-middle text-center">
                                    <span class="inline-flex items-center justify-center rounded-md bg-gray-100 px-2 py-0.5 text-xs font-semibold text-gray-700 dark:bg-gray-800 dark:text-gray-300" x-text="item.urutan"></span>
                                </td>

                                <!-- Status -->
                                <td class="py-3.5 px-3 align-middle text-center">
                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-medium"
                                        :class="item.status === 'aktif'
                                            ? 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-400'
                                            : 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-400'">
                                        <span class="h-1.5 w-1.5 rounded-full shrink-0"
                                            :class="item.status === 'aktif' ? 'bg-green-500' : 'bg-red-500'"></span>
                                        <span class="capitalize" x-text="item.status"></span>
                                    </span>
                                </td>

                                <!-- Aksi -->
                                <td class="py-3.5 pl-2 pr-4 sm:pl-3 sm:pr-6 align-middle text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <!-- Detail Action (Halaman Detail) -->
                                        <a :href="'{{ url('admin/layanan') }}/' + item.id" title="Lihat Detail"
                                            class="flex h-7.5 w-7.5 items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white transition">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <!-- Edit Action (Halaman Form) -->
                                        <a :href="'{{ url('admin/layanan') }}/' + item.id + '/edit'" title="Ubah Data"
                                            class="flex h-7.5 w-7.5 items-center justify-center rounded-lg text-blue-600 hover:bg-blue-50 hover:text-blue-700 dark:text-blue-400 dark:hover:bg-blue-500/10 transition">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <!-- Delete Action -->
                                        <button @click="openDeleteModal(item)" title="Hapus Data"
                                            class="flex h-7.5 w-7.5 items-center justify-center rounded-lg text-red-600 hover:bg-red-50 hover:text-red-700 dark:text-red-400 dark:hover:bg-red-500/10 transition">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        <!-- Empty State -->
                        <tr x-show="filteredLayanans.length === 0">
                            <td colspan="5" class="py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500 mb-2.5">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-medium text-gray-800 dark:text-white">Data layanan tidak ditemukan</h4>
                                    <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Coba ubah kata kunci pencarian atau filter status.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table Footer Pagination / Info -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-3.5 sm:px-5 border-t border-gray-100 dark:border-gray-800 gap-3 text-xs text-gray-500 dark:text-gray-400 bg-gray-50/30 dark:bg-white/[0.01]">
                <div>
                    Menampilkan
                    <span class="font-medium text-gray-800 dark:text-white" x-text="filteredLayanans.length > 0 ? ((currentPage - 1) * perPage) + 1 : 0"></span> -
                    <span class="font-medium text-gray-800 dark:text-white" x-text="Math.min(currentPage * perPage, filteredLayanans.length)"></span>
                    dari <span class="font-medium text-gray-800 dark:text-white" x-text="filteredLayanans.length"></span> data layanan
                </div>

                <template x-if="filteredLayanans.length > perPage">
                    <div class="flex items-center gap-1.5 self-center sm:self-auto">
                        <button @click="prevPage()" :disabled="currentPage === 1"
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            <span>Sebelumnya</span>
                        </button>
                        <button @click="nextPage()" :disabled="currentPage === totalPages"
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition">
                            <span>Selanjutnya</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <!-- ==================== MODAL HAPUS ==================== -->
        <div x-show="isDeleteModalOpen" x-cloak class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-xs" @keydown.escape.window="isDeleteModalOpen = false">
            <div class="w-full max-w-sm rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl p-6 text-center"
                x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                <div class="w-14 h-14 rounded-full bg-rose-100 dark:bg-rose-900/30 text-rose-500 mx-auto flex items-center justify-center mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Hapus Layanan?</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Apakah Anda yakin ingin menghapus layanan
                    <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="itemToDelete?.nama"></span>? Data tidak dapat dikembalikan.</p>

                <div class="flex items-center justify-center gap-3">
                    <button @click="isDeleteModalOpen = false" type="button"
                        class="px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">Batal</button>
                    <button @click="confirmDelete()" :disabled="isSubmitting" type="button"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-xs sm:text-sm font-medium text-white bg-rose-500 hover:bg-rose-600 rounded-xl transition-all disabled:opacity-50">
                        <template x-if="isSubmitting">
                            <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </template>
                        <span x-text="isSubmitting ? 'Menghapus...' : 'Ya, Hapus'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('layananManager', () => ({
                layanans: [],
                searchQuery: '',
                selectedStatus: 'Semua',
                isSubmitting: false,
                isDeleteModalOpen: false,
                itemToDelete: null,
                currentPage: 1,
                perPage: 10,

                init() {
                    this.fetchData();
                    this.$watch('searchQuery', () => { this.currentPage = 1; });
                    this.$watch('selectedStatus', () => { this.currentPage = 1; });
                },

                get activeCount() {
                    return this.layanans.filter(i => i.status === 'aktif').length;
                },
                get inactiveCount() {
                    return this.layanans.filter(i => i.status === 'nonaktif').length;
                },
                get featureCount() {
                    return this.layanans.reduce((sum, i) => sum + ((i.fitur || []).length), 0);
                },

                async fetchData() {
                    try {
                        const res = await fetch('{{ route('admin.layanan.index') }}', {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        const data = await res.json();
                        if (data.status === 'success') {
                            this.layanans = data.data;
                        }
                    } catch (error) {
                        console.error("Error fetching data:", error);
                    }
                },

                get filteredLayanans() {
                    let result = this.layanans;
                    if (this.searchQuery) {
                        const q = this.searchQuery.toLowerCase();
                        result = result.filter(item =>
                            (item.nama && item.nama.toLowerCase().includes(q)) ||
                            (item.slug && item.slug.toLowerCase().includes(q)) ||
                            (item.deskripsi_singkat && item.deskripsi_singkat.toLowerCase().includes(q))
                        );
                    }
                    if (this.selectedStatus !== 'Semua') {
                        result = result.filter(item => item.status === this.selectedStatus);
                    }
                    return result;
                },

                get paginatedLayanans() {
                    const start = (this.currentPage - 1) * this.perPage;
                    return this.filteredLayanans.slice(start, start + this.perPage);
                },

                get totalPages() {
                    return Math.ceil(this.filteredLayanans.length / this.perPage) || 1;
                },

                nextPage() {
                    if (this.currentPage < this.totalPages) this.currentPage++;
                },
                prevPage() {
                    if (this.currentPage > 1) this.currentPage--;
                },

                openDeleteModal(item) {
                    this.itemToDelete = item;
                    this.isDeleteModalOpen = true;
                },

                async confirmDelete() {
                    if (!this.itemToDelete) return;
                    this.isSubmitting = true;
                    try {
                        const res = await fetch(`{{ url('admin/layanan') }}/${this.itemToDelete.id}`, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        const result = await res.json();
                        if (result.status === 'success') {
                            this.layanans = this.layanans.filter(l => l.id !== this.itemToDelete.id);
                            this.isDeleteModalOpen = false;
                            this.itemToDelete = null;
                        }
                    } catch (error) {
                        console.error(error);
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            }));
        });
    </script>
@endpush
