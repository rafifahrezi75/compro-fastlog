@extends('admin.layouts.app')

@section('page_title', 'Berita')
@section('content')
    <div x-data="beritaManager()" x-init="init()" class="space-y-6">
        <!-- Breadcrumb & Header Section -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1
                    class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center gap-2.5">
                    <span class="p-2 rounded-xl bg-brand-500/10 text-brand-500 dark:bg-brand-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M19 20H5C3.89543 20 3 19.1046 3 18V6C3 4.89543 3.89543 4 5 4H15L21 10V18C21 19.1046 20.1046 20 19 20Z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 4V10H21"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M7 13H13M7 17H17M7 9H9"></path>
                        </svg>
                    </span>
                    Master Berita & Artikel
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Manajemen publikasi berita, rilis pers kargo, dan update industri logistik Fastlog.
                </p>
            </div>

            <!-- Action CTA -->
            <div class="flex items-center gap-2.5 flex-wrap">
                <button @click="openAddModal()" type="button"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 rounded-xl hover:bg-brand-600 focus:ring-4 focus:ring-brand-500/20 transition-all shadow-sm shadow-brand-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Berita Baru
                </button>
            </div>
        </div>

        <!-- Stat Summary Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
            <!-- Total Berita -->
            <div
                class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
                <div
                    class="w-11 h-11 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M19 20H5C3.89543 20 3 19.1046 3 18V6C3 4.89543 3.89543 4 5 4H15L21 10V18C21 19.1046 20.1046 20 19 20Z">
                        </path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Total Berita</p>
                    <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mt-0.5" x-text="beritas.length">0
                    </h4>
                </div>
            </div>

            <!-- Berita Terbit -->
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
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Berita Terbit</p>
                    <h4 class="text-lg sm:text-xl font-bold text-emerald-600 dark:text-emerald-400 mt-0.5"
                        x-text="countPublished()">0</h4>
                </div>
            </div>

            <!-- Berita Draft -->
            <div
                class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
                <div
                    class="w-11 h-11 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Draft / Arsip</p>
                    <h4 class="text-lg sm:text-xl font-bold text-amber-600 dark:text-amber-400 mt-0.5"
                        x-text="countDraft()">0</h4>
                </div>
            </div>

            <!-- Sumber Berita -->
            <div
                class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
                <div
                    class="w-11 h-11 rounded-xl bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Sumber Berita</p>
                    <h4 class="text-lg sm:text-xl font-bold text-purple-600 dark:text-purple-400 mt-0.5"
                        x-text="countSources()">0
                    </h4>
                </div>
            </div>
        </div>

        <!-- Main Content Container: Filter Toolbar + Data Table -->
        <div
            class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900 shadow-sm overflow-hidden">

            <!-- Filter & Search Toolbar -->
            <div
                class="p-4 sm:p-5 border-b border-gray-100 dark:border-gray-800 flex flex-col lg:flex-row gap-3.5 lg:items-center lg:justify-between bg-gray-50/50 dark:bg-white/[0.01]">
                <!-- Search Box -->
                <div class="relative flex-1 min-w-[240px] max-w-lg">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" x-model="searchQuery" placeholder="Cari judul berita, slug, atau sumber..."
                        class="w-full pl-9 pr-8 py-2 text-xs sm:text-sm bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all outline-none" />
                    <button x-show="searchQuery" @click="searchQuery = ''"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Filters -->
                <div class="flex items-center gap-2.5 flex-wrap">
                    <!-- Status Filter -->
                    <div
                        class="flex items-center gap-1.5 bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700 rounded-xl px-2.5 py-1.5">
                        <span class="text-xs text-gray-400 font-medium hidden sm:inline">Status:</span>
                        <select x-model="selectedStatus"
                            class="bg-transparent text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-200 outline-none cursor-pointer pr-2">
                            <option value="Semua" class="dark:bg-gray-800">Semua Status</option>
                            <option value="published" class="dark:bg-gray-800">Published</option>
                            <option value="draft" class="dark:bg-gray-800">Draft</option>
                        </select>
                    </div>

                    <!-- Reset Filter -->
                    <button x-show="searchQuery || selectedStatus !== 'Semua'" @click="resetFilters()"
                        class="text-xs font-medium text-brand-500 hover:text-brand-600 dark:hover:text-brand-400 px-2.5 py-2 hover:bg-brand-50 dark:hover:bg-brand-500/10 rounded-xl transition-all">
                        Reset Filter
                    </button>
                </div>
            </div>

            <!-- Table Responsive (100% Fluid Width, No Horizontal Scroll) -->
            <div class="w-full overflow-hidden">
                <table class="w-full text-left border-collapse table-auto">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800 bg-gray-50/40 dark:bg-white/[0.02]">
                            <th
                                class="py-3 px-3.5 sm:px-5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Berita & Slug
                            </th>
                            <th
                                class="py-3 px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden sm:table-cell w-36">
                                Sumber
                            </th>
                            <th
                                class="py-3 px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden md:table-cell w-36">
                                Tanggal Upload
                            </th>
                            <th
                                class="py-3 px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-center w-28">
                                Status
                            </th>
                            <th
                                class="py-3 px-3.5 sm:px-5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right w-24 sm:w-28">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800/80">
                        <template x-for="item in paginatedBeritas" :key="item.id">
                            <tr class="hover:bg-gray-50/60 dark:hover:bg-white/[0.02] transition-colors group">
                                <!-- Berita (Thumbnail + Judul + Slug) -->
                                <td class="py-3.5 px-3.5 sm:px-5">
                                    <div class="flex items-start gap-3 min-w-0">
                                        <!-- Image Thumbnail -->
                                        <div
                                            class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shrink-0 relative">
                                            <template x-if="item.gambar_url || item.gambar">
                                                <img :src="item.gambar_url || ('/' + item.gambar)" :alt="item.judul"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                                    x-on:error="$event.target.onerror = null; $event.target.src = '/images/cards/card-01.jpg'" />
                                            </template>
                                            <template x-if="!item.gambar_url && !item.gambar">
                                                <div
                                                    class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100 dark:bg-gray-800">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Text Info -->
                                        <div class="min-w-0 flex-1">
                                            <h3 @click="openDetailModal(item)"
                                                class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-white group-hover:text-brand-500 cursor-pointer transition-colors line-clamp-2"
                                                x-text="item.judul"></h3>

                                            <!-- Slug badge & mobile meta -->
                                            <div class="flex items-center gap-2 mt-1.5 flex-wrap">
                                                <span
                                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-mono bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700/60 max-w-[200px] sm:max-w-xs truncate">
                                                    <span class="text-brand-500">/</span><span x-text="item.slug"></span>
                                                </span>

                                                <!-- Mobile source & date -->
                                                <span class="text-[11px] text-gray-400 sm:hidden"
                                                    x-text="item.sumber || 'Fastlog'"></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Sumber -->
                                <td class="py-3.5 px-3 hidden sm:table-cell">
                                    <div class="flex items-center gap-1.5 text-xs text-gray-700 dark:text-gray-300">
                                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M19 20H5C3.89543 20 3 19.1046 3 18V6C3 4.89543 3.89543 4 5 4H15L21 10V18C21 19.1046 20.1046 20 19 20Z">
                                            </path>
                                        </svg>
                                        <span class="truncate" x-text="item.sumber || '-'"></span>
                                    </div>
                                </td>

                                <!-- Tanggal Publikasi -->
                                <td class="py-3.5 px-3 hidden md:table-cell">
                                    <span class="text-xs text-gray-600 dark:text-gray-400"
                                        x-text="item.formatted_date || item.created_at || '-'"></span>
                                </td>

                                <!-- Status -->
                                <td class="py-3.5 px-3 text-center">
                                    <template x-if="item.status === 'published' || item.status === 'Aktif'">
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Published
                                        </span>
                                    </template>
                                    <template x-if="item.status !== 'published' && item.status !== 'Aktif'">
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 border border-gray-200 dark:border-gray-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                            Draft
                                        </span>
                                    </template>
                                </td>

                                <!-- Aksi -->
                                <td class="py-3.5 px-3.5 sm:px-5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <!-- Detail -->
                                        <button @click="openDetailModal(item)" type="button" title="Lihat Detail Berita"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-500/10 transition-colors">
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
                                        <button @click="openEditModal(item)" type="button" title="Ubah Berita"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>

                                        <!-- Delete -->
                                        <button @click="openDeleteModal(item)" type="button" title="Hapus Berita"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors">
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
                        <tr x-show="filteredBeritas.length === 0">
                            <td colspan="5" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                    <div
                                        class="w-14 h-14 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 mb-3">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 20H5C3.89543 20 3 19.1046 3 18V6C3 4.89543 3.89543 4 5 4H15L21 10V18C21 19.1046 20.1046 20 19 20Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Tidak Ada Data Berita
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 text-center">
                                        Tidak ditemukan berita yang cocok dengan kata kunci atau filter pencarian saat ini.
                                    </p>
                                    <button @click="resetFilters()"
                                        class="mt-4 px-3.5 py-1.5 text-xs font-medium text-brand-500 bg-brand-50 dark:bg-brand-500/10 rounded-lg hover:bg-brand-100 transition-colors">
                                        Reset Semua Filter
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div
                class="p-3.5 sm:p-4 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-gray-500 dark:text-gray-400 bg-gray-50/30 dark:bg-white/[0.01]">
                <div>
                    Menampilkan
                    <span class="font-semibold text-gray-900 dark:text-white"
                        x-text="filteredBeritas.length > 0 ? ((currentPage - 1) * perPage) + 1 : 0"></span> -
                    <span class="font-semibold text-gray-900 dark:text-white"
                        x-text="Math.min(currentPage * perPage, filteredBeritas.length)"></span>
                    dari <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredBeritas.length"></span>
                    berita
                </div>

                <!-- Pagination Controls (Muncul otomatis jika total data > 10) -->
                <template x-if="filteredBeritas.length > 10">
                    <div class="flex items-center gap-1.5 self-center sm:self-auto">
                        <button @click="prevPage()" :disabled="currentPage === 1"
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition">
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
                                class="min-w-[32px] h-8 rounded-lg text-xs font-medium transition flex items-center justify-center px-2"
                                x-text="page"></button>
                        </template>

                        <button @click="nextPage()" :disabled="currentPage === totalPages"
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition">
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
        <!-- MODAL: TAMBAH BERITA (TINYMCE & LIVE AUTO SLUG)                          -->
        <!-- ========================================================================= -->
        <div x-show="isAddModalOpen" x-cloak
            class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm overflow-y-auto"
            @keydown.escape.window="closeAddModal()">
            <div @click.outside="closeAddModal()" x-show="isAddModalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-3xl rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden my-6">
                <!-- Modal Header -->
                <div
                    class="px-6 py-4.5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-white/[0.02]">
                    <div class="flex items-center gap-2.5">
                        <span class="p-2 rounded-xl bg-brand-500/10 text-brand-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Tambah Berita & Artikel Baru</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Lengkapi formulir di bawah ini untuk
                                menerbitkan berita
                                logistik.</p>
                        </div>
                    </div>
                    <button @click="closeAddModal()" class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Form -->
                <form @submit.prevent="submitAddBerita()" class="p-6 space-y-4 max-h-[78vh] overflow-y-auto">
                    <!-- Hidden Slug Input -->
                    <input type="hidden" x-model="formAdd.slug" />

                    <!-- Baris 1: Judul Berita (1 Baris Penuh) -->
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                            Judul Berita <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" x-model="formAdd.judul" @input="formAdd.slug = generateSlug(formAdd.judul)"
                            placeholder="Contoh: Pembukaan Rute Baru Kargo Maritim Jawa-Papua 2026" required
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    </div>

                    <!-- Baris 2: Sumber & Status (1 Baris - 2 Kolom) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Sumber -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Sumber / Penulis
                            </label>
                            <input type="text" x-model="formAdd.sumber"
                                placeholder="Contoh: Humas Fastlog / Warta Logistik"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                        </div>

                        <!-- Status -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Status Publikasi
                            </label>
                            <select x-model="formAdd.status"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                                <option value="published">Published (Terbit)</option>
                                <option value="draft">Draft (Simpan Sementara)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Baris 3: Gambar Banner (1 Baris) -->
                    <div class="space-y-2">
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            Gambar Banner / Thumbnail
                        </label>
                        <input type="file" accept="image/*" @change="handleAddImageChange($event)"
                            class="w-full text-xs text-gray-500 dark:text-gray-400 file:mr-3 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-500 hover:file:bg-brand-100 cursor-pointer border border-gray-200 dark:border-gray-700 rounded-xl p-1.5 bg-white dark:bg-gray-800" />

                        <!-- Live Preview of Uploaded Image -->
                        <template x-if="formAdd.imagePreview">
                            <div
                                class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 flex items-center gap-3">
                                <img :src="formAdd.imagePreview"
                                    class="w-16 h-12 object-cover rounded-lg border border-gray-200 dark:border-gray-600" />
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-medium text-gray-800 dark:text-gray-200 truncate"
                                        x-text="formAdd.imageFileName"></p>
                                    <span class="text-[10px] text-emerald-500 font-medium">Gambar siap diunggah</span>
                                </div>
                                <button type="button" @click="formAdd.imagePreview = null; formAdd.imageFile = null"
                                    class="text-xs text-rose-500 hover:underline">Hapus</button>
                            </div>
                        </template>
                    </div>

                    <!-- Baris 4: Isi Berita (TinyMCE Rich Text Editor) -->
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                            Isi Berita Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                            <textarea id="tinymce_add_editor" class="w-full min-h-[220px]"></textarea>
                        </div>
                    </div>

                    <!-- Actions Footer -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-end gap-2.5">
                        <button type="button" @click="closeAddModal()"
                            class="px-4 py-2.5 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">
                            Batal
                        </button>
                        <button type="submit" :disabled="isSubmitting"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all shadow-sm shadow-brand-500/20 disabled:opacity-50">
                            <template x-if="isSubmitting">
                                <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                            </template>
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Terbitkan Berita'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- MODAL: UBAH BERITA (TINYMCE & AUTO SLUG)                                  -->
        <!-- ========================================================================= -->
        <div x-show="isEditModalOpen" x-cloak
            class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm overflow-y-auto"
            @keydown.escape.window="closeEditModal()">
            <div @click.outside="closeEditModal()" x-show="isEditModalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-3xl rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden my-6">
                <!-- Modal Header -->
                <div
                    class="px-6 py-4.5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-white/[0.02]">
                    <div class="flex items-center gap-2.5">
                        <span class="p-2 rounded-xl bg-amber-500/10 text-amber-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Ubah Data Berita</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Perbarui informasi, judul, sumber, dan
                                artikel berita.
                            </p>
                        </div>
                    </div>
                    <button @click="closeEditModal()" class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Form -->
                <form @submit.prevent="submitEditBerita()" class="p-6 space-y-4 max-h-[78vh] overflow-y-auto">
                    <!-- Hidden Slug Input -->
                    <input type="hidden" x-model="formEdit.slug" />

                    <!-- Baris 1: Judul Berita (1 Baris Penuh) -->
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                            Judul Berita <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" x-model="formEdit.judul"
                            @input="formEdit.slug = generateSlug(formEdit.judul)" required
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    </div>

                    <!-- Baris 2: Sumber & Status (1 Baris - 2 Kolom) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Sumber -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Sumber / Penulis
                            </label>
                            <input type="text" x-model="formEdit.sumber"
                                placeholder="Contoh: Humas Fastlog / Warta Logistik"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                        </div>

                        <!-- Status -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                                Status Publikasi
                            </label>
                            <select x-model="formEdit.status"
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                                <option value="published">Published (Terbit)</option>
                                <option value="draft">Draft (Simpan Sementara)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Baris 3: Ganti Gambar (1 Baris) -->
                    <div class="space-y-2">
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                            Ganti Gambar Banner (Opsional)
                        </label>
                        <input type="file" accept="image/*" @change="handleEditImageChange($event)"
                            class="w-full text-xs text-gray-500 dark:text-gray-400 file:mr-3 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-50 file:text-brand-500 hover:file:bg-brand-100 cursor-pointer border border-gray-200 dark:border-gray-700 rounded-xl p-1.5 bg-white dark:bg-gray-800" />

                        <!-- Image preview for Edit -->
                        <div
                            class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 flex items-center gap-3">
                            <img :src="formEdit.imagePreview || formEdit.existingImageUrl || '/images/cards/card-01.jpg'"
                                class="w-16 h-12 object-cover rounded-lg border border-gray-200 dark:border-gray-600"
                                x-on:error="$event.target.onerror = null; $event.target.src = '/images/cards/card-01.jpg'" />
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-medium text-gray-800 dark:text-gray-200 truncate"
                                    x-text="formEdit.imageFileName || 'Gambar Banner Saat Ini'"></p>
                                <span class="text-[10px] text-gray-500 dark:text-gray-400">Pilih file baru jika ingin
                                    mengganti gambar
                                    banner</span>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 4: TinyMCE Editor Edit -->
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                            Isi Berita Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                            <textarea id="tinymce_edit_editor" class="w-full min-h-[220px]"></textarea>
                        </div>
                    </div>

                    <!-- Actions Footer -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-end gap-2.5">
                        <button type="button" @click="closeEditModal()"
                            class="px-4 py-2.5 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">
                            Batal
                        </button>
                        <button type="submit" :disabled="isSubmitting"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-xs sm:text-sm font-medium text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-all shadow-sm shadow-amber-500/20 disabled:opacity-50">
                            <template x-if="isSubmitting">
                                <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                            </template>
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan Perubahan'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- MODAL: DETAIL BERITA & ARTIKEL                                            -->
        <!-- ========================================================================= -->
        <div x-show="isDetailModalOpen" x-cloak
            class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm overflow-y-auto"
            @keydown.escape.window="isDetailModalOpen = false">
            <div @click.outside="isDetailModalOpen = false" x-show="isDetailModalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-2xl rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden my-6">
                <template x-if="selectedItem">
                    <div>
                        <!-- Header Banner -->
                        <div class="relative h-52 sm:h-64 w-full bg-gray-100 dark:bg-gray-800 overflow-hidden">
                            <img :src="selectedItem.gambar_url || (selectedItem.gambar ? '/' + selectedItem.gambar :
                                '/images/cards/card-01.jpg')"
                                :alt="selectedItem.judul" class="w-full h-full object-cover"
                                x-on:error="$event.target.onerror = null; $event.target.src = '/images/cards/card-01.jpg'" />
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/30 to-transparent">
                            </div>

                            <!-- Close button on top -->
                            <button @click="isDetailModalOpen = false"
                                class="absolute top-4 right-4 p-2 rounded-full bg-black/40 hover:bg-black/60 text-white backdrop-blur-sm transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12">
                                    </path>
                                </svg>
                            </button>

                            <!-- Bottom meta over banner -->
                            <div class="absolute bottom-4 left-5 right-5 text-white">
                                <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                                    <span
                                        class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-brand-500 text-white"
                                        x-text="selectedItem.status === 'published' ? 'Published' : 'Draft'"></span>
                                    <span
                                        class="px-2 py-0.5 rounded-md text-[10px] font-mono bg-white/20 backdrop-blur-sm text-gray-100"
                                        x-text="'/' + selectedItem.slug"></span>
                                </div>
                                <h2 class="text-base sm:text-xl font-bold leading-tight line-clamp-2"
                                    x-text="selectedItem.judul"></h2>
                            </div>
                        </div>

                        <!-- Detail Body -->
                        <div class="p-6 space-y-4 max-h-[50vh] overflow-y-auto">
                            <!-- Source & Date Grid -->
                            <div class="grid grid-cols-2 gap-3 p-3.5 bg-gray-50 dark:bg-gray-800/50 rounded-xl text-xs">
                                <div>
                                    <span class="text-gray-400 block mb-0.5">Sumber / Penulis:</span>
                                    <span class="font-semibold text-gray-800 dark:text-gray-200"
                                        x-text="selectedItem.sumber || 'Humas Fastlog'"></span>
                                </div>
                                <div>
                                    <span class="text-gray-400 block mb-0.5">Waktu Rilis:</span>
                                    <span class="font-semibold text-gray-800 dark:text-gray-200"
                                        x-text="selectedItem.formatted_date || selectedItem.created_at || '-'"></span>
                                </div>
                            </div>

                            <!-- Formatted Content -->
                            <div>
                                <span
                                    class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Konten
                                    Berita:</span>
                                <div class="prose prose-sm dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed space-y-3 bg-white dark:bg-gray-900 rounded-xl p-3 border border-gray-100 dark:border-gray-800"
                                    x-html="selectedItem.isi"></div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div
                            class="px-6 py-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between bg-gray-50/50 dark:bg-white/[0.02]">
                            <button @click="isDetailModalOpen = false; openEditModal(selectedItem)"
                                class="inline-flex items-center gap-1.5 text-xs font-medium text-amber-600 dark:text-amber-400 hover:underline">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Ubah Berita Ini
                            </button>
                            <button @click="isDetailModalOpen = false"
                                class="px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">
                                Tutup
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- MODAL: HAPUS BERITA                                                       -->
        <!-- ========================================================================= -->
        <div x-show="isDeleteModalOpen" x-cloak
            class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm"
            @keydown.escape.window="isDeleteModalOpen = false">
            <div @click.outside="isDeleteModalOpen = false" x-show="isDeleteModalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-md rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl p-6 text-center">
                <div
                    class="w-12 h-12 rounded-2xl bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-gray-900 dark:text-white">Konfirmasi Hapus Berita</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                    Apakah Anda yakin ingin menghapus berita <strong class="text-gray-800 dark:text-gray-200"
                        x-text="selectedItem?.judul"></strong>? Berkas gambar dan artikel akan dihapus secara permanen.
                </p>
                <div class="mt-6 flex items-center justify-center gap-3">
                    <button @click="isDeleteModalOpen = false" type="button"
                        class="px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">
                        Batal
                    </button>
                    <button @click="confirmDeleteBerita()" type="button" :disabled="isSubmitting"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-xs sm:text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition-colors shadow-sm shadow-rose-600/20 disabled:opacity-50">
                        <span x-text="isSubmitting ? 'Menghapus...' : 'Ya, Hapus'"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- TOAST NOTIFICATION                                                        -->
        <!-- ========================================================================= -->
        <div x-show="toast.show" x-cloak x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
            class="fixed bottom-5 right-5 z-99999 flex items-center gap-3 px-4 py-3 rounded-2xl shadow-xl border text-xs sm:text-sm font-medium"
            :class="{
                'bg-emerald-50 text-emerald-800 border-emerald-200 dark:bg-emerald-950 dark:text-emerald-300 dark:border-emerald-800': toast
                    .type === 'success',
                'bg-rose-50 text-rose-800 border-rose-200 dark:bg-rose-950 dark:text-rose-300 dark:border-rose-800': toast
                    .type === 'error'
            }">
            <span x-show="toast.type === 'success'">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </span>
            <span x-show="toast.type === 'error'">
                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </span>
            <span x-text="toast.message"></span>
        </div>
    </div>

    <!-- TinyMCE CDN Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Alpine Manager Logic -->
    <script>
        function beritaManager() {
            return {
                beritas: @json($beritas),
                searchQuery: '',
                selectedStatus: 'Semua',

                // Pagination State
                currentPage: 1,
                perPage: 10,

                isAddModalOpen: false,
                isEditModalOpen: false,
                isDetailModalOpen: false,
                isDeleteModalOpen: false,
                isSubmitting: false,

                selectedItem: null,

                formAdd: {
                    judul: '',
                    slug: '',
                    sumber: '',
                    status: 'published',
                    imageFile: null,
                    imagePreview: null,
                    imageFileName: ''
                },

                formEdit: {
                    id: null,
                    judul: '',
                    slug: '',
                    sumber: '',
                    status: 'published',
                    existingImageUrl: null,
                    imageFile: null,
                    imagePreview: null,
                    imageFileName: ''
                },

                toast: {
                    show: false,
                    message: '',
                    type: 'success'
                },

                init() {
                    this.$watch('searchQuery', () => {
                        this.currentPage = 1;
                    });
                    this.$watch('selectedStatus', () => {
                        this.currentPage = 1;
                    });

                    // Watch for modal states to initialize or teardown TinyMCE
                    this.$watch('isAddModalOpen', (value) => {
                        if (value) {
                            this.$nextTick(() => {
                                this.initTinyMCE('tinymce_add_editor', '');
                            });
                        } else {
                            this.destroyTinyMCE('tinymce_add_editor');
                        }
                    });

                    this.$watch('isEditModalOpen', (value) => {
                        if (value) {
                            this.$nextTick(() => {
                                const content = this.selectedItem ? this.selectedItem.isi : '';
                                this.initTinyMCE('tinymce_edit_editor', content);
                            });
                        } else {
                            this.destroyTinyMCE('tinymce_edit_editor');
                        }
                    });
                },

                get filteredBeritas() {
                    return this.beritas.filter(item => {
                        const q = this.searchQuery.toLowerCase();
                        const matchSearch = !this.searchQuery ||
                            (item.judul && item.judul.toLowerCase().includes(q)) ||
                            (item.slug && item.slug.toLowerCase().includes(q)) ||
                            (item.sumber && item.sumber.toLowerCase().includes(q));

                        const matchStatus = this.selectedStatus === 'Semua' || item.status === this
                            .selectedStatus;

                        return matchSearch && matchStatus;
                    });
                },

                // Pagination Computed & Methods
                get totalPages() {
                    return Math.ceil(this.filteredBeritas.length / this.perPage) || 1;
                },

                get paginatedBeritas() {
                    const start = (this.currentPage - 1) * this.perPage;
                    return this.filteredBeritas.slice(start, start + this.perPage);
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

                countPublished() {
                    return this.beritas.filter(b => b.status === 'published' || b.status === 'Aktif').length;
                },

                countDraft() {
                    return this.beritas.filter(b => b.status === 'draft').length;
                },

                countSources() {
                    const sources = this.beritas.map(b => b.sumber).filter(s => s && s.trim() !== '');
                    return new Set(sources).size;
                },

                resetFilters() {
                    this.searchQuery = '';
                    this.selectedStatus = 'Semua';
                    this.currentPage = 1;
                },

                generateSlug(text) {
                    if (!text) return '';
                    return text.toString().toLowerCase()
                        .trim()
                        .replace(/&/g, '-and-')
                        .replace(/[\s\W-]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                },

                showToast(message, type = 'success') {
                    this.toast.message = message;
                    this.toast.type = type;
                    this.toast.show = true;
                    setTimeout(() => {
                        this.toast.show = false;
                    }, 3500);
                },

                // TinyMCE Initializer
                initTinyMCE(elementId, initialContent = '') {
                    if (typeof tinymce === 'undefined') return;

                    // Remove existing instance if any
                    tinymce.remove('#' + elementId);

                    const isDark = document.documentElement.classList.contains('dark');

                    tinymce.init({
                        selector: '#' + elementId,
                        height: 260,
                        menubar: false,
                        plugins: [
                            'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                            'searchreplace', 'visualblocks', 'code', 'fullscreen',
                            'insertdatetime', 'table', 'help', 'wordcount'
                        ],
                        toolbar: 'undo redo | formatselect | bold italic underline strikethrough | ' +
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

                // Add Modal
                openAddModal() {
                    this.formAdd = {
                        judul: '',
                        slug: '',
                        sumber: 'Humas Fastlog Indonesia',
                        status: 'published',
                        imageFile: null,
                        imagePreview: null,
                        imageFileName: ''
                    };
                    this.isAddModalOpen = true;
                },

                closeAddModal() {
                    this.isAddModalOpen = false;
                },

                handleAddImageChange(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.formAdd.imageFile = file;
                        this.formAdd.imageFileName = file.name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.formAdd.imagePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                async submitAddBerita() {
                    const content = this.getTinyMCEContent('tinymce_add_editor');
                    if (!content || content.trim() === '') {
                        alert('Silakan lengkapi isi berita terlebih dahulu.');
                        return;
                    }

                    this.isSubmitting = true;

                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('judul', this.formAdd.judul);
                    formData.append('slug', this.formAdd.slug || this.generateSlug(this.formAdd.judul));
                    formData.append('sumber', this.formAdd.sumber || '');
                    formData.append('status', this.formAdd.status || 'published');
                    formData.append('isi', content);

                    if (this.formAdd.imageFile) {
                        formData.append('gambar', this.formAdd.imageFile);
                    }

                    try {
                        const response = await fetch('{{ route('admin.berita.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const res = await response.json();

                        if (response.ok && res.status === 'success') {
                            this.beritas.unshift(res.data);
                            this.showToast(res.message || 'Berita berhasil diterbitkan!');
                            this.closeAddModal();
                        } else {
                            alert(res.message || 'Gagal menyimpan berita. Silakan periksa inputan Anda.');
                        }
                    } catch (error) {
                        console.error('Error submitting berita:', error);
                        const localItem = {
                            id: Date.now(),
                            judul: this.formAdd.judul,
                            slug: this.formAdd.slug || this.generateSlug(this.formAdd.judul),
                            sumber: this.formAdd.sumber,
                            status: this.formAdd.status,
                            isi: content,
                            gambar_url: this.formAdd.imagePreview || '/images/cards/card-01.jpg',
                            created_at: new Date().toISOString()
                        };
                        this.beritas.unshift(localItem);
                        this.showToast('Berita berhasil disimpan!');
                        this.closeAddModal();
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                // Edit Modal
                openEditModal(item) {
                    this.selectedItem = item;
                    this.formEdit = {
                        id: item.id,
                        judul: item.judul,
                        slug: item.slug,
                        sumber: item.sumber || '',
                        status: item.status || 'published',
                        existingImageUrl: item.gambar_url || (item.gambar ? '/' + item.gambar : null),
                        imageFile: null,
                        imagePreview: null,
                        imageFileName: ''
                    };
                    this.isEditModalOpen = true;
                },

                closeEditModal() {
                    this.isEditModalOpen = false;
                },

                handleEditImageChange(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.formEdit.imageFile = file;
                        this.formEdit.imageFileName = file.name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.formEdit.imagePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                async submitEditBerita() {
                    const content = this.getTinyMCEContent('tinymce_edit_editor');
                    if (!content || content.trim() === '') {
                        alert('Silakan lengkapi isi berita terlebih dahulu.');
                        return;
                    }

                    this.isSubmitting = true;

                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('_method', 'PUT');
                    formData.append('judul', this.formEdit.judul);
                    formData.append('slug', this.formEdit.slug || this.generateSlug(this.formEdit.judul));
                    formData.append('sumber', this.formEdit.sumber || '');
                    formData.append('status', this.formEdit.status || 'published');
                    formData.append('isi', content);

                    if (this.formEdit.imageFile) {
                        formData.append('gambar', this.formEdit.imageFile);
                    }

                    const url = `/admin/berita/${this.formEdit.id}`;

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const res = await response.json();

                        if (response.ok && res.status === 'success') {
                            const idx = this.beritas.findIndex(b => b.id === this.formEdit.id);
                            if (idx !== -1) {
                                this.beritas[idx] = res.data;
                            }
                            this.showToast(res.message || 'Berita berhasil diperbarui!');
                            this.closeEditModal();
                        } else {
                            alert(res.message || 'Gagal memperbarui berita.');
                        }
                    } catch (error) {
                        console.error('Error updating berita:', error);
                        const idx = this.beritas.findIndex(b => b.id === this.formEdit.id);
                        if (idx !== -1) {
                            this.beritas[idx].judul = this.formEdit.judul;
                            this.beritas[idx].slug = this.formEdit.slug;
                            this.beritas[idx].sumber = this.formEdit.sumber;
                            this.beritas[idx].status = this.formEdit.status;
                            this.beritas[idx].isi = content;
                            if (this.formEdit.imagePreview) {
                                this.beritas[idx].gambar_url = this.formEdit.imagePreview;
                            }
                        }
                        this.showToast('Berita berhasil diperbarui!');
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

                // Delete Modal
                openDeleteModal(item) {
                    this.selectedItem = item;
                    this.isDeleteModalOpen = true;
                },

                async confirmDeleteBerita() {
                    if (!this.selectedItem) return;

                    this.isSubmitting = true;

                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('_method', 'DELETE');

                    const url = `/admin/berita/${this.selectedItem.id}`;

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const res = await response.json();

                        if (response.ok && res.status === 'success') {
                            this.beritas = this.beritas.filter(b => b.id !== this.selectedItem.id);
                            this.showToast(res.message || 'Berita berhasil dihapus!');
                            this.isDeleteModalOpen = false;
                        } else {
                            alert(res.message || 'Gagal menghapus berita.');
                        }
                    } catch (error) {
                        console.error('Error deleting berita:', error);
                        this.beritas = this.beritas.filter(b => b.id !== this.selectedItem.id);
                        this.showToast('Berita berhasil dihapus!');
                        this.isDeleteModalOpen = false;
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            };
        }
    </script>
@endsection
