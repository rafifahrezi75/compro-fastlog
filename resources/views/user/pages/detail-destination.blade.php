@extends('user.layouts.app')

@section('content')

{{-- ============ HERO HEADER BANNER ============ --}}
<section class="relative h-[250px] md:h-[300px] flex items-center justify-center pt-20 bg-cover bg-center bg-fixed"
         style="background-image: url('{{ asset('images/front-end/fastlog3.png') }}');">

    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-[#052B35]/70"></div>

    <div class="relative z-10 text-center text-white px-4 mt-8">
        <h1 class="text-3xl md:text-5xl font-bold mb-3">{{ __('Destination') }}</h1>
        <div class="flex items-center justify-center gap-2 text-sm md:text-base text-gray-200">
            <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">{{ __('Home') }}</a>
            <span>/</span>
            <a href="{{ route('destination') }}" class="hover:text-[#FF7A3D] transition">{{ __('Destination') }}</a>
            <span>/</span>
            {{-- DINAMIS: Menyesuaikan {{ __('City') }}/{{ __('Country') }} --}}
            <span class="text-white font-medium">{{ __($countryName) }}</span>
        </div>
    </div>
</section>

{{-- ============ MAIN CONTENT DETAIL ============ --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            
            {{-- KONTEN UTAMA KIRI (DETAIL & DIAGRAM STATISTIK) --}}
            <div class="lg:col-span-3 space-y-10">
                
                {{-- Judul Destinasi Dinamis --}}
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-[#052B35] inline-block border-b-4 border-[#00A884] pb-1">
                        {{ __($countryName) }}
                    </h2>
                    <p class="text-gray-600 mt-4 leading-relaxed">
                        {{ __('destination_detail_desc', ['name' => __($countryName)]) }}
                    </p>
                </div>

                {{-- STAT CARDS (METRIK RINGKAS) --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5 text-center shadow-sm">
                        <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">{{ __('Shipping Performance') }}</p>
                        <h4 class="text-2xl font-bold text-[#00A884] mt-1">98.5%</h4>
                        <p class="text-xs text-gray-400 mt-1">{{ __('On-Time Delivery Rate') }}</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5 text-center shadow-sm">
                        <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">{{ __('Time Estimation') }}</p>
                        <h4 class="text-2xl font-bold text-[#FF7A3D] mt-1">{{ __('22 - 28 Days') }}</h4>
                        <p class="text-xs text-gray-400 mt-1">{{ __('Transit Time') }}</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5 text-center shadow-sm">
                        <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">{{ __('Total Cargo 2025') }}</p>
                        <h4 class="text-2xl font-bold text-[#052B35] mt-1">1,450+ TEUs</h4>
                        <p class="text-xs text-gray-400 mt-1">{{ __('Shipped Container Volume') }}</p>
                    </div>
                </div>

                {{-- DIAGRAM / GRAFIK STATISTIK --}}
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm space-y-6">
                    <div class="flex items-center justify-between border-b pb-4">
                        {{-- Judul Grafik Dinamis --}}
                        <h3 class="text-lg font-bold text-[#052B35]">{{ __('Cargo Shipping Statistics (:name)', ['name' => __($countryName)]) }}</h3>
                        <span class="text-xs font-medium bg-[#00A884]/10 text-[#00A884] px-3 py-1 rounded-full">
                            {{ __('Data 2025 - 2026') }}
                        </span>
                    </div>

                    {{-- Grid 2 Chart Side-by-Side --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        {{-- Chart 1: Volume per Kuartal --}}
                        <div>
                            <p class="text-sm font-semibold text-gray-700 mb-3 text-center md:text-left">{{ __('Quarterly Shipping Volume (TEUs)') }}</p>
                            <div class="h-64">
                                <canvas id="volumeChart"></canvas>
                            </div>
                        </div>

                        {{-- Chart 2: Persentase Jenis Moda Pengiriman --}}
                        <div>
                            <p class="text-sm font-semibold text-gray-700 mb-3 text-center md:text-left">{{ __('Main Shipping Mode') }}</p>
                            <div class="h-64 flex items-center justify-center">
                                <canvas id="modeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- SIDEBAR KANAN (LIST NAVIGASI DIPISAH LOKAL & INTERNATIONAL) --}}
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm space-y-6">
                    
                    {{-- Kelompok 1: Lokal --}}
                    <div>
                        <h4 class="text-sm font-bold text-[#052B35] uppercase tracking-wider pb-2 border-b border-gray-100 mb-3">
                            {{ __('Local') }}
                        </h4>
                        <div class="flex flex-col space-y-1">
                            @php
                                $localCities = ['Surabaya', 'Jakarta', 'Balikpapan', 'Makassar', 'Medan', 'Batam'];
                            @endphp

                            @foreach($localCities as $city)
                                @php 
                                    $slug = \Illuminate\Support\Str::slug($city);
                                    $isActive = strtolower($countryName) === strtolower($city);
                                @endphp
                                <a href="{{ route('destination.detail', $slug) }}" 
                                class="{{ $isActive ? 'text-[#FF7A3D] font-bold border-l-2 border-[#FF7A3D] pl-3 bg-orange-50/50 py-1.5' : 'text-gray-600 hover:text-[#052B35] hover:pl-4 pl-3 py-1' }} text-sm transition-all duration-200 rounded-r-md">
                                    {{ __($city) }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Kelompok 2: International --}}
                    <div>
                        <h4 class="text-sm font-bold text-[#052B35] uppercase tracking-wider pb-2 border-b border-gray-100 mb-3">
                            {{ __('International') }}
                        </h4>
                        <div class="flex flex-col space-y-1">
                            @php
                                $internationalCountries = ['Netherlands', 'Spain', 'China', 'United States'];
                            @endphp

                            @foreach($internationalCountries as $country)
                                @php 
                                    $slug = \Illuminate\Support\Str::slug($country);
                                    $isActive = strtolower($countryName) === strtolower($country);
                                @endphp
                                <a href="{{ route('destination.detail', $slug) }}" 
                                class="{{ $isActive ? 'text-[#FF7A3D] font-bold border-l-2 border-[#FF7A3D] pl-3 bg-orange-50/50 py-1.5' : 'text-gray-600 hover:text-[#052B35] hover:pl-4 pl-3 py-1' }} text-sm transition-all duration-200 rounded-r-md">
                                    {{ __($country) }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>

                {{-- Card Inquiry --}}
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 text-center shadow-sm">
                    <h4 class="text-lg font-bold text-[#052B35] mb-2">{{ __('Logistics & Cargo for Business') }}</h4>
                    <p class="text-xs text-gray-500 mb-6 leading-relaxed">{{ __('If you are interested in our services, please feel free to fill inquiry below') }}</p>
                    
                    <div class="space-y-3">
                        <a href="#" class="block w-full bg-[#00A884] hover:bg-[#008f70] text-white text-sm font-medium py-3 rounded-xl transition shadow-sm hover:shadow-md">
                            {{ __('Get Inquiry') }}
                        </a>
                        <a href="#" class="block w-full bg-[#FF7A3D] hover:bg-orange-600 text-white text-sm font-medium py-3 rounded-xl transition shadow-sm hover:shadow-md">
                            {{ __('Contact Us') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- 1. BAR CHART: Volume Pengiriman ---
        const ctxVolume = document.getElementById('volumeChart').getContext('2d');
        new Chart(ctxVolume, {
            type: 'bar',
            data: {
                labels: ['Q1', 'Q2', 'Q3', 'Q4'],
                datasets: [{
                    label: 'Volume (TEUs)',
                    data: [320, 410, 380, 480],
                    backgroundColor: '#00A884',
                    borderRadius: 8,
                    hoverBackgroundColor: '#FF7A3D'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [2, 4] } },
                    x: { grid: { display: false } }
                }
            }
        });

        // --- 2. DONUT CHART: Moda Transportasi ---
        const ctxMode = document.getElementById('modeChart').getContext('2d');
        new Chart(ctxMode, {
            type: 'doughnut',
            data: {
                labels: ['Sea Freight', 'Air Freight', 'Multimodal'],
                datasets: [{
                    data: [75, 15, 10],
                    backgroundColor: ['#052B35', '#00A884', '#FF7A3D'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } }
                },
                cutout: '65%'
            }
        });
    });
</script>

@endsection