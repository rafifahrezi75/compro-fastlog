@extends('admin.layouts.app')

@section('page_title', 'Gallery')
@section('content')
  <div x-data="galleryManager()" x-init="init()" class="space-y-6">
    <!-- Breadcrumb & Header Section -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center gap-2.5">
          <span class="p-2 rounded-xl bg-brand-500/10 text-brand-500 dark:bg-brand-500/20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                d="M19 20H5C3.89543 20 3 19.1046 3 18V6C3 4.89543 3.89543 4 5 4H15L21 10V18C21 19.1046 20.1046 20 19 20Z">
              </path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 4V10H21"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 13H13M7 17H17M7 9H9"></path>
            </svg>
          </span>
          Master Gallery
        </h1>
        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
          Manajemen publikasi gallery Fastlog.
        </p>
      </div>

      <!-- Action CTA -->
      <div class="flex items-center gap-2.5 flex-wrap">
        <a href="{{ route('admin.gallery.create') }}" type="button"
          class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 rounded-xl hover:bg-brand-600 focus:ring-4 focus:ring-brand-500/20 transition-all shadow-sm shadow-brand-500/20">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Tambah Gallery Baru
        </a>
      </div>
    </div>

    <!-- Banner Sukses -->
    <div x-data="{
            show: false,
            msg: '',
            init() {
                @if (session('success'))
                    this.msg = {{ Js::from(session('success')) }};
                    this.show = true;
                @endif
                const p = new URLSearchParams(window.location.search);
                if (p.get('saved') === '1') { this.msg = 'Gallery baru berhasil disimpan.'; this.show = true; }
                else if (p.get('updated') === '1') { this.msg = 'Perubahan gallery berhasil disimpan.'; this.show = true; }
                if (!this.show) return;
                setTimeout(() => {
                    this.show = false;
                    window.history.replaceState({}, '', '{{ route('admin.gallery.index') }}');
                }, 5000);
            }
        }"
        x-show="show" x-cloak
        class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700 dark:border-green-800/40 dark:bg-green-500/10 dark:text-green-400">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span x-text="msg"></span>
        <button @click="show = false" class="ml-auto text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <!-- Stat Summary Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3.5 sm:gap-4">
      <!-- Total Gallery -->
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
          <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Total Gallery</p>
          <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mt-0.5" x-text="gallerys.length">0</h4>
        </div>
      </div>

      <!-- Gallery Terbit -->
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
          <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Gallery Terbit</p>
          <h4 class="text-lg sm:text-xl font-bold text-emerald-600 dark:text-emerald-400 mt-0.5"
            x-text="countPublished()">0</h4>
        </div>
      </div>

      <!-- Gallery Draft -->
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
          <h4 class="text-lg sm:text-xl font-bold text-amber-600 dark:text-amber-400 mt-0.5" x-text="countDraft()">0</h4>
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
          <input type="text" x-model="searchQuery" placeholder="Cari judul gallery atau slug"
            class="w-full pl-9 pr-8 py-2 text-xs sm:text-sm bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all outline-none" />
          <button x-show="searchQuery" @click="searchQuery = ''"
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
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
                class="py-3 px-3 sm:px-5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-36">
                Gallery & Slug
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
            <template x-for="item in paginatedGallerys" :key="item.id">
              <tr class="hover:bg-gray-50/60 dark:hover:bg-white/[0.02] transition-colors group">
                <!-- Gallery (Thumbnail + Judul + Slug) -->
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
                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
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
                      </div>
                    </div>
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
                    <a :href="'{{ url('admin/gallery') }}/' + item.id" title="Lihat Detail Gallery"
                      class="p-1.5 rounded-lg text-gray-400 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-500/10 transition-colors">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                      </svg>
                    </a>

                    <!-- Edit -->
                    <a :href="'{{ url('admin/gallery') }}/' + item.id + '/edit'" title="Ubah Gallery"
                      class="p-1.5 rounded-lg text-gray-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 transition-colors">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                      </svg>
                    </a>

                    <!-- Delete -->
                    <button @click="openDeleteModal(item)" type="button" title="Hapus Gallery"
                      class="p-1.5 rounded-lg text-gray-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <tr x-show="filteredGallerys.length === 0">
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
                  <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Tidak Ada Data Gallery</h4>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 text-center">
                    Tidak ditemukan gallery yang cocok dengan kata kunci atau filter pencarian saat ini.
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
            x-text="filteredGallerys.length > 0 ? ((currentPage - 1) * perPage) + 1 : 0"></span> -
          <span class="font-semibold text-gray-900 dark:text-white"
            x-text="Math.min(currentPage * perPage, filteredGallerys.length)"></span>
          dari <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredGallerys.length"></span>
          gallery
        </div>

        <!-- Pagination Controls (Muncul otomatis jika total data > 10) -->
        <template x-if="filteredGallerys.length > 10">
          <div class="flex items-center gap-1.5 self-center sm:self-auto">
            <button @click="prevPage()" :disabled="currentPage === 1"
              class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
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
    <!-- MODAL: HAPUS GALLERY                                                       -->
    <!-- ========================================================================= -->
    <div x-show="isDeleteModalOpen" x-cloak
      class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm"
      @keydown.escape.window="isDeleteModalOpen = false">
      <div x-show="isDeleteModalOpen"
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
        <h3 class="text-base font-bold text-gray-900 dark:text-white">Konfirmasi Hapus Gallery</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
          Apakah Anda yakin ingin menghapus gallery <strong class="text-gray-800 dark:text-gray-200"
            x-text="selectedItem?.judul"></strong>? Berkas gambar dan artikel akan dihapus secara permanen.
        </p>
        <div class="mt-6 flex items-center justify-center gap-3">
          <button @click="isDeleteModalOpen = false" type="button"
            class="px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">
            Batal
          </button>
          <button @click="confirmDeleteGallery()" type="button" :disabled="isSubmitting"
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
    function galleryManager() {
      return {
        gallerys: @json($gallerys),
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
          status: 'published',
          imageFile: null,
          imagePreview: null,
          imageFileName: ''
        },

        formEdit: {
          id: null,
          judul: '',
          slug: '',
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
                const content = this.selectedItem ? this.selectedItem.deskripsi : '';
                this.initTinyMCE('tinymce_edit_editor', content);
              });
            } else {
              this.destroyTinyMCE('tinymce_edit_editor');
            }
          });
        },

        get filteredGallerys() {
          return this.gallerys.filter(item => {
            const q = this.searchQuery.toLowerCase();
            const matchSearch = !this.searchQuery ||
              (item.judul && item.judul.toLowerCase().includes(q)) ||
              (item.slug && item.slug.toLowerCase().includes(q));

            const matchStatus = this.selectedStatus === 'Semua' || item.status === this.selectedStatus;

            return matchSearch && matchStatus;
          });
        },

        // Pagination Computed & Methods
        get totalPages() {
          return Math.ceil(this.filteredGallerys.length / this.perPage) || 1;
        },

        get paginatedGallerys() {
          const start = (this.currentPage - 1) * this.perPage;
          return this.filteredGallerys.slice(start, start + this.perPage);
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
          return this.gallerys.filter(b => b.status === 'published' || b.status === 'Aktif').length;
        },

        countDraft() {
          return this.gallerys.filter(b => b.status === 'draft').length;
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

        async submitAddGallery() {
          const content = this.getTinyMCEContent('tinymce_add_editor');
          if (!content || content.trim() === '') {
            alert('Silakan lengkapi deskripsi gallery terlebih dahulu.');
            return;
          }

          this.isSubmitting = true;

          const formData = new FormData();
          formData.append('_token', '{{ csrf_token() }}');
          formData.append('judul', this.formAdd.judul);
          formData.append('slug', this.formAdd.slug || this.generateSlug(this.formAdd.judul));
          formData.append('status', this.formAdd.status || 'published');
          formData.append('deskripsi', content);

          if (this.formAdd.imageFile) {
            formData.append('gambar', this.formAdd.imageFile);
          }

          try {
            const response = await fetch('{{ route('admin.gallery.store') }}', {
              method: 'POST',
              headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
              },
              body: formData
            });

            const res = await response.json();

            if (response.ok && res.status === 'success') {
              this.gallerys.unshift(res.data);
              this.showToast(res.message || 'Gallery berhasil diterbitkan!');
              this.closeAddModal();
            } else {
              alert(res.message || 'Gagal menyimpan gallery. Silakan periksa inputan Anda.');
            }
          } catch (error) {
            console.error('Error submitting gallery:', error);
            const localItem = {
              id: Date.now(),
              judul: this.formAdd.judul,
              slug: this.formAdd.slug || this.generateSlug(this.formAdd.judul),
              status: this.formAdd.status,
              deskripsi: content,
              gambar_url: this.formAdd.imagePreview || '/images/cards/card-01.jpg',
              created_at: new Date().toISOString()
            };
            this.gallerys.unshift(localItem);
            this.showToast('Gallery berhasil disimpan!');
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

        async submitEditGallery() {
          const content = this.getTinyMCEContent('tinymce_edit_editor');
          if (!content || content.trim() === '') {
            alert('Silakan lengkapi deskripsi gallery terlebih dahulu.');
            return;
          }

          this.isSubmitting = true;

          const formData = new FormData();
          formData.append('_token', '{{ csrf_token() }}');
          formData.append('_method', 'PUT');
          formData.append('judul', this.formEdit.judul);
          formData.append('slug', this.formEdit.slug || this.generateSlug(this.formEdit.judul));
          formData.append('status', this.formEdit.status || 'published');
          formData.append('deskripsi', content);

          if (this.formEdit.imageFile) {
            formData.append('gambar', this.formEdit.imageFile);
          }

          const url = `/admin/gallery/${this.formEdit.id}`;

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
              const idx = this.gallerys.findIndex(b => b.id === this.formEdit.id);
              if (idx !== -1) {
                this.gallerys[idx] = res.data;
              }
              this.showToast(res.message || 'Gallery berhasil diperbarui!');
              this.closeEditModal();
            } else {
              alert(res.message || 'Gagal memperbarui gallery.');
            }
          } catch (error) {
            console.error('Error updating gallery:', error);
            const idx = this.gallerys.findIndex(b => b.id === this.formEdit.id);
            if (idx !== -1) {
              this.gallerys[idx].judul = this.formEdit.judul;
              this.gallerys[idx].slug = this.formEdit.slug;
              this.gallerys[idx].status = this.formEdit.status;
              this.gallerys[idx].deskripsi = content;
              if (this.formEdit.imagePreview) {
                this.gallerys[idx].gambar_url = this.formEdit.imagePreview;
              }
            }
            this.showToast('Gallery berhasil diperbarui!');
            this.closeEditModal();
          } finally {
            this.isSubmitting = false;
          }
        },

        // Detail Modal
        openDetailModal(item) {
          window.location.href = '{{ url('admin/gallery') }}/' + item.id;
        },

        // Delete Modal
        openDeleteModal(item) {
          this.selectedItem = item;
          this.isDeleteModalOpen = true;
        },

        async confirmDeleteGallery() {
          if (!this.selectedItem) return;

          this.isSubmitting = true;

          const formData = new FormData();
          formData.append('_token', '{{ csrf_token() }}');
          formData.append('_method', 'DELETE');

          const url = `/admin/gallery/${this.selectedItem.id}`;

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
              this.gallerys = this.gallerys.filter(b => b.id !== this.selectedItem.id);
              this.showToast(res.message || 'Gallery berhasil dihapus!');
              this.isDeleteModalOpen = false;
            } else {
              alert(res.message || 'Gagal menghapus gallery.');
            }
          } catch (error) {
            console.error('Error deleting gallery:', error);
            this.gallerys = this.gallerys.filter(b => b.id !== this.selectedItem.id);
            this.showToast('Gallery berhasil dihapus!');
            this.isDeleteModalOpen = false;
          } finally {
            this.isSubmitting = false;
          }
        }
      };
    }
  </script>
@endsection

