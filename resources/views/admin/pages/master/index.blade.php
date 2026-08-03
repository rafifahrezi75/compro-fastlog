@extends('admin.layouts.app')

@section('content')
<div 
    x-data="{
        // Master Dummy Data Statis
        defaultMasters: [
            {
                id: 1,
                code: 'FL-SEA-001',
                name: 'FCL / LCL Ocean Freight Export-Import',
                category: 'Sea Freight',
                unit: '20ft / 40ft Container',
                price: 'Rp 18.500.000',
                status: 'Aktif',
                description: 'Pengiriman kargo laut internasional & domestik dengan sistem Full Container Load maupun Less than Container Load.',
                icon: 'ship',
                updated_at: '2026-08-01 10:30'
            },
            {
                id: 2,
                code: 'FL-AIR-002',
                name: 'Air Cargo Express & Charter Flight',
                category: 'Air Freight',
                unit: 'Per Kg / ULD',
                price: 'Rp 65.000 / Kg',
                status: 'Aktif',
                description: 'Layanan kargo udara kilat lintas pulau dan internasional dengan jaminan prioritas boarding penerbangan.',
                icon: 'plane',
                updated_at: '2026-08-02 14:15'
            },
            {
                id: 3,
                code: 'FL-COLD-003',
                name: 'Reefer Container & Frozen Logistics',
                category: 'Cold Chain',
                unit: '40ft High Cube Reefer',
                price: 'Rp 28.000.000',
                status: 'Aktif',
                description: 'Logistik rantai dingin khusus produk perikanan (tuna, udang), daging beku, dan farmasi dengan temperatur terkontrol -25°C s/d +15°C.',
                icon: 'snowflake',
                updated_at: '2026-08-02 16:45'
            },
            {
                id: 4,
                code: 'FL-TRK-004',
                name: 'Inland Trucking & Wingbox Fleet',
                category: 'Land Transport',
                unit: 'Tronton Wingbox 30T',
                price: 'Rp 9.500.000 / Trip',
                status: 'Maintenance',
                description: 'Armada angkutan darat antar kota & antar pulau (Jawa - Bali - Sumatra) untuk distribusi retail dan manufaktur.',
                icon: 'truck',
                updated_at: '2026-07-28 09:20'
            },
            {
                id: 5,
                code: 'FL-CST-005',
                name: 'Customs Clearance & Port Handling PPJK',
                category: 'Customs & Port',
                unit: 'Per Dokumen PIB/PEB',
                price: 'Rp 1.750.000 / Doc',
                status: 'Aktif',
                description: 'Pengurusan kepabeanan ekspor/impor terintegrasi NLE (National Logistics Ecosystem) di Pelabuhan Tanjung Perak & Tanjung Priok.',
                icon: 'file-text',
                updated_at: '2026-08-03 08:10'
            },
            {
                id: 6,
                code: 'FL-WRH-006',
                name: 'Bonded Warehouse & Distribution Center',
                category: 'Warehousing',
                unit: 'Per CBM / Pallet / Bulan',
                price: 'Rp 120.000 / CBM',
                status: 'Nonaktif',
                description: 'Fasilitas pergudangan berikat (TPS/TPB) dengan sistem WMS modern, CCTV 24 jam, dan handling forklift profesional.',
                icon: 'warehouse',
                updated_at: '2026-07-15 11:00'
            }
        ],

        // Reactive State
        masters: [],
        searchQuery: '',
        selectedCategory: 'Semua',
        selectedStatus: 'Semua',
        
        // Modal States
        isAddModalOpen: false,
        isEditModalOpen: false,
        isDetailModalOpen: false,
        isDeleteModalOpen: false,
        
        // Selected Item & Form Models
        selectedItem: null,
        deleteItemId: null,
        formData: {
            id: null,
            code: '',
            name: '',
            category: 'Sea Freight',
            unit: '',
            price: '',
            status: 'Aktif',
            description: '',
            icon: 'ship'
        },

        // Toast Feedback
        toast: {
            show: false,
            message: '',
            type: 'success' // success | error | warning | info
        },

        init() {
            this.masters = JSON.parse(JSON.stringify(this.defaultMasters));
        },

        showToast(message, type = 'success') {
            this.toast.message = message;
            this.toast.type = type;
            this.toast.show = true;
            setTimeout(() => {
                this.toast.show = false;
            }, 3500);
        },

        // Filtered Computed Data
        get filteredMasters() {
            return this.masters.filter(item => {
                const matchQuery = this.searchQuery === '' || 
                    item.code.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.unit.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.category.toLowerCase().includes(this.searchQuery.toLowerCase());
                
                const matchCategory = this.selectedCategory === 'Semua' || item.category === this.selectedCategory;
                const matchStatus = this.selectedStatus === 'Semua' || item.status === this.selectedStatus;

                return matchQuery && matchCategory && matchStatus;
            });
        },

        // KPI Counts
        get totalCount() {
            return this.masters.length;
        },
        get activeCount() {
            return this.masters.filter(m => m.status === 'Aktif').length;
        },
        get maintenanceCount() {
            return this.masters.filter(m => m.status === 'Maintenance').length;
        },
        get categoryCount() {
            return [...new Set(this.masters.map(m => m.category))].length;
        },

        // CRUD Actions
        openAddModal() {
            const nextId = this.masters.length > 0 ? Math.max(...this.masters.map(m => m.id)) + 1 : 1;
            const padId = String(nextId).padStart(3, '0');
            this.formData = {
                id: nextId,
                code: 'FL-MST-' + padId,
                name: '',
                category: 'Sea Freight',
                unit: '',
                price: '',
                status: 'Aktif',
                description: '',
                icon: 'ship'
            };
            this.isAddModalOpen = true;
        },

        saveNewMaster() {
            if (!this.formData.name.trim() || !this.formData.code.trim()) {
                this.showToast('Harap lengkapi Kode dan Nama Master!', 'warning');
                return;
            }

            const now = new Date();
            const formattedDate = now.getFullYear() + '-' + 
                String(now.getMonth() + 1).padStart(2, '0') + '-' + 
                String(now.getDate()).padStart(2, '0') + ' ' + 
                String(now.getHours()).padStart(2, '0') + ':' + 
                String(now.getMinutes()).padStart(2, '0');

            const newItem = {
                id: this.formData.id,
                code: this.formData.code.trim().toUpperCase(),
                name: this.formData.name.trim(),
                category: this.formData.category,
                unit: this.formData.unit.trim() || 'Unit Standar',
                price: this.formData.price.trim() || 'Sesuai Kontrak',
                status: this.formData.status,
                description: this.formData.description.trim() || 'Tidak ada deskripsi tambahan.',
                icon: this.getCategoryIcon(this.formData.category),
                updated_at: formattedDate
            };

            this.masters.unshift(newItem);
            this.isAddModalOpen = false;
            this.showToast('Data master ' + newItem.code + ' berhasil ditambahkan!', 'success');
        },

        openEditModal(item) {
            this.formData = JSON.parse(JSON.stringify(item));
            this.isEditModalOpen = true;
        },

        saveEditMaster() {
            if (!this.formData.name.trim()) {
                this.showToast('Nama Master tidak boleh kosong!', 'warning');
                return;
            }

            const index = this.masters.findIndex(m => m.id === this.formData.id);
            if (index !== -1) {
                const now = new Date();
                const formattedDate = now.getFullYear() + '-' + 
                    String(now.getMonth() + 1).padStart(2, '0') + '-' + 
                    String(now.getDate()).padStart(2, '0') + ' ' + 
                    String(now.getHours()).padStart(2, '0') + ':' + 
                    String(now.getMinutes()).padStart(2, '0');

                this.formData.icon = this.getCategoryIcon(this.formData.category);
                this.formData.updated_at = formattedDate;
                this.masters[index] = JSON.parse(JSON.stringify(this.formData));
                this.isEditModalOpen = false;
                this.showToast('Data master ' + this.formData.code + ' berhasil diperbarui!', 'success');
            }
        },

        openDetailModal(item) {
            this.selectedItem = item;
            this.isDetailModalOpen = true;
        },

        confirmDelete(id) {
            this.deleteItemId = id;
            this.selectedItem = this.masters.find(m => m.id === id);
            this.isDeleteModalOpen = true;
        },

        executeDelete() {
            if (this.deleteItemId) {
                const deleted = this.masters.find(m => m.id === this.deleteItemId);
                this.masters = this.masters.filter(m => m.id !== this.deleteItemId);
                this.isDeleteModalOpen = false;
                this.showToast('Data master ' + (deleted ? deleted.code : '') + ' berhasil dihapus.', 'error');
                this.deleteItemId = null;
            }
        },

        resetToDefault() {
            this.masters = JSON.parse(JSON.stringify(this.defaultMasters));
            this.searchQuery = '';
            this.selectedCategory = 'Semua';
            this.selectedStatus = 'Semua';
            this.showToast('Data master berhasil direset ke data awal.', 'info');
        },

        getCategoryIcon(category) {
            switch (category) {
                case 'Sea Freight': return 'ship';
                case 'Air Freight': return 'plane';
                case 'Land Transport': return 'truck';
                case 'Cold Chain': return 'snowflake';
                case 'Customs & Port': return 'file-text';
                case 'Warehousing': return 'warehouse';
                default: return 'box';
            }
        },

        getStatusBadgeClass(status) {
            switch (status) {
                case 'Aktif':
                    return 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-400 border border-green-200 dark:border-green-800/30';
                case 'Maintenance':
                    return 'bg-amber-50 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400 border border-amber-200 dark:border-amber-800/30';
                case 'Nonaktif':
                    return 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-400 border border-red-200 dark:border-red-800/30';
                default:
                    return 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400';
            }
        },

        getCategoryBadgeClass(category) {
            switch (category) {
                case 'Sea Freight':
                    return 'bg-blue-50 text-blue-700 dark:bg-blue-500/15 dark:text-blue-400 border-blue-200 dark:border-blue-800/30';
                case 'Air Freight':
                    return 'bg-sky-50 text-sky-700 dark:bg-sky-500/15 dark:text-sky-400 border-sky-200 dark:border-sky-800/30';
                case 'Cold Chain':
                    return 'bg-cyan-50 text-cyan-700 dark:bg-cyan-500/15 dark:text-cyan-400 border-cyan-200 dark:border-cyan-800/30';
                case 'Land Transport':
                    return 'bg-amber-50 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400 border-amber-200 dark:border-amber-800/30';
                case 'Customs & Port':
                    return 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800/30';
                case 'Warehousing':
                    return 'bg-purple-50 text-purple-700 dark:bg-purple-500/15 dark:text-purple-400 border-purple-200 dark:border-purple-800/30';
                default:
                    return 'bg-gray-50 text-gray-700 dark:bg-gray-800 dark:text-gray-400 border-gray-200';
            }
        }
    }"
    class="w-full max-w-full space-y-5"
>
    <!-- Page Header & Breadcrumb -->
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">Master Data</h1>
            <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                Kelola parameter layanan logistik, tarif dasar, spesifikasi armada, dan status operasional Fastlog
            </p>
        </div>

        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
            <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
            <span>/</span>
            <span class="font-medium text-gray-800 dark:text-gray-200">Master</span>
        </div>
    </div>

    <!-- 4 KPI Metrics Grid (Fit 100% width) -->
    <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 lg:grid-cols-4 sm:gap-4">
        <!-- Card 1: Total Master -->
        <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 dark:border-gray-800 dark:bg-white/[0.03] shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Master</span>
                    <h3 class="mt-1.5 text-xl sm:text-2xl font-bold text-gray-900 dark:text-white" x-text="totalCount">6</h3>
                </div>
                <div class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-xl bg-brand-50 text-brand-500 dark:bg-brand-500/10">
                    <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                </div>
            </div>
            <div class="mt-2.5 text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 truncate">
                <span>Database layanan utama</span>
            </div>
        </div>

        <!-- Card 2: Layanan Aktif -->
        <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 dark:border-gray-800 dark:bg-white/[0.03] shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Layanan Aktif</span>
                    <h3 class="mt-1.5 text-xl sm:text-2xl font-bold text-green-600 dark:text-green-400" x-text="activeCount">4</h3>
                </div>
                <div class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-xl bg-green-50 text-green-600 dark:bg-green-500/10">
                    <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2.5 text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 truncate">
                <span>Siap melayani order client</span>
            </div>
        </div>

        <!-- Card 3: Kategori Layanan -->
        <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 dark:border-gray-800 dark:bg-white/[0.03] shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Kategori</span>
                    <h3 class="mt-1.5 text-xl sm:text-2xl font-bold text-blue-600 dark:text-blue-400" x-text="categoryCount">6</h3>
                </div>
                <div class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10">
                    <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>
            <div class="mt-2.5 text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 truncate">
                <span>Multi-modal freight & logistics</span>
            </div>
        </div>

        <!-- Card 4: Status Perawatan -->
        <div class="rounded-2xl border border-gray-200 bg-white p-4 sm:p-5 dark:border-gray-800 dark:bg-white/[0.03] shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Review / Off</span>
                    <h3 class="mt-1.5 text-xl sm:text-2xl font-bold text-amber-600 dark:text-amber-400" x-text="maintenanceCount + (totalCount - activeCount - maintenanceCount)">2</h3>
                </div>
                <div class="flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10">
                    <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2.5 text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 truncate">
                <span>Evaluasi armada & tarif</span>
            </div>
        </div>
    </div>

    <!-- Main Table Card (Full Width, No Horizontal Scrollbar) -->
    <div class="w-full rounded-2xl border border-gray-200 bg-white shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
        
        <!-- Table Toolbar -->
        <div class="p-4 sm:p-5 border-b border-gray-100 dark:border-gray-800 flex flex-col gap-3.5 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-white/90">Daftar Data Master</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                    Menampilkan <span class="font-semibold text-gray-800 dark:text-white" x-text="filteredMasters.length"></span> dari <span x-text="masters.length"></span> layanan logistik
                </p>
            </div>

            <!-- Action Buttons & Toolbar Controls -->
            <div class="flex flex-wrap items-center gap-2.5 sm:gap-3">
                
                <!-- Search Input -->
                <div class="relative flex-1 min-w-[180px] sm:w-56 sm:flex-initial">
                    <input 
                        type="text" 
                        x-model="searchQuery"
                        placeholder="Cari kode, nama, unit..."
                        class="h-9.5 w-full rounded-xl border border-gray-300 bg-gray-50/50 pl-9 pr-7 text-xs sm:text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500"
                    />
                    <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <button 
                        x-show="searchQuery" 
                        @click="searchQuery = ''" 
                        class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Category Filter -->
                <div class="relative">
                    <select 
                        x-model="selectedCategory"
                        class="h-9.5 rounded-xl border border-gray-300 bg-white px-3 pr-7 text-xs sm:text-sm text-gray-700 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                        <option value="Semua">Semua Kategori</option>
                        <option value="Sea Freight">Sea Freight</option>
                        <option value="Air Freight">Air Freight</option>
                        <option value="Cold Chain">Cold Chain</option>
                        <option value="Land Transport">Land Transport</option>
                        <option value="Customs & Port">Customs & Port</option>
                        <option value="Warehousing">Warehousing</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="relative">
                    <select 
                        x-model="selectedStatus"
                        class="h-9.5 rounded-xl border border-gray-300 bg-white px-3 pr-7 text-xs sm:text-sm text-gray-700 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                        <option value="Semua">Semua Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>

                <!-- Reset Dummy Button -->
                <button 
                    @click="resetToDefault()"
                    title="Kembalikan data semula"
                    class="inline-flex h-9.5 items-center justify-center gap-1.5 rounded-xl border border-gray-300 bg-white px-3 text-xs sm:text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700/50 transition">
                    <svg class="h-3.5 w-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span class="hidden md:inline">Reset</span>
                </button>

                <!-- Tambah Data Button -->
                <button 
                    @click="openAddModal()"
                    class="inline-flex h-9.5 items-center justify-center gap-1.5 rounded-xl bg-brand-500 px-3.5 text-xs sm:text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/50 transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Data</span>
                </button>
            </div>
        </div>

        <!-- Fluid Table (Fits 100% Screen Width without horizontal scrollbar) -->
        <div class="w-full overflow-hidden">
            <table class="w-full table-auto text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/75 dark:border-gray-800 dark:bg-white/[0.02] text-[11px] sm:text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        <th class="py-3.5 pl-4 pr-2 sm:pl-6 sm:pr-3 w-28 sm:w-32">Kode</th>
                        <th class="py-3.5 px-3">Layanan & Spesifikasi</th>
                        <th class="py-3.5 px-3 w-32 hidden md:table-cell">Kategori</th>
                        <th class="py-3.5 px-3 w-36 hidden sm:table-cell">Estimasi Tarif</th>
                        <th class="py-3.5 px-3 w-24 sm:w-28 text-center">Status</th>
                        <th class="py-3.5 pl-2 pr-4 sm:pl-3 sm:pr-6 text-right w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-xs sm:text-sm">
                    <template x-for="item in filteredMasters" :key="item.id">
                        <tr class="hover:bg-gray-50/70 dark:hover:bg-white/[0.02] transition">
                            
                            <!-- Kode Master -->
                            <td class="py-3.5 pl-4 pr-2 sm:pl-6 sm:pr-3 align-middle">
                                <span class="inline-flex items-center rounded-md bg-brand-50 px-2 py-0.5 text-xs font-mono font-bold text-brand-600 dark:bg-brand-500/10 dark:text-brand-400" x-text="item.code"></span>
                            </td>

                            <!-- Nama Layanan & Spesifikasi -->
                            <td class="py-3.5 px-3 align-middle">
                                <div class="flex items-center gap-3">
                                    <!-- Dynamic Category Icon -->
                                    <div class="hidden sm:flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-500 dark:bg-brand-500/10">
                                        <template x-if="item.category === 'Sea Freight'">
                                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 17l1.5-7h15L21 17M6 10V6a2 2 0 012-2h8a2 2 0 012 2v4M4 17c1.5 1 3.5 1 5 0s3.5-1 5 0 3.5 1 5 0 3.5-1 5 0"/></svg>
                                        </template>
                                        <template x-if="item.category === 'Air Freight'">
                                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                        </template>
                                        <template x-if="item.category === 'Land Transport'">
                                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10h10zm0 0h5.586a1 1 0 00.707-.293l2.414-2.414A1 1 0 0022 12.586V16h-3"/></svg>
                                        </template>
                                        <template x-if="item.category === 'Cold Chain'">
                                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 3v18m0-18l3 3m-3-3l-3 3m0 12l3 3m0 0l3-3m-9-6h18m-18 0l3-3m-3 3l3 3m12-6l-3-3m3 3l-3 3"/></svg>
                                        </template>
                                        <template x-if="item.category === 'Customs & Port' || item.category === 'Warehousing'">
                                            <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        </template>
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="font-medium text-gray-900 dark:text-white leading-snug truncate" x-text="item.name"></h4>
                                        <div class="mt-0.5 flex flex-wrap items-center gap-x-2 text-xs text-gray-500 dark:text-gray-400">
                                            <span class="inline-flex items-center gap-1 font-medium text-gray-600 dark:text-gray-300">
                                                <svg class="h-3 w-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                                <span x-text="item.unit"></span>
                                            </span>
                                            <!-- Responsive Price badge for small screens -->
                                            <span class="sm:hidden font-semibold text-brand-600 dark:text-brand-400" x-text="item.price"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Kategori (Hidden on mobile, visible on tablet/desktop) -->
                            <td class="py-3.5 px-3 align-middle hidden md:table-cell">
                                <span 
                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium border"
                                    :class="getCategoryBadgeClass(item.category)"
                                    x-text="item.category">
                                </span>
                            </td>

                            <!-- Tarif Dasar (Hidden on mobile, shown in subtext) -->
                            <td class="py-3.5 px-3 align-middle hidden sm:table-cell">
                                <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="item.price"></span>
                            </td>

                            <!-- Status -->
                            <td class="py-3.5 px-3 align-middle text-center">
                                <span 
                                    class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-medium"
                                    :class="getStatusBadgeClass(item.status)">
                                    <span class="h-1.5 w-1.5 rounded-full shrink-0" 
                                        :class="{
                                            'bg-green-500': item.status === 'Aktif',
                                            'bg-amber-500': item.status === 'Maintenance',
                                            'bg-red-500': item.status === 'Nonaktif'
                                        }">
                                    </span>
                                    <span x-text="item.status"></span>
                                </span>
                            </td>

                            <!-- Aksi (Detail, Edit, Delete) -->
                            <td class="py-3.5 pl-2 pr-4 sm:pl-3 sm:pr-6 align-middle text-right">
                                <div class="flex items-center justify-end gap-1">
                                    
                                    <!-- Detail Action -->
                                    <button 
                                        @click="openDetailModal(item)"
                                        title="Lihat Detail"
                                        class="flex h-7.5 w-7.5 items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white transition">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>

                                    <!-- Edit Action -->
                                    <button 
                                        @click="openEditModal(item)"
                                        title="Ubah Data"
                                        class="flex h-7.5 w-7.5 items-center justify-center rounded-lg text-blue-600 hover:bg-blue-50 hover:text-blue-700 dark:text-blue-400 dark:hover:bg-blue-500/10 transition">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    <!-- Delete Action -->
                                    <button 
                                        @click="confirmDelete(item.id)"
                                        title="Hapus Data"
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
                    <tr x-show="filteredMasters.length === 0">
                        <td colspan="6" class="py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500 mb-2.5">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-sm font-medium text-gray-800 dark:text-white">Data master tidak ditemukan</h4>
                                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Coba ubah kata kunci pencarian atau reset filter kategori/status.</p>
                                <button 
                                    @click="searchQuery = ''; selectedCategory = 'Semua'; selectedStatus = 'Semua';"
                                    class="mt-3 inline-flex items-center gap-1.5 rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                    Reset Filter
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table Footer Pagination / Info -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-3.5 sm:px-5 border-t border-gray-100 dark:border-gray-800 gap-2.5 text-xs text-gray-500 dark:text-gray-400">
            <div>
                Menampilkan <span class="font-medium text-gray-700 dark:text-gray-200" x-text="filteredMasters.length"></span> dari <span class="font-medium text-gray-700 dark:text-gray-200" x-text="masters.length"></span> data master
            </div>
            <div class="flex items-center gap-1 self-center sm:self-auto">
                <button class="px-2.5 py-1 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 disabled:opacity-50 text-gray-600 dark:text-gray-300" disabled>Sebelumnya</button>
                <button class="px-2.5 py-1 rounded-lg bg-brand-500 text-white font-medium">1</button>
                <button class="px-2.5 py-1 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800 disabled:opacity-50 text-gray-600 dark:text-gray-300" disabled>Selanjutnya</button>
            </div>
        </div>
    </div>

    <!-- ==================== MODAL TAMBAH DATA ==================== -->
    <div x-show="isAddModalOpen" x-cloak class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-4 sm:p-6" @keydown.escape.window="isAddModalOpen = false">
        <!-- Backdrop -->
        <div @click="isAddModalOpen = false" class="fixed inset-0 h-full w-full bg-gray-900/60 backdrop-blur-xs transition-opacity"
            x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <!-- Modal Card -->
        <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 sm:p-7 shadow-2xl dark:bg-gray-900 border border-gray-100 dark:border-gray-800 z-10"
            x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
            
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-50 text-brand-500 dark:bg-brand-500/10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Tambah Data Master</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Input parameter layanan atau master logistik baru</p>
                    </div>
                </div>
                <button @click="isAddModalOpen = false" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-white">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Form -->
            <form @submit.prevent="saveNewMaster()" class="mt-4 space-y-3.5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <!-- Kode -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Master <span class="text-red-500">*</span></label>
                        <input type="text" x-model="formData.code" required placeholder="Contoh: FL-EXP-007"
                            class="h-9.5 w-full rounded-xl border border-gray-300 bg-white px-3 text-xs sm:text-sm text-gray-800 uppercase focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white font-mono" />
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori <span class="text-red-500">*</span></label>
                        <select x-model="formData.category" required
                            class="h-9.5 w-full rounded-xl border border-gray-300 bg-white px-3 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                            <option value="Sea Freight">Sea Freight</option>
                            <option value="Air Freight">Air Freight</option>
                            <option value="Cold Chain">Cold Chain</option>
                            <option value="Land Transport">Land Transport</option>
                            <option value="Customs & Port">Customs & Port</option>
                            <option value="Warehousing">Warehousing</option>
                        </select>
                    </div>
                </div>

                <!-- Nama Layanan -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Layanan / Master <span class="text-red-500">*</span></label>
                    <input type="text" x-model="formData.name" required placeholder="Contoh: Project Cargo Handling & Heavy Lift"
                        class="h-9.5 w-full rounded-xl border border-gray-300 bg-white px-3 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <!-- Armada / Spesifikasi -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Armada / Unit</label>
                        <input type="text" x-model="formData.unit" placeholder="Contoh: Lowbed Trailer 50T"
                            class="h-9.5 w-full rounded-xl border border-gray-300 bg-white px-3 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>

                    <!-- Tarif Dasar -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Estimasi Tarif</label>
                        <input type="text" x-model="formData.price" placeholder="Contoh: Rp 35.000.000 / Job"
                            class="h-9.5 w-full rounded-xl border border-gray-300 bg-white px-3 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status Layanan</label>
                    <div class="flex items-center gap-4">
                        <label class="inline-flex items-center gap-2 cursor-pointer text-xs sm:text-sm text-gray-700 dark:text-gray-300">
                            <input type="radio" value="Aktif" x-model="formData.status" class="text-brand-500 focus:ring-brand-500">
                            <span>Aktif</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer text-xs sm:text-sm text-gray-700 dark:text-gray-300">
                            <input type="radio" value="Maintenance" x-model="formData.status" class="text-amber-500 focus:ring-amber-500">
                            <span>Maintenance</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer text-xs sm:text-sm text-gray-700 dark:text-gray-300">
                            <input type="radio" value="Nonaktif" x-model="formData.status" class="text-red-500 focus:ring-red-500">
                            <span>Nonaktif</span>
                        </label>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi / Keterangan</label>
                    <textarea x-model="formData.description" rows="2" placeholder="Tuliskan spesifikasi operasional..."
                        class="w-full rounded-xl border border-gray-300 bg-white p-3 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white"></textarea>
                </div>

                <!-- Action buttons -->
                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-gray-100 dark:border-gray-800">
                    <button type="button" @click="isAddModalOpen = false"
                        class="rounded-xl border border-gray-300 bg-white px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-brand-500 px-4 py-2 text-xs sm:text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 transition">
                        Simpan Data
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

        <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 sm:p-7 shadow-2xl dark:bg-gray-900 border border-gray-100 dark:border-gray-800 z-10"
            x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
            
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Ubah Data Master</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Perbarui rincian data <span class="font-mono text-brand-500 font-semibold" x-text="formData.code"></span></p>
                    </div>
                </div>
                <button @click="isEditModalOpen = false" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-white">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form @submit.prevent="saveEditMaster()" class="mt-4 space-y-3.5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Master</label>
                        <input type="text" x-model="formData.code" disabled
                            class="h-9.5 w-full rounded-xl border border-gray-200 bg-gray-100 px-3 text-xs sm:text-sm text-gray-500 uppercase dark:border-gray-800 dark:bg-gray-800/60 dark:text-gray-400 font-mono cursor-not-allowed" />
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori <span class="text-red-500">*</span></label>
                        <select x-model="formData.category" required
                            class="h-9.5 w-full rounded-xl border border-gray-300 bg-white px-3 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                            <option value="Sea Freight">Sea Freight</option>
                            <option value="Air Freight">Air Freight</option>
                            <option value="Cold Chain">Cold Chain</option>
                            <option value="Land Transport">Land Transport</option>
                            <option value="Customs & Port">Customs & Port</option>
                            <option value="Warehousing">Warehousing</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Layanan / Master <span class="text-red-500">*</span></label>
                    <input type="text" x-model="formData.name" required
                        class="h-9.5 w-full rounded-xl border border-gray-300 bg-white px-3 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Armada / Unit</label>
                        <input type="text" x-model="formData.unit"
                            class="h-9.5 w-full rounded-xl border border-gray-300 bg-white px-3 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Estimasi Tarif</label>
                        <input type="text" x-model="formData.price"
                            class="h-9.5 w-full rounded-xl border border-gray-300 bg-white px-3 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status Layanan</label>
                    <div class="flex items-center gap-4">
                        <label class="inline-flex items-center gap-2 cursor-pointer text-xs sm:text-sm text-gray-700 dark:text-gray-300">
                            <input type="radio" value="Aktif" x-model="formData.status" class="text-brand-500 focus:ring-brand-500">
                            <span>Aktif</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer text-xs sm:text-sm text-gray-700 dark:text-gray-300">
                            <input type="radio" value="Maintenance" x-model="formData.status" class="text-amber-500 focus:ring-amber-500">
                            <span>Maintenance</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer text-xs sm:text-sm text-gray-700 dark:text-gray-300">
                            <input type="radio" value="Nonaktif" x-model="formData.status" class="text-red-500 focus:ring-red-500">
                            <span>Nonaktif</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi / Keterangan</label>
                    <textarea x-model="formData.description" rows="2"
                        class="w-full rounded-xl border border-gray-300 bg-white p-3 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-gray-100 dark:border-gray-800">
                    <button type="button" @click="isEditModalOpen = false"
                        class="rounded-xl border border-gray-300 bg-white px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-xs sm:text-sm font-medium text-white shadow-theme-xs hover:bg-blue-700 transition">
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL DETAIL DATA ==================== -->
    <div x-show="isDetailModalOpen" x-cloak class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-4 sm:p-6" @keydown.escape.window="isDetailModalOpen = false">
        <div @click="isDetailModalOpen = false" class="fixed inset-0 h-full w-full bg-gray-900/60 backdrop-blur-xs transition-opacity"></div>

        <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 sm:p-7 shadow-2xl dark:bg-gray-900 border border-gray-100 dark:border-gray-800 z-10"
            x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50 text-purple-600 dark:bg-purple-500/10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Detail Master Data</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Informasi spesifikasi lengkap layanan</p>
                    </div>
                </div>
                <button @click="isDetailModalOpen = false" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-white">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <template x-if="selectedItem">
                <div class="mt-4 space-y-3.5">
                    <div class="flex items-center justify-between p-3.5 rounded-2xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800">
                        <div>
                            <span class="text-xs font-mono font-bold text-brand-600 dark:text-brand-400" x-text="selectedItem.code"></span>
                            <h4 class="text-sm sm:text-base font-bold text-gray-900 dark:text-white mt-0.5" x-text="selectedItem.name"></h4>
                        </div>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                            :class="getStatusBadgeClass(selectedItem.status)" x-text="selectedItem.status"></span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs sm:text-sm">
                        <div class="p-3 rounded-xl border border-gray-100 dark:border-gray-800">
                            <span class="text-xs text-gray-500 dark:text-gray-400 block">Kategori</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200 mt-0.5 block" x-text="selectedItem.category"></span>
                        </div>
                        <div class="p-3 rounded-xl border border-gray-100 dark:border-gray-800">
                            <span class="text-xs text-gray-500 dark:text-gray-400 block">Tarif Dasar</span>
                            <span class="font-bold text-brand-600 dark:text-brand-400 mt-0.5 block" x-text="selectedItem.price"></span>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl border border-gray-100 dark:border-gray-800 text-xs sm:text-sm">
                        <span class="text-xs text-gray-500 dark:text-gray-400 block">Armada / Spesifikasi Unit</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200 mt-0.5 block" x-text="selectedItem.unit"></span>
                    </div>

                    <div class="p-3 rounded-xl border border-gray-100 dark:border-gray-800 text-xs sm:text-sm">
                        <span class="text-xs text-gray-500 dark:text-gray-400 block mb-0.5">Deskripsi Lengkap</span>
                        <p class="text-gray-700 dark:text-gray-300 text-xs leading-relaxed" x-text="selectedItem.description"></p>
                    </div>

                    <div class="flex items-center justify-between text-xs text-gray-400 pt-1">
                        <span>Terakhir diperbarui:</span>
                        <span class="font-mono" x-text="selectedItem.updated_at"></span>
                    </div>

                    <div class="pt-3 border-t border-gray-100 dark:border-gray-800 flex justify-end">
                        <button type="button" @click="isDetailModalOpen = false"
                            class="rounded-xl bg-gray-100 px-4 py-2 text-xs sm:text-sm font-medium text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- ==================== MODAL KONFIRMASI HAPUS ==================== -->
    <div x-show="isDeleteModalOpen" x-cloak class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto p-4 sm:p-6" @keydown.escape.window="isDeleteModalOpen = false">
        <div @click="isDeleteModalOpen = false" class="fixed inset-0 h-full w-full bg-gray-900/60 backdrop-blur-xs transition-opacity"></div>

        <div class="relative w-full max-w-md rounded-3xl bg-white p-6 sm:p-7 shadow-2xl dark:bg-gray-900 border border-gray-100 dark:border-gray-800 z-10 text-center"
            x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-50 text-red-600 dark:bg-red-500/10 mb-3.5">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>

            <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Hapus Data Master?</h3>
            <p class="mt-1.5 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                Apakah Anda yakin ingin menghapus data <span class="font-semibold text-gray-800 dark:text-white" x-text="selectedItem ? selectedItem.name : ''"></span>?
            </p>

            <div class="mt-5 flex items-center justify-center gap-3">
                <button type="button" @click="isDeleteModalOpen = false"
                    class="w-full rounded-xl border border-gray-300 bg-white py-2 text-xs sm:text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 transition">
                    Batal
                </button>
                <button type="button" @click="executeDelete()"
                    class="w-full rounded-xl bg-red-600 py-2 text-xs sm:text-sm font-medium text-white shadow-theme-xs hover:bg-red-700 transition">
                    Hapus Sekarang
                </button>
            </div>
        </div>
    </div>

    <!-- ==================== TOAST NOTIFICATION ==================== -->
    <div 
        x-show="toast.show" 
        x-cloak
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed bottom-5 right-5 z-99999 flex items-center gap-3 rounded-2xl bg-gray-900 px-4 py-3 text-white shadow-xl dark:bg-gray-800 border border-gray-700/50 max-w-sm">
        
        <template x-if="toast.type === 'success'">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-500/20 text-green-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
        </template>
        <template x-if="toast.type === 'error'">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-500/20 text-red-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </div>
        </template>
        <template x-if="toast.type === 'warning'">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-500/20 text-amber-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </template>
        <template x-if="toast.type === 'info'">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/20 text-blue-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </template>

        <p class="text-xs font-medium text-gray-100 flex-1" x-text="toast.message"></p>
        <button @click="toast.show = false" class="text-gray-400 hover:text-white">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

</div>
@endsection
