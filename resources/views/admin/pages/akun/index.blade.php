@extends('admin.layouts.app')

@section('page_title', 'Master Akun')
@section('content')
    <div x-data="akunManager()" x-init="init()" class="space-y-6 max-w-full overflow-x-hidden">
        <!-- Breadcrumb & Header Section -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1
                    class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center gap-2.5">
                    <span class="p-2 rounded-xl bg-brand-500/10 text-brand-500 dark:bg-brand-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                            </path>
                        </svg>
                    </span>
                    Master Data Akun
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Kelola data pengguna/akun yang memiliki akses ke sistem admin.
                </p>
            </div>

            <!-- Action CTA -->
            <div class="flex items-center gap-2.5 flex-wrap">
                <button @click="openAddModal()" type="button"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-xs sm:text-sm font-medium text-white bg-brand-500 rounded-xl hover:bg-brand-600 focus:ring-4 focus:ring-brand-500/20 transition-all shadow-sm shadow-brand-500/20 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Akun Baru
                </button>
            </div>
        </div>

        @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-200" role="alert">
            {{ session('success') }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-200" role="alert">
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-200" role="alert">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Main Table Container -->
        <div
            class="rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
            <!-- Filter & Search Toolbar -->
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
                        placeholder="Cari nama akun atau email..."
                        class="w-full pl-9 pr-8 py-2 text-xs sm:text-sm bg-white dark:bg-gray-800/80 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all outline-none" />
                    <button x-show="searchQuery" @click="searchQuery = ''; currentPage = 1"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-xs cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Responsive Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-white/[0.01]">
                            <th class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase">#</th>
                            <th class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase">Nama Akun</th>
                            <th class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase">Email</th>
                            <th class="py-3.5 px-3.5 sm:px-5 text-[11px] font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-xs sm:text-sm">
                        <template x-for="(item, index) in paginatedAkuns" :key="item.id">
                            <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-800/40 transition-colors">
                                <td class="py-3.5 px-3.5 sm:px-5 font-mono text-gray-400 dark:text-gray-500 text-xs" x-text="((currentPage - 1) * perPage) + index + 1"></td>
                                <td class="py-3.5 px-3.5 sm:px-5 min-w-[220px]">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-xs uppercase" x-text="item.name.substring(0,2)">
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-white" x-text="item.name"></h4>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-3.5 sm:px-5 text-gray-700 dark:text-gray-300">
                                    <div class="flex items-center gap-1.5 text-xs">
                                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        <span x-text="item.email"></span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-3.5 sm:px-5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button @click="openEditModal(item)" type="button" title="Ubah Akun"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 transition-colors cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </button>
                                        <button @click="openDeleteModal(item)" type="button" title="Hapus Akun"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="filteredAkuns.length === 0">
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center max-w-sm mx-auto text-gray-400">
                                    <svg class="w-7 h-7 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Tidak Ada Data Akun</h4>
                                    <p class="text-xs text-gray-500 mt-1">Data akun kosong atau tidak ada hasil pencarian.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-3.5 sm:p-4 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-gray-500 dark:text-gray-400 bg-gray-50/30 dark:bg-white/[0.01]">
                <div>
                    Menampilkan <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredAkuns.length > 0 ? ((currentPage - 1) * perPage) + 1 : 0"></span> - 
                    <span class="font-semibold text-gray-900 dark:text-white" x-text="Math.min(currentPage * perPage, filteredAkuns.length)"></span> dari 
                    <span class="font-semibold text-gray-900 dark:text-white" x-text="filteredAkuns.length"></span> Akun
                </div>
                <template x-if="filteredAkuns.length > perPage">
                    <div class="flex items-center gap-1.5">
                        <button @click="prevPage()" :disabled="currentPage === 1" class="px-3 py-1.5 rounded-lg border border-gray-200 disabled:opacity-40 cursor-pointer">Sebelumnya</button>
                        <template x-for="page in totalPages" :key="page">
                            <button @click="goToPage(page)" :class="currentPage === page ? 'bg-brand-500 text-white' : 'border border-gray-200'" class="w-8 h-8 rounded-lg flex items-center justify-center cursor-pointer" x-text="page"></button>
                        </template>
                        <button @click="nextPage()" :disabled="currentPage === totalPages" class="px-3 py-1.5 rounded-lg border border-gray-200 disabled:opacity-40 cursor-pointer">Selanjutnya</button>
                    </div>
                </template>
            </div>
        </div>

        <!-- MODAL ADD -->
        <div x-show="isAddModalOpen" x-cloak class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm overflow-y-auto" @keydown.escape.window="closeAddModal()">
            <div class="w-full max-w-md rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden my-8">
                <div class="px-6 py-4.5 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Tambah Akun Baru</h3>
                    <button @click="closeAddModal()" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form action="{{ route('admin.akun.store') }}" method="POST" class="p-6 space-y-4 max-h-[78vh] overflow-y-auto">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1.5">Nama Lengkap *</label>
                        <input type="text" name="name" required class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-brand-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1.5">Email *</label>
                        <input type="email" name="email" required class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-brand-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1.5">Password *</label>
                        <input type="password" name="password" minlength="8" required class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-brand-500" />
                        <p class="text-[10px] text-gray-400 mt-1">Password minimal 8 karakter.</p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                        <button type="button" @click="closeAddModal()" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 cursor-pointer">Batal</button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-brand-500 rounded-xl hover:bg-brand-600 cursor-pointer">Simpan Akun</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT -->
        <div x-show="isEditModalOpen" x-cloak class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm overflow-y-auto" @keydown.escape.window="closeEditModal()">
            <div class="w-full max-w-md rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-2xl overflow-hidden my-8">
                <div class="px-6 py-4.5 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Ubah Akun</h3>
                    <button @click="closeEditModal()" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form :action="'/admin/akun/' + formEdit.id" method="POST" class="p-6 space-y-4 max-h-[78vh] overflow-y-auto">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1.5">Nama Lengkap *</label>
                        <input type="text" name="name" x-model="formEdit.name" required class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-brand-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1.5">Email *</label>
                        <input type="email" name="email" x-model="formEdit.email" required class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-brand-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1.5">Password Baru (opsional)</label>
                        <input type="password" name="password" minlength="8" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-brand-500" />
                        <p class="text-[10px] text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                        <button type="button" @click="closeEditModal()" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 cursor-pointer">Batal</button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-amber-500 rounded-xl hover:bg-amber-600 cursor-pointer">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL DELETE -->
        <div x-show="isDeleteModalOpen" x-cloak class="fixed inset-0 z-99999 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm" @keydown.escape.window="closeDeleteModal()">
            <div class="w-full max-w-md rounded-2xl bg-white dark:bg-gray-900 border border-gray-200 shadow-2xl overflow-hidden p-6 text-center">
                <div class="w-16 h-16 rounded-full bg-rose-100 text-rose-500 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Akun?</h3>
                <p class="text-sm text-gray-500 mb-6">Tindakan ini tidak dapat dibatalkan. Akun "<span x-text="formDelete.name" class="font-semibold text-gray-800"></span>" akan dihapus secara permanen.</p>
                <form :action="'/admin/akun/' + formDelete.id" method="POST" class="flex items-center justify-center gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="closeDeleteModal()" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 cursor-pointer">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-rose-500 rounded-xl hover:bg-rose-600 cursor-pointer">Ya, Hapus!</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('akunManager', () => ({
            akuns: @json($users ?? []),
            searchQuery: '',
            currentPage: 1,
            perPage: 10,
            isAddModalOpen: false,
            isEditModalOpen: false,
            isDeleteModalOpen: false,
            formEdit: {},
            formDelete: {},

            init() {
                // Inisialisasi tambahan bila diperlukan
            },

            get filteredAkuns() {
                let filtered = this.akuns;
                if (this.searchQuery.trim() !== '') {
                    const q = this.searchQuery.toLowerCase();
                    filtered = filtered.filter(item => 
                        (item.name && item.name.toLowerCase().includes(q)) ||
                        (item.email && item.email.toLowerCase().includes(q))
                    );
                }
                return filtered;
            },

            get paginatedAkuns() {
                const start = (this.currentPage - 1) * this.perPage;
                const end = start + this.perPage;
                return this.filteredAkuns.slice(start, end);
            },

            get totalPages() {
                return Math.ceil(this.filteredAkuns.length / this.perPage);
            },

            prevPage() { if (this.currentPage > 1) this.currentPage--; },
            nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; },
            goToPage(page) { this.currentPage = page; },

            openAddModal() {
                this.isAddModalOpen = true;
                document.body.style.overflow = 'hidden';
            },
            closeAddModal() {
                this.isAddModalOpen = false;
                document.body.style.overflow = 'auto';
            },

            openEditModal(item) {
                this.formEdit = { ...item };
                this.isEditModalOpen = true;
                document.body.style.overflow = 'hidden';
            },
            closeEditModal() {
                this.isEditModalOpen = false;
                document.body.style.overflow = 'auto';
            },

            openDeleteModal(item) {
                this.formDelete = { ...item };
                this.isDeleteModalOpen = true;
                document.body.style.overflow = 'hidden';
            },
            closeDeleteModal() {
                this.isDeleteModalOpen = false;
                document.body.style.overflow = 'auto';
            }
        }));
    });
</script>
@endpush
