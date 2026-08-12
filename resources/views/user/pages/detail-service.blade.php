@extends('user.layouts.app')

@section('title', $service['title'] . ' - Fastlog Era Mandiri')

@section('content')

{{-- 1. HERO BANNER --}}
<section class="relative bg-[#052B35] pt-36 pb-16 text-white bg-cover bg-center"
         style="background-image: url('{{ asset('images/front-end/fastlog1.png') }}');">

    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-[#052B35]/80"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        {{-- Breadcrumb Navigasi --}}
        <nav class="flex items-center gap-2 text-sm text-white/70 mb-4">
            <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">{{ __('Home') }}</a>
            <span>/</span>
            <a href="{{ route('services') }}" class="hover:text-[#FF7A3D] transition">{{ __('Services') }}</a>
            <span>/</span>
            <span class="text-[#FF7A3D] font-medium">{{ $service['title'] }}</span>
        </nav>

        <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $service['title'] }}</h1>
        <p class="text-white/80 max-w-2xl text-base md:text-lg">
            {{ __('Solusi penanganan logistik terbaik dengan standar operasional internasional untuk menjaga keandalan bisnis Anda.') }}
        </p>
    </div>
</section>

{{-- 2. DETAIL CONTENT SECTION --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- MAIN CONTENT (LEFT - 2 COLUMNS) --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Gambar Service --}}
                <div class="rounded-2xl overflow-hidden shadow-md bg-gray-200">
                    <img src="{{ asset('images/services/' . $service['image']) }}" 
                         alt="{{ $service['title'] }}" 
                         class="w-full h-[350px] md:h-[450px] object-cover"
                         onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1200&q=80';">
                </div>

                {{-- {{ __('Description') }} Layanan --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-[#052B35] mb-4">{{ __('Service Description') }}</h2>
                    <p class="text-gray-600 leading-relaxed text-base mb-6">
                        {{ $service['desc'] }}
                    </p>
                    <p class="text-gray-600 leading-relaxed text-base">
                        {{ __('PT Fastlog Era Mandiri memastikan setiap tahapan operasional') }} {{ strtolower($service['title']) }} {{ __('berjalan secara transparan, akurat, dan efisien. Didukung oleh tim ahli berpengalaman serta jaringan armada yang kuat, kami siap meminimalkan risiko pengiriman Anda.') }}
                    </p>
                </div>

                {{-- Fitur / Keunggulan Layanan --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-[#052B35] mb-6">{{ __('Scope & Key Advantages') }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($service['features'] as $feature)
                        <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="w-6 h-6 rounded-full bg-[#FF7A3D]/20 text-[#FF7A3D] flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium text-sm md:text-base">{{ $feature }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- SIDEBAR (RIGHT - 1 COLUMN) --}}
            <div class="space-y-8">

                {{-- Card Navigasi Layanan Lain --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-[#052B35] mb-4 border-b pb-3">{{ __('Other Services') }}</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('services.detail', 'custom-clearance') }}" 
                               class="flex items-center justify-between p-3 rounded-xl transition {{ $slug === 'custom-clearance' ? 'bg-[#FF7A3D] text-white font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-[#FF7A3D]' }}">
                                <span>Custom Clearance</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('services.detail', 'reefer-logistic') }}" 
                               class="flex items-center justify-between p-3 rounded-xl transition {{ $slug === 'reefer-logistic' ? 'bg-[#FF7A3D] text-white font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-[#FF7A3D]' }}">
                                <span>Reefer Logistic</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('services.detail', 'freight-forwarding') }}" 
                               class="flex items-center justify-between p-3 rounded-xl transition {{ $slug === 'freight-forwarding' ? 'bg-[#FF7A3D] text-white font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-[#FF7A3D]' }}">
                                <span>Freight Forwarding</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('services.detail', 'inland-transport') }}" 
                               class="flex items-center justify-between p-3 rounded-xl transition {{ $slug === 'inland-transport' ? 'bg-[#FF7A3D] text-white font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-[#FF7A3D]' }}">
                                <span>Inland Transport</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Quick Contact Box --}}
                <div class="bg-[#052B35] text-white rounded-2xl p-6 shadow-md relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-[#FF7A3D]/20 rounded-full blur-2xl"></div>
                    
                    <h3 class="text-xl font-bold mb-3">{{ __('Need Consultation for This Service?') }}</h3>
                    <p class="text-white/80 text-sm mb-6 leading-relaxed">
                        {{ __('Hubungi tim marketing kami untuk mendapatkan konsultasi gratis dan penawaran harga terbaik.') }}
                    </p>
                    
                    <a href="https://wa.me/6281234567890" target="_blank" class="w-full bg-[#FF7A3D] hover:bg-orange-600 text-white py-3 rounded-xl font-semibold text-center flex items-center justify-center gap-2 transition duration-300 shadow-md">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        {{ __('Contact via WhatsApp') }}
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection