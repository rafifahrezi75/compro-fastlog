@extends('user.layouts.app')

@section('title', __('Contact Us') . ' - Fastlog Era Mandiri')

@section('content')

{{-- 1. HERO BANNER --}}
<section class="relative bg-[#052B35] pt-36 pb-20 text-white text-center bg-cover bg-center" style="background-image: linear-gradient(rgba(5, 43, 53, 0.85), rgba(5, 43, 53, 0.85)), url('https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=1600&q=80');">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-3">{{ __('Contact Us') }}</h1>
        <nav class="flex justify-center items-center gap-2 text-sm text-white/80">
            <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">{{ __('Home') }}</a>
            <span>/</span>
            <span class="text-white/60">{{ __('Page') }}</span>
        </nav>
    </div>
</section>

{{-- 2. CONTACT CONTENT SECTION --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        {{-- Alert Notifikasi Sukses --}}
        @if(session('success'))
        <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-4 flex items-center gap-3">
            <svg class="w-6 h-6 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            {{-- SISI KIRI: FORM "Leave us your info" (Col 7) --}}
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-[#052B35] border-b-2 border-[#052B35] pb-2 inline-block">
                        {{ __('Leave us your info') }}
                    </h2>
                    <p class="text-gray-500 text-sm mt-4">
                        {{ __('Get interesting offers from us') }}
                    </p>
                </div>

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-4 pt-2">
                    @csrf
                    <div>
                        <input type="text" name="name" required placeholder="{{ __('Full Name') }}*"
                            class="w-full px-4 py-3 bg-gray-100 border border-transparent rounded-lg text-sm text-gray-800 focus:bg-white focus:border-[#052B35] focus:outline-none transition duration-200">
                    </div>

                    <div>
                        <input type="email" name="email" required placeholder="{{ __('Email') }}*"
                            class="w-full px-4 py-3 bg-gray-100 border border-transparent rounded-lg text-sm text-gray-800 focus:bg-white focus:border-[#052B35] focus:outline-none transition duration-200">
                    </div>

                    <div>
                        <input type="tel" name="phone" required placeholder="{{ __('Telephone') }}*"
                            class="w-full px-4 py-3 bg-gray-100 border border-transparent rounded-lg text-sm text-gray-800 focus:bg-white focus:border-[#052B35] focus:outline-none transition duration-200">
                    </div>

                    <div>
                        <textarea name="message" rows="5" required placeholder="{{ __('Message') }}*"
                            class="w-full px-4 py-3 bg-gray-100 border border-transparent rounded-lg text-sm text-gray-800 focus:bg-white focus:border-[#052B35] focus:outline-none transition duration-200"></textarea>
                    </div>

                    <div>
                        <button type="submit" 
                            class="bg-[#FF7A3D] hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:shadow-lg transition duration-200 text-sm">
                            {{ __('Send Message') }}
                        </button>
                    </div>
                </form>
            </div>

            {{-- SISI KANAN: LOCATION & MAP (Col 5) --}}
            <div class="lg:col-span-5 space-y-8">
                
                {{-- Detail Lokasi --}}
                <div>
                    <h2 class="text-2xl font-bold text-[#052B35] border-b-2 border-[#052B35] pb-2 inline-block mb-6">
                        {{ __('Location') }}
                    </h2>

                    <div class="space-y-4 text-sm text-gray-700">
                        <p class="font-semibold uppercase tracking-wider text-[#052B35] leading-relaxed">
                            VICTORIA MAINSTREET GRAND PAKUWON<br>
                            <span class="font-normal capitalize text-gray-600">
                                RA 08, Banjar Sugihan, Kec. Tandes, Kota SBY, Jawa Timur 60184
                            </span>
                        </p>

                        <div class="flex items-center gap-3 pt-2">
                            <svg class="w-5 h-5 text-[#052B35] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:admin@fastlogem.co.id" class="text-gray-700 hover:text-[#FF7A3D] transition">
                                admin@fastlogem.co.id
                            </a>
                        </div>

                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#052B35] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:+623199343392" class="text-gray-700 hover:text-[#FF7A3D] transition">
                                +62 31 9934 3392
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Map Section --}}
                <div>
                    <h2 class="text-xl font-bold text-[#052B35] border-b-2 border-[#052B35] pb-2 inline-block mb-4">
                        {{ __('Map') }}
                    </h2>
                    
                   <div class="rounded-xl overflow-hidden shadow-sm border border-gray-200">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.9422894589253!2d112.6637346!3d-7.2452788!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fd442b288873%3A0xe7d93f0d33eb7b20!2sPT.%20FASTLOG%20ERA%20MANDIRI!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid"
                            width="100%" 
                            height="220" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection