@extends('user.layouts.app')

{{-- SEO Meta Tags — Halaman Layanan --}}
@section('meta_title', 'Layanan Logistik')
@section('meta_description',
    'Fastlog Era Mandiri menawarkan layanan logistik lengkap: Custom Clearance, Reefer
    Logistic, Freight Forwarding internasional, dan Inland Transport di Indonesia.')
@section('meta_canonical', route('services'))

@section('content')

    {{-- HERO BANNER --}}
    <section class="relative bg-[#052B35] pt-36 pb-20 overflow-hidden text-white bg-cover bg-center bg-fixed"
        style="background-image: url('{{ asset('images/front-end/fastlog3.png') }}');">

        {{-- Overlay Gelap --}}
        <div class="absolute inset-0 bg-[#052B35]/80"></div>

        <div class="relative z-10 text-center text-white px-4 mt-8">
            <h1 class="text-3xl md:text-5xl font-bold mb-3">{{ __('Integrated Logistics Services') }}</h1>
            <div class="flex items-center justify-center gap-2 text-sm md:text-base text-gray-200">
                <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">{{ __('Home') }}</a>
                <span>/</span>
                <span class="text-white font-medium">{{ __('Services') }}</span>
            </div>
        </div>
    </section>

    {{-- GRID LAYANAN --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                @foreach ($services as $service)
                    <a href="{{ route('services.detail', $service->slug) }}"
                        class="group relative rounded-2xl overflow-hidden h-96 block shadow-lg hover:shadow-2xl transition-all duration-500">

                        <img src="{{ $service->gambar_url }}" alt="{{ $service->nama }}"
                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-[#052B35] via-[#052B35]/70 to-[#052B35]/20 group-hover:from-[#FF7A3D]/95 group-hover:via-[#052B35]/80 transition-all duration-500">
                        </div>

                        <div
                            class="absolute top-7 left-7 w-14 h-14 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center text-white border border-white/20 group-hover:bg-white group-hover:text-[#FF7A3D] transition-all duration-300">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                {!! $service->ikon !!}
                            </svg>
                        </div>

                        <div class="absolute bottom-0 left-0 right-0 p-7">
                            <h3 class="text-2xl font-bold text-white mb-3">{{ __($service->nama) }}</h3>
                            <p
                                class="text-white/80 text-sm leading-relaxed mb-4 line-clamp-2 group-hover:line-clamp-none transition-all [&_p]:m-0">
                                {!! $service->deskripsi_singkat !!}
                            </p>
                            <span
                                class="inline-flex items-center text-white font-semibold gap-2 text-sm group-hover:gap-3 transition-all duration-300">
                                {{ __('Read More') }}
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
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
            <img src="{{ asset('images/front-end/logo2.png') }}" alt="Fastlog Era Mandiri"
                class="h-20 md:h-24 mx-auto mb-6 object-contain">

            <h2 class="text-3xl font-bold mb-4">{{ __('Need a Price Quote or Logistics Consultation?') }}</h2>
            <p class="text-white/80 max-w-2xl mx-auto mb-8">
                {{ __('CTA description') }}
            </p>
            <a href="#contact"
                class="bg-[#FF7A3D] hover:bg-orange-600 text-white px-8 py-3.5 rounded-xl font-semibold transition duration-300 inline-block shadow-lg">
                {{ __('Contact Us Now') }}
            </a>
        </div>
    </section>

@endsection
