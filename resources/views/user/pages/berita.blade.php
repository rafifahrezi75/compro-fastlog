@extends('user.layouts.app')

@section('content')

{{-- ============ HERO HEADER BANNER ============ --}}
<section class="relative h-[300px] md:h-[350px] flex items-center justify-center pt-20 bg-cover bg-center bg-fixed"
         style="background-image: url('{{ asset('images/front-end/fastlog1.png') }}');">

    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-[#052B35]/70"></div>

    <div class="relative z-10 text-center text-white px-4 mt-8">
        <h1 class="text-3xl md:text-5xl font-bold mb-3">{{ __('News') }}</h1>
        <div class="flex items-center justify-center gap-2 text-sm md:text-base text-gray-200">
            <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">{{ __('Home') }}</a>
            <span>/</span>
            <span class="text-white font-medium">{{ __('News') }}</span>
        </div>
    </div>
</section>

{{-- ============ MAIN CONTENT (GRID BERITA CENTERED) ============ --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        {{-- Menggunakan Flexbox Centered agar jika berita < 3 posisinya di tengah --}}
        <div class="flex flex-wrap justify-center gap-8">
            @forelse($beritas as $news)
                <a href="{{ route('berita.detail', $news->slug) }}" 
                   class="group block bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition duration-300 w-full md:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1.5rem)] max-w-sm flex flex-col">
                    
                    <div class="h-52 overflow-hidden shrink-0">
                        @if($news->gambar)
                            <img src="{{ str_starts_with($news->gambar, 'uploads/') ? asset($news->gambar) : asset('storage/' . $news->gambar) }}" alt="{{ $news->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">{{ __('No Image') }}</div>
                        @endif
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 text-xs text-[#FF7A3D] font-medium mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('D, d M Y') }}</span>
                        </div>
                        <h3 class="text-base font-bold text-[#052B35] group-hover:text-[#FF7A3D] transition line-clamp-3 leading-snug">
                            {{ $news->judul }}
                        </h3>
                    </div>

                </a>
            @empty
                <div class="text-center py-10 text-gray-500 w-full">{{ __('No news yet.') }}</div>
            @endforelse
        </div>
    </div>
</section>

@endsection