@extends('admin.layouts.app')

@section('page_title', 'Marketing')
@section('content')
    <div x-data="marketingManager()" x-init="init()" class="space-y-6">
        <!-- Breadcrumb & Header Section -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1
                    class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center gap-2.5">
                    <span class="p-2 rounded-xl bg-brand-500/10 text-brand-500 dark:bg-brand-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 11c2.20914 0 4-1.79086 4-4s-1.79086-4-4-4-4 1.79086-4 4 1.79086 4 4 4zm0 2c-3.31371 0-10 1.68629-10 5v2h20v-2c0-3.31371-6.68629-5-10-5z">
                            </path>
                        </svg>
                    </span>
                    Master Marketing
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Manajemen profil tim marketing dan kontak WhatsApp.
                </p>
            </div>

            <!-- Action CTA -->
            <div class="flex items-center gap-2.5 flex-wrap">
                <a href="{{ route('admin.marketing.create') }}" type="button"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 rounded-xl hover:bg-brand-600 focus:ring-4 focus:ring-brand-500/20 transition-all shadow-sm shadow-brand-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Marketing
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
                    if (p.get('saved') === '1') { this.msg = 'Profil marketing berhasil disimpan.'; this.show = true; }
                    else if (p.get('updated') === '1') { this.msg = 'Perubahan profil marketing berhasil disimpan.'; this.show = true; }
                    if (!this.show) return;
                    setTimeout(() => {
                        this.show = false;
                        window.history.replaceState({}, '', '{{ route('admin.marketing.index') }}');
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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
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
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Total Marketing</p>
                    <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mt-0.5"
                        x-text="marketings.length">0</h4>
                </div>
            </div>

            <!-- Online -->
            <div
                class="p-4 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm flex items-center gap-3.5">
                <div
                    class="w-11 h-11 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5.636 5.636a9 9 0 1012.728 0M12 3v9" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 truncate">Online</p>
                    <h4 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mt-0.5"
                        x-text="marketings.filter(m => m.status === 'online').length">0</h4>
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
                    <input type="text" x-model="searchQuery" placeholder="Cari nama, divisi, atau nomor WA..."
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
                                class="py-3 px-3.5 sm:px-5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-[35%]">
                                Profil & Divisi</th>
                            <th
                                class="py-3 px-3.5 sm:px-5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-[25%]">
                                Nomor WA</th>
                            <th
                                class="py-3 px-3.5 sm:px-5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-[20%]">
                                Status</th>
                            <th
                                class="py-3 px-3.5 sm:px-5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right w-[20%]">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800/80">
                        <template x-for="item in paginatedMarketings" :key="item.id">
                            <tr class="hover:bg-gray-50/60 dark:hover:bg-white/[0.02] transition-colors group">
                                <td class="py-3.5 px-3.5 sm:px-5">
                                    <div class="flex items-start gap-3 min-w-0">
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-brand-50 dark:bg-brand-950/40 text-brand-600 dark:text-brand-400 flex items-center justify-center shrink-0 border border-brand-100 dark:border-brand-800 font-bold text-sm relative overflow-hidden bg-cover bg-center"
                                            :style="item.foto ? `background-image: url('/storage/${item.foto}')` : ''">
                                            <span x-show="!item.foto" x-text="item.nama.charAt(0).toUpperCase()"></span>
                                            <!-- Status Indicator Dot -->
                                            <span
                                                class="absolute bottom-0 right-0 w-3 h-3 rounded-full border-2 border-white dark:border-gray-900 z-10"
                                                :class="item.status === 'online' ? 'bg-emerald-500' : 'bg-gray-400'"></span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-0.5">
                                            <h3 class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-white line-clamp-1"
                                                x-text="item.nama"></h3>
                                            <p class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-1"
                                                x-text="item.divisi || '-'"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-3.5 sm:px-5">
                                    <p
                                        class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 flex items-center gap-1.5 font-mono">
                                        <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.599-.187-.968-.306-1.877-.604-3.093-2.514-3.187-2.639-.092-.125-.761-1.015-.761-1.936 0-.922.477-1.376.64-1.554.163-.178.354-.223.473-.223.118 0 .237.004.342.008.109.004.256-.042.4.306.148.356.505 1.231.551 1.324.045.094.075.203.015.324-.06.12-.09.195-.18.293-.09.098-.19.213-.27.298-.09.085-.183.18-.08.357.103.177.458.756 1.015 1.25.719.638 1.285.836 1.464.928.179.093.284.078.389-.041.106-.118.455-.53.578-.711.122-.182.245-.152.408-.091.163.06 1.026.483 1.202.571.177.088.295.132.338.204.043.073.043.424-.101.829z" />
                                        </svg>
                                        <span x-text="item.no_wa"></span>
                                    </p>
                                </td>
                                <td class="py-3.5 px-3.5 sm:px-5">
                                    <span x-show="item.status === 'online'"
                                        class="inline-flex items-center px-2 py-1 rounded-md text-[10px] sm:text-xs font-medium bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200/50 dark:border-emerald-500/20">Online</span>
                                    <span x-show="item.status === 'offline'"
                                        class="inline-flex items-center px-2 py-1 rounded-md text-[10px] sm:text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 border border-gray-200/50 dark:border-gray-700">Offline</span>
                                </td>
                                <td class="py-3.5 px-3.5 sm:px-5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a :href="'{{ url('admin/marketing') }}/' + item.id" title="Lihat Detail"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-brand-500 hover:bg-brand-50 dark:hover:bg-brand-500/10 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a :href="'{{ url('admin/marketing') }}/' + item.id + '/edit'" title="Ubah Profil"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <button @click="openDeleteModal(item)" type="button" title="Hapus Profil"
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
                        <tr x-show="filteredMarketings.length === 0">
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                    <div
                                        class="w-14 h-14 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 mb-3">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 11c2.20914 0 4-1.79086 4-4s-1.79086-4-4-4-4 1.79086-4 4 1.79086 4 4 4zm0 2c-3.31371 0-10 1.68629-10 5v2h20v-2c0-3.31371-6.68629-5-10-5z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Tidak Ada Data
                                        Marketing</h4>
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
                        x-text="filteredMarketings.length > 0 ? ((currentPage - 1) * perPage) + 1 : 0"></span> -
                    <span class="font-semibold text-gray-900 dark:text-white"
                        x-text="Math.min(currentPage * perPage, filteredMarketings.length)"></span>
                    dari <span class="font-semibold text-gray-900 dark:text-white"
                        x-text="filteredMarketings.length"></span> profil
                </div>
                <template x-if="filteredMarketings.length > perPage">
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
        <!-- MODAL: HAPUS MARKETING                                                    -->
        <!-- ========================================================================= -->
        <div x-show="isDeleteModalOpen" x-cloak
            class="fixed inset-0 z-[99999] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm"
            @keydown.escape.window="closeDeleteModal()">
            <div x-show="isDeleteModalOpen"
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
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Hapus Profil?</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Apakah Anda yakin ingin menghapus profil marketing
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
            Alpine.data('marketingManager', () => ({
                marketings: @json($marketings),
                searchQuery: '',
                isSubmitting: false,
                isDeleteModalOpen: false,
                itemToDelete: null,
                currentPage: 1,
                perPage: 10,

                init() {
                    this.$watch('searchQuery', () => {
                        this.currentPage = 1;
                    });
                },

                get filteredMarketings() {
                    let result = this.marketings;
                    if (this.searchQuery) {
                        const q = this.searchQuery.toLowerCase();
                        result = result.filter(item =>
                            (item.nama && item.nama.toLowerCase().includes(q)) ||
                            (item.divisi && item.divisi.toLowerCase().includes(q)) ||
                            (item.no_wa && item.no_wa.toLowerCase().includes(q))
                        );
                    }
                    return result;
                },

                get paginatedMarketings() {
                    const start = (this.currentPage - 1) * this.perPage;
                    const end = start + this.perPage;
                    return this.filteredMarketings.slice(start, end);
                },

                get totalPages() {
                    return Math.ceil(this.filteredMarketings.length / this.perPage);
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
                closeDeleteModal() {
                    this.isDeleteModalOpen = false;
                    this.itemToDelete = null;
                },

                async confirmDelete() {
                    if (!this.itemToDelete) return;
                    this.isSubmitting = true;
                    try {
                        const res = await fetch(
                            `{{ url('admin/marketing') }}/${this.itemToDelete.id}`, {
                                method: 'DELETE',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });
                        const result = await res.json();
                        if (result.status === 'success') {
                            this.marketings = this.marketings.filter(m => m.id !== this.itemToDelete
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
