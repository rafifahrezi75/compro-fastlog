<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fastlog Era Mandiri')</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php
        $logoSrc = asset('images/front-end/logo2.png');
        if (isset($infos) && $infos->logo) {
            $logoSrc = str_starts_with($infos->logo, 'images/') ? asset($infos->logo) : asset('storage/' . $infos->logo);
        }
    @endphp
    <link rel="icon" type="image/png" href="{{ $logoSrc }}?v=1">
</head>

<body class="font-sans antialiased">

    <header id="main-header" x-data="{ mobileMenuOpen: false }" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">

        {{-- 1. TOP BAR INFO --}}
        <div id="top-bar" class="bg-[#052B35] text-white text-xs sm:text-sm py-2.5 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">

                {{-- LOGO MOBILE (Hanya Muncul di Mobile/Tablet) --}}
                <a href="{{ route('home') }}" class="flex lg:hidden items-center shrink-0">
                    <img src="{{ $logoSrc }}" alt="{{ $infos?->nama ?? 'Fastlog Era Mandiri' }}"
                        class="h-8 sm:h-10 w-auto object-contain">
                </a>

                {{-- LANGUAGE SWITCHER --}}
                {{-- Desktop: Di paling kiri | Mobile: Didorong ke kanan bersama hamburger --}}
                <div class="flex items-center space-x-2 lg:space-x-0 ml-auto lg:ml-0">
                    <div class="flex items-center bg-white/10 rounded-lg p-1 space-x-1">
                        <a href="?lang=id"
                            class="flex items-center space-x-1.5 px-2 py-1 rounded-md transition {{ app()->getLocale() === 'id' ? 'bg-white/20' : 'hover:bg-white/10' }}">
                            <svg class="w-4 h-4 rounded-sm shadow-sm" viewBox="0 0 32 32" fill="none">
                                <rect width="32" height="16" fill="#E70011" />
                                <rect y="16" width="32" height="16" fill="#FFFFFF" />
                            </svg>
                            <span class="text-xs font-medium">ID</span>
                        </a>
                        <a href="?lang=en"
                            class="flex items-center space-x-1.5 px-2 py-1 rounded-md transition {{ app()->getLocale() === 'en' ? 'bg-white/20' : 'hover:bg-white/10' }}">
                            <svg class="w-4 h-4 rounded-sm shadow-sm overflow-hidden" viewBox="0 0 60 30">
                                <clipPath id="s">
                                    <path d="M0,0 v30 h60 v-30 z" />
                                </clipPath>
                                <clipPath id="t">
                                    <path d="M30,15 m-30,0 l60,30 m0,-30 l-60,30 h60 v-30 z" />
                                </clipPath>
                                <g clip-path="url(#s)">
                                    <path d="M0,0 v30 h60 v-30 z" fill="#012169" />
                                    <path d="M0,0 l60,30 m0,-30 l-60,30" stroke="#fff" stroke-width="6" />
                                    <path d="M0,0 l60,30 m0,-30 l-60,30" clip-path="url(#t)" stroke="#C8102E"
                                        stroke-width="4" />
                                    <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10" />
                                    <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6" />
                                </g>
                            </svg>
                            <span class="text-xs font-medium">EN</span>
                        </a>
                    </div>

                    {{-- HAMBURGER BUTTON (Hanya Muncul di Mobile, Berada di sebelah kanan Language Switcher) --}}
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="lg:hidden text-white focus:outline-none p-1 ml-2">
                        <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- CONTACT INFO (Hanya Muncul di Desktop 'lg:') --}}
                <div class="hidden lg:flex items-center space-x-6 text-xs sm:text-sm">
                    <div class="flex items-center space-x-1.5">
                        <svg class="w-4 h-4 text-white shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5-2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                        <span>{{ $infos?->kota ?? 'Surabaya' }}, Indonesia</span>
                    </div>

                    @if($infos?->email)
                    <a href="mailto:{{ $infos->email }}"
                        class="flex items-center space-x-1.5 hover:text-[#FF7A3D] transition">
                        <svg class="w-4 h-4 text-white shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                        <span>{{ $infos->email }}</span>
                    </a>
                    @endif

                    @if($infos?->notelp)
                    <a href="tel:{{ $infos->notelp }}" class="flex items-center space-x-1.5 hover:text-[#FF7A3D] transition">
                        <svg class="w-4 h-4 text-white shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        </svg>
                        <span>{{ $infos->notelp }}</span>
                    </a>
                    @endif
                </div>

            </div>
        </div>

        {{-- 2. MAIN NAVBAR (Hanya Tampil di Desktop 'hidden lg:block') --}}
<div id="nav-body" class="bg-transparent text-white transition-all duration-300 hidden lg:block">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 sm:h-24">

            {{-- LOGO DESKTOP --}}
            <a href="{{ route('home') }}" class="flex items-center shrink-0">
                <img src="{{ $logoSrc }}" alt="{{ $infos?->nama ?? 'Fastlog Era Mandiri' }}"
                    class="h-10 sm:h-14 w-auto object-contain">
            </a>

            {{-- DESKTOP MENU + BUTTON --}}
            <div class="flex items-center gap-8">
                <nav class="flex items-center gap-7">
                    <a href="{{ route('home') }}"
                        class="text-[15px] font-medium transition duration-200 {{ request()->routeIs('home') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">{{ __('Home') }}</a>
                    <a href="{{ route('about') }}"
                        class="text-[15px] font-medium transition duration-200 {{ request()->routeIs('about*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">{{ __('About Us') }}</a>
                    <div class="relative group">
                        <a href="{{ route('services') }}"
                            class="text-[15px] font-medium transition duration-200 flex items-center gap-1 {{ request()->routeIs('services*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">
                            {{ __('Services') }}
                            <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-180"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                        <div
                            class="absolute left-0 top-full pt-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 w-64 z-50">
                            <div class="bg-[#052B35] rounded-xl shadow-xl border-t-2 border-[#FF7A3D] py-3">
                                <a href="{{ route('services.detail', 'custom-clearance') }}"
                                    class="block px-5 py-2.5 text-white/90 hover:text-[#FF7A3D] hover:bg-white/5 transition">{{ __('Custom Clearance') }}</a>
                                <a href="{{ route('services.detail', 'reefer-logistic') }}"
                                    class="block px-5 py-2.5 text-white/90 hover:text-[#FF7A3D] hover:bg-white/5 transition">{{ __('Reefer Logistic') }}</a>
                                <a href="{{ route('services.detail', 'freight-forwarding') }}"
                                    class="block px-5 py-2.5 text-white/90 hover:text-[#FF7A3D] hover:bg-white/5 transition">{{ __('Forwarding') }}</a>
                                <a href="{{ route('services.detail', 'inland-transport') }}"
                                    class="block px-5 py-2.5 text-white/90 hover:text-[#FF7A3D] hover:bg-white/5 transition">{{ __('Inland Transport') }}</a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('destination') }}"
                        class="text-[15px] font-medium transition duration-200 {{ request()->routeIs('destination*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">{{ __('Destination') }}</a>
                    <a href="{{ route('gallery') }}"
                        class="text-[15px] font-medium transition duration-200 {{ request()->routeIs('gallery*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">{{ __('Gallery') }}</a>
                    <a href="{{ route('berita') }}"
                        class="text-[15px] font-medium transition duration-200 {{ request()->routeIs('berita*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">{{ __('News') }}</a>
                    <a href="{{ route('career') }}"
                        class="text-[15px] font-medium transition duration-200 {{ request()->routeIs('career*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">{{ __('Career') }}</a>
                </nav>

                <a href="{{ route('contact') }}"
                    class="bg-[#FF7A3D] hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-semibold text-sm transition duration-300 shadow-md whitespace-nowrap">{{ __('Contact Us') }}</a>
            </div>

        </div>
    </div>
</div>



{{-- 3. MOBILE OFF-CANVAS DRAWER (GAMBAR 1 DESIGN) --}}
<div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 w-[80%] max-w-xs bg-[#052B35] z-50 overflow-y-auto flex flex-col justify-between shadow-2xl lg:hidden"
    x-cloak>

    <div class="p-6">
        {{-- Header Menu Drawer --}}
        <div class="flex items-center justify-between pb-6 border-b border-white/10 mb-6">
            <img src="{{ $logoSrc }}" alt="{{ $infos?->nama ?? 'Fastlog Era Mandiri' }}" class="h-10 w-auto">
            <button @click="mobileMenuOpen = false" class="text-white hover:text-[#FF7A3D]">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Nav Links --}}
        <nav class="flex flex-col space-y-4 font-semibold uppercase tracking-wider text-sm">
            <a href="{{ route('home') }}"
                class="py-2 border-b border-white/5 text-white hover:text-[#FF7A3D]">{{ __('Home') }}</a>
            <a href="{{ route('about') }}"
                class="py-2 border-b border-white/5 text-white hover:text-[#FF7A3D]">{{ __('About Us') }}</a>
            <a href="{{ route('services') }}"
                class="py-2 border-b border-white/5 text-white hover:text-[#FF7A3D]">{{ __('Services') }}</a>
            <a href="{{ route('destination') }}"
                class="py-2 border-b border-white/5 text-white hover:text-[#FF7A3D]">{{ __('Destination') }}</a>
            <a href="{{ route('gallery') }}"
                class="py-2 border-b border-white/5 text-white hover:text-[#FF7A3D]">{{ __('Gallery') }}</a>
            <a href="{{ route('berita') }}"
                class="py-2 border-b border-white/5 text-white hover:text-[#FF7A3D]">{{ __('News') }}</a>
            <a href="{{ route('career') }}"
                class="py-2 border-b border-white/5 text-white hover:text-[#FF7A3D]">{{ __('Career') }}</a>
        </nav>

        {{-- Button Contact Us --}}
        <div class="mt-8">
            <a href="{{ route('contact') }}"
                class="block w-full text-center bg-[#FF7A3D] hover:bg-orange-600 text-white font-bold py-3 rounded-lg transition uppercase text-xs tracking-wider shadow">
                {{ __('Contact Us') }}
            </a>
        </div>
    </div>

    {{-- Footer Kontak di bagian bawah Drawer --}}
    <div class="p-6 bg-black/20 text-xs text-white/80 space-y-3">
        <div class="flex items-center space-x-2">
            <svg class="w-4 h-4 text-[#FF7A3D]" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5-2.5-1.12 2.5-2.5 2.5z" />
            </svg>
            <span>{{ $infos?->kota ?? 'Surabaya' }}, Indonesia</span>
        </div>
        @if($infos?->email)
        <div class="flex items-center space-x-2">
            <svg class="w-4 h-4 text-[#FF7A3D]" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
            </svg>
            <span>{{ $infos->email }}</span>
        </div>
        @endif
        @if($infos?->notelp)
        <div class="flex items-center space-x-2">
            <svg class="w-4 h-4 text-[#FF7A3D]" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
            </svg>
            <span>{{ $infos->notelp }}</span>
        </div>
        @endif
    </div>

</div>

        {{-- Backdrop Hitam saat Drawer Buka --}}
        <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/60 z-40 lg:hidden" x-cloak></div>

    </header>

    {{-- 3. MOBILE MENU --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-[#052B35] border-t border-white/10">
        <div class="flex flex-col p-6 space-y-5">
            <a href="{{ route('home') }}" class="text-white hover:text-[#FF7A3D]">Home</a>
            <a href="{{ route('about') }}" class="nav-item-mobile text-white hover:text-[#FF7A3D]">Tentang Kami</a>
            <a href="{{ route('services') }}" class="nav-item-mobile text-white hover:text-[#FF7A3D]">Layanan</a>
            <a href="{{ route('destination') }}"
                class="nav-item-mobile text-white hover:text-[#FF7A3D]">Destinasi</a>
            <a href="{{ route('gallery') }}" class="nav-item-mobile text-white hover:text-[#FF7A3D]">Galeri</a>
            <a href="{{ route('berita') }}" class="nav-item-mobile text-white hover:text-[#FF7A3D]">Berita</a>
            <a href="{{ route('career') }}" class="nav-item-mobile text-white hover:text-[#FF7A3D]">Karir</a>
            <a href="{{ route('contact') }}"
                class="bg-[#FF7A3D] text-center py-3 rounded-xl text-white font-semibold">Contact Us</a>
        </div>
    </div>

    </header>

    @yield('content')

    <footer class="relative bg-[#052B35] pt-16 pb-8 overflow-hidden">

        {{-- World Map / Globe Background Decoration --}}
        <div class="absolute left-0 top-1/2 -translate-y-1/2 pointer-events-none opacity-10 z-0">
            <img src="{{ asset('images/front-end/globe.png') }}" alt=""
                class="w-[600px] max-w-none -translate-x-12 object-contain">
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">

                {{-- Logo & Desc --}}
                <div class="md:col-span-1">
                    <img src="{{ $logoSrc }}" alt="{{ $infos?->nama ?? 'Fastlog Era Mandiri' }}"
                        class="h-34 mb-5">

                    <div class="flex gap-3">
                        {{-- Facebook --}}
                        <a href="{{ $infos?->linkFacebook ?? '#' }}" target="_blank"
                            rel="noopener noreferrer"
                            class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#FF7A3D] transition"
                            aria-label="Facebook">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z" />
                            </svg>
                        </a>

                        {{-- Instagram --}}
                        <a href="{{ $infos?->linkInstagram ?? '#' }}" target="_blank"
                            rel="noopener noreferrer"
                            class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#FF7A3D] transition"
                            aria-label="Instagram">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>

                        {{-- X (Twitter) --}}
                        <a href="{{ $infos?->linkX ?? '#' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#FF7A3D] transition"
                            aria-label="X">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>

                        {{-- LinkedIn --}}
                        <a href="{{ $infos?->linkLinkedin ?? '#' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#FF7A3D] transition"
                            aria-label="LinkedIn">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14zM8.34 18v-8.4H5.67V18h2.67zM7 8.48a1.55 1.55 0 100-3.1 1.55 1.55 0 000 3.1zM18.34 18v-4.63c0-2.48-1.32-3.63-3.08-3.63-1.42 0-2.06.78-2.4 1.33V9.6H10.2c.03.7 0 8.4 0 8.4h2.66v-4.7c0-.25.02-.5.1-.68.2-.5.66-1.02 1.44-1.02.99 0 1.44.75 1.44 1.86V18h2.5z" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Support Links --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('about') }}"
                                class="text-white/60 hover:text-[#FF7A3D] transition">About Us</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-white/60 hover:text-[#FF7A3D] transition">Contact</a></li>
                        <li><a href="{{ route('gallery') }}"
                                class="text-white/60 hover:text-[#FF7A3D] transition">Gallery</a></li>
                        <li><a href="{{ route('berita') }}"
                                class="text-white/60 hover:text-[#FF7A3D] transition">News</a></li>
                    </ul>
                </div>

                {{-- Services Links --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Services</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('services.detail', 'custom-clearance') }}"
                                class="text-white/60 hover:text-[#FF7A3D] transition">Custom Clearance</a></li>
                        <li><a href="{{ route('services.detail', 'freight-forwarding') }}"
                                class="text-white/60 hover:text-[#FF7A3D] transition">Forwarding</a></li>
                        <li><a href="{{ route('services.detail', 'inland-transport') }}"
                                class="text-white/60 hover:text-[#FF7A3D] transition">Ekspedisi</a></li>
                        <li><a href="{{ route('services.detail', 'reefer-logistic') }}"
                                class="text-white/60 hover:text-[#FF7A3D] transition">Ekspor Impor</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact</h4>
                    <p class="text-white/60 text-sm mb-3 leading-relaxed">
                        {{ $infos?->alamatLengkap ?? 'Victoria Mainstreet Grand Pakuwon RA 08, Banjar Sugihan, Kec. Tandes, Kota SBY, Jawa Timur 60184' }}
                    </p>
                    @if($infos?->email)
                    <a href="mailto:{{ $infos->email }}"
                        class="block text-white/60 hover:text-[#FF7A3D] text-sm mb-1 transition">{{ $infos->email }}</a>
                    @endif
                    @if($infos?->notelp)
                    <a href="tel:{{ $infos->notelp }}" class="block text-white/60 hover:text-[#FF7A3D] text-sm transition">{{ $infos->notelp }}</a>
                    @endif
                </div>

            </div>

            <div class="border-t border-white/10 pt-6 text-center">
                <p class="text-white/40 text-sm">
                    Copyright © {{ date('Y') }} - {{ $infos?->nama ?? 'PT Fastlog Era Mandiri' }}. All Rights Reserved.
                </p>
            </div>

        </div>
    </footer>

    {{-- 4. JAVASCRIPT --}}

    {{-- Chart.js Library --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const topBar = document.getElementById('top-bar');
            const navBody = document.getElementById('nav-body');
            const menuButton = document.getElementById('menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            window.addEventListener('scroll', () => {
                if (window.scrollY > 40) {
                    topBar.classList.add('-mt-14', 'opacity-0');
                    navBody.classList.remove('bg-transparent');
                    navBody.classList.add('bg-[#052B35]', 'shadow-lg');
                } else {
                    topBar.classList.remove('-mt-14', 'opacity-0');
                    navBody.classList.add('bg-transparent');
                    navBody.classList.remove('bg-[#052B35]', 'shadow-lg');
                }
            });
        });
    </script>

</body>

</html>
