@extends('user.layouts.app') {{-- Sesuaikan dengan nama file layout utama kamu --}}

@section('title', 'Layanan Kami - Fastlog Era Mandiri')

@section('content')

{{-- HERO BANNER --}}
<section class="relative bg-[#052B35] pt-36 pb-20 overflow-hidden text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Logistik Terpadu</h1>
        <p class="text-white/80 max-w-2xl mx-auto text-base md:text-lg">
            Kami menyediakan solusi rantai pasok dan logistik end-to-end yang efisien, aman, dan dapat diandalkan untuk bisnis Anda.
        </p>
    </div>
</section>

{{-- GRID LAYANAN --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- 1. Custom Clearance --}}
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-8 border border-gray-100 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 bg-[#FF7A3D]/10 rounded-xl flex items-center justify-center text-[#FF7A3D] mb-6 group-hover:bg-[#FF7A3D] group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#052B35] mb-3">Custom Clearance</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Layanan pengurusan dokumen ekspor dan impor cepat serta tepat waktu, memastikan seluruh aturan kepabeanan terpenuhi tanpa kendala.
                    </p>
                </div>
                <a href="{{ route('services.detail', 'custom-clearance') }}" class="inline-flex items-center text-[#FF7A3D] font-semibold hover:gap-3 gap-2 transition-all duration-200">
                    Pelajari Selengkapnya
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            {{-- 2. Reefer Logistic --}}
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-8 border border-gray-100 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 bg-[#FF7A3D]/10 rounded-xl flex items-center justify-center text-[#FF7A3D] mb-6 group-hover:bg-[#FF7A3D] group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#052B35] mb-3">Reefer Logistic</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Spesialis penanganan kargo berpendingin seperti komoditas frozen food, ikan, dan buah dengan kontrol suhu yang ketat.
                    </p>
                </div>
                <a href="{{ route('services.detail', 'reefer-logistic') }}" class="inline-flex items-center text-[#FF7A3D] font-semibold hover:gap-3 gap-2 transition-all duration-200">
                    Pelajari Selengkapnya
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            {{-- 3. Freight Forwarding --}}
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-8 border border-gray-100 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 bg-[#FF7A3D]/10 rounded-xl flex items-center justify-center text-[#FF7A3D] mb-6 group-hover:bg-[#FF7A3D] group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 002.5-2.5V11a2 2 0 012-2h1.064" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#052B35] mb-3">Freight Forwarding</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Pengiriman barang internasional via Laut (Sea Freight) dan Udara (Air Freight) dengan opsi FCL maupun LCL secara efisien.
                    </p>
                </div>
                <a href="{{ route('services.detail', 'freight-forwarding') }}" class="inline-flex items-center text-[#FF7A3D] font-semibold hover:gap-3 gap-2 transition-all duration-200">
                    Pelajari Selengkapnya
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            {{-- 4. Inland Transport --}}
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-8 border border-gray-100 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 bg-[#FF7A3D]/10 rounded-xl flex items-center justify-center text-[#FF7A3D] mb-6 group-hover:bg-[#FF7A3D] group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#052B35] mb-3">Inland Transport</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Pengangkutan darat door-to-door menggunakan berbagai jenis armada truk pendukung pengiriman kargo Anda ke seluruh pelosok tanah air.
                    </p>
                </div>
                <a href="{{ route('services.detail', 'inland-transport') }}" class="inline-flex items-center text-[#FF7A3D] font-semibold hover:gap-3 gap-2 transition-all duration-200">
                    Pelajari Selengkapnya
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

        </div>

    </div>
</section>

{{-- CALL TO ACTION (CTA) --}}
<section class="py-16 bg-[#052B35] text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Butuh Penawaran Harga atau Konsultasi Logistik?</h2>
        <p class="text-white/80 max-w-2xl mx-auto mb-8">
            Tim profesional kami siap membantu merencanakan pengiriman barang Anda secara efisien dan tepat waktu.
        </p>
        <a href="#contact" class="bg-[#FF7A3D] hover:bg-orange-600 text-white px-8 py-3.5 rounded-xl font-semibold transition duration-300 inline-block shadow-lg">
            Hubungi Kami Sekarang
        </a>
    </div>
</section>

@endsection