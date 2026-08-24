@extends('admin.layouts.app')

@section('page_title', $mode === 'edit' ? 'Ubah Layanan' : 'Tambah Layanan')
@section('content')
    <div x-data="layananForm('{{ $mode }}')" class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">
                    @if ($mode === 'edit')
                        Ubah: <span x-text="form.nama || {{ Js::from($layanan->nama) }}"></span>
                    @else
                        Tambah Layanan
                    @endif
                </h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                    Konten yang diisi di sini langsung tampil di website (homepage, halaman layanan & detail layanan)
                </p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.layanan.index') }}" class="hover:text-brand-500 transition">Layanan</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $mode === 'edit' ? 'Ubah' : 'Tambah' }}</span>
            </div>
        </div>

        <!-- Form Card -->
        <div class="w-full rounded-2xl border border-gray-200 bg-white shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
            <form @submit.prevent="submitForm()" class="p-5 sm:p-6 space-y-5">
                <!-- Info Dasar -->
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800 pb-3">Informasi Layanan</h3>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Layanan <span class="text-red-500">*</span></label>
                        <input type="text" x-model.trim="form.nama" required placeholder="Contoh: Project Cargo Handling"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        @if ($mode === 'edit')
                            <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">
                                Slug saat ini: <span class="font-mono" x-text="'/layanan/' + (form.slug || {{ Js::from($layanan->slug) }})"></span> — slug otomatis mengikuti nama bila diubah.
                            </p>
                        @endif
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                        <textarea id="tinymce_singkat"></textarea>
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Tampil pada kartu layanan di homepage & halaman layanan.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi Lengkap <span class="text-red-500">*</span></label>
                        <textarea id="tinymce_lengkap"></textarea>
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Tampil pada halaman detail layanan.</p>
                    </div>
                </div>

                <!-- Fitur & Ikon -->
                <div class="space-y-4 pt-1">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800 pb-3">Fitur & Tampilan</h3>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Fitur Keunggulan</label>
                        <textarea x-model="form.fitur" rows="4" placeholder="Satu fitur per baris, contoh:&#10;Pengiriman Door-to-Door&#10;Tracking GPS 24/7"
                            class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white"></textarea>
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Tulis satu fitur per baris.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Ikon</label>
                        <div class="grid grid-cols-6 sm:grid-cols-12 gap-2">
                            <template x-for="(opt, i) in iconOptions" :key="'icon-' + i">
                                <button type="button" @click="form.ikon = opt.value" :title="opt.label"
                                    :class="form.ikon === opt.value
                                        ? 'border-brand-500 bg-brand-50 text-brand-600 ring-2 ring-brand-500/20 dark:bg-brand-500/10'
                                        : 'border-gray-200 text-gray-400 hover:border-brand-300 hover:text-brand-500 dark:border-gray-700 dark:text-gray-500'"
                                    class="flex h-11 items-center justify-center rounded-xl border transition">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" x-html="opt.value"></svg>
                                </button>
                            </template>
                        </div>
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Klik ikon untuk memilih tampilan layanan di website.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Path SVG Kustom (Opsional)</label>
                            <input type="text" x-model="form.ikon" placeholder='<path d="..." />'
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-xs font-mono text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Urutan Tampil</label>
                            <input type="number" x-model.number="form.urutan" min="0"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                        </div>
                    </div>
                </div>

                <!-- Media & Publikasi -->
                <div class="space-y-4 pt-1">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800 pb-3">Gambar & Publikasi</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                {{ $mode === 'edit' ? 'Ganti Gambar' : 'Gambar' }}
                            </label>
                            <input type="file" x-ref="gambar" accept="image/*" @change="previewGambar($event)"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-xs sm:text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-brand-600" />
                            @if ($mode === 'edit')
                                <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                            @endif
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <select x-model="form.status"
                                class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-800 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                <option value="aktif">Aktif — tampil di front end</option>
                                <option value="nonaktif">Nonaktif — disembunyikan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Preview Gambar -->
                    <div x-show="gambarPreview" x-cloak class="mt-1">
                        <p class="text-xs font-medium text-gray-600 dark:text-gray-300 mb-1.5">Preview:</p>
                        <img :src="gambarPreview" alt="Preview gambar layanan"
                            class="h-40 w-full max-w-md object-cover rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm" />
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between gap-3 flex-wrap">
                    <a href="{{ route('admin.layanan.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Batal</a>
                    <div class="flex items-center gap-2.5">
                        <template x-if="isSubmitting">
                            <svg class="animate-spin w-4 h-4 text-brand-500" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </template>
                        <button type="submit" :disabled="isSubmitting"
                            class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all shadow-sm shadow-brand-500/20 disabled:opacity-50">
                            <span x-text="isSubmitting ? 'Menyimpan...' : '{{ $mode === 'edit' ? 'Simpan Perubahan' : 'Simpan Layanan' }}'"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- TinyMCE CDN Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('layananForm', (mode) => ({
                mode: mode,
                isSubmitting: false,
                gambarPreview: null,
                form: {
                    nama: '',
                    slug: null,
                    fitur: '',
                    ikon: '',
                    urutan: {{ $mode === 'create' ? \App\Models\Layanan::count() + 1 : $layanan->urutan }},
                    status: '{{ $mode === 'create' ? 'aktif' : $layanan->status }}'
                },

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
                    @if ($mode === 'edit')
                        this.form.nama = @json($layanan->nama);
                        this.form.slug = @json($layanan->slug);
                        this.form.fitur = @json(implode("\n", $layanan->fitur ?? []));
                        this.form.ikon = @json($layanan->ikon ?? '');
                        this.gambarPreview = @json($layanan->gambar_url);

                        const initialSingkat = @json($layanan->deskripsi_singkat);
                        const initialLengkap = @json($layanan->deskripsi_lengkap);
                    @else
                        const initialSingkat = '';
                        const initialLengkap = '';
                    @endif

                    this.$nextTick(() => {
                        this.initTinyMCE('tinymce_singkat', initialSingkat, true);
                        this.initTinyMCE('tinymce_lengkap', initialLengkap);
                    });
                },

                previewGambar(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.gambarPreview = URL.createObjectURL(file);
                    }
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

                getTinyMCEContent(elementId) {
                    if (typeof tinymce !== 'undefined' && tinymce.get(elementId)) {
                        return tinymce.get(elementId).getContent();
                    }
                    const el = document.getElementById(elementId);
                    return el ? el.value : '';
                },

                async submitForm() {
                    const singkat = this.getTinyMCEContent('tinymce_singkat').trim();
                    const lengkap = this.getTinyMCEContent('tinymce_lengkap').trim();

                    if (!this.form.nama.trim() || !singkat || !lengkap) {
                        alert('Nama layanan dan kedua deskripsi wajib diisi.');
                        return;
                    }

                    this.isSubmitting = true;
                    try {
                        const formData = new FormData();
                        formData.append('nama', this.form.nama);
                        formData.append('deskripsi_singkat', singkat);
                        formData.append('deskripsi_lengkap', lengkap);
                        formData.append('fitur', this.form.fitur);
                        formData.append('ikon', this.form.ikon);
                        formData.append('urutan', this.form.urutan ?? 0);
                        formData.append('status', this.form.status);

                        if (this.$refs.gambar && this.$refs.gambar.files[0]) {
                            formData.append('gambar', this.$refs.gambar.files[0]);
                        }

                        let url = '{{ route('admin.layanan.store') }}';
                        @if ($mode === 'edit')
                            formData.append('_method', 'PUT');
                            url = '{{ route('admin.layanan.update', $layanan) }}';
                        @endif

                        const res = await fetch(url, {
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
                            window.location.href = '{{ route('admin.layanan.index') }}?{{ $mode === 'edit' ? 'updated' : 'saved' }}=1';
                        } else {
                            alert(result.message || 'Terjadi kesalahan saat menyimpan data.');
                            console.error(result.errors || result.message);
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Terjadi kesalahan jaringan saat menyimpan data.');
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            }));
        });
    </script>
@endpush
