@extends('admin.layouts.app')

@section('page_title', $mode === 'edit' ? 'Ubah Berita' : 'Tambah Berita')
@section('content')
    <div x-data="beritaForm('{{ $mode }}')" class="space-y-5">

        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white sm:text-2xl">
                    @if ($mode === 'edit')
                        Ubah: <span x-text="form.judul || {{ Js::from($berita->judul) }}"></span>
                    @else
                        Tulis Berita Baru
                    @endif
                </h1>
                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                    Kelola berita & artikel yang tampil di website Fastlog.
                </p>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <a href="{{ route('dashboard') }}" class="hover:text-brand-500 transition">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.berita.index') }}" class="hover:text-brand-500 transition">Berita</a>
                <span>/</span>
                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $mode === 'edit' ? 'Ubah' : 'Tambah' }}</span>
            </div>
        </div>

        <!-- Form Card -->
        <div class="w-full rounded-2xl border border-gray-200 bg-white shadow-xs dark:border-gray-800 dark:bg-white/[0.03]">
            <form @submit.prevent="submitForm()" class="p-5 sm:p-6 space-y-5">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Judul <span class="text-rose-500">*</span></label>
                    <input type="text" x-model.trim="form.judul" required placeholder="Judul berita"
                        class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    @if ($mode === 'edit')
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500">
                            Slug saat ini: <span class="font-mono" x-text="form.slug || {{ Js::from($berita->slug) }}"></span> — slug otomatis mengikuti judul.
                        </p>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Sumber</label>
                        <input type="text" x-model.trim="form.sumber" placeholder="Cth: Fastlog Internal"
                            class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Status <span class="text-rose-500">*</span></label>
                        <select x-model="form.status" required
                            class="w-full px-3.5 py-2.5 text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Gambar Utama</label>
                    <input type="file" x-ref="gambar" accept="image/jpeg,image/png,image/webp,image/gif" @change="previewGambar($event)"
                        class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none" />
                    @if ($mode === 'edit')
                        <p class="mt-1 text-[10px] sm:text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    @endif

                    <div x-show="gambarPreview" x-cloak class="mt-3">
                        <img :src="gambarPreview" alt="Preview gambar"
                            class="h-48 w-full max-w-md object-cover rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">Isi Berita <span class="text-rose-500">*</span></label>
                    <textarea id="tinymce_isi"></textarea>
                </div>

                <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between flex-wrap gap-3">
                    <a href="{{ route('admin.berita.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-colors">&larr; Batal</a>
                    <button type="submit" :disabled="isSubmitting"
                        class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-all disabled:opacity-50">
                        <template x-if="isSubmitting">
                            <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </template>
                        <span x-text="isSubmitting ? 'Menyimpan...' : '{{ $mode === 'edit' ? 'Simpan Perubahan' : 'Terbitkan Berita' }}'"></span>
                    </button>
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
            Alpine.data('beritaForm', (mode) => ({
                mode: mode,
                isSubmitting: false,
                gambarFile: null,
                gambarPreview: null,
                form: {
                    judul: '',
                    slug: null,
                    sumber: '',
                    status: '{{ $mode === 'create' ? 'published' : $berita->status }}'
                },

                init() {
                    @if ($mode === 'edit')
                        this.form.judul = @json($berita->judul);
                        this.form.slug = @json($berita->slug);
                        this.form.sumber = @json($berita->sumber ?? '');
                        @if ($berita->gambar)
                            this.gambarPreview = @json(asset($berita->gambar));
                        @endif
                        const initialIsi = @json($berita->isi);
                    @else
                        const initialIsi = '';
                    @endif

                    this.$nextTick(() => {
                        this.initTinyMCE('tinymce_isi', initialIsi);
                    });
                },

                previewGambar(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.gambarFile = file;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.gambarPreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                initTinyMCE(elementId, initialContent = '') {
                    if (typeof tinymce === 'undefined') return;

                    tinymce.remove('#' + elementId);

                    const isDark = document.documentElement.classList.contains('dark');

                    tinymce.init({
                        selector: '#' + elementId,
                        height: 320,
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

                getTinyMCEContent(elementId) {
                    if (typeof tinymce !== 'undefined' && tinymce.get(elementId)) {
                        return tinymce.get(elementId).getContent();
                    }
                    const el = document.getElementById(elementId);
                    return el ? el.value : '';
                },

                async submitForm() {
                    const isi = this.getTinyMCEContent('tinymce_isi').trim();

                    if (!this.form.judul.trim() || !isi) {
                        alert('Judul dan isi berita wajib diisi.');
                        return;
                    }

                    this.isSubmitting = true;
                    try {
                        const formData = new FormData();
                        formData.append('judul', this.form.judul);
                        formData.append('sumber', this.form.sumber ?? '');
                        formData.append('isi', isi);
                        formData.append('status', this.form.status || 'published');

                        if (this.gambarFile) {
                            formData.append('gambar', this.gambarFile);
                        }

                        let url = '{{ route('admin.berita.store') }}';
                        @if ($mode === 'edit')
                            formData.append('_method', 'PUT');
                            url = '{{ route('admin.berita.update', ['beritum' => $berita->id]) }}';
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
                            window.location.href = '{{ route('admin.berita.index') }}?{{ $mode === 'edit' ? 'updated' : 'saved' }}=1';
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
