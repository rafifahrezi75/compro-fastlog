@extends('user.layouts.app')

@section('title', __('Our Services') . ' - Fastlog Era Mandiri')

@section('content')

{{-- HERO BANNER --}}
<section class="relative bg-[#052B35] pt-36 pb-20 overflow-hidden text-white bg-cover bg-center bg-fixed"
         style="background-image: url('{{ asset('images/front-end/fastlog3.png') }}');">

    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-[#052B35]/80"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ __('Integrated Logistics Services') }}</h1>
        <p class="text-white/80 max-w-2xl mx-auto text-base md:text-lg">
            {{ __('Integrated logistics supply chain description') }}
        </p>
    </div>
</section>

{{-- GRID LAYANAN --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            @php
                $services = [
                    [
                        'title' => 'Custom Clearance',
                        'desc' => __('Layanan pengurusan dokumen ekspor dan impor cepat serta tepat waktu, memastikan seluruh aturan kepabeanan terpenuhi tanpa kendala.'),
                        'slug' => 'custom-clearance',
                        'image' => 'fastlog1.png',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />',
                    ],
                    [
                        'title' => 'Reefer Logistic',
                        'desc' => __('Spesialis penanganan kargo berpendingin seperti komoditas frozen food, ikan, dan buah dengan kontrol suhu yang ketat.'),
                        'slug' => 'reefer-logistic',
                        'image' => 'fastlog2.jpg',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM19 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5h1.5m0 0V7a1 1 0 011-1h9.5a1 1 0 011 1v2m-11.5 7.5h8m0 0V9m0 7.5h3m2.5 0H17m2.5 0V11a1 1 0 00-1-1h-3" />',
                    ],
                    [
                        'title' => 'Freight Forwarding',
                        'desc' => __('Pengiriman barang internasional via Laut (Sea Freight) dan Udara (Air Freight) dengan opsi FCL maupun LCL secara efisien.'),
                        'slug' => 'freight-forwarding',
                        'image' => 'fastlog3.png',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 15.75l1.5-4.5h16.5l1.5 4.5m-19.5 0v3a1.5 1.5 0 001.5 1.5h16.5a1.5 1.5 0 001.5-1.5v-3m-19.5 0h19.5M6 11.25V6a1.5 1.5 0 011.5-1.5h9A1.5 1.5 0 0118 6v5.25" />',
                    ],
                    [
                        'title' => 'Inland Transport',
                        'desc' => __('Pengangkutan darat door-to-door menggunakan berbagai jenis armada truk pendukung pengiriman kargo Anda ke seluruh pelosok tanah air.'),
                        'slug' => 'inland-transport',
                        'image' => 'fastlog1.png',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />',
                    ],
                ];
            @endphp

            @foreach ($services as $service)
                <a href="{{ route('services.detail', $service['slug']) }}" class="group relative rounded-2xl overflow-hidden h-96 block shadow-lg hover:shadow-2xl transition-all duration-500">

                    <img src="{{ asset('images/front-end/' . $service['image']) }}" alt="{{ $service['title'] }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#052B35] via-[#052B35]/70 to-[#052B35]/20 group-hover:from-[#FF7A3D]/95 group-hover:via-[#052B35]/80 transition-all duration-500"></div>

                    <div class="absolute top-7 left-7 w-14 h-14 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center text-white border border-white/20 group-hover:bg-white group-hover:text-[#FF7A3D] transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            {!! $service['icon'] !!}
                        </svg>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-7">
                        <h3 class="text-2xl font-bold text-white mb-3">{{ $service['title'] }}</h3>
                        <p class="text-white/80 text-sm leading-relaxed mb-4 line-clamp-2 group-hover:line-clamp-none transition-all">
                            {{ $service['desc'] }}
                        </p>
                        <span class="inline-flex items-center text-white font-semibold gap-2 text-sm group-hover:gap-3 transition-all duration-300">
                            {{ __('Read More') }}
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </span>
                    </div>

                </a>
            @endforeach

        </div>

    </div>
</section>

{{-- CALL TO ACTION (CTA) --}}
<section class="relative py-24 text-white bg-fixed bg-center bg-cover" 
         style="background-image: url('{{ asset('images/front-end/fastlog3.png') }}');">
    
    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-[#052B35]/85"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center relative z-10">
        
        {{-- Logo --}}
        <img src="{{ asset('images/front-end/logo2.png') }}" 
             alt="Fastlog Era Mandiri" 
             class="h-20 md:h-24 mx-auto mb-6 object-contain">

        <h2 class="text-3xl font-bold mb-4">{{ __('Need a Price Quote or Logistics Consultation?') }}</h2>
        <p class="text-white/80 max-w-2xl mx-auto mb-8">
            {{ __('CTA description') }}
        </p>
        <a href="#contact" class="bg-[#FF7A3D] hover:bg-orange-600 text-white px-8 py-3.5 rounded-xl font-semibold transition duration-300 inline-block shadow-lg">
            {{ __('Contact Us Now') }}
        </a>
    </div>
</section>

@endsection