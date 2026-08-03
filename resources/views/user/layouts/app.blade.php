<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Fastlog Era Mandiri')</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

  <header id="main-header" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">

    {{-- 1. TOP BAR INFO --}}
<div id="top-bar" class="bg-[#052B35] text-white text-xs sm:text-sm py-2.5 transition-all duration-300 overflow-hidden">
      <div class="max-w-7xl mx-auto px-6 lg:px-8 flex items-center justify-between">

        {{-- Language Switcher (Left) --}}
        <div class="flex items-center bg-white/10 rounded-lg p-1 space-x-1">
          <a href="?lang=id"
            class="flex items-center space-x-1.5 px-2.5 py-1 rounded-md transition {{ app()->getLocale() === 'id' ? 'bg-white/20' : 'hover:bg-white/10' }}">
            <svg class="w-4 h-4 rounded-sm shadow-sm" viewBox="0 0 32 32" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <rect width="32" height="16" fill="#E70011" />
              <rect y="16" width="32" height="16" fill="#FFFFFF" />
            </svg>
            <span class="text-xs font-medium">ID</span>
          </a>
          <a href="?lang=en"
            class="flex items-center space-x-1.5 px-2.5 py-1 rounded-md transition {{ app()->getLocale() === 'en' ? 'bg-white/20' : 'hover:bg-white/10' }}">
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
                <path d="M0,0 l60,30 m0,-30 l-60,30" clip-path="url(#t)" stroke="#C8102E" stroke-width="4" />
                <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10" />
                <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6" />
              </g>
            </svg>
            <span class="text-xs font-medium">EN</span>
          </a>
        </div>

        {{-- Contact & Location Info (Right) --}}
        <div class="flex items-center space-x-6 text-xs sm:text-sm">
          <div class="flex items-center space-x-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white shrink-0" fill="currentColor"
              viewBox="0 0 24 24">
              <path
                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
            </svg>
            <span>Surabaya, Indonesia</span>
          </div>

          <a href="mailto:admin@fastlogem.co.id"
            class="hidden sm:flex items-center space-x-1.5 hover:text-[#FF7A3D] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white shrink-0" fill="currentColor"
              viewBox="0 0 24 24">
              <path
                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
            </svg>
            <span>admin@fastlogem.co.id</span>
          </a>

          <a href="tel:+623199343392" class="flex items-center space-x-1.5 hover:text-[#FF7A3D] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white shrink-0" fill="currentColor"
              viewBox="0 0 24 24">
              <path
                d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
            </svg>
            <span>+62 31 9934 3392</span>
          </a>
        </div>

      </div>
    </div>


<div id="nav-body" class="bg-transparent text-white transition-all duration-300">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="flex items-center justify-between h-24">

      <a href="{{ route('home') }}" class="flex items-center">
        <img src="{{ asset('images/front-end/logo2.png') }}" alt="Fastlog Era Mandiri"
          class="h-14 w-auto object-contain">
      </a>

      {{-- Nav + Button digabung jadi 1 grup di kanan --}}
      <div class="hidden lg:flex items-center gap-8">
        <nav class="flex items-center gap-7">
          <a href="{{ route('home') }}"
            class="text-white text-[15px] font-medium hover:text-[#FF7A3D] transition duration-200">Home</a>
          <a href="{{ route('about') }}"
    class="text-[15px] font-medium transition duration-200 {{ request()->routeIs('about*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">Tentang Kami</a>

          {{-- Dropdown Layanan --}}
      <div class="relative group">
          <a href="{{ route('services') }}"
              class="text-[15px] font-medium transition duration-200 flex items-center gap-1 {{ request()->routeIs('services*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">
              Layanan
              <svg class="w-3.5 h-3.5 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
          </a>
          <div class="absolute left-0 top-full pt-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 w-64">
              <div class="bg-[#052B35] rounded-xl shadow-xl border-t-2 border-[#FF7A3D] py-3">
                  <a href="{{ route('services.detail', 'custom-clearance') }}" class="block px-5 py-2.5 text-white/90 hover:text-[#FF7A3D] hover:bg-white/5 transition">Custom Clearance</a>
                  <a href="{{ route('services.detail', 'reefer-logistic') }}" class="block px-5 py-2.5 text-white/90 hover:text-[#FF7A3D] hover:bg-white/5 transition">Reefer Logistic</a>
                  <a href="{{ route('services.detail', 'freight-forwarding') }}" class="block px-5 py-2.5 text-white/90 hover:text-[#FF7A3D] hover:bg-white/5 transition">Freight Forwarding</a>
                  <a href="{{ route('services.detail', 'inland-transport') }}" class="block px-5 py-2.5 text-white/90 hover:text-[#FF7A3D] hover:bg-white/5 transition">Inland Transport</a>
              </div>
          </div>
      </div>

          <a href="{{ route('destination') }}"
          class="text-[15px] font-medium transition duration-200 {{ request()->routeIs('destination*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">Destinasi</a>
          <a href="{{ route('gallery') }}"
            class="text-[15px] font-medium transition duration-200 {{ request()->routeIs('gallery*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">Galeri</a>

          <a href="{{ route('berita') }}"
            class="text-[15px] font-medium transition duration-200 {{ request()->routeIs('berita*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">
            Berita
          </a>

          <a href="{{ route('career') }}"
            class="text-[15px] font-medium transition duration-200 {{ request()->routeIs('career*') ? 'text-[#FF7A3D]' : 'text-white hover:text-[#FF7A3D]' }}">Karir</a>
        </nav>

        <a href="#contact"
          class="bg-[#FF7A3D] hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-semibold text-sm transition duration-300 shadow-md whitespace-nowrap">
          Contact Us
        </a>
      </div>

      <button id="menu-button" class="lg:hidden text-white focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

    </div>
  </div>
</div>
    {{-- 3. MOBILE MENU --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-[#052B35] border-t border-white/10">
      <div class="flex flex-col p-6 space-y-5">
    <a href="{{ route('home') }}" class="text-white hover:text-[#FF7A3D]">Home</a>
    <a href="{{ route('about') }}" class="text-white hover:text-[#FF7A3D]">Tentang Kami</a>
    <a href="{{ route('services') }}" class="text-white hover:text-[#FF7A3D]">Layanan</a>
    <a href="{{ route('destination') }}" class="text-white hover:text-[#FF7A3D]">Destinasi</a>
    <a href="{{ route('gallery') }}" class="text-white hover:text-[#FF7A3D]">Galeri</a>
    <a href="{{ route('berita') }}" class="text-white hover:text-[#FF7A3D]">Berita</a>
    <a href="{{ route('career') }}" class="text-white hover:text-[#FF7A3D]">Karir</a>
    <a href="#contact" class="bg-[#FF7A3D] text-center py-3 rounded-xl text-white font-semibold">Contact Us</a>
</div>
    </div>

  </header>

  @yield('content')

  <footer class="bg-[#052B35] pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

      <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">

        {{-- Logo & Desc --}}
        <div class="md:col-span-1">
          <img src="{{ asset('images/front-end/logo2.png') }}" alt="Fastlog Era Mandiri" class="h-14 mb-4">
          <p class="text-white/60 text-sm mb-5">
            World Leading Contract Logistics Provider
          </p>
          <div class="flex gap-3">
            <a href="#"
              class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#FF7A3D] transition">
              <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z" />
              </svg>
            </a>
            <a href="#"
              class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#FF7A3D] transition">
              <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 2c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm5 6.5c0 .28-.22.5-.5.5h-1.75c-.83 0-1.25.42-1.25 1.25v1.25h2.75l-.4 2.75h-2.35v7h-2.75v-7h-1.75v-2.75h1.75V9.5c0-1.93 1.32-3.5 3.5-3.5h1.75c.28 0 .5.22.5.5v1.5z" />
              </svg>
            </a>
            <a href="#"
              class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#FF7A3D] transition">
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
            <li><a href="#about" class="text-white/60 hover:text-[#FF7A3D] transition">About Us</a></li>
            <li><a href="#contact" class="text-white/60 hover:text-[#FF7A3D] transition">Contact</a></li>
            <li><a href="#gallery" class="text-white/60 hover:text-[#FF7A3D] transition">Gallery</a></li>
            <li><a href="#news" class="text-white/60 hover:text-[#FF7A3D] transition">News</a></li>
          </ul>
        </div>

        {{-- Services Links --}}
        <div>
          <h4 class="text-white font-semibold mb-4">Services</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="#services" class="text-white/60 hover:text-[#FF7A3D] transition">Custom Clearance</a></li>
            <li><a href="#services" class="text-white/60 hover:text-[#FF7A3D] transition">Forwarding</a></li>
            <li><a href="#services" class="text-white/60 hover:text-[#FF7A3D] transition">Ekspedisi</a></li>
            <li><a href="#services" class="text-white/60 hover:text-[#FF7A3D] transition">Ekspor Impor</a></li>
          </ul>
        </div>

        {{-- Contact --}}
        <div>
          <h4 class="text-white font-semibold mb-4">Contact</h4>
          <p class="text-white/60 text-sm mb-3 leading-relaxed">
            Victoria Mainstreet Grand Pakuwon RA 08, Banjar Sugihan, Kec. Tandes, Kota SBY, Jawa Timur 60184
          </p>
          <a href="mailto:admin@fastlogem.co.id"
            class="block text-white/60 hover:text-[#FF7A3D] text-sm mb-1 transition">admin@fastlogem.co.id</a>
          <a href="tel:0319934392" class="block text-white/60 hover:text-[#FF7A3D] text-sm transition">031 9934
            3392</a>
        </div>

      </div>

      <div class="border-t border-white/10 pt-6 text-center">
        <p class="text-white/40 text-sm">
          Copyright © {{ date('Y') }} - PT Fastlog Era Mandiri. All Rights Reserved.
        </p>
      </div>

    </div>
  </footer>

</body>


{{-- 4. JAVASCRIPT --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const topBar = document.getElementById('top-bar');
    const navBody = document.getElementById('nav-body');
    const menuButton = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const navItems = document.querySelectorAll('.nav-item, .nav-item-mobile');

    navItems.forEach(item => {
      item.addEventListener('click', function() {
        navItems.forEach(link => {
          link.classList.remove('text-[#FF7A3D]');
          link.classList.add('text-white');
        });
        this.classList.remove('text-white');
        this.classList.add('text-[#FF7A3D]');
      });
    });

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
