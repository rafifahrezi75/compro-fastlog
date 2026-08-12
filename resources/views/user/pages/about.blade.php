@extends('user.layouts.app')

@section('content')

{{-- ============ HERO HEADER BANNER ============ --}}
<section class="relative h-[300px] md:h-[350px] flex items-center justify-center pt-20 bg-cover bg-center bg-fixed"
         style="background-image: url('{{ asset('images/front-end/fastlog2.jpg') }}');">

    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-[#052B35]/70"></div>

    <div class="relative z-10 text-center text-white px-4 mt-8">
        <h1 class="text-3xl md:text-5xl font-bold mb-3">{{ __('About Us') }}</h1>
        <div class="flex items-center justify-center gap-2 text-sm md:text-base text-gray-200">
            <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">{{ __('Home') }}</a>
            <span>/</span>
            <span class="text-white font-medium">{{ __('About Us') }}</span>
        </div>
    </div>
</section>

{{-- ============ MAIN CONTENT (SIDEBAR + CONTENT) ============ --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

            {{-- SIDEBAR KIRI --}}
            <aside class="lg:col-span-1">
                <div class="border-b border-gray-200 pb-3 mb-4">
                    <h3 class="text-xl font-bold text-[#052B35]">{{ __('About Us') }}</h3>
                </div>
                <nav class="flex flex-col space-y-1">
                    <a href="#" class="px-3 py-2 text-[#FF7A3D] font-semibold border-l-2 border-[#FF7A3D] bg-orange-50/50 transition">
                        {{ __('Vision & Mission') }}
                    </a>
                    {{-- Navigasi tambahan (jika nanti dibutuhkan) --}}
                    {{-- <a href="#" class="px-3 py-2 text-gray-600 hover:text-[#052B35] transition">Sejarah Perusahaan</a> --}}
                </nav>
            </aside>

            {{-- KONTEN VISI MISI KANAN --}}
            <main class="lg:col-span-3">
                <div class="mb-6">
                    <h2 class="text-2xl md:text-3xl font-bold text-[#052B35] mb-2">{{ __('Vision & Mission') }}</h2>
                    {{-- Accent Bar --}}
                    <div class="w-12 h-1 bg-[#00A884] rounded-full"></div>
                </div>

                <div class="space-y-8 text-gray-600 leading-relaxed">
                    
                    {{-- VISI --}}
                    <div>
                        <h3 class="text-lg font-semibold text-[#052B35] mb-3">{{ __('Company Vision:') }}</h3>
                        <ul class="space-y-2 list-none pl-1">
                            <li class="flex items-start gap-2">
                                <span class="select-none font-bold text-gray-400">•</span>
                                <span>{{ __('about_vis_1') }}</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="select-none font-bold text-gray-400">•</span>
                                <span>{{ __('about_vis_2') }}</span>
                            </li>
                        </ul>
                    </div>

                    {{-- MISI --}}
                    <div>
                        <h3 class="text-lg font-semibold text-[#052B35] mb-3">{{ __('Company Mission:') }}</h3>
                        <ul class="space-y-2 list-none pl-1">
                            <li class="flex items-start gap-2">
                                <span class="select-none font-bold text-gray-400">•</span>
                                <span>{{ __('about_mis_1') }}</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="select-none font-bold text-gray-400">•</span>
                                <span>{{ __('about_mis_2') }}</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="select-none font-bold text-gray-400">•</span>
                                <span>{{ __('about_mis_3') }}</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="select-none font-bold text-gray-400">•</span>
                                <span>{{ __('about_mis_4') }}</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </main>

        </div>
    </div>
</section>

@endsection