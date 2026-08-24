@extends('admin.layouts.app')

@section('page_title', $mode === 'edit' ? 'Ubah Karir' : 'Tambah Karir')
@section('content')
    <div x-data="karirForm('{{ $mode }}', @json($masterKotaMap))" class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">
                    @if ($mode === 'edit')
                        Ubah: <span x-text="form.nama_karir || {{ Js::from($karir->nama_karir) }}"></span>
                    @else
                        Tambah Lowongan Karir
                    @endif
                </h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                    Kelola lowongan pekerjaan yang tampil di halaman karir website.
                </p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.karir.index') }}" class="hover:text-brand-500 transition">Karir</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $mode === 'edit' ? 'Ubah' : 'Tambah' }}</span>
            </div>
        </div>

        <!-- Form Card -->
        <div class="w-full rounded-2xl border border-gray-200 bg-white shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
            <form @submit.prevent="submitForm()" class="p-5 sm:p-6 space-y-5">

                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800 pb-3">Informasi Posisi</h3>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Nama Posisi / Lowongan <span class="text-rose-500">*</span></label>
                    <input type="text" x-model.trim="form.nama_karir" required placeholder="Cth: Operational Staff Surabaya"
                        class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Departemen</label>
                        <input type="text" x-model.trim="form.departemen" placeholder="Cth: Operations"
                            class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Tipe Pekerjaan</label>
                        <select x-model="form.tipe_pekerjaan"
                            class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                            <option value="Full-Time">Full-Time (Penuh Waktu)</option>
                            <option value="Part-Time">Part-Time (Paruh Waktu)</option>
                            <option value="Contract">Contract (Kontrak)</option>
                            <option value="Internship">Internship (Magang)</option>
                            <option value="Remote / Hybrid">Remote / Hybrid</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Status <span class="text-rose-500">*</span></label>
                    <select x-model="form.status" required
                        class="w-full max-w-xs px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                        <option value="Aktif">Aktif (Buka Pendaftaran)</option>
                        <option value="Tutup">Tutup (Closed)</option>
                        <option value="Draft">Draft (Simpan Sementara)</option>
                    </select>
                </div>

                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800 pb-3 pt-2">Lokasi Kerja</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Provinsi <span class="text-rose-500">*</span></label>
                        <select x-model="form.provinsi_kode" @change="onProvinsiChange()" required x-ref="provinsiSelect"
                            class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                            <option value="" disabled>-- Pilih Provinsi --</option>
                            @foreach ($masterProvinsiList as $p)
                                <option value="{{ $p->kode }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Kota / Kabupaten <span class="text-rose-500">*</span></label>
                        <select x-model.trim="form.kota" :disabled="!form.provinsi_kode" required
                            class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none disabled:opacity-60">
                            <option value="" disabled x-text="form.provinsi_kode ? '-- Pilih Kota / Kabupaten --' : '-- Pilih Provinsi Terlebih Dahulu --'"></option>
                            <template x-for="k in kotaList" :key="k">
                                <option :value="k" x-text="k"></option>
                            </template>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Negara</label>
                    <input type="text" x-model.trim="form.negara" placeholder="Indonesia"
                        class="w-full max-w-xs px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Alamat Detail <span class="text-rose-500">*</span></label>
                    <textarea x-model.trim="form.alamat_detail" rows="2" required placeholder="Alamat lengkap kantor / site penempatan"
                        class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none"></textarea>
                </div>

                <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800 pb-3 pt-2">Deskripsi & Persyaratan</h3>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Deskripsi Pekerjaan</label>
                    <textarea x-model.trim="form.deskripsi" rows="4" placeholder="Uraian tanggung jawab dan deskripsi pekerjaan..."
                        class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Kualifikasi / Persyaratan</label>
                    <textarea x-model="form.kualifikasi_text" rows="5" placeholder="Satu poin per baris, contoh:&#10;Pendidikan minimal SMA/SMK&#10;Pengalaman 1 tahun di bidang logistik"
                        class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none"></textarea>
                    <p class="mt-1 text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">Tulis satu poin kualifikasi per baris.</p>
                </div>

                <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between flex-wrap gap-3">
                    <a href="{{ route('admin.karir.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Batal</a>
                    <button type="submit" :disabled="isSubmitting"
                        class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all disabled:opacity-50">
                        <template x-if="isSubmitting">
                            <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </template>
                        <span x-text="isSubmitting ? 'Menyimpan...' : '{{ $mode === 'edit' ? 'Simpan Perubahan' : 'Simpan Lowongan' }}'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('karirForm', (mode, masterKotaMap) => ({
                mode: mode,
                masterKotaMap: masterKotaMap,
                kotaList: [],
                isSubmitting: false,
                form: {
                    nama_karir: '',
                    departemen: '',
                    tipe_pekerjaan: '{{ $mode === 'create' ? 'Full-Time' : e($karir->tipe_pekerjaan ?: 'Full-Time') }}',
                    status: '{{ $mode === 'create' ? 'Aktif' : $karir->status }}',
                    provinsi_kode: '',
                    kota: '',
                    negara: '',
                    alamat_detail: '',
                    deskripsi: '',
                    kualifikasi_text: ''
                },

                init() {
                    @if ($mode === 'edit')
                        this.form.nama_karir = @json($karir->nama_karir);
                        this.form.departemen = @json($karir->departemen ?? '');
                        this.form.kota = @json($karir->kota);
                        this.form.negara = @json($karir->negara ?? '');
                        this.form.alamat_detail = @json($karir->alamat_detail);
                        this.form.deskripsi = @json($karir->deskripsi ?? '');
                        this.form.kualifikasi_text = @json(implode("\n", $karir->kualifikasi_array ?? []));

                        // Set provinsi berdasarkan nama → kode
                        const provNama = @json($karir->provinsi);
                        const option = [...this.$refs.provinsiSelect.options].find(o => o.text === provNama);
                        if (option) {
                            this.form.provinsi_kode = option.value;
                            this.onProvinsiChange();
                            this.$nextTick(() => { this.form.kota = @json($karir->kota); });
                        }
                    @endif
                },

                onProvinsiChange() {
                    this.kotaList = this.masterKotaMap[this.form.provinsi_kode] || [];
                    this.form.kota = '';
                },

                async submitForm() {
                    if (!this.form.nama_karir.trim() || !this.form.provinsi_kode || !this.form.kota || !this.form.alamat_detail.trim()) {
                        alert('Nama posisi, provinsi, kota, dan alamat detail wajib diisi.');
                        return;
                    }

                    this.isSubmitting = true;
                    try {
                        const formData = new FormData();
                        formData.append('nama_karir', this.form.nama_karir);
                        formData.append('departemen', this.form.departemen || '');
                        formData.append('tipe_pekerjaan', this.form.tipe_pekerjaan || 'Full-Time');
                        formData.append('status', this.form.status || 'Aktif');

                        const provOption = [...this.$refs.provinsiSelect.options].find(o => o.value === this.form.provinsi_kode);
                        formData.append('provinsi', provOption ? provOption.text : '');
                        formData.append('kota', this.form.kota);
                        formData.append('negara', this.form.negara || 'Indonesia');
                        formData.append('alamat_detail', this.form.alamat_detail);
                        formData.append('deskripsi', this.form.deskripsi ?? '');

                        const points = (this.form.kualifikasi_text || '').split('\n').map(s => s.trim()).filter(s => s !== '');
                        points.forEach(p => formData.append('kualifikasi[]', p));

                        let url = '{{ route('admin.karir.store') }}';
                        @if ($mode === 'edit')
                            formData.append('_method', 'PUT');
                            url = '{{ route('admin.karir.update', ['karir' => $karir->id]) }}';
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
                            window.location.href = '{{ route('admin.karir.index') }}?{{ $mode === 'edit' ? 'updated' : 'saved' }}=1';
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
