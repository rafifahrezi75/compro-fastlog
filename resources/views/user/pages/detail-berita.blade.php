@extends('user.layouts.app')

@section('content')

{{-- ============ HERO HEADER BANNER ============ --}}
<section class="relative h-[250px] md:h-[300px] flex items-center justify-center pt-20 bg-cover bg-center bg-fixed"
         style="background-image: url('{{ asset('images/front-end/fastlog2.jpg') }}');">

    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-[#052B35]/70"></div>

    <div class="relative z-10 text-center text-white px-4 mt-8">
        <h1 class="text-3xl md:text-5xl font-bold mb-3">Berita</h1>
        <div class="flex items-center justify-center gap-2 text-sm md:text-base text-gray-200">
            <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">Home</a>
            <span>/</span>
            <a href="{{ route('berita') }}" class="hover:text-[#FF7A3D] transition">Berita</a>
            <span>/</span>
            <span class="text-white font-medium truncate max-w-xs">{{ $berita->judul }}</span>
        </div>
    </div>
</section>

{{-- ============ MAIN CONTENT DETAIL ============ --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            
            {{-- KONTEN UTAMA ARTIKEL (KIRI) --}}
            <div class="lg:col-span-3 space-y-6">
                
                {{-- Gambar Utama Artikel --}}
                <div class="rounded-2xl overflow-hidden shadow-sm">
                    @if($berita->gambar)
                        <img src="{{ str_starts_with($berita->gambar, 'uploads/') ? asset($berita->gambar) : asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-auto max-h-[450px] object-cover">
                    @endif
                </div>

                {{-- Judul & Tanggal --}}
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-[#052B35] leading-tight mb-3">
                        {{ $berita->judul }}
                    </h1>
                    <div class="flex items-center gap-2 text-sm text-[#FF7A3D] font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('D, d M Y') }}</span>
                    </div>
                </div>

                {{-- Isi Artikel / Paragraf --}}
                <div class="text-gray-600 space-y-4 leading-relaxed text-sm md:text-base">
                    {!! $berita->isi !!}
                </div>

                {{-- Share Social Media Buttons --}}
                <div class="flex items-center gap-2 pt-6 border-t border-gray-100">
                    <span class="text-xs font-semibold text-gray-500 uppercase mr-2">Share:</span>
                    <a href="#" class="bg-blue-600 text-white text-xs px-3 py-1.5 rounded hover:opacity-90 transition">Facebook</a>
                    <a href="#" class="bg-green-500 text-white text-xs px-3 py-1.5 rounded hover:opacity-90 transition">LINE</a>
                    <a href="#" class="bg-black text-white text-xs px-3 py-1.5 rounded hover:opacity-90 transition">X / Twitter</a>
                </div>

            </div>

            {{-- SIDEBAR KANAN (LATEST BERITA) --}}
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                    <h3 class="text-lg font-bold text-[#052B35] pb-3 border-b-2 border-[#052B35] mb-5">
                        Latest Berita
                    </h3>

                    <div class="space-y-6">
                        @forelse($latest_beritas as $item)
                            <a href="{{ route('berita.detail', $item->slug) }}" class="group block border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                                <div class="overflow-hidden rounded-xl h-28 mb-3">
                                    @if($item->gambar)
                                        <img src="{{ str_starts_with($item->gambar, 'uploads/') ? asset($item->gambar) : asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
                                    @endif
                                </div>
                                <h4 class="text-xs font-bold text-[#052B35] group-hover:text-[#FF7A3D] transition line-clamp-3 leading-snug mb-2 uppercase">
                                    {{ $item->judul }}
                                </h4>
                                <div class="flex items-center gap-1.5 text-[11px] text-[#FF7A3D]">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('F d, Y') }}</span>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-gray-500">Belum ada berita lainnya.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection