@extends('admin.layouts.app')

@section('page_title', $mode === 'edit' ? 'Ubah Marketing' : 'Tambah Marketing')
@section('content')
    <div x-data="marketingForm('{{ $mode }}')" class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">
                    @if ($mode === 'edit')
                        Ubah: <span x-text="form.nama || {{ Js::from($marketing->nama) }}"></span>
                    @else
                        Tambah Profil Marketing
                    @endif
                </h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                    Manajemen profil tim marketing dan kontak WhatsApp.
                </p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.marketing.index') }}" class="hover:text-brand-500 transition">Marketing</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $mode === 'edit' ? 'Ubah' : 'Tambah' }}</span>
            </div>
        </div>

        <!-- Form Card -->
        <div class="w-full rounded-2xl border border-gray-200 bg-white shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
            <form @submit.prevent="submitForm()" class="p-5 sm:p-6 space-y-5">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Nama <span class="text-rose-500">*</span></label>
                    <input type="text" x-model.trim="form.nama" required placeholder="Cth: Sarah Wijaya"
                        class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Divisi</label>
                    <input type="text" x-model.trim="form.divisi" placeholder="Cth: Marketing Executive"
                        class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Nomor WhatsApp <span class="text-rose-500">*</span></label>
                    <input type="text" x-model.trim="form.no_wa" required placeholder="Cth: 6281234567890"
                        class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    <p class="text-[10px] sm:text-xs text-gray-500 mt-1">Awali dengan kode negara (misal 62) tanpa tanda plus (+).</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Foto Profil</label>
                    <input type="file" x-ref="foto" accept="image/*" @change="previewFoto($event)"
                        class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    @if ($mode === 'edit')
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah foto.</p>
                    @endif

                    <div x-show="fotoPreview" x-cloak class="mt-3">
                        <img :src="fotoPreview" alt="Preview foto"
                            class="h-20 w-20 rounded-full object-cover border-2 border-brand-100 dark:border-brand-800 shadow-sm" />
                    </div>
                </div>

                <div class="max-w-xs">
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Status <span class="text-rose-500">*</span></label>
                    <select x-model="form.status" required
                        class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                        <option value="online">Online</option>
                        <option value="offline">Offline</option>
                    </select>
                </div>

                <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between flex-wrap gap-3">
                    <a href="{{ route('admin.marketing.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Batal</a>
                    <button type="submit" :disabled="isSubmitting"
                        class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all disabled:opacity-50">
                        <template x-if="isSubmitting">
                            <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </template>
                        <span x-text="isSubmitting ? 'Menyimpan...' : '{{ $mode === 'edit' ? 'Simpan Perubahan' : 'Simpan Profil' }}'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('marketingForm', (mode) => ({
                mode: mode,
                isSubmitting: false,
                fotoPreview: null,
                form: {
                    nama: '',
                    divisi: '',
                    no_wa: '',
                    status: '{{ $mode === 'create' ? 'online' : $marketing->status }}'
                },

                init() {
                    @if ($mode === 'edit')
                        this.form.nama = @json($marketing->nama);
                        this.form.divisi = @json($marketing->divisi ?? '');
                        this.form.no_wa = @json($marketing->no_wa);
                        @if ($marketing->foto)
                            this.fotoPreview = @json(asset('storage/' . $marketing->foto));
                        @endif
                    @endif
                },

                previewFoto(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.fotoPreview = URL.createObjectURL(file);
                    }
                },

                async submitForm() {
                    this.isSubmitting = true;
                    try {
                        const formData = new FormData();
                        formData.append('nama', this.form.nama);
                        formData.append('divisi', this.form.divisi || '');
                        formData.append('no_wa', this.form.no_wa);
                        formData.append('status', this.form.status);

                        if (this.$refs.foto && this.$refs.foto.files[0]) {
                            formData.append('foto', this.$refs.foto.files[0]);
                        }

                        let url = '{{ route('admin.marketing.store') }}';
                        @if ($mode === 'edit')
                            formData.append('_method', 'PUT');
                            url = '{{ route('admin.marketing.update', $marketing) }}';
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
                            window.location.href = '{{ route('admin.marketing.index') }}?{{ $mode === 'edit' ? 'updated' : 'saved' }}=1';
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
