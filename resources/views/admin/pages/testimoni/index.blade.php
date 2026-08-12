@extends('admin.layouts.app')

@section('page_title', 'Testimoni')
@section('content')
    <div x-data="testimoniManager()" x-init="init()" class="space-y-6">
        <!-- Breadcrumb & Header Section -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1
                    class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center gap-2.5">
                    <span class="p-2 rounded-xl bg-brand-500/10 text-brand-500 dark:bg-brand-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                            </path>
                        </svg>
                    </span>
                    Master Testimoni
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Manajemen ulasan dan testimoni pelanggan untuk Fastlog.
                </p>
            </div>

            <!-- Action CTA -->
            <div class="flex items-center gap-2.5 flex-wrap">
                <button @click="openAddModal()" type="button"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 rounded-xl hover:bg-brand-600 focus:ring-4 focus:ring-brand-500/20 transition-all shadow-sm shadow-brand-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Testimoni Baru
                </button>
            </div>
        </div>

        <!-- Stat Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
            <!-- Total Testimoni -->
            <div
                class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
                <div
                    class="w-11 h-11 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                        </path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Total Testimoni</p>
                    <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mt-0.5"
                        x-text="testimonis.length">0</h4>
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
                    <input type="text" x-model="searchQuery" placeholder="Cari nama, perusahaan, atau ulasan..."
                        class="w-full pl-9 pr-8 py-2 text-xs sm:text-sm bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all outline-none" />
                    <button x-show="searchQuery" @click="searchQuery = ''"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Table Responsive -->
            <div class="w-full overflow-x-auto">
                <table class="w-full text-left border-collapse table-auto min-w-[600px]">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800 bg-gray-50/40 dark:bg-white/[0.02]">
                            <th
                                class="py-3 px-3.5 sm:px-5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-[30%]">
                                Nama & Perusahaan</th>
                            <th
                                class="py-3 px-3.5 sm:px-5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-[40%]">
                                Ulasan</th>
                            <th
                                class="py-3 px-3.5 sm:px-5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-[15%]">
                                Status</th>
                            <th
                                class="py-3 px-3.5 sm:px-5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right w-[20%]">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800/80">
                        <template x-for="item in paginatedTestimonis" :key="item.id">
                            <tr class="hover:bg-gray-50/60 dark:hover:bg-white/[0.02] transition-colors group">
                                <td class="py-3.5 px-3.5 sm:px-5">
                                    <div class="flex items-start gap-3 min-w-0">
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-brand-50 dark:bg-brand-950/40 text-brand-600 dark:text-brand-400 flex items-center justify-center shrink-0 border border-brand-100 dark:border-brand-800 font-bold text-sm bg-cover bg-center"
                                            :style="item.foto ? `background-image: url('/storage/${item.foto}')` : ''">
                                            <span x-show="!item.foto" x-text="item.nama.charAt(0).toUpperCase()"></span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-0.5">
                                            <h3 class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-white line-clamp-1"
                                                x-text="item.nama"></h3>
                                            <p class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-1"
                                                x-text="item.perusahaan || '-'"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-3.5 sm:px-5">
                                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 line-clamp-2 italic"
                                        x-text="`&quot;${item.testimoni}&quot;`"></p>
                                </td>
                                <td class="py-3.5 px-3.5 sm:px-5">
                                    <span x-show="item.status === 'published'"
                                        class="inline-flex items-center px-2 py-1 rounded-md text-[10px] sm:text-xs font-medium bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200/50 dark:border-emerald-500/20">Published</span>
                                    <span x-show="item.status === 'draft'"
                                        class="inline-flex items-center px-2 py-1 rounded-md text-[10px] sm:text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 border border-gray-200/50 dark:border-gray-700">Draft</span>
                                </td>
                                <td class="py-3.5 px-3.5 sm:px-5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button @click="openEditModal(item)" type="button" title="Ubah Testimoni"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button @click="openDeleteModal(item)" type="button" title="Hapus Testimoni"
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
                        <tr x-show="filteredTestimonis.length === 0">
                            <td colspan="3" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                    <div
                                        class="w-14 h-14 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 mb-3">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Tidak Ada Data
                                        Testimoni</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 text-center">Data kosong atau
                                        tidak ditemukan hasil yang cocok.</p>
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
                        x-text="filteredTestimonis.length > 0 ? ((currentPage - 1) * perPage) + 1 : 0"></span> -
                    <span class="font-semibold text-gray-900 dark:text-white"
                        x-text="Math.min(currentPage * perPage, filteredTestimonis.length)"></span>
                    dari <span class="font-semibold text-gray-900 dark:text-white"
                        x-text="filteredTestimonis.length"></span> testimoni
                </div>
                <template x-if="filteredTestimonis.length > perPage">
                    <div class="flex items-center gap-1.5 self-center sm:self-auto">
                        <button @click="prevPage()" :disabled="currentPage === 1"
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <span>Sebelumnya</span>
                        </button>
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
        <!-- MODAL: TAMBAH TESTIMONI                                                   -->
        <!-- ========================================================================= -->
        <div x-show="isAddModalOpen" x-cloak
            class="fixed inset-0 z-[99999] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm overflow-y-auto"
            @keydown.escape.window="closeAddModal()">
            <div @click.outside="closeAddModal()" x-show="isAddModalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-lg rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden my-6">

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
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Tambah Testimoni Baru</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Masukkan ulasan pelanggan.</p>
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
                <form @submit.prevent="submitAdd()" class="p-6 space-y-4">
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Nama
                            <span class="text-rose-500">*</span></label>
                        <input type="text" x-model="formAdd.nama" placeholder="Cth: Budi Santoso" required
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Foto
                            Profil</label>
                        <input type="file" x-ref="fotoAdd" accept="image/*"
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Perusahaan</label>
                        <input type="text" x-model="formAdd.perusahaan" placeholder="Cth: PT Maju Jaya"
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Isi
                            Testimoni <span class="text-rose-500">*</span></label>
                        <textarea x-model="formAdd.testimoni" placeholder="Tuliskan ulasan pelanggan di sini..." required rows="4"
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none"></textarea>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Status
                            <span class="text-rose-500">*</span></label>
                        <select x-model="formAdd.status" required
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-end gap-2.5">
                        <button type="button" @click="closeAddModal()"
                            class="px-4 py-2.5 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">Batal</button>
                        <button type="submit" :disabled="isSubmitting"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all shadow-sm shadow-brand-500/20 disabled:opacity-50">
                            <template x-if="isSubmitting">
                                <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                            </template>
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan Testimoni'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- MODAL: UBAH TESTIMONI                                                     -->
        <!-- ========================================================================= -->
        <div x-show="isEditModalOpen" x-cloak
            class="fixed inset-0 z-[99999] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm overflow-y-auto"
            @keydown.escape.window="closeEditModal()">
            <div @click.outside="closeEditModal()" x-show="isEditModalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-lg rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden my-6">

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
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Ubah Data Testimoni</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Perbarui ulasan dari pelanggan.</p>
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
                <form @submit.prevent="submitEdit()" class="p-6 space-y-4">
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Nama
                            <span class="text-rose-500">*</span></label>
                        <input type="text" x-model="formEdit.nama" required
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Foto
                            Profil</label>
                        <input type="file" x-ref="fotoEdit" accept="image/*"
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                        <p class="text-[10px] sm:text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Perusahaan</label>
                        <input type="text" x-model="formEdit.perusahaan"
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Isi
                            Testimoni <span class="text-rose-500">*</span></label>
                        <textarea x-model="formEdit.testimoni" required rows="4"
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none"></textarea>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Status
                            <span class="text-rose-500">*</span></label>
                        <select x-model="formEdit.status" required
                            class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-end gap-2.5">
                        <button type="button" @click="closeEditModal()"
                            class="px-4 py-2.5 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">Batal</button>
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
        <!-- MODAL: HAPUS TESTIMONI                                                    -->
        <!-- ========================================================================= -->
        <div x-show="isDeleteModalOpen" x-cloak
            class="fixed inset-0 z-[99999] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm"
            @keydown.escape.window="closeDeleteModal()">
            <div @click.outside="closeDeleteModal()" x-show="isDeleteModalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-sm rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl p-6 text-center">

                <div
                    class="w-14 h-14 rounded-full bg-rose-100 dark:bg-rose-900/30 text-rose-500 mx-auto flex items-center justify-center mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Hapus Testimoni?</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Apakah Anda yakin ingin menghapus testimoni dari
                    <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="itemToDelete?.nama"></span>? Data
                    tidak dapat dikembalikan.</p>

                <div class="flex items-center justify-center gap-3">
                    <button @click="closeDeleteModal()" type="button"
                        class="px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">Batal</button>
                    <button @click="confirmDelete()" :disabled="isSubmitting" type="button"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 text-xs sm:text-sm font-medium text-white bg-rose-500 hover:bg-rose-600 rounded-xl transition-all shadow-sm shadow-rose-500/20 disabled:opacity-50">
                        <template x-if="isSubmitting">
                            <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
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
            Alpine.data('testimoniManager', () => ({
                testimonis: [],
                searchQuery: '',
                isSubmitting: false,
                isAddModalOpen: false,
                isEditModalOpen: false,
                isDeleteModalOpen: false,
                itemToDelete: null,
                formAdd: {
                    nama: '',
                    perusahaan: '',
                    testimoni: '',
                    status: 'published'
                },
                formEdit: {
                    id: null,
                    nama: '',
                    perusahaan: '',
                    testimoni: '',
                    status: 'published'
                },
                currentPage: 1,
                perPage: 10,

                init() {
                    this.fetchData();
                    this.$watch('searchQuery', () => {
                        this.currentPage = 1;
                    });
                },

                async fetchData() {
                    try {
                        const res = await fetch('{{ route('admin.testimoni.index') }}', {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        const data = await res.json();
                        if (data.status === 'success') {
                            this.testimonis = data.data;
                        }
                    } catch (error) {
                        console.error("Error fetching data:", error);
                    }
                },

                get filteredTestimonis() {
                    let result = this.testimonis;
                    if (this.searchQuery) {
                        const q = this.searchQuery.toLowerCase();
                        result = result.filter(item =>
                            (item.nama && item.nama.toLowerCase().includes(q)) ||
                            (item.perusahaan && item.perusahaan.toLowerCase().includes(q)) ||
                            (item.testimoni && item.testimoni.toLowerCase().includes(q))
                        );
                    }
                    return result;
                },

                get paginatedTestimonis() {
                    const start = (this.currentPage - 1) * this.perPage;
                    const end = start + this.perPage;
                    return this.filteredTestimonis.slice(start, end);
                },

                get totalPages() {
                    return Math.ceil(this.filteredTestimonis.length / this.perPage);
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
                        perusahaan: '',
                        testimoni: '',
                        status: 'published'
                    };
                    if (this.$refs.fotoAdd) this.$refs.fotoAdd.value = '';
                    this.isAddModalOpen = true;
                },
                closeAddModal() {
                    this.isAddModalOpen = false;
                },

                async submitAdd() {
                    this.isSubmitting = true;
                    try {
                        const formData = new FormData();
                        formData.append('nama', this.formAdd.nama);
                        formData.append('perusahaan', this.formAdd.perusahaan);
                        formData.append('testimoni', this.formAdd.testimoni);
                        formData.append('status', this.formAdd.status);
                        if (this.$refs.fotoAdd && this.$refs.fotoAdd.files[0]) {
                            formData.append('foto', this.$refs.fotoAdd.files[0]);
                        }

                        const res = await fetch('{{ route('admin.testimoni.store') }}', {
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
                            this.testimonis.unshift(result.data);
                            this.closeAddModal();
                        }
                    } catch (error) {
                        console.error(error);
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                openEditModal(item) {
                    this.formEdit = {
                        ...item
                    };
                    if (this.$refs.fotoEdit) this.$refs.fotoEdit.value = '';
                    this.isEditModalOpen = true;
                },
                closeEditModal() {
                    this.isEditModalOpen = false;
                },

                async submitEdit() {
                    this.isSubmitting = true;
                    try {
                        const formData = new FormData();
                        formData.append('_method', 'PUT');
                        formData.append('id', this.formEdit.id);
                        formData.append('nama', this.formEdit.nama);
                        formData.append('perusahaan', this.formEdit.perusahaan);
                        formData.append('testimoni', this.formEdit.testimoni);
                        formData.append('status', this.formEdit.status);

                        if (this.$refs.fotoEdit && this.$refs.fotoEdit.files[0]) {
                            formData.append('foto', this.$refs.fotoEdit.files[0]);
                        }

                        const res = await fetch(
                        `{{ url('admin/testimoni') }}/${this.formEdit.id}`, {
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
                            const index = this.testimonis.findIndex(t => t.id === this.formEdit.id);
                            if (index !== -1) {
                                this.testimonis[index] = result.data;
                            }
                            this.closeEditModal();
                        }
                    } catch (error) {
                        console.error(error);
                    } finally {
                        this.isSubmitting = false;
                    }
                },

                openDeleteModal(item) {
                    this.itemToDelete = item;
                    this.isDeleteModalOpen = true;
                },
                closeDeleteModal() {
                    this.isDeleteModalOpen = false;
                    this.itemToDelete = null;
                },

                async confirmDelete() {
                    if (!this.itemToDelete) return;
                    this.isSubmitting = true;
                    try {
                        const res = await fetch(
                            `{{ url('admin/testimoni') }}/${this.itemToDelete.id}`, {
                                method: 'DELETE',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });
                        const result = await res.json();
                        if (result.status === 'success') {
                            this.testimonis = this.testimonis.filter(t => t.id !== this.itemToDelete
                                .id);
                            this.closeDeleteModal();
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
