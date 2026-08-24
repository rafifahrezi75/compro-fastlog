@extends('admin.layouts.app')

@section('page_title', 'Detail Pelamar')
@section('content')
    <div x-data="pelamarShow()" x-init="init()" class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">Detail Pelamar</h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Profil lengkap & penilaian lamaran</p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.pelamar.index') }}" class="hover:text-brand-500 transition">Pelamar</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">Detail</span>
            </div>
        </div>

        <!-- Banner Sukses -->
        <div x-show="banner" x-cloak
            class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700 dark:border-green-800/40 dark:bg-green-500/10 dark:text-green-400">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>Status pelamar berhasil diperbarui.</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <!-- Profil Lamaran -->
            <div class="lg:col-span-2 space-y-5">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="flex items-start gap-4 flex-wrap">
                        <div class="h-16 w-16 rounded-2xl bg-brand-50 dark:bg-brand-500/10 text-brand-600 dark:text-brand-400 flex items-center justify-center font-bold text-2xl shrink-0">
                            {{ strtoupper(substr($pelamar->nama, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">{{ $pelamar->nama }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Melamar posisi:
                                <span class="font-semibold text-[#FF7A3D]">{{ $pelamar->posisi }}</span></p>
                            @if ($pelamar->karir)
                                <p class="text-xs text-gray-400 mt-0.5">Lowongan: {{ $pelamar->karir->nama_karir }} — {{ $pelamar->karir->kota }}, {{ $pelamar->karir->provinsi }}</p>
                            @endif
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $pelamar->status === 'Diterima' ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' : ($pelamar->status === 'Ditolak' ? 'bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400' : ($pelamar->status === 'Pending' ? 'bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400' : 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400')) }}">
                            {{ $pelamar->status }}
                        </span>
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-4">Kontak</h3>
                    <dl class="space-y-3 text-sm">
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Email</dt>
                            <dd><a href="mailto:{{ $pelamar->email }}" class="font-medium text-brand-600 hover:underline dark:text-brand-400 break-all">{{ $pelamar->email }}</a></dd>
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Telepon / WA</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200">{{ $pelamar->telepon }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Pesan Pelamar</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $pelamar->pesan ?: '-' }}</p>
                </div>
            </div>

            <!-- Sidebar: CV + Update Status -->
            <div class="space-y-5">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Berkas CV</h3>
                    @if ($pelamar->file_cv)
                        <a href="{{ route('admin.pelamar.cv', $pelamar->id) }}"
                            class="inline-flex w-full items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-brand-500 hover:bg-brand-600 text-white text-sm font-medium transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                            Download CV (PDF)
                        </a>
                    @else
                        <p class="text-xs text-gray-400 italic">CV tidak tersedia.</p>
                    @endif
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Update Status Rekrutmen</h3>
                    <form @submit.prevent="submitStatus()" class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <select x-model="form.status"
                                class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                                @foreach (['Pending', 'Review', 'Wawancara', 'Diterima', 'Ditolak'] as $st)
                                    <option value="{{ $st }}">{{ $st }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan Admin</label>
                            <textarea x-model="form.catatan_admin" rows="4" placeholder="Catatan internal mengenai pelamar ini..."
                                class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none"></textarea>
                        </div>
                        <button type="submit" :disabled="isSubmitting"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all disabled:opacity-50">
                            <template x-if="isSubmitting">
                                <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                            </template>
                            <span x-text="isSubmitting ? 'Menyimpan...' : 'Simpan Status'"></span>
                        </button>
                    </form>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Informasi</h3>
                    <dl class="space-y-2.5 text-sm">
                        <div class="flex items-start justify-between gap-3">
                            <dt class="text-xs text-gray-500 dark:text-gray-400 shrink-0 pt-0.5">Dilamar Pada</dt>
                            <dd class="font-medium text-gray-800 dark:text-gray-200 text-right">{{ $pelamar->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="pb-2">
            <a href="{{ route('admin.pelamar.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Kembali ke Daftar</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('pelamarShow', () => ({
                isSubmitting: false,
                banner: false,
                form: {
                    status: @json($pelamar->status),
                    catatan_admin: @json($pelamar->catatan_admin ?? '')
                },

                init() {
                    const p = new URLSearchParams(window.location.search);
                    if (p.get('updated') === '1') {
                        this.banner = true;
                        setTimeout(() => {
                            this.banner = false;
                            window.history.replaceState({}, '', window.location.pathname);
                        }, 5000);
                    }
                },

                async submitStatus() {
                    this.isSubmitting = true;
                    try {
                        const formData = new FormData();
                        formData.append('_method', 'PUT');
                        formData.append('status', this.form.status);
                        formData.append('catatan_admin', this.form.catatan_admin || '');

                        const res = await fetch('{{ route('admin.pelamar.update', ['pelamar' => $pelamar->id]) }}', {
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
                            this.banner = true;
                            setTimeout(() => { this.banner = false; }, 4000);
                        } else {
                            alert(result.message || 'Terjadi kesalahan saat menyimpan status.');
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Terjadi kesalahan jaringan.');
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            }));
        });
    </script>
@endpush
