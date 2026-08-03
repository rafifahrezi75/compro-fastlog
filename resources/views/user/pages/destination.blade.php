@extends('user.layouts.app')

@section('title', __('Destinasi') . ' - Fastlog Era Mandiri')

@section('content')

{{-- ============ HERO HEADER BANNER ============ --}}
<section class="relative h-[300px] md:h-[350px] flex items-center justify-center pt-20 bg-cover bg-center bg-fixed"
         style="background-image: url('{{ asset('images/front-end/fastlog1.png') }}');">

    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-[#052B35]/70"></div>

    <div class="relative z-10 text-center text-white px-4 mt-8">
        <h1 class="text-3xl md:text-5xl font-bold mb-3">{{ __('Destinasi') }}</h1>
        <div class="flex items-center justify-center gap-2 text-sm md:text-base text-gray-200">
            <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">{{ __('Home') }}</a>
            <span>/</span>
            <span class="text-white font-medium">{{ __('Destinasi') }}</span>
        </div>
    </div>
</section>

{{-- ============ MAIN CONTENT DESTINASI (CARD GRID LOKAL & INT) ============ --}}
<section class="py-16 bg-white" x-data="{ activeTab: 'lokal' }">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            
            {{-- SIDEBAR NAVIGASI KIRI --}}
            <div class="lg:col-span-1 border-r border-gray-100 pr-0 lg:pr-6">
                <h3 class="text-xl font-bold text-[#052B35] pb-3 border-b border-gray-200 mb-4">{{ __('Destinasi') }}</h3>
                <div class="flex flex-col space-y-3">
                    <button type="button" @click="activeTab = 'lokal'" 
                            :class="activeTab === 'lokal' ? 'text-[#FF7A3D] font-bold border-l-4 border-[#FF7A3D] pl-3' : 'text-gray-600 hover:text-[#052B35] pl-3'"
                            class="text-left py-1 text-base md:text-lg transition-all duration-200">
                        {{ __('Lokal') }}
                    </button>
                    <button type="button" @click="activeTab = 'international'" 
                            :class="activeTab === 'international' ? 'text-[#FF7A3D] font-bold border-l-4 border-[#FF7A3D] pl-3' : 'text-gray-600 hover:text-[#052B35] pl-3'"
                            class="text-left py-1 text-base md:text-lg transition-all duration-200">
                        {{ __('International') }}
                    </button>
                </div>
            </div>

            {{-- KONTEN UTAMA KANAN --}}
            <div class="lg:col-span-3">
                
                {{-- TAB 1: DESTINASI LOKAL (GRID CARD KOTA) --}}
                <div x-show="activeTab === 'lokal'">
                    @php
                        $localCities = [
                            ['name' => 'Surabaya', 'image' => 'surabaya.jpg'],
                            ['name' => 'Jakarta', 'image' => 'jakarta.jpg'],
                            ['name' => 'Balikpapan', 'image' => 'balikpapan.jpg'],
                            ['name' => 'Makassar', 'image' => 'makassar.jpg'],
                            ['name' => 'Medan', 'image' => 'medan.jpg'],
                            ['name' => 'Batam', 'image' => 'batam.jpg'],
                        ];
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($localCities as $city)
                            <a href="{{ route('destination.detail', \Illuminate\Support\Str::slug($city['name'])) }}" 
                            class="group block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 border border-gray-100">
                                <div class="h-44 overflow-hidden">
                                    <img src="{{ asset('images/front-end/' . $city['image']) }}" alt="{{ $city['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                </div>
                                <div class="p-4 text-center">
                                    <h5 class="font-bold text-[#052B35] group-hover:text-[#FF7A3D] transition">{{ $city['name'] }}</h5>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- TAB 2: DESTINASI INTERNATIONAL (GRID CARD NEGARA) --}}
                <div x-show="activeTab === 'international'" style="display: none;">
                    @php
                        $countries = [
                            ['name' => 'Netherlands', 'image' => 'netherlands.jpg'],
                            ['name' => 'Spain', 'image' => 'spain.jpg'],
                            ['name' => 'China', 'image' => 'china.jpg'],
                            ['name' => 'United States', 'image' => 'usa.jpg'],
                        ];
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($countries as $c)
                            <a href="{{ route('destination.detail', \Illuminate\Support\Str::slug($c['name'])) }}" 
                               class="group block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 border border-gray-100">
                                <div class="h-44 overflow-hidden">
                                    <img src="{{ asset('images/front-end/' . $c['image']) }}" alt="{{ $c['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                </div>
                                <div class="p-4 text-center">
                                    <h5 class="font-bold text-[#052B35] group-hover:text-[#FF7A3D] transition">{{ $c['name'] }}</h5>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

{{-- CDN Alpine.js --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@endsection