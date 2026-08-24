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
                    <button @click="openAddModal()"
                        class="inline-flex h-9.5 items-center justify-center gap-1.5 rounded-xl bg-brand-500 px-3.5 text-xs sm:text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/50 transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Tambah Data</span>
                    </button>
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
                                        <button @click="openDetailModal(item)" title="Lihat Detail"
                                            class="flex h-7.5 w-7.5 items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white transition">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button @click="openEditModal(item)" title="Ubah Data"
                                            class="flex h-7.5 w-7.5 items-center justify-center rounded-lg text-blue-600 hover:bg-blue-50 hover:text-blue-700 dark:text-blue-400 dark:hover:bg-blue-500/10 transition">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
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

        <!-- ==================== MODAL TAMBAH DATA ==================== -->
        <div x-show="isAddModalOpen" x-cloak class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-4 sm:p-6" @keydown.escape.window="isAddModalOpen = false">
            <div @click="isAddModalOpen = false" class="fixed inset-0 h-full w-full bg-gray-900/60 backdrop-blur-xs transition-opacity"
                x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

            <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 sm:p-7 shadow-2xl dark:bg-gray-900 border border-gray-100 dark:border-gray-800 z-10 my-6"
                x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-800">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-50 text-brand-500 dark:bg-brand-500/10">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Tambah Layanan Baru</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Konten akan langsung tampil di front end</p>
                        </div>
                    </div>
                    <button @click="isAddModalOpen = false" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form @submit.prevent="submitAdd()" class="mt-4 space-y-3.5 max-h-[65vh] overflow-y-auto pr-1">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Layanan <span class="text-red-500">*</span></label>
                        <input type="text" x-model.trim="formAdd.nama" required placeholder="Contoh: Project Cargo Handling"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                        <textarea id="tinymce_singkat_add"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi Lengkap <span class="text-red-500">*</span></label>
                        <textarea id="tinymce_lengkap_add"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Fitur Keunggulan</label>
                        <textarea x-model="formAdd.fitur" rows="4" placeholder="Satu fitur per baris, contoh:&#10;Pengiriman Door-to-Door&#10;Tracking GPS 24/7"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white"></textarea>
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Tulis satu fitur per baris.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Ikon</label>
                        <div class="grid grid-cols-6 gap-2">
                            <template x-for="(opt, i) in iconOptions" :key="'add-icon-' + i">
                                <button type="button" @click="formAdd.ikon = opt.value" :title="opt.label"
                                    :class="formAdd.ikon === opt.value
                                        ? 'border-brand-500 bg-brand-50 text-brand-600 ring-2 ring-brand-500/20 dark:bg-brand-500/10'
                                        : 'border-gray-200 text-gray-400 hover:border-brand-300 hover:text-brand-500 dark:border-gray-700 dark:text-gray-500'"
                                    class="flex h-11 items-center justify-center rounded-xl border transition">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" x-html="opt.value"></svg>
                                </button>
                            </template>
                        </div>
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Klik ikon untuk memilih tampilan layanan di website.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Path SVG Kustom (Opsional)</label>
                            <input type="text" x-model="formAdd.ikon" placeholder='<path d="..." />'
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs font-mono text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Urutan Tampil</label>
                            <input type="number" x-model.number="formAdd.urutan" min="0" placeholder="0"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar</label>
                            <input type="file" x-ref="gambarAdd" accept="image/*"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <select x-model="formAdd.status"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-end gap-2.5">
                        <button type="button" @click="isAddModalOpen = false"
                            class="px-4 py-2.5 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">Batal</button>
                        <button type="submit" :disabled="isSubmitting"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all disabled:opacity-50">
                            <template x-if="isSubmitting">
                                <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                            </template>
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan Layanan'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ==================== MODAL UBAH DATA ==================== -->
        <div x-show="isEditModalOpen" x-cloak class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-4 sm:p-6" @keydown.escape.window="isEditModalOpen = false">
            <div @click="isEditModalOpen = false" class="fixed inset-0 h-full w-full bg-gray-900/60 backdrop-blur-xs transition-opacity"
                x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

            <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 sm:p-7 shadow-2xl dark:bg-gray-900 border border-gray-100 dark:border-gray-800 z-10 my-6"
                x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-800">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-500 dark:bg-amber-500/10">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Ubah Layanan</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400" x-text="formEdit.nama"></p>
                        </div>
                    </div>
                    <button @click="isEditModalOpen = false" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form @submit.prevent="submitEdit()" class="mt-4 space-y-3.5 max-h-[65vh] overflow-y-auto pr-1">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Layanan <span class="text-red-500">*</span></label>
                        <input type="text" x-model.trim="formEdit.nama" required
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">
                            Slug saat ini: <span class="font-mono" x-text="'/layanan/' + formEdit.slug"></span> — slug otomatis mengikuti nama bila diubah.
                        </p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                        <textarea id="tinymce_singkat_edit"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi Lengkap <span class="text-red-500">*</span></label>
                        <textarea id="tinymce_lengkap_edit"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Fitur Keunggulan</label>
                        <textarea x-model="formEdit.fitur_text" rows="4"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white"></textarea>
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Tulis satu fitur per baris.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Ikon</label>
                        <div class="grid grid-cols-6 gap-2">
                            <template x-for="(opt, i) in iconOptions" :key="'edit-icon-' + i">
                                <button type="button" @click="formEdit.ikon = opt.value" :title="opt.label"
                                    :class="formEdit.ikon === opt.value
                                        ? 'border-brand-500 bg-brand-50 text-brand-600 ring-2 ring-brand-500/20 dark:bg-brand-500/10'
                                        : 'border-gray-200 text-gray-400 hover:border-brand-300 hover:text-brand-500 dark:border-gray-700 dark:text-gray-500'"
                                    class="flex h-11 items-center justify-center rounded-xl border transition">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" x-html="opt.value"></svg>
                                </button>
                            </template>
                        </div>
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Klik ikon untuk memilih tampilan layanan di website.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Path SVG Kustom (Opsional)</label>
                            <input type="text" x-model="formEdit.ikon" placeholder='<path d="..." />'
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs font-mono text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Urutan Tampil</label>
                            <input type="number" x-model.number="formEdit.urutan" min="0"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Ganti Gambar</label>
                            <input type="file" x-ref="gambarEdit" accept="image/*"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                            <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <select x-model="formEdit.status"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-end gap-2.5">
                        <button type="button" @click="isEditModalOpen = false"
                            class="px-4 py-2.5 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">Batal</button>
                        <button type="submit" :disabled="isSubmitting"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-xs sm:text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-all disabled:opacity-50">
                            <template x-if="isSubmitting">
                                <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                            </template>
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan Perubahan'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ==================== MODAL DETAIL ==================== -->
        <div x-show="isDetailModalOpen" x-cloak class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-4 sm:p-6" @keydown.escape.window="isDetailModalOpen = false">
            <div @click="isDetailModalOpen = false" class="fixed inset-0 h-full w-full bg-gray-900/60 backdrop-blur-xs transition-opacity"
                x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

            <div class="relative w-full max-w-lg rounded-3xl bg-white shadow-2xl dark:bg-gray-900 border border-gray-100 dark:border-gray-800 z-10 my-6 overflow-hidden"
                x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <template x-if="selectedItem">
                    <div>
                        <!-- Header Image -->
                        <div class="relative h-40 bg-gray-200 dark:bg-gray-800">
                            <img :src="selectedItem.gambar_url" :alt="selectedItem.nama" class="w-full h-full object-cover" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <button @click="isDetailModalOpen = false" class="absolute top-4 right-4 rounded-lg bg-black/30 p-1.5 text-white hover:bg-black/50">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                            <div class="absolute bottom-4 left-5 right-5 flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/15 backdrop-blur-sm text-white border border-white/25">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" x-html="selectedItem.ikon || ''"></svg>
                                </div>
                                <div class="min-w-0">
                                    <h3 class="text-lg font-bold text-white truncate" x-text="selectedItem.nama"></h3>
                                    <p class="text-xs text-white/80 font-mono truncate" x-text="'/layanan/' + selectedItem.slug"></p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 space-y-4 max-h-[55vh] overflow-y-auto">
                            <div>
                                <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Deskripsi Singkat</h4>
                                <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed [&_p]:m-0" x-html="selectedItem.deskripsi_singkat"></div>
                            </div>
                            <div>
                                <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Deskripsi Lengkap</h4>
                                <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed" x-html="selectedItem.deskripsi_lengkap"></div>
                            </div>
                            <div>
                                <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Fitur Keunggulan</h4>
                                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <template x-for="(fitur, idx) in (selectedItem.fitur || [])" :key="idx">
                                        <li class="flex items-start gap-2 p-2.5 bg-gray-50 dark:bg-white/[0.03] rounded-xl border border-gray-100 dark:border-gray-800">
                                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-xs text-gray-700 dark:text-gray-300" x-text="fitur"></span>
                                        </li>
                                    </template>
                                </ul>
                                <p x-show="!selectedItem.fitur || selectedItem.fitur.length === 0" class="text-xs text-gray-400 italic">Belum ada fitur.</p>
                            </div>
                            <div class="flex flex-wrap gap-x-8 gap-y-2 pt-2 border-t border-gray-100 dark:border-gray-800">
                                <div>
                                    <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</h4>
                                    <span class="text-sm font-medium capitalize" :class="selectedItem.status === 'aktif' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'" x-text="selectedItem.status"></span>
                                </div>
                                <div>
                                    <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Urutan</h4>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300" x-text="selectedItem.urutan"></span>
                                </div>
                                <div>
                                    <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Terakhir Diubah</h4>
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300" x-text="new Date(selectedItem.updated_at).toLocaleString('id-ID')"></span>
                                </div>
                            </div>
                        </div>
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
    <!-- TinyMCE CDN Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('layananManager', () => ({
                layanans: [],
                searchQuery: '',
                selectedStatus: 'Semua',
                isSubmitting: false,
                isAddModalOpen: false,
                isEditModalOpen: false,
                isDetailModalOpen: false,
                isDeleteModalOpen: false,
                selectedItem: null,
                itemToDelete: null,
                formAdd: {
                    nama: '',
                    deskripsi_singkat: '',
                    deskripsi_lengkap: '',
                    fitur: '',
                    ikon: '',
                    urutan: 0,
                    status: 'aktif'
                },
                formEdit: {
                    id: null,
                    nama: '',
                    slug: '',
                    deskripsi_singkat: '',
                    deskripsi_lengkap: '',
                    fitur_text: '',
                    ikon: '',
                    urutan: 0,
                    status: 'aktif'
                },
                currentPage: 1,
                perPage: 10,

                // Opsi ikon siap pilih (value = inner-SVG, format sama dengan data lama)
                iconOptions: [
                    { label: 'Dokumen Kepabeanan', value: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />' },
                    { label: 'Truk Reefer', value: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM19 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5h1.5m0 0V7a1 1 0 011-1h9.5a1 1 0 011 1v2m-11.5 7.5h8m0 0V9m0 7.5h3m2.5 0H17m2.5 0V11a1 1 0 00-1-1h-3" />' },
                    { label: 'Kontainer', value: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 15.75l1.5-4.5h16.5l1.5 4.5m-19.5 0v3a1.5 1.5 0 001.5 1.5h16.5a1.5 1.5 0 001.5-1.5v-3m-19.5 0h19.5M6 11.25V6a1.5 1.5 0 011.5-1.5h9A1.5 1.5 0 0118 6v5.25" />' },
                    { label: 'Angkutan Darat', value: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />' },
                    { label: 'Kapal Laut', value: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 17l1.5-7h15L21 17M6 10V6a2 2 0 012-2h8a2 2 0 012 2v4M4 17c1.5 1 3.5 1 5 0s3.5-1 5 0 3.5 1 5 0 3.5-1 5 0" />' },
                    { label: 'Kargo Udara', value: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />' },
                    { label: 'Gudang', value: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />' },
                    { label: 'Cold Chain', value: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v18m0-18l3 3m-3-3l-3 3m0 12l3 3m0 0l3-3m-9-6h18m-18 0l3-3m-3 3l3 3m12-6l-3-3m3 3l-3 3" />' },
                    { label: 'Paket', value: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.27 6.96L12 12.01l8.73-5.05M12 22.08V12" />' },
                    { label: 'Jaringan Global', value: '<circle cx="12" cy="12" r="10" stroke-width="1.8" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" />' },
                    { label: 'Tepat Waktu', value: '<circle cx="12" cy="12" r="10" stroke-width="1.8" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2" />' },
                    { label: 'Jaminan Aman', value: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />' }
                ],

                init() {
                    this.fetchData();
                    this.$watch('searchQuery', () => { this.currentPage = 1; });
                    this.$watch('selectedStatus', () => { this.currentPage = 1; });

                    // Init/teardown TinyMCE saat modal dibuka/ditutup
                    this.$watch('isAddModalOpen', (value) => {
                        if (value) {
                            this.$nextTick(() => {
                                this.initTinyMCE('tinymce_singkat_add', '', true);
                                this.initTinyMCE('tinymce_lengkap_add', '');
                            });
                        } else {
                            this.destroyTinyMCE('tinymce_singkat_add');
                            this.destroyTinyMCE('tinymce_lengkap_add');
                        }
                    });

                    this.$watch('isEditModalOpen', (value) => {
                        if (value) {
                            this.$nextTick(() => {
                                this.initTinyMCE('tinymce_singkat_edit', this.formEdit.deskripsi_singkat || '', true);
                                this.initTinyMCE('tinymce_lengkap_edit', this.formEdit.deskripsi_lengkap || '');
                            });
                        } else {
                            this.destroyTinyMCE('tinymce_singkat_edit');
                            this.destroyTinyMCE('tinymce_lengkap_edit');
                        }
                    });
                },

                // TinyMCE helpers
                initTinyMCE(elementId, initialContent = '', compact = false) {
                    if (typeof tinymce === 'undefined') return;

                    tinymce.remove('#' + elementId);

                    const isDark = document.documentElement.classList.contains('dark');

                    tinymce.init({
                        selector: '#' + elementId,
                        height: compact ? 150 : 260,
                        menubar: false,
                        plugins: compact ? [] : [
                            'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                            'searchreplace', 'visualblocks', 'code', 'fullscreen',
                            'insertdatetime', 'table', 'help', 'wordcount'
                        ],
                        toolbar: compact
                            ? 'undo redo | bold italic underline | removeformat'
                            : 'undo redo | formatselect | bold italic underline strikethrough | ' +
                              'alignleft aligncenter alignright alignjustify | ' +
                              'bullist numlist blockquote | link table | removeformat code',
                        skin: isDark ? 'oxide-dark' : 'oxide',
                        content_css: isDark ? 'dark' : 'default',
                        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; }',
                        setup: (editor) => {
                            editor.on('init', () => {
                                editor.setContent(initialContent || '');
                            });
                        }
                    });
                },

                destroyTinyMCE(elementId) {
                    if (typeof tinymce !== 'undefined') {
                        tinymce.remove('#' + elementId);
                    }
                },

                getTinyMCEContent(elementId) {
                    if (typeof tinymce !== 'undefined' && tinymce.get(elementId)) {
                        return tinymce.get(elementId).getContent();
                    }
                    const el = document.getElementById(elementId);
                    return el ? el.value : '';
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

                openAddModal() {
                    this.formAdd = {
                        nama: '',
                        deskripsi_singkat: '',
                        deskripsi_lengkap: '',
                        fitur: '',
                        ikon: '',
                        urutan: this.layanans.length + 1,
                        status: 'aktif'
                    };
                    if (this.$refs.gambarAdd) this.$refs.gambarAdd.value = '';
                    this.isAddModalOpen = true;
                },

                async submitAdd() {
                    const singkat = this.getTinyMCEContent('tinymce_singkat_add').trim();
                    const lengkap = this.getTinyMCEContent('tinymce_lengkap_add').trim();

                    if (!this.formAdd.nama.trim() || !singkat || !lengkap) {
                        alert('Nama layanan dan kedua deskripsi wajib diisi.');
                        return;
                    }

                    this.isSubmitting = true;
                    try {
                        const formData = new FormData();
                        formData.append('nama', this.formAdd.nama);
                        formData.append('deskripsi_singkat', singkat);
                        formData.append('deskripsi_lengkap', lengkap);
                        formData.append('fitur', this.formAdd.fitur);
                        formData.append('ikon', this.formAdd.ikon);
                        formData.append('urutan', this.formAdd.urutan ?? 0);
                        formData.append('status', this.formAdd.status);
                        if (this.$refs.gambarAdd && this.$refs.gambarAdd.files[0]) {
                            formData.append('gambar', this.$refs.gambarAdd.files[0]);
                        }

                        const res = await fetch('{{ route('admin.layanan.store') }}', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        });
                        const result = await res.json();
                        if (result.status === 'success') {
                            await this.fetchData();
                            this.isAddModalOpen = false;
                        } else {
                            console.error(result.errors || result.message);
                        }
                    } catch (error) {
                        console.error(error);
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                openEditModal(item) {
                    this.formEdit = {
                        id: item.id,
                        nama: item.nama,
                        slug: item.slug,
                        deskripsi_singkat: item.deskripsi_singkat,
                        deskripsi_lengkap: item.deskripsi_lengkap,
                        fitur_text: (item.fitur || []).join('\n'),
                        ikon: item.ikon || '',
                        urutan: item.urutan,
                        status: item.status
                    };
                    if (this.$refs.gambarEdit) this.$refs.gambarEdit.value = '';
                    this.isEditModalOpen = true;
                },

                async submitEdit() {
                    const singkat = this.getTinyMCEContent('tinymce_singkat_edit').trim();
                    const lengkap = this.getTinyMCEContent('tinymce_lengkap_edit').trim();

                    if (!this.formEdit.nama.trim() || !singkat || !lengkap) {
                        alert('Nama layanan dan kedua deskripsi wajib diisi.');
                        return;
                    }

                    this.isSubmitting = true;
                    try {
                        const formData = new FormData();
                        formData.append('_method', 'PUT');
                        formData.append('nama', this.formEdit.nama);
                        formData.append('deskripsi_singkat', singkat);
                        formData.append('deskripsi_lengkap', lengkap);
                        formData.append('fitur', this.formEdit.fitur_text);
                        formData.append('ikon', this.formEdit.ikon);
                        formData.append('urutan', this.formEdit.urutan ?? 0);
                        formData.append('status', this.formEdit.status);

                        if (this.$refs.gambarEdit && this.$refs.gambarEdit.files[0]) {
                            formData.append('gambar', this.$refs.gambarEdit.files[0]);
                        }

                        const res = await fetch(`{{ url('admin/layanan') }}/${this.formEdit.id}`, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        });
                        const result = await res.json();
                        if (result.status === 'success') {
                            await this.fetchData();
                            this.isEditModalOpen = false;
                        } else {
                            console.error(result.errors || result.message);
                        }
                    } catch (error) {
                        console.error(error);
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                openDetailModal(item) {
                    this.selectedItem = item;
                    this.isDetailModalOpen = true;
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
