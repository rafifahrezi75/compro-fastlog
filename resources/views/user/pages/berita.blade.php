@extends('user.layouts.app')

@section('content')

{{-- ============ HERO HEADER BANNER ============ --}}
<section class="relative h-[250px] md:h-[300px] flex items-center justify-center pt-20">
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-cargo.jpg') }}" alt="Berita" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-[#052B35]/70"></div>
    </div>

    <div class="relative z-10 text-center text-white px-4 mt-8">
        <h1 class="text-3xl md:text-5xl font-bold mb-3">Berita</h1>
        <div class="flex items-center justify-center gap-2 text-sm md:text-base text-gray-200">
            <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">Home</a>
            <span>/</span>
            <span class="text-white font-medium">Berita</span>
        </div>
    </div>
</section>

{{-- ============ MAIN CONTENT (GRID BERITA CENTERED) ============ --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        @php
            $newsList = [
                [
                    'title' => 'Penerapan NLE Picu Penurunan Biaya Logistik hingga 50 Persen',
                    'date'  => 'Tue, 05 Jul 2022',
                    'image' => 'news-nle.jpg',
                    'slug'  => 'penerapan-nle-picu-penurunan-biaya-logistik-hingga-50-persen'
                ],
                [
                    'title' => 'HANDLING REEFER COUNTAINER DARI SURABAYA KE LOS ANGELES, USA KOMODITY FROZEN YELLOWFIN TUNA GROUND MEAT',
                    'date'  => 'Wed, 15 Nov 2023',
                    'image' => 'news-reefer.jpg',
                    'slug'  => 'handling-reefer-container-surabaya-ke-los-angeles'
                ],
            ];
        @endphp

        {{-- Menggunakan Flexbox Centered agar jika berita < 3 posisinya di tengah --}}
        <div class="flex flex-wrap justify-center gap-8">
            @foreach($newsList as $news)
                <a href="{{ route('berita.detail', $news['slug']) }}" 
                   class="group block bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition duration-300 w-full md:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1.5rem)] max-w-sm">
                    
                    <div class="h-52 overflow-hidden">
                        <img src="{{ asset('images/' . $news['image']) }}" alt="{{ $news['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>

                    <div class="p-6">
                        <div class="flex items-center gap-2 text-xs text-[#FF7A3D] font-medium mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $news['date'] }}</span>
                        </div>
                        <h3 class="text-base font-bold text-[#052B35] group-hover:text-[#FF7A3D] transition line-clamp-3 leading-snug">
                            {{ $news['title'] }}
                        </h3>
                    </div>

                </a>
            @endforeach
        </div>
    </div>
</section>

@endsection