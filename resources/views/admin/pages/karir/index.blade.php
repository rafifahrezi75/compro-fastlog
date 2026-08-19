@extends('admin.layouts.app')

@section('page_title', 'Karir')
@section('content')
    <div x-data="karirManager()" x-init="init()" class="space-y-6 max-w-full overflow-x-hidden">
        <!-- Breadcrumb & Header Section -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1
                    class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center gap-2.5">
                    <span class="p-2 rounded-xl bg-brand-500/10 text-brand-500 dark:bg-brand-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M20 7H4C2.89543 7 2 7.89543 2 9V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19V9C22 7.89543 21.1046 7 20 7Z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M16 21V5C16 4.46957 15.7893 3.96086 15.4142 3.58579C15.0391 3.21071 14.5304 3 14 3H10C9.46957 3 8.96086 3.21071 8.58579 3.58579C8.21071 3.96086 8 4.46957 8 5V21">
                            </path>
                        </svg>
                    </span>
                    Master Data Karir & Lowongan
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Kelola informasi lowongan pekerjaan, kualifikasi persyaratan, serta penempatan kantor cabang Fastlog.
                </p>
            </div>

            <!-- Action CTA -->
            <div class="flex items-center gap-2.5 flex-wrap">
                <button @click="openAddModal()" type="button"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 rounded-xl hover:bg-brand-600 focus:ring-4 focus:ring-brand-500/20 transition-all shadow-sm shadow-brand-500/20 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Karir Baru
                </button>
            </div>
        </div>

        <!-- Stat Summary Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
            <!-- Total Lowongan -->
            <div
                class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
                <div
                    class="w-11 h-11 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M20 7H4C2.89543 7 2 7.89543 2 9V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19V9C22 7.89543 21.1046 7 20 7Z">
                        </path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Total Posisi</p>
                    <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mt-0.5" x-text="karirs.length">0
                    </h4>
                </div>
            </div>

            <!-- Lowongan Aktif -->
            <div
                class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
                <div
                    class="w-11 h-11 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Lowongan Aktif</p>
                    <h4 class="text-lg sm:text-xl font-bold text-emerald-600 dark:text-emerald-400 mt-0.5"
                        x-text="countAktif()">0</h4>
                </div>
            </div>

            <!-- Lowongan Tutup / Draft -->
            <div
                class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
                <div
                    class="w-11 h-11 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Tutup / Draft</p>
                    <h4 class="text-lg sm:text-xl font-bold text-amber-600 dark:text-amber-400 mt-0.5"
                        x-text="countTutup()">0</h4>
                </div>
            </div>

            <!-- Kota & Penempatan -->
            <div
                class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
                <div
                    class="w-11 h-11 rounded-xl bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Kota Penempatan</p>
                    <h4 class="text-lg sm:text-xl font-bold text-purple-600 dark:text-purple-400 mt-0.5"
                        x-text="countCities()">0</h4>
                </div>
            </div>
        </div>

        <!-- Main Table Container -->
        <div
            class="rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
            <!-- Filter & Search Toolbar (Di kanan sendiri seperti master lainnya) -->
            <div
                class="p-4 sm:p-5 border-b border-gray-100 dark:border-gray-800 flex flex-col lg:flex-row gap-3.5 lg:items-center lg:justify-between bg-gray-50/50 dark:bg-white/[0.01]">
                <!-- Search Box (Kiri) -->
                <div class="relative flex-1 min-w-[240px] max-w-lg">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" x-model="searchQuery" @input="currentPage = 1"
                        placeholder="Cari posisi karir, kota, provinsi, departemen..."
                        class="w-full pl-9 pr-8 py-2 text-xs sm:text-sm bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all outline-none" />
                    <button x-show="searchQuery" @click="searchQuery = ''; currentPage = 1"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Filter Controls (Di Kanan Sendiri) -->
                <div class="flex items-center gap-2.5 flex-wrap justify-end">
                    <!-- Filter Status -->
                    <div
                        class="flex items-center gap-1.5 bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700 rounded-xl px-2.5 py-1.5">
                        <span class="text-xs text-gray-400 font-medium hidden sm:inline">Status:</span>
                        <select x-model="selectedStatus" @change="currentPage = 1"
                            class="bg-transparent text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-200 outline-none cursor-pointer pr-2">
                            <option value="Semua" class="dark:bg-gray-800">Semua Status</option>
                            <option value="Aktif" class="dark:bg-gray-800">Aktif</option>
                            <option value="Tutup" class="dark:bg-gray-800">Tutup</option>
                            <option value="Draft" class="dark:bg-gray-800">Draft</option>
                        </select>
                    </div>

                    <!-- Filter Provinsi -->
                    <div
                        class="flex items-center gap-1.5 bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700 rounded-xl px-2.5 py-1.5">
                        <span class="text-xs text-gray-400 font-medium hidden sm:inline">Provinsi:</span>
                        <select x-model="selectedProvinsi" @change="currentPage = 1"
                            class="bg-transparent text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-200 outline-none cursor-pointer pr-2 max-w-[170px] truncate">
                            <option value="Semua" class="dark:bg-gray-800">Semua Provinsi</option>
                            <template x-for="prov in uniqueProvinces" :key="prov">
                                <option :value="prov" x-text="prov" class="dark:bg-gray-800"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Reset Filter -->
                    <button x-show="searchQuery || selectedStatus !== 'Semua' || selectedProvinsi !== 'Semua'"
                        @click="resetFilters()"
                        class="text-xs font-medium text-brand-500 hover:text-brand-600 dark:hover:text-brand-400 px-2.5 py-2 hover:bg-brand-50 dark:hover:bg-brand-500/10 rounded-xl transition-all cursor-pointer">
                        Reset Filter
                    </button>
                </div>
            </div>

            <!-- Responsive Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-white/[0.01]">
                            <th
                                class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase">
                                #
                            </th>
                            <th
                                class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase">
                                Posisi Karir / Departemen
                            </th>
                            <th
                                class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase">
                                Lokasi Penempatan
                            </th>
                            <th
                                class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase">
                                Tipe Pekerjaan
                            </th>
                            <th
                                class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase text-center">
                                Status
                            </th>
                            <th
                                class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase text-right">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-xs sm:text-sm">
                        <template x-for="(item, index) in paginatedKarirs" :key="item.id">
                            <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-800/40 transition-colors">
                                <!-- No -->
                                <td class="py-3.5 px-3.5 sm:px-5 font-mono text-gray-400 dark:text-gray-500 text-xs"
                                    x-text="((currentPage - 1) * perPage) + index + 1"></td>

                                <!-- Posisi Karir & Departemen (Tanpa Display Slug) -->
                                <td class="py-3.5 px-3.5 sm:px-5 min-w-[220px]">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-brand-50 dark:bg-brand-500/10 text-brand-500 flex items-center justify-center shrink-0 mt-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-white"
                                                x-text="item.nama_karir"></h4>
                                            <div class="flex items-center gap-2 mt-1 flex-wrap">
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-medium bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300"
                                                    x-text="item.departemen || 'Operations'"></span>

                                                <a :href="'/admin/pelamar?posisi=' + encodeURIComponent(item.nama_karir)"
                                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-semibold bg-brand-50 hover:bg-brand-100 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400 dark:hover:bg-brand-500/20 transition cursor-pointer"
                                                    title="Klik untuk melihat daftar pelamar posisi ini">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                                                        <circle cx="9" cy="7" r="4" />
                                                        <path d="M22 21v-2a4 4 0 00-3-3.87" />
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                    </svg>
                                                    <span x-text="(item.pelamars_count || 0) + ' Pelamar'"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Lokasi Karir (Kota, Provinsi, Negara) -->
                                <td class="py-3.5 px-3.5 sm:px-5 min-w-[200px]">
                                    <div class="flex items-start gap-1.5 text-gray-700 dark:text-gray-300">
                                        <svg class="w-4 h-4 text-rose-500 shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">
                                                <span x-text="item.kota"></span>, <span x-text="item.provinsi"></span>
                                            </p>
                                            <p class="text-xs text-gray-400 line-clamp-1 mt-0.5"
                                                x-text="item.alamat_detail"></p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Tipe Pekerjaan -->
                                <td class="py-3.5 px-3.5 sm:px-5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-400 border border-blue-200 dark:border-blue-800"
                                        x-text="item.tipe_pekerjaan || 'Full-Time'"></span>
                                </td>

                                <!-- Status -->
                                <td class="py-3.5 px-3.5 sm:px-5 text-center whitespace-nowrap">
                                    <template x-if="item.status === 'Aktif'">
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Aktif
                                        </span>
                                    </template>
                                    <template x-if="item.status === 'Tutup'">
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-rose-50 text-rose-700 dark:bg-rose-950/40 dark:text-rose-400 border border-rose-200 dark:border-rose-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            Tutup
                                        </span>
                                    </template>
                                    <template x-if="item.status === 'Draft'">
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Draft
                                        </span>
                                    </template>
                                </td>

                                <!-- Aksi -->
                                <td class="py-3.5 px-3.5 sm:px-5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <!-- Detail -->
                                        <button @click="openDetailModal(item)" type="button" title="Lihat Detail Karir"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-500/10 transition-colors cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </button>

                                        <!-- Edit -->
                                        <button @click="openEditModal(item)" type="button" title="Ubah Data Karir"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 transition-colors cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>

                                        <!-- Delete -->
                                        <button @click="openDeleteModal(item)" type="button" title="Hapus Karir"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        <!-- Empty State -->
                        <tr x-show="filteredKarirs.length === 0">
                            <td colspan="6" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                    <div
                                        class="w-14 h-14 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 mb-3">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 7H4C2.89543 7 2 7.89543 2 9V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19V9C22 7.89543 21.1046 7 20 7Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Tidak Ada Data Karir
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 text-center">
                                        Tidak ditemukan lowongan karir yang cocok dengan kata kunci atau filter saat ini.
                                    </p>
                                    <button @click="resetFilters()"
                                        class="mt-4 px-3.5 py-1.5 text-xs font-medium text-brand-500 bg-brand-50 dark:bg-brand-500/10 rounded-lg hover:bg-brand-100 transition-colors cursor-pointer">
                                        Reset Semua Filter
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table Footer & Pagination -->
            <div
                class="p-3.5 sm:p-4 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-gray-500 dark:text-gray-400 bg-gray-50/30 dark:bg-white/[0.01]">
                <div>
                    Menampilkan
                    <span class="font-semibold text-gray-900 dark:text-white"
                        x-text="filteredKarirs.length > 0 ? ((currentPage - 1) * perPage) + 1 : 0"></span> -
                    <span class="font-semibold text-gray-900 dark:text-white"
                        x-text="Math.min(currentPage * perPage, filteredKarirs.length)"></span>
                    dari <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredKarirs.length"></span>
                    posisi karir
                </div>

                <!-- Pagination Controls (Muncul otomatis jika data > 10) -->
                <template x-if="filteredKarirs.length > 10">
                    <div class="flex items-center gap-1.5 self-center sm:self-auto">
                        <button @click="prevPage()" :disabled="currentPage === 1"
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <span>Sebelumnya</span>
                        </button>

                        <template x-for="page in totalPages" :key="page">
                            <button @click="goToPage(page)"
                                :class="currentPage === page ? 'bg-brand-500 text-white font-semibold shadow-xs' :
                                    'border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'"
                                class="min-w-[32px] h-8 rounded-lg text-xs font-medium transition flex items-center justify-center px-2 cursor-pointer"
                                x-text="page"></button>
                        </template>

                        <button @click="nextPage()" :disabled="currentPage === totalPages"
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition cursor-pointer">
                            <span>Selanjutnya</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- MODAL: TAMBAH KARIR BARU                                                 -->
        <!-- ========================================================================= -->
        <div x-show="isAddModalOpen" x-cloak
            class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm overflow-y-auto"
            @keydown.escape.window="closeAddModal()">
            <div x-show="isAddModalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-2xl rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden my-8">
                <!-- Modal Header -->
                <div class="px-6 py-4.5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-xl bg-brand-50 dark:bg-brand-500/10 text-brand-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Tambah Lowongan Karir</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Lengkapi detail posisi, wilayah penempatan,
                                dan poin kualifikasi.</p>
                        </div>
                    </div>
                    <button @click="closeAddModal()"
                        class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body Form -->
                <form @submit.prevent="submitAddKarir()" class="p-6 space-y-4 max-h-[78vh] overflow-y-auto">
                    <!-- Baris 1: Judul / Posisi Karir (1 Baris Penuh) -->
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                            Nama Posisi Karir <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" x-model="formAdd.nama_karir"
                            @input="formAdd.slug = generateSlug(formAdd.nama_karir)"
                            placeholder="Contoh: Sea Freight Operations Officer / Customs Specialist" required
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                        <input type="hidden" x-model="formAdd.slug" />
                    </div>

                    <!-- Baris 2: Departemen & Tipe Pekerjaan (1 Baris - 2 Kolom) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Departemen
                            </label>
                            <input type="text" x-model="formAdd.departemen"
                                placeholder="Contoh: Operations / Logistics / Finance"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                        </div>

                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Tipe Pekerjaan
                            </label>
                            <select x-model="formAdd.tipe_pekerjaan"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                                <option value="Full-Time">Full-Time (Penuh Waktu)</option>
                                <option value="Part-Time">Part-Time (Paruh Waktu)</option>
                                <option value="Contract">Contract (Kontrak)</option>
                                <option value="Internship">Internship (Magang)</option>
                                <option value="Remote / Hybrid">Remote / Hybrid</option>
                            </select>
                        </div>
                    </div>

                    <!-- Baris 3: Alamat Karir - PROVINSI DULU BARU KOTA (Cascading Select) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Provinsi <span class="text-rose-500">*</span>
                            </label>
                            <select x-model="formAdd.provinsi_kode" @change="onProvinsiAddChange()" required
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                                <option value="" disabled selected>-- Pilih Provinsi --</option>
                                <template x-for="p in masterProvinsiList" :key="p.kode">
                                    <option :value="p.kode" x-text="p.nama"></option>
                                </template>
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Kota / Kabupaten <span class="text-rose-500">*</span>
                            </label>
                            <select x-model="formAdd.kota" :disabled="!formAdd.provinsi_kode" required
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none disabled:opacity-50 disabled:bg-gray-50 dark:disabled:bg-gray-900 disabled:cursor-not-allowed">
                                <option value="" disabled selected
                                    x-text="formAdd.provinsi_kode ? '-- Pilih Kota / Kabupaten --' : '-- Pilih Provinsi Terlebih Dahulu --'">
                                </option>
                                <template x-for="k in formAdd.kotaList" :key="k">
                                    <option :value="k" x-text="k"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <!-- Baris 4: Negara & Status (1 Baris - 2 Kolom) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Negara
                            </label>
                            <input type="text" x-model="formAdd.negara" placeholder="Indonesia"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                        </div>

                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Status Lowongan
                            </label>
                            <select x-model="formAdd.status"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                                <option value="Aktif">Aktif (Buka Pendaftaran)</option>
                                <option value="Tutup">Tutup (Closed)</option>
                                <option value="Draft">Draft (Simpan Sementara)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Baris 5: Alamat Detail (1 Baris Penuh) -->
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                            Alamat Detail Penempatan <span class="text-rose-500">*</span>
                        </label>
                        <textarea x-model="formAdd.alamat_detail" rows="2" required
                            placeholder="Contoh: Gedung Fastlog Hub Perak, Jl. Tanjung Perak Timur No. 88, Pabean Cantian, Surabaya 60165"
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none"></textarea>
                    </div>

                    <!-- Baris 6: Deskripsi Pekerjaan -->
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                            Deskripsi Pekerjaan
                        </label>
                        <textarea x-model="formAdd.deskripsi" rows="3"
                            placeholder="Jelaskan ringkasan tugas dan tanggung jawab posisi ini..."
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none"></textarea>
                    </div>

                    <!-- Baris 7: Kualifikasi & Persyaratan DYNAMIC POINTS (+ / -) -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Kualifikasi & Persyaratan <span class="text-rose-500">*</span>
                            </label>
                            <button type="button" @click="addKualifikasiPoint('add')"
                                class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-lg bg-brand-500/10 text-brand-600 hover:bg-brand-500/20 dark:text-brand-400 transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Poin
                            </button>
                        </div>

                        <div class="space-y-2.5">
                            <template x-for="(point, idx) in formAdd.kualifikasi_list" :key="idx">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="w-6 h-6 rounded-lg bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400 text-xs font-bold flex items-center justify-center shrink-0"
                                        x-text="idx + 1"></span>
                                    <input type="text" x-model="formAdd.kualifikasi_list[idx]"
                                        placeholder="Contoh: Pendidikan minimal D3 / S1 semua jurusan"
                                        class="flex-1 px-3.5 py-2 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                                    <button type="button" @click="removeKualifikasiPoint('add', idx)"
                                        :disabled="formAdd.kualifikasi_list.length === 1"
                                        class="p-2 text-gray-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-xl transition disabled:opacity-30 disabled:cursor-not-allowed cursor-pointer"
                                        title="Hapus Poin">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <p class="text-[11px] text-gray-400 mt-1.5">Klik <strong>+ Tambah Poin</strong> untuk menambah
                            butir persyaratan kualifikasi kerja.</p>
                    </div>

                    <!-- Actions Footer -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-end gap-2.5">
                        <button type="button" @click="closeAddModal()"
                            class="px-4 py-2.5 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" :disabled="isSubmitting"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all shadow-sm shadow-brand-500/20 disabled:opacity-50 cursor-pointer">
                            <template x-if="isSubmitting">
                                <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                            </template>
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan Data Karir'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- MODAL: UBAH DATA KARIR                                                    -->
        <!-- ========================================================================= -->
        <div x-show="isEditModalOpen" x-cloak
            class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm overflow-y-auto"
            @keydown.escape.window="closeEditModal()">
            <div x-show="isEditModalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-2xl rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden my-8">
                <!-- Modal Header -->
                <div class="px-6 py-4.5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Ubah Data Karir</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Perbarui informasi posisi, lokasi, atau
                                butir kualifikasi.</p>
                        </div>
                    </div>
                    <button @click="closeEditModal()"
                        class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body Form -->
                <form @submit.prevent="submitEditKarir()" class="p-6 space-y-4 max-h-[78vh] overflow-y-auto">
                    <!-- Baris 1: Judul / Posisi Karir -->
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                            Nama Posisi Karir <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" x-model="formEdit.nama_karir"
                            @input="formEdit.slug = generateSlug(formEdit.nama_karir)" required
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                        <input type="hidden" x-model="formEdit.slug" />
                    </div>

                    <!-- Baris 2: Departemen & Tipe Pekerjaan -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Departemen
                            </label>
                            <input type="text" x-model="formEdit.departemen"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                        </div>

                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Tipe Pekerjaan
                            </label>
                            <select x-model="formEdit.tipe_pekerjaan"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                                <option value="Full-Time">Full-Time (Penuh Waktu)</option>
                                <option value="Part-Time">Part-Time (Paruh Waktu)</option>
                                <option value="Contract">Contract (Kontrak)</option>
                                <option value="Internship">Internship (Magang)</option>
                                <option value="Remote / Hybrid">Remote / Hybrid</option>
                            </select>
                        </div>
                    </div>

                    <!-- Baris 3: Alamat Karir - PROVINSI DULU BARU KOTA (Cascading Select) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Provinsi <span class="text-rose-500">*</span>
                            </label>
                            <select x-model="formEdit.provinsi_kode" @change="onProvinsiEditChange()" required
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                                <option value="" disabled selected>-- Pilih Provinsi --</option>
                                <template x-for="p in masterProvinsiList" :key="p.kode">
                                    <option :value="p.kode" x-text="p.nama"></option>
                                </template>
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Kota / Kabupaten <span class="text-rose-500">*</span>
                            </label>
                            <select x-model="formEdit.kota" :disabled="!formEdit.provinsi_kode" required
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none disabled:opacity-50 disabled:bg-gray-50 dark:disabled:bg-gray-900 disabled:cursor-not-allowed">
                                <option value="" disabled selected
                                    x-text="formEdit.provinsi_kode ? '-- Pilih Kota / Kabupaten --' : '-- Pilih Provinsi Terlebih Dahulu --'">
                                </option>
                                <template x-for="k in formEdit.kotaList" :key="k">
                                    <option :value="k" x-text="k"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <!-- Baris 4: Negara & Status -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Negara
                            </label>
                            <input type="text" x-model="formEdit.negara"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                        </div>

                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Status Lowongan
                            </label>
                            <select x-model="formEdit.status"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                                <option value="Aktif">Aktif (Buka Pendaftaran)</option>
                                <option value="Tutup">Tutup (Closed)</option>
                                <option value="Draft">Draft (Simpan Sementara)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Baris 5: Alamat Detail -->
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                            Alamat Detail Penempatan <span class="text-rose-500">*</span>
                        </label>
                        <textarea x-model="formEdit.alamat_detail" rows="2" required
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none"></textarea>
                    </div>

                    <!-- Baris 6: Deskripsi Pekerjaan -->
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                            Deskripsi Pekerjaan
                        </label>
                        <textarea x-model="formEdit.deskripsi" rows="3"
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none"></textarea>
                    </div>

                    <!-- Baris 7: Kualifikasi & Persyaratan DYNAMIC POINTS (+ / -) -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Kualifikasi & Persyaratan <span class="text-rose-500">*</span>
                            </label>
                            <button type="button" @click="addKualifikasiPoint('edit')"
                                class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-lg bg-brand-500/10 text-brand-600 hover:bg-brand-500/20 dark:text-brand-400 transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Poin
                            </button>
                        </div>

                        <div class="space-y-2.5">
                            <template x-for="(point, idx) in formEdit.kualifikasi_list" :key="idx">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="w-6 h-6 rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 text-xs font-bold flex items-center justify-center shrink-0"
                                        x-text="idx + 1"></span>
                                    <input type="text" x-model="formEdit.kualifikasi_list[idx]"
                                        placeholder="Contoh: Pengalaman minimal 1-2 tahun di bidang terkait"
                                        class="flex-1 px-3.5 py-2 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                                    <button type="button" @click="removeKualifikasiPoint('edit', idx)"
                                        :disabled="formEdit.kualifikasi_list.length === 1"
                                        class="p-2 text-gray-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-xl transition disabled:opacity-30 disabled:cursor-not-allowed cursor-pointer"
                                        title="Hapus Poin">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <p class="text-[11px] text-gray-400 mt-1.5">Klik <strong>+ Tambah Poin</strong> untuk menambah
                            butir persyaratan kualifikasi kerja.</p>
                    </div>

                    <!-- Actions Footer -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-end gap-2.5">
                        <button type="button" @click="closeEditModal()"
                            class="px-4 py-2.5 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" :disabled="isSubmitting"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all shadow-sm shadow-brand-500/20 disabled:opacity-50 cursor-pointer">
                            <template x-if="isSubmitting">
                                <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                            </template>
                            <span x-text="isSubmitting ? 'Memperbarui...' : 'Simpan Perubahan'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- MODAL: DETAIL KARIR & PERSYARATAN                                         -->
        <!-- ========================================================================= -->
        <div x-show="isDetailModalOpen" x-cloak
            class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm overflow-y-auto"
            @keydown.escape.window="closeDetailModal()">
            <div x-show="isDetailModalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-2xl rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden my-8">
                <template x-if="selectedItem">
                    <div>
                        <!-- Header Detail -->
                        <div
                            class="px-6 py-4.5 border-b border-gray-100 dark:border-gray-800 flex items-start justify-between">
                            <div>
                                <div class="flex items-center gap-2 flex-wrap mb-1.5">
                                    <span
                                        class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400"
                                        x-text="selectedItem.departemen || 'Operations'"></span>
                                    <span
                                        class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300"
                                        x-text="selectedItem.tipe_pekerjaan || 'Full-Time'"></span>
                                    <span
                                        :class="selectedItem.status === 'Aktif' ?
                                            'bg-emerald-50 text-emerald-700 border-emerald-200' :
                                            'bg-rose-50 text-rose-700 border-rose-200'"
                                        class="px-2.5 py-0.5 rounded-full text-xs font-semibold border"
                                        x-text="selectedItem.status"></span>
                                </div>
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white"
                                    x-text="selectedItem.nama_karir"></h3>
                            </div>
                            <button @click="closeDetailModal()"
                                class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg cursor-pointer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Body Detail -->
                        <div class="p-6 space-y-5 max-h-[75vh] overflow-y-auto">
                            <!-- Info Pelamar Masuk -->
                            <div
                                class="p-4 rounded-xl bg-brand-50/60 dark:bg-brand-500/10 border border-brand-200 dark:border-brand-500/20 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-brand-500 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">Total Kandidat
                                            Pelamar:</span>
                                        <h4 class="text-base font-bold text-gray-900 dark:text-white"
                                            x-text="(selectedItem.pelamars_count || 0) + ' Orang Mendaftar'"></h4>
                                    </div>
                                </div>
                                <a :href="'/admin/pelamar?posisi=' + encodeURIComponent(selectedItem.nama_karir)"
                                    class="inline-flex items-center justify-center gap-1.5 px-3.5 py-2 text-xs font-semibold text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition shadow-xs">
                                    <span>Lihat Daftar Pelamar</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                            <!-- Info Lokasi Penempatan -->
                            <div
                                class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700/60 space-y-2">
                                <div
                                    class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-brand-600 dark:text-brand-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Lokasi & Alamat Penempatan
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-xs">
                                    <div>
                                        <span class="text-gray-400">Kota / Kabupaten:</span>
                                        <p class="font-semibold text-gray-900 dark:text-white mt-0.5"
                                            x-text="selectedItem.kota"></p>
                                    </div>
                                    <div>
                                        <span class="text-gray-400">Provinsi:</span>
                                        <p class="font-semibold text-gray-900 dark:text-white mt-0.5"
                                            x-text="selectedItem.provinsi"></p>
                                    </div>
                                    <div>
                                        <span class="text-gray-400">Negara:</span>
                                        <p class="font-semibold text-gray-900 dark:text-white mt-0.5"
                                            x-text="selectedItem.negara || 'Indonesia'"></p>
                                    </div>
                                </div>
                                <div class="pt-2 border-t border-gray-200 dark:border-gray-700 text-xs">
                                    <span class="text-gray-400">Alamat Lengkap:</span>
                                    <p class="font-medium text-gray-800 dark:text-gray-200 mt-1"
                                        x-text="selectedItem.alamat_detail"></p>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <h4
                                    class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">
                                    Deskripsi Pekerjaan
                                </h4>
                                <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 whitespace-pre-line leading-relaxed"
                                    x-text="selectedItem.deskripsi || 'Tidak ada deskripsi pekerjaan.'"></p>
                            </div>

                            <!-- Kualifikasi Poin List -->
                            <div>
                                <h4
                                    class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2.5 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Kualifikasi & Persyaratan
                                </h4>
                                <div
                                    class="p-4 bg-gray-50 dark:bg-gray-800/40 rounded-xl border border-gray-100 dark:border-gray-800">
                                    <template
                                        x-if="selectedItem.kualifikasi_array && selectedItem.kualifikasi_array.length > 0">
                                        <ul class="space-y-2">
                                            <template x-for="(req, rIdx) in selectedItem.kualifikasi_array"
                                                :key="rIdx">
                                                <li
                                                    class="flex items-start gap-2.5 text-xs sm:text-sm text-gray-700 dark:text-gray-200">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full bg-brand-500 mt-1.5 shrink-0"></span>
                                                    <span x-text="req"></span>
                                                </li>
                                            </template>
                                        </ul>
                                    </template>
                                    <template
                                        x-if="!selectedItem.kualifikasi_array || selectedItem.kualifikasi_array.length === 0">
                                        <p class="text-xs text-gray-400"
                                            x-text="selectedItem.kualifikasi || 'Tidak ada persyaratan khusus.'"></p>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Detail -->
                        <div
                            class="px-6 py-4 border-t border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-white/[0.02] flex items-center justify-end gap-2.5">
                            <button @click="closeDetailModal(); openEditModal(selectedItem)" type="button"
                                class="px-4 py-2 text-xs sm:text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition cursor-pointer">
                                Ubah Lowongan
                            </button>
                            <button @click="closeDetailModal()" type="button"
                                class="px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition cursor-pointer">
                                Tutup
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- MODAL: KONFIRMASI HAPUS KARIR                                             -->
        <!-- ========================================================================= -->
        <div x-show="isDeleteModalOpen" x-cloak
            class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm"
            @keydown.escape.window="closeDeleteModal()">
            <div x-show="isDeleteModalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-md rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden p-6 text-center">
                <!-- Delete Icon -->
                <div
                    class="w-12 h-12 rounded-2xl bg-rose-50 dark:bg-rose-950/40 text-rose-500 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </div>

                <h3 class="text-base font-bold text-gray-900 dark:text-white">Hapus Lowongan Karir?</h3>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1.5">
                    Apakah Anda yakin ingin menghapus posisi <strong class="text-gray-900 dark:text-white"
                        x-text="itemToDelete?.nama_karir"></strong>? Tindakan ini tidak dapat dibatalkan.
                </p>

                <!-- Actions -->
                <div class="mt-6 flex items-center justify-center gap-3">
                    <button type="button" @click="closeDeleteModal()"
                        class="w-full px-4 py-2.5 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition cursor-pointer">
                        Batal
                    </button>
                    <button type="button" @click="executeDeleteKarir()" :disabled="isSubmitting"
                        class="w-full px-4 py-2.5 text-xs sm:text-sm font-medium text-white bg-rose-500 hover:bg-rose-600 rounded-xl transition shadow-sm shadow-rose-500/20 disabled:opacity-50 cursor-pointer">
                        <span x-text="isSubmitting ? 'Menghapus...' : 'Ya, Hapus'"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- FLOATING TOAST NOTIFICATION                                               -->
        <!-- ========================================================================= -->
        <div x-show="toast.visible" x-cloak x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            class="fixed bottom-6 right-6 z-99999 max-w-md p-4 rounded-2xl bg-gray-900 dark:bg-white text-white dark:text-gray-900 shadow-2xl border border-gray-800 dark:border-gray-200 flex items-center gap-3">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shrink-0"></span>
            <p class="text-xs sm:text-sm font-medium" x-text="toast.message"></p>
        </div>
    </div>

    <script>
        function karirManager() {
            return {
                karirs: @json($karirs ?? []),
                masterProvinsiList: @json($masterProvinsiList ?? []),
                masterKotaMap: @json($masterKotaMap ?? []),

                searchQuery: '',
                selectedStatus: 'Semua',
                selectedProvinsi: 'Semua',
                currentPage: 1,
                perPage: 10,
                isSubmitting: false,

                // Modals state
                isAddModalOpen: false,
                isEditModalOpen: false,
                isDetailModalOpen: false,
                isDeleteModalOpen: false,

                selectedItem: null,
                itemToDelete: null,

                // Form state
                formAdd: {
                    nama_karir: '',
                    slug: '',
                    provinsi_kode: '',
                    provinsi: '',
                    kota: '',
                    kotaList: [],
                    negara: 'Indonesia',
                    alamat_detail: '',
                    tipe_pekerjaan: 'Full-Time',
                    departemen: 'Operations',
                    deskripsi: '',
                    kualifikasi_list: [''],
                    status: 'Aktif',
                },

                formEdit: {
                    id: null,
                    nama_karir: '',
                    slug: '',
                    provinsi_kode: '',
                    provinsi: '',
                    kota: '',
                    kotaList: [],
                    negara: 'Indonesia',
                    alamat_detail: '',
                    tipe_pekerjaan: 'Full-Time',
                    departemen: 'Operations',
                    deskripsi: '',
                    kualifikasi_list: [''],
                    status: 'Aktif',
                },

                toast: {
                    visible: false,
                    message: '',
                    timeout: null
                },

                init() {
                    console.log('KarirManager initialized with ' + this.karirs.length + ' items');
                },

                showToast(message) {
                    this.toast.message = message;
                    this.toast.visible = true;
                    if (this.toast.timeout) clearTimeout(this.toast.timeout);
                    this.toast.timeout = setTimeout(() => {
                        this.toast.visible = false;
                    }, 3500);
                },

                generateSlug(text) {
                    if (!text) return '';
                    return text.toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .trim();
                },

                // Cascading Wilayah Handlers
                onProvinsiAddChange() {
                    const provObj = this.masterProvinsiList.find(p => p.kode === this.formAdd.provinsi_kode);
                    this.formAdd.provinsi = provObj ? provObj.nama : '';
                    this.formAdd.kotaList = this.masterKotaMap[this.formAdd.provinsi_kode] || [];
                    this.formAdd.kota = '';
                },

                onProvinsiEditChange() {
                    const provObj = this.masterProvinsiList.find(p => p.kode === this.formEdit.provinsi_kode);
                    this.formEdit.provinsi = provObj ? provObj.nama : '';
                    this.formEdit.kotaList = this.masterKotaMap[this.formEdit.provinsi_kode] || [];
                    this.formEdit.kota = '';
                },

                // Kualifikasi Points Dynamic Handlers
                addKualifikasiPoint(mode) {
                    if (mode === 'add') {
                        this.formAdd.kualifikasi_list.push('');
                    } else {
                        this.formEdit.kualifikasi_list.push('');
                    }
                },

                removeKualifikasiPoint(mode, idx) {
                    if (mode === 'add') {
                        if (this.formAdd.kualifikasi_list.length > 1) {
                            this.formAdd.kualifikasi_list.splice(idx, 1);
                        }
                    } else {
                        if (this.formEdit.kualifikasi_list.length > 1) {
                            this.formEdit.kualifikasi_list.splice(idx, 1);
                        }
                    }
                },

                get uniqueProvinces() {
                    const provs = this.karirs.map(k => k.provinsi).filter(Boolean);
                    return [...new Set(provs)].sort();
                },

                get filteredKarirs() {
                    return this.karirs.filter(item => {
                        const query = this.searchQuery.toLowerCase().trim();
                        const matchesSearch = !query ||
                            (item.nama_karir && item.nama_karir.toLowerCase().includes(query)) ||
                            (item.kota && item.kota.toLowerCase().includes(query)) ||
                            (item.provinsi && item.provinsi.toLowerCase().includes(query)) ||
                            (item.negara && item.negara.toLowerCase().includes(query)) ||
                            (item.alamat_detail && item.alamat_detail.toLowerCase().includes(query)) ||
                            (item.departemen && item.departemen.toLowerCase().includes(query)) ||
                            (item.tipe_pekerjaan && item.tipe_pekerjaan.toLowerCase().includes(query));

                        const matchesStatus = this.selectedStatus === 'Semua' || item.status === this
                            .selectedStatus;
                        const matchesProv = this.selectedProvinsi === 'Semua' || item.provinsi === this
                            .selectedProvinsi;

                        return matchesSearch && matchesStatus && matchesProv;
                    });
                },

                get totalPages() {
                    return Math.ceil(this.filteredKarirs.length / this.perPage) || 1;
                },

                get paginatedKarirs() {
                    const start = (this.currentPage - 1) * this.perPage;
                    return this.filteredKarirs.slice(start, start + this.perPage);
                },

                goToPage(page) {
                    if (page >= 1 && page <= this.totalPages) {
                        this.currentPage = page;
                    }
                },

                prevPage() {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                    }
                },

                nextPage() {
                    if (this.currentPage < this.totalPages) {
                        this.currentPage++;
                    }
                },

                resetFilters() {
                    this.searchQuery = '';
                    this.selectedStatus = 'Semua';
                    this.selectedProvinsi = 'Semua';
                    this.currentPage = 1;
                },

                countAktif() {
                    return this.karirs.filter(k => k.status === 'Aktif').length;
                },

                countTutup() {
                    return this.karirs.filter(k => k.status === 'Tutup' || k.status === 'Draft').length;
                },

                countCities() {
                    const cities = this.karirs.map(k => k.kota).filter(Boolean);
                    return [...new Set(cities)].length;
                },

                // Add Modal Functions
                openAddModal() {
                    this.formAdd = {
                        nama_karir: '',
                        slug: '',
                        provinsi_kode: '',
                        provinsi: '',
                        kota: '',
                        kotaList: [],
                        negara: 'Indonesia',
                        alamat_detail: '',
                        tipe_pekerjaan: 'Full-Time',
                        departemen: 'Operations',
                        deskripsi: '',
                        kualifikasi_list: [''],
                        status: 'Aktif',
                    };
                    this.isAddModalOpen = true;
                },

                closeAddModal() {
                    this.isAddModalOpen = false;
                },

                async submitAddKarir() {
                    this.isSubmitting = true;

                    // Filter out empty qualification points
                    const filteredPoints = this.formAdd.kualifikasi_list.map(p => p.trim()).filter(Boolean);

                    const payload = {
                        _token: '{{ csrf_token() }}',
                        nama_karir: this.formAdd.nama_karir,
                        slug: this.formAdd.slug || this.generateSlug(this.formAdd.nama_karir),
                        kota: this.formAdd.kota,
                        provinsi: this.formAdd.provinsi,
                        negara: this.formAdd.negara || 'Indonesia',
                        alamat_detail: this.formAdd.alamat_detail,
                        tipe_pekerjaan: this.formAdd.tipe_pekerjaan || 'Full-Time',
                        departemen: this.formAdd.departemen || 'Operations',
                        deskripsi: this.formAdd.deskripsi,
                        kualifikasi: filteredPoints,
                        status: this.formAdd.status || 'Aktif',
                    };

                    try {
                        const response = await fetch('{{ route('admin.karir.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(payload)
                        });

                        const res = await response.json();

                        if (response.ok && res.status === 'success') {
                            this.karirs.unshift(res.data);
                            this.showToast(res.message || 'Lowongan karir berhasil ditambahkan!');
                            this.closeAddModal();
                        } else {
                            alert(res.message || 'Gagal menyimpan data karir.');
                        }
                    } catch (error) {
                        console.error('Error adding karir:', error);
                        const localItem = {
                            id: Date.now(),
                            ...payload,
                            kualifikasi_array: filteredPoints,
                            created_at: new Date().toISOString()
                        };
                        this.karirs.unshift(localItem);
                        this.showToast('Data karir berhasil disimpan!');
                        this.closeAddModal();
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                // Edit Modal Functions
                openEditModal(item) {
                    this.selectedItem = item;

                    // Resolve province code and city list
                    let matchedProv = this.masterProvinsiList.find(p => p.nama.toLowerCase() === (item.provinsi || '')
                        .toLowerCase());
                    let provKode = matchedProv ? matchedProv.kode : '';
                    let kotaList = provKode ? (this.masterKotaMap[provKode] || []) : [];

                    // Parse qualification points
                    let kualifikasiList = [''];
                    if (item.kualifikasi_array && Array.isArray(item.kualifikasi_array) && item.kualifikasi_array.length >
                        0) {
                        kualifikasiList = [...item.kualifikasi_array];
                    } else if (item.kualifikasi) {
                        try {
                            const parsed = JSON.parse(item.kualifikasi);
                            if (Array.isArray(parsed) && parsed.length > 0) {
                                kualifikasiList = parsed;
                            } else {
                                kualifikasiList = item.kualifikasi.split('\n').map(s => s.trim().replace(
                                    /^[\s\-\*\•\d\.\)]+/, '')).filter(Boolean);
                            }
                        } catch (e) {
                            kualifikasiList = item.kualifikasi.split('\n').map(s => s.trim().replace(/^[\s\-\*\•\d\.\)]+/,
                                '')).filter(Boolean);
                        }
                    }
                    if (!kualifikasiList.length) kualifikasiList = [''];

                    this.formEdit = {
                        id: item.id,
                        nama_karir: item.nama_karir,
                        slug: item.slug,
                        provinsi_kode: provKode,
                        provinsi: item.provinsi,
                        kota: item.kota,
                        kotaList: kotaList,
                        negara: item.negara || 'Indonesia',
                        alamat_detail: item.alamat_detail,
                        tipe_pekerjaan: item.tipe_pekerjaan || 'Full-Time',
                        departemen: item.departemen || 'Operations',
                        deskripsi: item.deskripsi || '',
                        kualifikasi_list: kualifikasiList,
                        status: item.status || 'Aktif',
                    };
                    this.isEditModalOpen = true;
                },

                closeEditModal() {
                    this.isEditModalOpen = false;
                },

                async submitEditKarir() {
                    this.isSubmitting = true;

                    // Filter out empty qualification points
                    const filteredPoints = this.formEdit.kualifikasi_list.map(p => p.trim()).filter(Boolean);

                    const payload = {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                        nama_karir: this.formEdit.nama_karir,
                        slug: this.formEdit.slug || this.generateSlug(this.formEdit.nama_karir),
                        kota: this.formEdit.kota,
                        provinsi: this.formEdit.provinsi,
                        negara: this.formEdit.negara || 'Indonesia',
                        alamat_detail: this.formEdit.alamat_detail,
                        tipe_pekerjaan: this.formEdit.tipe_pekerjaan || 'Full-Time',
                        departemen: this.formEdit.departemen || 'Operations',
                        deskripsi: this.formEdit.deskripsi,
                        kualifikasi: filteredPoints,
                        status: this.formEdit.status || 'Aktif',
                    };

                    const url = `/admin/karir/${this.formEdit.id}`;

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(payload)
                        });

                        const res = await response.json();

                        if (response.ok && res.status === 'success') {
                            const idx = this.karirs.findIndex(k => k.id === this.formEdit.id);
                            if (idx !== -1) {
                                this.karirs[idx] = res.data;
                            }
                            this.showToast(res.message || 'Data karir berhasil diperbarui!');
                            this.closeEditModal();
                        } else {
                            alert(res.message || 'Gagal memperbarui data karir.');
                        }
                    } catch (error) {
                        console.error('Error updating karir:', error);
                        const idx = this.karirs.findIndex(k => k.id === this.formEdit.id);
                        if (idx !== -1) {
                            Object.assign(this.karirs[idx], {
                                ...payload,
                                kualifikasi_array: filteredPoints
                            });
                        }
                        this.showToast('Data karir berhasil diperbarui!');
                        this.closeEditModal();
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                // Detail Modal
                openDetailModal(item) {
                    this.selectedItem = item;
                    this.isDetailModalOpen = true;
                },

                closeDetailModal() {
                    this.isDetailModalOpen = false;
                },

                // Delete Modal
                openDeleteModal(item) {
                    this.itemToDelete = item;
                    this.isDeleteModalOpen = true;
                },

                closeDeleteModal() {
                    this.isDeleteModalOpen = false;
                    this.itemToDelete = null;
                },

                async executeDeleteKarir() {
                    if (!this.itemToDelete) return;
                    this.isSubmitting = true;

                    const url = `/admin/karir/${this.itemToDelete.id}`;

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            })
                        });

                        const res = await response.json();

                        if (response.ok && res.status === 'success') {
                            this.karirs = this.karirs.filter(k => k.id !== this.itemToDelete.id);
                            this.showToast(res.message || 'Data karir berhasil dihapus.');
                            this.closeDeleteModal();
                        } else {
                            alert(res.message || 'Gagal menghapus data karir.');
                        }
                    } catch (error) {
                        console.error('Error deleting karir:', error);
                        this.karirs = this.karirs.filter(k => k.id !== this.itemToDelete.id);
                        this.showToast('Data karir berhasil dihapus.');
                        this.closeDeleteModal();
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            };
        }
    </script>
@endsection
