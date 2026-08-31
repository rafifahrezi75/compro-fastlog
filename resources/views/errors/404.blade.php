@extends('user.layouts.app')

{{-- SEO --}}
@section('meta_title', 'Halaman Tidak Ditemukan')
@section('meta_description', 'Halaman yang kamu cari tidak ditemukan. Kembali ke beranda Fastlog Era Mandiri.')
@section('meta_robots', 'noindex, nofollow')

@section('content')
    <main class="relative bg-[#052B35] pt-28 pb-16 md:pt-36 md:pb-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mx-auto max-w-[560px] text-center">
                {{-- Ilustrasi 404 Modern & Responsif (Fastlog Logistics Themed) --}}
                <div class="mx-auto w-full max-w-[320px] sm:max-w-[420px] md:max-w-[480px] transition-all duration-300">
                    <svg class="w-full h-auto drop-shadow-2xl select-none" viewBox="0 0 600 340" fill="none"
                        xmlns="http://www.w3.org/2000/svg" aria-label="404 Page Not Found Illustration">
                        <defs>
                            {{-- Gradients --}}
                            <linearGradient id="numGradLeft" x1="70" y1="70" x2="195" y2="260" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFA366" />
                                <stop offset="45%" stop-color="#FF7A3D" />
                                <stop offset="100%" stop-color="#E04F16" />
                            </linearGradient>

                            <linearGradient id="numGradRight" x1="405" y1="70" x2="530" y2="260" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFA366" />
                                <stop offset="45%" stop-color="#FF7A3D" />
                                <stop offset="100%" stop-color="#E04F16" />
                            </linearGradient>

                            <linearGradient id="numDepthGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#C24714" />
                                <stop offset="100%" stop-color="#802604" />
                            </linearGradient>

                            {{-- Parcel / Box Gradients --}}
                            <linearGradient id="boxTopGrad" x1="235" y1="125" x2="365" y2="185" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#FFC594" />
                                <stop offset="100%" stop-color="#FFA66A" />
                            </linearGradient>

                            <linearGradient id="boxLeftGrad" x1="235" y1="160" x2="300" y2="260" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#F78A4D" />
                                <stop offset="100%" stop-color="#D9581A" />
                            </linearGradient>

                            <linearGradient id="boxRightGrad" x1="300" y1="160" x2="365" y2="260" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#D14E15" />
                                <stop offset="100%" stop-color="#9C3408" />
                            </linearGradient>

                            <linearGradient id="tapeGradTop" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#FFF5EA" stop-opacity="0.95" />
                                <stop offset="100%" stop-color="#FCD5B5" stop-opacity="0.85" />
                            </linearGradient>

                            <linearGradient id="pinGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#FF5252" />
                                <stop offset="50%" stop-color="#E52B2B" />
                                <stop offset="100%" stop-color="#9E0C0C" />
                            </linearGradient>

                            <linearGradient id="routeGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#00F0FF" stop-opacity="0.1" />
                                <stop offset="30%" stop-color="#00F0FF" stop-opacity="0.8" />
                                <stop offset="70%" stop-color="#FF7A3D" stop-opacity="0.9" />
                                <stop offset="100%" stop-color="#FF7A3D" stop-opacity="0.2" />
                            </linearGradient>

                            {{-- Radial Glows --}}
                            <radialGradient id="groundGlow" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#FF7A3D" stop-opacity="0.3" />
                                <stop offset="50%" stop-color="#FF7A3D" stop-opacity="0.08" />
                                <stop offset="100%" stop-color="#052B35" stop-opacity="0" />
                            </radialGradient>

                            <radialGradient id="radarPulseGlow" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#00F0FF" stop-opacity="0.5" />
                                <stop offset="60%" stop-color="#00F0FF" stop-opacity="0.15" />
                                <stop offset="100%" stop-color="#00F0FF" stop-opacity="0" />
                            </radialGradient>

                            <radialGradient id="beaconLight" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#FFF" stop-opacity="1" />
                                <stop offset="30%" stop-color="#00F0FF" stop-opacity="0.8" />
                                <stop offset="100%" stop-color="#00F0FF" stop-opacity="0" />
                            </radialGradient>

                            {{-- Filters --}}
                            <filter id="softGlow" x="-20%" y="-20%" width="140%" height="140%">
                                <feGaussianBlur stdDeviation="8" result="blur" />
                                <feMerge>
                                    <feMergeNode in="blur" />
                                    <feMergeNode in="SourceGraphic" />
                                </feMerge>
                            </filter>

                            <filter id="pinShadow" x="-30%" y="-20%" width="160%" height="160%">
                                <feDropShadow dx="0" dy="6" stdDeviation="6" flood-color="#000000" flood-opacity="0.45" />
                            </filter>
                        </defs>

                        {{-- Internal Styles for Micro-Animations --}}
                        <style>
                            @keyframes fastlogFloat {
                                0%, 100% { transform: translateY(0px); }
                                50% { transform: translateY(-10px); }
                            }
                            @keyframes fastlogFloatAlt {
                                0%, 100% { transform: translateY(0px) rotate(0deg); }
                                50% { transform: translateY(-7px) rotate(3deg); }
                            }
                            @keyframes radarWave {
                                0% { r: 12px; opacity: 0.8; stroke-width: 2px; }
                                70% { opacity: 0.3; }
                                100% { r: 60px; opacity: 0; stroke-width: 0.5px; }
                            }
                            @keyframes dashAnimation {
                                to { stroke-dashoffset: -100; }
                            }
                            @keyframes twinkleSparkle {
                                0%, 100% { opacity: 0.2; transform: scale(0.8); }
                                50% { opacity: 1; transform: scale(1.2); }
                            }
                            @keyframes beaconBlink {
                                0%, 100% { opacity: 0.4; }
                                50% { opacity: 1; }
                            }
                            .anim-box-float {
                                animation: fastlogFloat 4s ease-in-out infinite;
                            }
                            .anim-drone-float {
                                animation: fastlogFloatAlt 3.5s ease-in-out infinite 1s;
                            }
                            .anim-radar-1 {
                                animation: radarWave 3s cubic-bezier(0.2, 0.6, 0.3, 1) infinite;
                                transform-origin: 300px 180px;
                            }
                            .anim-radar-2 {
                                animation: radarWave 3s cubic-bezier(0.2, 0.6, 0.3, 1) infinite 1.5s;
                                transform-origin: 300px 180px;
                            }
                            .anim-route-dash {
                                stroke-dasharray: 6 6;
                                animation: dashAnimation 12s linear infinite;
                            }
                            .anim-twinkle-1 {
                                animation: twinkleSparkle 2.5s ease-in-out infinite;
                                transform-origin: center;
                            }
                            .anim-twinkle-2 {
                                animation: twinkleSparkle 3.2s ease-in-out infinite 1.2s;
                                transform-origin: center;
                            }
                            .anim-beacon {
                                animation: beaconBlink 2s ease-in-out infinite;
                            }
                        </style>

                        {{-- 1. Ambient Background Grid & Platform Glow --}}
                        <ellipse cx="300" cy="285" rx="220" ry="38" fill="url(#groundGlow)" />
                        <ellipse cx="300" cy="285" rx="140" ry="24" fill="#000000" opacity="0.3" />

                        {{-- Subtle background logistics grid --}}
                        <g opacity="0.12" stroke="#00F0FF" stroke-width="1">
                            <line x1="120" y1="285" x2="480" y2="285" stroke-dasharray="4 4" />
                            <line x1="180" y1="265" x2="420" y2="265" stroke-dasharray="3 3" />
                            <line x1="220" y1="305" x2="380" y2="305" stroke-dasharray="3 3" />
                        </g>

                        {{-- 2. Dotted Transit / Flight Route Curve --}}
                        <path d="M 60 210 C 130 130, 180 270, 300 190 C 420 110, 470 250, 540 150"
                            fill="none" stroke="url(#routeGrad)" stroke-width="2.5" stroke-linecap="round"
                            class="anim-route-dash" />

                        {{-- Route Waypoint Nodes --}}
                        <g opacity="0.8">
                            <circle cx="85" cy="180" r="4" fill="#00F0FF" />
                            <circle cx="85" cy="180" r="8" fill="none" stroke="#00F0FF" stroke-width="1" opacity="0.5" />
                            
                            <circle cx="515" cy="165" r="4" fill="#FF7A3D" />
                            <circle cx="515" cy="165" r="8" fill="none" stroke="#FF7A3D" stroke-width="1" opacity="0.5" />
                        </g>

                        {{-- 3. Left Number 4 (Modern 3D Isometric Style) --}}
                        <g>
                            {{-- 3D Depth Extrusion (Shadow Side) --}}
                            <path d="M 72 225 L 82 235 L 142 235 L 142 265 L 177 265 L 177 235 L 197 235 L 197 200 L 177 200 L 177 85 L 132 85 L 72 195 Z"
                                fill="url(#numDepthGrad)" opacity="0.8" />
                            
                            {{-- Front Face --}}
                            <path d="M 65 220 L 135 220 L 135 255 L 170 255 L 170 220 L 190 220 L 190 185 L 170 185 L 170 75 L 125 75 L 65 185 Z
                                     M 135 185 L 98 185 L 135 125 Z"
                                fill="url(#numGradLeft)" fill-rule="evenodd" filter="url(#softGlow)" />

                            {{-- Crisp Specular Highlight Edges --}}
                            <path d="M 65 185 L 125 75 L 170 75" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" stroke-linecap="round" />
                            <path d="M 65 220 L 135 220 L 135 255" fill="none" stroke="rgba(255,255,255,0.25)" stroke-width="1.5" />
                        </g>

                        {{-- 4. Right Number 4 (Modern 3D Isometric Style) --}}
                        <g>
                            {{-- 3D Depth Extrusion (Shadow Side) --}}
                            <path d="M 412 225 L 422 235 L 482 235 L 482 265 L 517 265 L 517 235 L 537 235 L 537 200 L 517 200 L 517 85 L 472 85 L 412 195 Z"
                                fill="url(#numDepthGrad)" opacity="0.8" />

                            {{-- Front Face --}}
                            <path d="M 405 220 L 475 220 L 475 255 L 510 255 L 510 220 L 530 220 L 530 185 L 510 185 L 510 75 L 465 75 L 405 185 Z
                                     M 475 185 L 438 185 L 475 125 Z"
                                fill="url(#numGradRight)" fill-rule="evenodd" filter="url(#softGlow)" />

                            {{-- Crisp Specular Highlight Edges --}}
                            <path d="M 405 185 L 465 75 L 510 75" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" stroke-linecap="round" />
                            <path d="M 405 220 L 475 220 L 475 255" fill="none" stroke="rgba(255,255,255,0.25)" stroke-width="1.5" />
                        </g>

                        {{-- 5. Center Element: Floating Fastlog Cargo Box / Lost Parcel (Replacing 0) --}}
                        <g class="anim-box-float">
                            {{-- Radar wave expanding from the lost package --}}
                            <circle cx="300" cy="180" r="20" fill="none" stroke="#00F0FF" class="anim-radar-1" />
                            <circle cx="300" cy="180" r="20" fill="none" stroke="#00F0FF" class="anim-radar-2" />

                            {{-- Shadow under floating box --}}
                            <ellipse cx="300" cy="275" rx="55" ry="14" fill="#000000" opacity="0.35" />

                            {{-- 3D Isometric Box --}}
                            <g filter="url(#softGlow)">
                                {{-- Box Left Face --}}
                                <path d="M 230 170 L 300 210 L 300 282 L 230 242 Z" fill="url(#boxLeftGrad)" />
                                
                                {{-- Box Right Face --}}
                                <path d="M 300 210 L 370 170 L 370 242 L 300 282 Z" fill="url(#boxRightGrad)" />

                                {{-- Box Top Face --}}
                                <path d="M 300 130 L 370 170 L 300 210 L 230 170 Z" fill="url(#boxTopGrad)" />

                                {{-- Packaging Tape (Top) --}}
                                <path d="M 288 137 L 312 151 L 312 196 L 288 182 Z" fill="url(#tapeGradTop)" opacity="0.9" />
                                {{-- Packaging Tape (Left Side) --}}
                                <path d="M 288 182 L 300 189 L 300 282 L 288 275 Z" fill="#E6C4A2" opacity="0.85" />
                                {{-- Packaging Tape (Right Side) --}}
                                <path d="M 300 189 L 312 182 L 312 275 L 300 282 Z" fill="#C99E75" opacity="0.85" />

                                {{-- Top Face Corner Highlights --}}
                                <path d="M 300 130 L 370 170" stroke="rgba(255,255,255,0.6)" stroke-width="1.5" />
                                <path d="M 300 130 L 230 170" stroke="rgba(255,255,255,0.4)" stroke-width="1.5" />
                                <line x1="300" y1="210" x2="300" y2="282" stroke="rgba(255,255,255,0.2)" stroke-width="1" />

                                {{-- Fastlog Shipping Label on Left Face --}}
                                <g transform="matrix(0.866 0.5 0 1 242 195)" opacity="0.9">
                                    <rect x="0" y="0" width="32" height="22" rx="2" fill="#FFFFFF" />
                                    {{-- Barcode lines --}}
                                    <rect x="3" y="3" width="26" height="7" fill="#1E293B" opacity="0.15" />
                                    <line x1="5" y1="4" x2="5" y2="9" stroke="#052B35" stroke-width="1.5" />
                                    <line x1="8" y1="4" x2="8" y2="9" stroke="#052B35" stroke-width="1" />
                                    <line x1="11" y1="4" x2="11" y2="9" stroke="#052B35" stroke-width="2" />
                                    <line x1="15" y1="4" x2="15" y2="9" stroke="#052B35" stroke-width="1" />
                                    <line x1="18" y1="4" x2="18" y2="9" stroke="#052B35" stroke-width="1.5" />
                                    <line x1="22" y1="4" x2="22" y2="9" stroke="#052B35" stroke-width="2" />
                                    <line x1="26" y1="4" x2="26" y2="9" stroke="#052B35" stroke-width="1" />
                                    {{-- Tracking Text --}}
                                    <text x="3" y="15" font-size="4" font-weight="bold" fill="#FF7A3D" font-family="sans-serif">FASTLOG</text>
                                    <text x="3" y="19" font-size="3" font-weight="bold" fill="#64748B" font-family="sans-serif">ERR-404</text>
                                </g>

                                {{-- Fragile / Handling Icons on Right Face --}}
                                <g transform="matrix(0.866 -0.5 0 1 315 235)" opacity="0.65">
                                    {{-- Up Arrows --}}
                                    <path d="M 6 14 L 6 6 M 6 6 L 3 9 M 6 6 L 9 9" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M 14 14 L 14 6 M 14 6 L 11 9 M 14 6 L 17 9" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                            </g>

                            {{-- 3D GPS Lost Location Pin Floating Above Box --}}
                            <g transform="translate(300, 100)" filter="url(#pinShadow)">
                                {{-- Glowing halo under pin --}}
                                <ellipse cx="0" cy="18" rx="14" ry="5" fill="#00F0FF" opacity="0.6" class="anim-beacon" />
                                
                                {{-- Pin Body --}}
                                <path d="M 0 16 C -12 2, -14 -10, -14 -18 C -14 -26, -7.7 -32, 0 -32 C 7.7 -32, 14 -26, 14 -18 C 14 -10, 12 2, 0 16 Z"
                                    fill="url(#pinGrad)" />
                                
                                {{-- Inner White Circle --}}
                                <circle cx="0" cy="-18" r="7.5" fill="#FFFFFF" />
                                
                                {{-- Question Mark Symbol (?) --}}
                                <path d="M -2.5 -21 C -2.5 -23.5 -0.5 -24.5 0.5 -24.5 C 2 -24.5 3.5 -23.5 3.5 -22 C 3.5 -20.5 2 -19.8 0.5 -18.8 C -0.2 -18.2 -0.2 -17.5 -0.2 -16.5
                                         M 0 -14.2 L 0 -13.5"
                                    fill="none" stroke="#FF7A3D" stroke-width="1.8" stroke-linecap="round" />

                                {{-- Pin Highlight --}}
                                <path d="M -10 -20 C -10 -26, -4 -30, 0 -30" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="1.5" stroke-linecap="round" />
                            </g>
                        </g>

                        {{-- 6. Floating Mini Drone / Speed Parcel --}}
                        <g class="anim-drone-float">
                            {{-- Mini delivery drone / satellite helper at upper right --}}
                            <g transform="translate(460, 50)">
                                {{-- Drone Body --}}
                                <rect x="-14" y="-8" width="28" height="16" rx="6" fill="#0D4E5F" stroke="#00F0FF" stroke-width="1.5" />
                                {{-- Drone Camera / Beacon Light --}}
                                <circle cx="0" cy="0" r="3.5" fill="#00F0FF" class="anim-beacon" />
                                <circle cx="0" cy="0" r="8" fill="url(#beaconLight)" />
                                
                                {{-- Rotor Arms --}}
                                <line x1="-14" y1="-4" x2="-22" y2="-10" stroke="#00F0FF" stroke-width="1.5" stroke-linecap="round" />
                                <line x1="14" y1="-4" x2="22" y2="-10" stroke="#00F0FF" stroke-width="1.5" stroke-linecap="round" />
                                
                                {{-- Rotor Blades --}}
                                <ellipse cx="-22" cy="-10" rx="8" ry="2" fill="#00F0FF" opacity="0.7" />
                                <ellipse cx="22" cy="-10" rx="8" ry="2" fill="#00F0FF" opacity="0.7" />
                                
                                {{-- Mini Suspended Parcel --}}
                                <line x1="-4" y1="8" x2="-6" y2="15" stroke="rgba(255,255,255,0.4)" stroke-width="1" />
                                <line x1="4" y1="8" x2="6" y2="15" stroke="rgba(255,255,255,0.4)" stroke-width="1" />
                                <rect x="-7" y="15" width="14" height="10" rx="1.5" fill="#FF7A3D" />
                                <line x1="0" y1="15" x2="0" y2="25" stroke="#FFFFFF" stroke-width="1" opacity="0.6" />
                            </g>
                        </g>

                        {{-- 7. Sparkling Stars & High-Tech Particles --}}
                        {{-- Star 1 (Top Left) --}}
                        <g transform="translate(110, 45)" class="anim-twinkle-1">
                            <path d="M 0 -8 Q 0 0 -8 0 Q 0 0 0 8 Q 0 0 8 0 Q 0 0 0 -8 Z" fill="#FFA366" />
                            <circle cx="0" cy="0" r="2" fill="#FFF" />
                        </g>
                        
                        {{-- Star 2 (Middle Right) --}}
                        <g transform="translate(375, 75)" class="anim-twinkle-2">
                            <path d="M 0 -6 Q 0 0 -6 0 Q 0 0 0 6 Q 0 0 6 0 Q 0 0 0 -6 Z" fill="#00F0FF" />
                            <circle cx="0" cy="0" r="1.5" fill="#FFF" />
                        </g>

                        {{-- Star 3 (Bottom Left) --}}
                        <g transform="translate(190, 290)" class="anim-twinkle-1">
                            <path d="M 0 -5 Q 0 0 -5 0 Q 0 0 0 5 Q 0 0 5 0 Q 0 0 0 -5 Z" fill="#FF7A3D" opacity="0.8" />
                        </g>

                        {{-- Small floating particle dots --}}
                        <circle cx="215" cy="95" r="2" fill="#00F0FF" opacity="0.6" class="anim-beacon" />
                        <circle cx="395" cy="270" r="2" fill="#FFA366" opacity="0.5" class="anim-twinkle-2" />
                        <circle cx="530" cy="225" r="1.5" fill="#00F0FF" opacity="0.4" />
                    </svg>
                </div>

                {{-- Judul (Oranye Utama) --}}
                <h1 class="mt-8 text-3xl font-bold tracking-tight text-[#FF7A3D] sm:text-4xl">
                    Halaman Tidak Ditemukan
                </h1>

                {{-- Deskripsi (Abu-abu Slate agar tidak sakit mata) --}}
                <p class="mt-4 text-base leading-relaxed text-white sm:text-lg">
                    Maaf, halaman yang kamu cari tidak tersedia atau telah dipindahkan.
                </p>

                {{-- Tombol --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                    {{-- Tombol Kembali --}}
                    <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('home') }}"
                        onclick="if (history.length > 1) { history.back(); return false; }"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-orange-200 bg-orange-50/60 px-6 py-3.5 text-sm font-semibold text-[#FF7A3D] shadow-sm transition hover:bg-orange-100 hover:border-orange-300 sm:w-auto">
                        <svg class="h-4 w-4 stroke-[#FF7A3D]" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>

                    {{-- Tombol Beranda --}}
                    <a href="{{ route('home') }}"
                        class="inline-flex w-full items-center justify-center rounded-xl bg-[#FF7A3D] px-6 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-600 sm:w-auto">
                        Kembali ke Beranda
                    </a>
                </div>

                {{-- Link Bantuan --}}
                <p class="mt-6 text-sm text-white">
                    Butuh bantuan? <a href="{{ route('contact') }}"
                        class="font-semibold text-[#FF7A3D] hover:text-orange-600 hover:underline">Hubungi Kami</a>
                </p>
            </div>
        </div>
    </main>
@endsection
