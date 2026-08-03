@extends('user.layouts.app')

@section('title', $job['title'] . ' - Karir Fastlog')

@section('content')

{{-- HERO --}}
<section class="relative bg-[#052B35] pt-36 pb-16 text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm text-white/70 mb-4">
            <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">Home</a>
            <span>/</span>
            <a href="{{ route('career') }}" class="hover:text-[#FF7A3D] transition">Karir</a>
            <span>/</span>
            <span class="text-[#FF7A3D] font-medium">{{ $job['title'] }}</span>
        </nav>

        <div class="flex flex-wrap items-center gap-3 mb-3">
            <span class="bg-[#FF7A3D] text-white text-xs font-semibold px-3 py-1 rounded-full">
                {{ $job['department'] }}
            </span>
            <span class="bg-white/10 text-white text-xs font-semibold px-3 py-1 rounded-full">
                {{ $job['type'] }}
            </span>
        </div>

        <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $job['title'] }}</h1>
        <p class="text-white/80 text-sm md:text-base flex items-center gap-2">
            <svg class="w-4 h-4 text-[#FF7A3D]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            {{ $job['location'] }}
        </p>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        {{-- Alert Notifikasi Simulasi Sukses --}}
        @if(session('success'))
        <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-4 flex items-center gap-3">
            <svg class="w-6 h-6 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm md:text-base font-medium">{{ session('success') }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- KIRI: RINCIAN PEKERJAAN --}}
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 space-y-8">
                
                <div>
                    <h2 class="text-2xl font-bold text-[#052B35] mb-4">Deskripsi Pekerjaan</h2>
                    <p class="text-gray-600 leading-relaxed text-base">
                        {{ $job['description'] }}
                    </p>
                </div>

                <hr class="border-gray-100">

                <div>
                    <h2 class="text-xl font-bold text-[#052B35] mb-4">Tanggung Jawab Utama</h2>
                    <ul class="space-y-3">
                        @foreach($job['responsibilities'] as $item)
                        <li class="flex items-start gap-3">
                            <span class="w-2 h-2 rounded-full bg-[#FF7A3D] mt-2 shrink-0"></span>
                            <span class="text-gray-600 text-base leading-relaxed">{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <hr class="border-gray-100">

                <div>
                    <h2 class="text-xl font-bold text-[#052B35] mb-4">Kualifikasi & Persyaratan</h2>
                    <ul class="space-y-3">
                        @foreach($job['requirements'] as $req)
                        <li class="flex items-start gap-3">
                            <span class="w-2 h-2 rounded-full bg-[#052B35] mt-2 shrink-0"></span>
                            <span class="text-gray-600 text-base leading-relaxed">{{ $req }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            {{-- KANAN: FORM APPLY LAMARAN --}}
            <div class="lg:sticky lg:top-28">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold text-[#052B35] mb-1">Lamar Posisi Ini</h3>
                    <p class="text-gray-500 text-xs mb-6">Isi formulir berikut dan unggah CV terbaru Anda.</p>

                    <form action="{{ route('career.apply') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="job_title" value="{{ $job['title'] }}">

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap *</label>
                            <input type="text" name="name" required placeholder="Contoh: Budi Santoso"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF7A3D] transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Email *</label>
                            <input type="email" name="email" required placeholder="budi@gmail.com"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF7A3D] transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor WhatsApp *</label>
                            <input type="tel" name="phone" required placeholder="081234567890"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF7A3D] transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Upload CV / Resume (PDF) *</label>
                            <input type="file" name="cv" accept=".pdf" required
                                class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#FF7A3D]/10 file:text-[#FF7A3D] hover:file:bg-[#FF7A3D]/20 cursor-pointer">
                            <span class="text-[10px] text-gray-400 mt-1 block">Maksimal ukuran file: 2MB (.pdf)</span>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Pesan / Catatan (Opsional)</label>
                            <textarea name="message" rows="3" placeholder="Tuliskan perkenalan singkat Anda..."
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF7A3D] transition"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-[#FF7A3D] hover:bg-orange-600 text-white font-semibold py-3 rounded-xl transition duration-200 shadow-md text-sm mt-2">
                            Kirim Lamaran Sekarang
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection