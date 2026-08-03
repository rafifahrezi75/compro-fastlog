@extends('user.layouts.app')

@section('content')
  {{-- ============ HERO HEADER BANNER ============ --}}
  <section class="relative h-[300px] md:h-[350px] flex items-center justify-center pt-20">
    <div class="absolute inset-0">
      <img src="{{ asset('images/hero-cargo.jpg') }}" alt="Gallery" class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-[#052B35]/70"></div>
    </div>

    <div class="relative z-10 text-center text-white px-4 mt-8">
      <h1 class="text-3xl md:text-5xl font-bold mb-3">Gallery</h1>
      <div class="flex items-center justify-center gap-2 text-sm md:text-base text-gray-200">
        <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">Home</a>
        <span>/</span>
        <span class="text-white font-medium">Gallery</span>
      </div>
    </div>
  </section>

  {{-- ============ MAIN CONTENT GALLERY (INTERAKTIF) ============ --}}
  {{-- x-data menyimpan state/data gambar yang sedang dipilih --}}
  <section class="py-16 bg-white" x-data="{ openModal: false, activeImage: '', activeTitle: '', activeDesc: '' }">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

      {{-- Data Gambar --}}
      @php
        $galleries = [
            [
                'title' => 'Aktivitas Team Building',
                'desc' =>
                    'Kegiatan outbond tahunan untuk mempererat keakraban dan kerja sama antar karyawan PT. Fastlog Era Mandiri.',
                'image' => 'gallery-1.jpg',
            ],
            [
                'title' => 'Komisaris & Direksi',
                'desc' => 'Foto bersama jajaran manajemen utama dan pimpinan PT. Fastlog Era Mandiri.',
                'image' => 'gallery-2.jpg',
            ],
            [
                'title' => 'Tim Fastlog Era Mandiri',
                'desc' => 'Kebersamaan seluruh anggota tim operasional dan staf kantor Fastlog Era Mandiri.',
                'image' => 'gallery-3.jpg',
            ],
        ];
      @endphp

      {{-- Grid Foto Gallery --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($galleries as $item)
          <div
            @click="openModal = true; activeImage = '{{ asset('images/' . $item['image']) }}'; activeTitle = '{{ $item['title'] }}'; activeDesc = '{{ $item['desc'] }}'"
            class="group relative rounded-2xl overflow-hidden aspect-[4/3] cursor-pointer shadow-md hover:shadow-2xl transition-all duration-300">

            <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['title'] }}"
              class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

            {{-- Overlay Gradient --}}
            <div
              class="absolute inset-0 bg-gradient-to-t from-[#052B35]/80 via-transparent to-transparent opacity-80 group-hover:opacity-100 transition duration-300">
            </div>

            {{-- Teks Preview Singkat + Icon Zoom --}}
            <div class="absolute bottom-0 left-0 p-6 w-full flex items-end justify-between">
              <div>
                <p class="text-white font-bold text-lg leading-snug">{{ $item['title'] }}</p>
                <p class="text-gray-200 text-xs mt-1">Klik untuk memperbesar</p>
              </div>
              <div
                class="w-9 h-9 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white group-hover:bg-[#FF7A3D] transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                </svg>
              </div>
            </div>
          </div>
        @endforeach
      </div>

    </div>

    {{-- ============ MODAL LIGHTBOX (TAMPIL SAAT GAMBAR DIKLIK) ============ --}}
    <div x-show="openModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
      x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @keydown.escape.window="openModal = false"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" style="display: none;">

      {{-- Area Luar (Klik untuk menutup) --}}
      <div class="absolute inset-0" @click="openModal = false"></div>

      {{-- Konten Card Modal --}}
      <div
        class="relative bg-white rounded-2xl overflow-hidden max-w-3xl w-full z-10 shadow-2xl transform transition-all">

        {{-- Tombol Close (X) --}}
        <button @click="openModal = false"
          class="absolute top-4 right-4 z-20 w-10 h-10 bg-black/50 hover:bg-[#FF7A3D] text-white rounded-full flex items-center justify-center transition">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

        {{-- Gambar Membesar --}}
        <div class="max-h-[60vh] overflow-hidden bg-black flex items-center justify-center">
          <img :src="activeImage" :alt="activeTitle" class="w-full h-full object-contain">
        </div>

        {{-- Keterangan / Deskripsi Gambar --}}
        <div class="p-6 bg-white">
          <h3 class="text-2xl font-bold text-[#052B35]" x-text="activeTitle"></h3>
          <p class="text-gray-600 mt-2 text-sm leading-relaxed" x-text="activeDesc"></p>
        </div>
      </div>
    </div>
  </section>

  {{-- Script Alpine.js (Include jika belum ada di layout app.blade.php kamu) --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
