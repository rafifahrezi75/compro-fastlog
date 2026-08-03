@extends('user.layouts.app')

@section('title', 'Karir - Fastlog Era Mandiri')

@section('content')

{{-- HERO BANNER --}}
<section class="relative bg-[#052B35] pt-36 pb-20 text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <span class="bg-[#FF7A3D]/20 text-[#FF7A3D] border border-[#FF7A3D]/30 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider mb-4 inline-block">
            Bergabung Bersama Kami
        </span>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Membangun Masa Depan Logistik</h1>
        <p class="text-white/80 max-w-2xl mx-auto text-base md:text-lg">
            Temukan peluang karir terbaik dan berkembanglah bersama tim profesional PT Fastlog Era Mandiri.
        </p>
    </div>
</section>

{{-- WHY JOIN US / CULTURE --}}
<section class="py-12 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-[#FF7A3D]/10 text-[#FF7A3D] rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-[#052B35] text-lg mb-1">Pengembangan Karir</h3>
                    <p class="text-gray-600 text-sm">Peluang kenaikan jenjang karir yang terbuka luas berbasis kinerja dan kompetensi.</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-[#FF7A3D]/10 text-[#FF7A3D] rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5-3.562M9 20H4v-2a3 3 0 015-3.562M12 4a4 4 0 100 8 4 4 0 000-8z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-[#052B35] text-lg mb-1">Lingkungan Kolaboratif</h3>
                    <p class="text-gray-600 text-sm">Budaya kerja yang saling mendukung, profesional, dan mengedepankan kerja tim.</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-[#FF7A3D]/10 text-[#FF7A3D] rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-[#052B35] text-lg mb-1">Benefit Kompetitif</h3>
                    <p class="text-gray-600 text-sm">Paket remunerasi yang menarik, asuransi kesehatan, dan insentif berbasis performa.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- DAFTAR LOWONGAN KERJA --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-[#052B35]">Lowongan Kerja Tersedia</h2>
                <p class="text-gray-500 text-sm mt-1">Pilih posisi yang sesuai dengan keahlian dan passion Anda</p>
            </div>
            <span class="text-sm bg-white px-4 py-2 rounded-xl shadow-sm border font-semibold text-[#052B35] w-fit">
                {{ count($careers) }} Posisi Dibuka
            </span>
        </div>

        {{-- LIST VACANCIES --}}
        <div class="space-y-4">
            @foreach($careers as $job)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-[#FF7A3D]/30 transition duration-200 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="bg-[#052B35]/10 text-[#052B35] text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $job['department'] }}
                        </span>
                        <span class="bg-emerald-50 text-emerald-600 text-xs font-semibold px-3 py-1 rounded-full border border-emerald-200">
                            {{ $job['type'] }}
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-[#052B35] hover:text-[#FF7A3D] transition">
                        <a href="{{ route('career.detail', $job['slug']) }}">{{ $job['title'] }}</a>
                    </h3>

                    <div class="flex items-center gap-4 text-xs md:text-sm text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $job['location'] }}
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $job['posted_at'] }}
                        </span>
                    </div>
                </div>

                <a href="{{ route('career.detail', $job['slug']) }}" class="bg-[#052B35] hover:bg-[#FF7A3D] text-white px-6 py-3 rounded-xl font-semibold text-sm transition duration-200 text-center shrink-0">
                    Lihat Detail & Apply
                </a>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection