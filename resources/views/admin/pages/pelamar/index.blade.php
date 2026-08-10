@extends('admin.layouts.app')

@section('content')
  <div x-data="pelamarManager()" x-init="init()" class="space-y-6 max-w-full overflow-x-hidden">
    <!-- Breadcrumb & Header Section -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center gap-2.5">
          <span class="p-2 rounded-xl bg-brand-500/10 text-brand-500 dark:bg-brand-500/20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
          </span>
          Master Data Pelamar Kerja
        </h1>
        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
          Kelola berkas kandidat pelamar yang masuk dari formulir karir, evaluasi CV, dan pembaruan status seleksi.
        </p>
      </div>

      <!-- Action CTA -->
      <div class="flex items-center gap-2.5 flex-wrap">
        <a href="{{ route('admin.karir.index') }}"
          class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-xs sm:text-sm font-medium text-brand-600 bg-brand-50 dark:bg-brand-500/10 dark:text-brand-400 rounded-xl hover:bg-brand-100 transition-all border border-brand-200/60 dark:border-brand-500/20">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
            </path>
          </svg>
          Kelola Master Karir
        </a>
      </div>
    </div>

    <!-- Stat Summary Cards (Persis seperti master karir) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
      <!-- Total Pelamar -->
      <div
        class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
        <div
          class="w-11 h-11 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
            </path>
          </svg>
        </div>
        <div class="min-w-0">
          <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Total Pelamar</p>
          <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mt-0.5" x-text="pelamars.length">0</h4>
        </div>
      </div>

      <!-- Menunggu Review (Pending) -->
      <div
        class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
        <div
          class="w-11 h-11 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
            </path>
          </svg>
        </div>
        <div class="min-w-0">
          <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Menunggu Review</p>
          <h4 class="text-lg sm:text-xl font-bold text-amber-600 dark:text-amber-400 mt-0.5" x-text="countPending()">0</h4>
        </div>
      </div>

      <!-- Dalam Seleksi (Review / Wawancara) -->
      <div
        class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
        <div
          class="w-11 h-11 rounded-xl bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
            </path>
          </svg>
        </div>
        <div class="min-w-0">
          <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Review / Interview</p>
          <h4 class="text-lg sm:text-xl font-bold text-purple-600 dark:text-purple-400 mt-0.5" x-text="countProses()">0</h4>
        </div>
      </div>

      <!-- Diterima / Lolos -->
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
          <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Diterima / Lolos</p>
          <h4 class="text-lg sm:text-xl font-bold text-emerald-600 dark:text-emerald-400 mt-0.5" x-text="countDiterima()">0</h4>
        </div>
      </div>
    </div>

    <!-- Main Table Container (Persis seperti master karir & berita) -->
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
            placeholder="Cari nama kandidat, email, no WA, atau posisi..."
            class="w-full pl-9 pr-8 py-2 text-xs sm:text-sm bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all outline-none" />
          <button x-show="searchQuery" @click="searchQuery = ''; currentPage = 1"
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
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
              <option value="Pending" class="dark:bg-gray-800">Pending (Menunggu)</option>
              <option value="Review" class="dark:bg-gray-800">Review</option>
              <option value="Wawancara" class="dark:bg-gray-800">Wawancara</option>
              <option value="Diterima" class="dark:bg-gray-800">Diterima</option>
              <option value="Ditolak" class="dark:bg-gray-800">Ditolak</option>
            </select>
          </div>

          <!-- Filter Posisi Lowongan -->
          <div
            class="flex items-center gap-1.5 bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700 rounded-xl px-2.5 py-1.5">
            <span class="text-xs text-gray-400 font-medium hidden sm:inline">Posisi:</span>
            <select x-model="selectedPosisi" @change="currentPage = 1"
              class="bg-transparent text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-200 outline-none cursor-pointer pr-2 max-w-[170px] truncate">
              <option value="Semua" class="dark:bg-gray-800">Semua Posisi</option>
              <template x-for="pos in uniquePositions" :key="pos">
                <option :value="pos" x-text="pos" class="dark:bg-gray-800"></option>
              </template>
            </select>
          </div>

          <!-- Reset Filter -->
          <button x-show="searchQuery || selectedStatus !== 'Semua' || selectedPosisi !== 'Semua'" @click="resetFilters()"
            class="text-xs font-medium text-brand-500 hover:text-brand-600 dark:hover:text-brand-400 px-2.5 py-2 hover:bg-brand-50 dark:hover:bg-brand-500/10 rounded-xl transition-all cursor-pointer">
            Reset Filter
          </button>
        </div>
      </div>

      <!-- Responsive Table (100% Fluid Width) -->
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
                Kandidat Pelamar
              </th>
              <th
                class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase">
                Posisi yang Dilamar
              </th>
              <th
                class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase text-center">
                Berkas CV
              </th>
              <th
                class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase hidden md:table-cell">
                Waktu Masuk
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
            <template x-for="(item, index) in paginatedPelamars" :key="item.id">
              <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-800/40 transition-colors">
                <!-- No -->
                <td class="py-3.5 px-3.5 sm:px-5 font-mono text-gray-400 dark:text-gray-500 text-xs"
                  x-text="((currentPage - 1) * perPage) + index + 1"></td>

                <!-- Pelamar Info (Avatar Inisial, Nama, Email, WA) -->
                <td class="py-3.5 px-3.5 sm:px-5 min-w-[220px]">
                  <div class="flex items-start gap-3">
                    <div
                      class="w-9 h-9 rounded-xl bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400 flex items-center justify-center shrink-0 mt-0.5 font-bold text-sm border border-brand-200/50 dark:border-brand-500/20"
                      x-text="item.nama ? item.nama.charAt(0).toUpperCase() : 'P'">
                    </div>
                    <div>
                      <h4 @click="openDetailModal(item)"
                        class="font-semibold text-gray-900 dark:text-white hover:text-brand-500 cursor-pointer transition"
                        x-text="item.nama"></h4>
                      <div class="flex flex-col sm:flex-row sm:items-center gap-x-2 text-xs text-gray-400 dark:text-gray-500 mt-0.5">
                        <span x-text="item.email"></span>
                        <span class="hidden sm:inline">•</span>
                        <span class="font-mono text-gray-600 dark:text-gray-300" x-text="item.telepon"></span>
                      </div>
                    </div>
                  </div>
                </td>

                <!-- Posisi yang Dilamar + Total Pendaftar Lowongan Tersebut -->
                <td class="py-3.5 px-3.5 sm:px-5 min-w-[200px]">
                  <div class="flex flex-col gap-1">
                    <span class="font-semibold text-gray-900 dark:text-white" x-text="item.posisi"></span>
                    <div class="flex items-center gap-1.5">
                      <span
                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-semibold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 border border-gray-200/60 dark:border-gray-700">
                        <svg class="w-3 h-3 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                          </path>
                        </svg>
                        <span x-text="getApplicantCountForPosition(item.posisi) + ' Orang Mendaftar'"></span>
                      </span>
                    </div>
                  </div>
                </td>

                <!-- Berkas CV PDF -->
                <td class="py-3.5 px-3.5 sm:px-5 text-center whitespace-nowrap">
                  <template x-if="item.file_cv">
                    <a :href="'/admin/pelamar/' + item.id + '/cv'" target="_blank"
                      class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/40 dark:text-rose-400 dark:hover:bg-rose-900/50 rounded-lg transition border border-rose-200 dark:border-rose-800"
                      title="Unduh / Buka Berkas CV">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                      </svg>
                      <span>CV (.pdf)</span>
                    </a>
                  </template>
                  <template x-if="!item.file_cv">
                    <span class="text-xs text-gray-400">-</span>
                  </template>
                </td>

                <!-- Tanggal Masuk -->
                <td class="py-3.5 px-3.5 sm:px-5 hidden md:table-cell text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap"
                  x-text="item.formatted_date || item.created_at || '-'"></td>

                <!-- Status Seleksi -->
                <td class="py-3.5 px-3.5 sm:px-5 text-center whitespace-nowrap">
                  <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-medium border"
                    :class="getStatusBadgeClass(item.status)">
                    <span class="w-1.5 h-1.5 rounded-full" :class="getStatusDotClass(item.status)"></span>
                    <span x-text="item.status"></span>
                  </span>
                </td>

                <!-- Aksi -->
                <td class="py-3.5 px-3.5 sm:px-5 text-right whitespace-nowrap">
                  <div class="flex items-center justify-end gap-1">
                    <!-- Chat WhatsApp -->
                    <a :href="'https://wa.me/' + cleanPhone(item.telepon)" target="_blank" title="Hubungi Pelamar via WhatsApp"
                      class="p-1.5 rounded-lg text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 transition cursor-pointer">
                      <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path
                          d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654z" />
                      </svg>
                    </a>

                    <!-- Detail / Review Status -->
                    <button @click="openDetailModal(item)" type="button" title="Lihat Detail & Update Status"
                      class="p-1.5 rounded-lg text-gray-400 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-500/10 transition-colors cursor-pointer">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                      </svg>
                    </button>

                    <!-- Delete -->
                    <button @click="openDeleteModal(item)" type="button" title="Hapus Data Pelamar"
                      class="p-1.5 rounded-lg text-gray-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors cursor-pointer">
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
            <tr x-show="filteredPelamars.length === 0">
              <td colspan="7" class="py-12 text-center">
                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                  <div
                    class="w-14 h-14 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                      </path>
                    </svg>
                  </div>
                  <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Tidak Ada Data Pelamar</h4>
                  <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 text-center">
                    Tidak ditemukan kandidat pelamar yang cocok dengan kata kunci atau filter saat ini.
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

      <!-- Table Footer (Pagination & Meta) -->
      <div
        class="p-3.5 sm:p-4 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-gray-500 dark:text-gray-400 bg-gray-50/30 dark:bg-white/[0.01]">
        <div>
          Menampilkan
          <span class="font-semibold text-gray-900 dark:text-white"
            x-text="filteredPelamars.length > 0 ? ((currentPage - 1) * perPage) + 1 : 0"></span> -
          <span class="font-semibold text-gray-900 dark:text-white"
            x-text="Math.min(currentPage * perPage, filteredPelamars.length)"></span>
          dari <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredPelamars.length"></span>
          pelamar
        </div>

        <!-- Pagination Controls -->
        <template x-if="filteredPelamars.length > 10">
          <div class="flex items-center gap-1.5 self-center sm:self-auto">
            <button @click="prevPage()" :disabled="currentPage === 1"
              class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-40 disabled:cursor-not-allowed transition cursor-pointer">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
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
    <!-- MODAL: DETAIL & UPDATE STATUS PELAMAR                                     -->
    <!-- ========================================================================= -->
    <div x-show="isDetailModalOpen" x-cloak
      class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm overflow-y-auto"
      @keydown.escape.window="isDetailModalOpen = false">
      <div @click.outside="isDetailModalOpen = false" x-show="isDetailModalOpen"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="w-full max-w-2xl rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden my-8">

        <template x-if="selectedItem">
          <div>
            <!-- Modal Header -->
            <div class="px-6 py-4.5 border-b border-gray-100 dark:border-gray-800 flex items-start justify-between">
              <div class="flex items-start gap-3">
                <div
                  class="w-11 h-11 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center font-bold text-lg shrink-0 mt-0.5"
                  x-text="selectedItem.nama ? selectedItem.nama.charAt(0).toUpperCase() : 'P'">
                </div>
                <div>
                  <div class="flex items-center gap-2 flex-wrap mb-1">
                    <span
                      class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400"
                      x-text="selectedItem.posisi"></span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold border"
                      :class="getStatusBadgeClass(selectedItem.status)" x-text="selectedItem.status"></span>
                  </div>
                  <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white" x-text="selectedItem.nama"></h3>
                </div>
              </div>
              <button @click="isDetailModalOpen = false" class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
              <!-- Info Kontak & Posisi Grid -->
              <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700/60 space-y-2.5 text-xs">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <div>
                    <span class="text-gray-400 block mb-0.5">Email Kandidat:</span>
                    <a :href="'mailto:' + selectedItem.email" class="font-semibold text-brand-500 hover:underline"
                      x-text="selectedItem.email"></a>
                  </div>
                  <div>
                    <span class="text-gray-400 block mb-0.5">WhatsApp / Telepon:</span>
                    <div class="flex items-center gap-2">
                      <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="selectedItem.telepon"></span>
                      <a :href="'https://wa.me/' + cleanPhone(selectedItem.telepon)" target="_blank"
                        class="px-2 py-0.5 bg-emerald-50 text-emerald-600 font-semibold rounded-md hover:bg-emerald-100 transition inline-flex items-center gap-1 text-[11px]">
                        <span>Hubungi WA</span>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 border-t border-gray-200 dark:border-gray-700">
                  <div>
                    <span class="text-gray-400 block mb-0.5">Waktu Mendaftar:</span>
                    <p class="font-medium text-gray-800 dark:text-gray-200"
                      x-text="selectedItem.formatted_date || selectedItem.created_at || '-'"></p>
                  </div>
                  <div>
                    <span class="text-gray-400 block mb-0.5">Total Pendaftar Posisi Ini:</span>
                    <p class="font-semibold text-brand-600 dark:text-brand-400"
                      x-text="getApplicantCountForPosition(selectedItem.posisi) + ' Orang Mendaftar'"></p>
                  </div>
                </div>

                <div class="pt-2 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                  <span class="text-gray-400">Berkas CV:</span>
                  <template x-if="selectedItem.file_cv">
                    <a :href="'/admin/pelamar/' + selectedItem.id + '/cv'" target="_blank"
                      class="inline-flex items-center gap-1.5 font-semibold text-rose-600 dark:text-rose-400 hover:underline">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                      </svg>
                      <span>Unduh Berkas CV (.pdf)</span>
                    </a>
                  </template>
                </div>
              </div>

              <!-- Pesan Pengantar / Cover Letter -->
              <div>
                <h4 class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                  Pesan / Surat Pengantar Kandidat
                </h4>
                <div
                  class="p-3.5 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-xs sm:text-sm text-gray-600 dark:text-gray-300 leading-relaxed italic"
                  x-text="selectedItem.pesan ? '“' + selectedItem.pesan + '”' : 'Tidak ada pesan pengantar.'">
                </div>
              </div>

              <!-- Form Update Status & Catatan HRD -->
              <form @submit.prevent="submitUpdateStatus()" class="space-y-3.5 pt-3 border-t border-gray-100 dark:border-gray-800">
                <div>
                  <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                    Status Seleksi Kandidat <span class="text-rose-500">*</span>
                  </label>
                  <select x-model="formEdit.status" required
                    class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                    <option value="Pending">Pending (Menunggu Review)</option>
                    <option value="Review">Review (Sedang Ditinjau Tim HRD)</option>
                    <option value="Wawancara">Wawancara (Kandidat Masuk Tahap Interview)</option>
                    <option value="Diterima">Diterima (Lolos Seleksi Kerja)</option>
                    <option value="Ditolak">Ditolak (Tidak Memenuhi Kualifikasi)</option>
                  </select>
                </div>

                <div>
                  <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                    Catatan Internal HRD (Opsional)
                  </label>
                  <textarea x-model="formEdit.catatan_admin" rows="3"
                    placeholder="Tuliskan catatan hasil review, skor interview, atau rekomendasi..."
                    class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none"></textarea>
                </div>

                <div class="pt-2 flex items-center justify-end gap-2.5">
                  <button type="button" @click="isDetailModalOpen = false"
                    class="px-4 py-2.5 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 rounded-xl transition cursor-pointer">
                    Tutup
                  </button>
                  <button type="submit" :disabled="isSubmitting"
                    class="inline-flex items-center gap-1.5 px-5 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition shadow-sm shadow-brand-500/20 disabled:opacity-50 cursor-pointer">
                    <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan Status & Catatan'"></span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </template>
      </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL: HAPUS PELAMAR                                                      -->
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
        <h3 class="text-base font-bold text-gray-900 dark:text-white">Konfirmasi Hapus Pelamar</h3>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
          Apakah Anda yakin ingin menghapus berkas pelamar <strong class="text-gray-800 dark:text-gray-200"
            x-text="selectedItem?.nama"></strong>? Berkas CV akan ikut terhapus secara permanen.
        </p>
        <div class="mt-6 flex items-center justify-center gap-3">
          <button @click="isDeleteModalOpen = false" type="button"
            class="px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 rounded-xl transition cursor-pointer">
            Batal
          </button>
          <button @click="confirmDeletePelamar()" type="button" :disabled="isSubmitting"
            class="inline-flex items-center gap-1.5 px-4 py-2 text-xs sm:text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition shadow-sm disabled:opacity-50 cursor-pointer">
            <span x-text="isSubmitting ? 'Menghapus...' : 'Ya, Hapus'"></span>
          </button>
        </div>
      </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div x-show="toast.show" x-cloak x-transition:enter="transition ease-out duration-300 transform"
      x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
      x-transition:leave="transition ease-in duration-200 transform"
      x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
      class="fixed bottom-5 right-5 z-99999 flex items-center gap-3 px-4 py-3 rounded-2xl shadow-xl border text-xs sm:text-sm font-medium"
      :class="{
          'bg-emerald-50 text-emerald-800 border-emerald-200 dark:bg-emerald-950 dark:text-emerald-300 dark:border-emerald-800': toast.type === 'success',
          'bg-rose-50 text-rose-800 border-rose-200 dark:bg-rose-950 dark:text-rose-300 dark:border-rose-800': toast.type === 'error'
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

  <script>
    function pelamarManager() {
      return {
        pelamars: @json($pelamars),
        searchQuery: '',
        selectedStatus: 'Semua',
        selectedPosisi: 'Semua',
        currentPage: 1,
        perPage: 10,
        isDetailModalOpen: false,
        isDeleteModalOpen: false,
        isSubmitting: false,
        selectedItem: null,
        formEdit: {
          status: 'Pending',
          catatan_admin: ''
        },
        toast: {
          show: false,
          message: '',
          type: 'success'
        },

        init() {
          // Check if there is ?posisi= query parameter in URL on page load
          const urlParams = new URLSearchParams(window.location.search);
          if (urlParams.has('posisi')) {
            const pos = urlParams.get('posisi');
            if (pos) {
              this.selectedPosisi = pos;
            }
          }

          this.$watch('searchQuery', () => { this.currentPage = 1; });
          this.$watch('selectedStatus', () => { this.currentPage = 1; });
          this.$watch('selectedPosisi', () => { this.currentPage = 1; });
        },

        showToast(message, type = 'success') {
          this.toast.message = message;
          this.toast.type = type;
          this.toast.show = true;
          setTimeout(() => { this.toast.show = false; }, 3500);
        },

        cleanPhone(phone) {
          if (!phone) return '';
          let cleaned = phone.replace(/[^0-9]/g, '');
          if (cleaned.startsWith('0')) {
            cleaned = '62' + cleaned.substring(1);
          }
          return cleaned;
        },

        get uniquePositions() {
          return [...new Set(this.pelamars.map(p => p.posisi).filter(Boolean))];
        },

        getApplicantCountForPosition(posisiName) {
          if (!posisiName) return 0;
          return this.pelamars.filter(p => p.posisi && p.posisi.trim().toLowerCase() === posisiName.trim().toLowerCase()).length;
        },

        get filteredPelamars() {
          return this.pelamars.filter(item => {
            const query = this.searchQuery.toLowerCase();
            const matchQuery = this.searchQuery === '' ||
              (item.nama && item.nama.toLowerCase().includes(query)) ||
              (item.email && item.email.toLowerCase().includes(query)) ||
              (item.telepon && item.telepon.includes(query)) ||
              (item.posisi && item.posisi.toLowerCase().includes(query));

            const matchStatus = this.selectedStatus === 'Semua' || item.status === this.selectedStatus;
            const matchPosisi = this.selectedPosisi === 'Semua' || item.posisi === this.selectedPosisi;

            return matchQuery && matchStatus && matchPosisi;
          });
        },

        get totalPages() {
          return Math.ceil(this.filteredPelamars.length / this.perPage) || 1;
        },

        get paginatedPelamars() {
          const start = (this.currentPage - 1) * this.perPage;
          return this.filteredPelamars.slice(start, start + this.perPage);
        },

        goToPage(page) {
          if (page >= 1 && page <= this.totalPages) this.currentPage = page;
        },
        prevPage() {
          if (this.currentPage > 1) this.currentPage--;
        },
        nextPage() {
          if (this.currentPage < this.totalPages) this.currentPage++;
        },

        resetFilters() {
          this.searchQuery = '';
          this.selectedStatus = 'Semua';
          this.selectedPosisi = 'Semua';
          this.currentPage = 1;
        },

        countPending() {
          return this.pelamars.filter(p => p.status === 'Pending').length;
        },
        countProses() {
          return this.pelamars.filter(p => p.status === 'Review' || p.status === 'Wawancara').length;
        },
        countDiterima() {
          return this.pelamars.filter(p => p.status === 'Diterima').length;
        },

        getStatusBadgeClass(status) {
          switch (status) {
            case 'Pending':
              return 'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400 border-amber-200 dark:border-amber-800';
            case 'Review':
              return 'bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-400 border-blue-200 dark:border-blue-800';
            case 'Wawancara':
              return 'bg-purple-50 text-purple-700 dark:bg-purple-950/40 dark:text-purple-400 border-purple-200 dark:border-purple-800';
            case 'Diterima':
              return 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800';
            case 'Ditolak':
              return 'bg-rose-50 text-rose-700 dark:bg-rose-950/40 dark:text-rose-400 border-rose-200 dark:border-rose-800';
            default:
              return 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 border-gray-200';
          }
        },

        getStatusDotClass(status) {
          switch (status) {
            case 'Pending': return 'bg-amber-500';
            case 'Review': return 'bg-blue-500';
            case 'Wawancara': return 'bg-purple-500';
            case 'Diterima': return 'bg-emerald-500';
            case 'Ditolak': return 'bg-rose-500';
            default: return 'bg-gray-400';
          }
        },

        openDetailModal(item) {
          this.selectedItem = item;
          this.formEdit = {
            status: item.status || 'Pending',
            catatan_admin: item.catatan_admin || ''
          };
          this.isDetailModalOpen = true;
        },

        openDeleteModal(item) {
          this.selectedItem = item;
          this.isDeleteModalOpen = true;
        },

        async submitUpdateStatus() {
          if (!this.selectedItem) return;
          this.isSubmitting = true;

          try {
            const response = await fetch(`/admin/pelamar/${this.selectedItem.id}`, {
              method: 'PUT',
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({
                status: this.formEdit.status,
                catatan_admin: this.formEdit.catatan_admin
              })
            });

            const res = await response.json();
            if (response.ok && res.status === 'success') {
              const idx = this.pelamars.findIndex(p => p.id === this.selectedItem.id);
              if (idx !== -1) {
                this.pelamars[idx].status = res.data.status;
                this.pelamars[idx].catatan_admin = res.data.catatan_admin;
              }
              this.isDetailModalOpen = false;
              this.showToast(res.message || 'Status berhasil diperbarui!', 'success');
            } else {
              this.showToast(res.message || 'Gagal memperbarui status!', 'error');
            }
          } catch (err) {
            this.showToast('Terjadi kesalahan jaringan.', 'error');
          } finally {
            this.isSubmitting = false;
          }
        },

        async confirmDeletePelamar() {
          if (!this.selectedItem) return;
          this.isSubmitting = true;

          try {
            const response = await fetch(`/admin/pelamar/${this.selectedItem.id}`, {
              method: 'DELETE',
              headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              }
            });

            const res = await response.json();
            if (response.ok && res.status === 'success') {
              this.pelamars = this.pelamars.filter(p => p.id !== this.selectedItem.id);
              this.isDeleteModalOpen = false;
              this.showToast(res.message || 'Pelamar berhasil dihapus!', 'success');
            } else {
              this.showToast(res.message || 'Gagal menghapus data!', 'error');
            }
          } catch (err) {
            this.showToast('Terjadi kesalahan jaringan.', 'error');
          } finally {
            this.isSubmitting = false;
          }
        }
      };
    }
  </script>
@endsection
