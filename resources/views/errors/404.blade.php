@extends('user.layouts.app')

{{-- SEO --}}
@section('meta_title', 'Halaman Tidak Ditemukan')
@section('meta_description', 'Halaman yang kamu cari tidak ditemukan. Kembali ke beranda Fastlog Era Mandiri.')
@section('meta_robots', 'noindex, nofollow')

@section('content')
    <main class="relative bg-[#052B35] pt-28 pb-16 md:pt-36 md:pb-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mx-auto max-w-[560px] text-center">
                {{-- Ilustrasi 404 (SVG Inline Oranye) --}}
                <div class="mx-auto w-full max-w-[280px] sm:max-w-[320px]">
                    <svg class="w-full h-auto text-[#FF7A3D]" viewBox="50 0 400 200" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        {{-- Angka 4 Pertama --}}
                        <path d="M60 40V120H110V160H140V120H160V90H140V40H60ZM90 90V70H110V90H90Z" fill="currentColor" />
                        {{-- Wajah Sedih / Angka 0 --}}
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M180 40H280V160H180V40ZM210 70H260V130H210V70ZM220 85H230V95H220V85ZM240 85H250V95H240V85ZM220 115H250V105H220V115Z"
                            fill="currentColor" />
                        {{-- Angka 4 Kedua --}}
                        <path d="M300 40V120H350V160H380V120H400V90H380V40H300ZM330 90V70H350V90H330Z"
                            fill="currentColor" />
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
