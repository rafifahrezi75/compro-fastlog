@extends('user.layouts.app')

@section('content')

{{-- ============ HERO HEADER BANNER ============ --}}
<section class="relative h-[250px] md:h-[300px] flex items-center justify-center pt-20">
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-cargo.jpg') }}" alt="Berita" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-[#052B35]/70"></div>
    </div>

    <div class="relative z-10 text-center text-white px-4 mt-8">
        <h1 class="text-3xl md:text-5xl font-bold mb-3">Berita</h1>
        <div class="flex items-center justify-center gap-2 text-sm md:text-base text-gray-200">
            <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">Home</a>
            <span>/</span>
            <a href="{{ route('berita') }}" class="hover:text-[#FF7A3D] transition">Berita</a>
            <span>/</span>
            <span class="text-white font-medium truncate max-w-xs">{{ $title }}</span>
        </div>
    </div>
</section>

{{-- ============ MAIN CONTENT DETAIL ============ --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            
            {{-- KONTEN UTAMA ARTIKEL (KIRI) --}}
            <div class="lg:col-span-3 space-y-6">
                
                {{-- Gambar Utama Artikel --}}
                <div class="rounded-2xl overflow-hidden shadow-sm">
                    <img src="{{ asset('images/' . $image) }}" alt="{{ $title }}" class="w-full h-auto max-h-[450px] object-cover">
                </div>

                {{-- Judul & Tanggal --}}
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-[#052B35] leading-tight mb-3">
                        {{ $title }}
                    </h1>
                    <div class="flex items-center gap-2 text-sm text-[#FF7A3D] font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>{{ $date }}</span>
                    </div>
                </div>

                {{-- Isi Artikel / Paragraf --}}
                <div class="text-gray-600 space-y-4 leading-relaxed text-sm md:text-base">
                    <p>
                        Pemerintah bakal mengoptimalkan pengoperasian Inaportnet di pelabuhan. Penerapan layanan digital menuai apresiasi dari berbagai kalangan. Pengamat dan pengguna jasa mendorong pengembangan national logistics ecosystem (NLE) untuk mengurangi biaya logistik hingga 50 persen.
                    </p>
                    <p>
                        Berdasar informasi, rencananya ada 25 pelabuhan yang menerapkan Inaportnet tahun ini. Pelabuhan Tanjung Perak sudah memanfaatkannya. Aplikasi diterapkan seiring dengan merebaknya pandemi Covid-19.
                    </p>
                    <p>
                        Pengamat maritim dari ITS Raja Oloan Saut Gurning menyatakan, penerapan Inaportnet di Pelabuhan Tanjung Perak sudah berjalan baik. Namun, dia mengingatkan pentingnya dukungan fasilitas internet. "Ada pengguna jasa yang melapor sulit meng-upload dokumen karena server down. Ini menjadi perhatian bersama," kata Saut.
                    </p>
                    <p>
                        Dia tutur menjelaskan, layanan perlu dievaluasi secara terus-menerus. Setidaknya terkait dengan hambatan pengoperasian. Operator juga perlu mengembangkan layanan untuk mendorong percepatan bongkar muat.
                    </p>
                    <p>
                        Menurut Saut, Inaportnet bukan satu-satunya platform digital yang diterapkan di pelabuhan. Ada banyak aplikasi lain. Operatornya juga berasal dari instansi berbeda-beda.
                    </p>
                    <p>
                        Saut menyampaikan, NLE menjadi pemersatu layanan. Seluruh platform yang jumlahnya banyak bisa diintegrasikan. Pelayanan di pelabuhan akan semakin mudah, efektif, dan terpantau.
                    </p>
                    <p class="text-xs text-gray-400 pt-4 border-t">
                        Sumber: https://www.jawapos.com/surabaya/28/02/2022/penerapan-nle-picu-penurunan-biaya-logistik-hingga-50-persen/
                    </p>
                </div>

                {{-- Share Social Media Buttons --}}
                <div class="flex items-center gap-2 pt-6 border-t border-gray-100">
                    <span class="text-xs font-semibold text-gray-500 uppercase mr-2">Share:</span>
                    <a href="#" class="bg-blue-600 text-white text-xs px-3 py-1.5 rounded hover:opacity-90 transition">Facebook</a>
                    <a href="#" class="bg-green-500 text-white text-xs px-3 py-1.5 rounded hover:opacity-90 transition">LINE</a>
                    <a href="#" class="bg-black text-white text-xs px-3 py-1.5 rounded hover:opacity-90 transition">X / Twitter</a>
                </div>

            </div>

            {{-- SIDEBAR KANAN (LATEST BERITA) --}}
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                    <h3 class="text-lg font-bold text-[#052B35] pb-3 border-b-2 border-[#052B35] mb-5">
                        Latest Berita
                    </h3>

                    @php
                        $latestNews = [
                            [
                                'title' => 'HANDLING REEFER COUNTAINER DARI SURABAYA KE LOS ANGELES, USA KOMODITY FROZEN YELLOWFIN TUNA GROUND MEAT',
                                'date'  => 'November 15, 2023',
                                'image' => 'news-reefer.jpg',
                                'slug'  => 'handling-reefer-container-surabaya-ke-los-angeles'
                            ],
                            [
                                'title' => 'Penerapan NLE Picu Penurunan Biaya Logistik hingga 50 Persen',
                                'date'  => 'July 05, 2022',
                                'image' => 'news-nle.jpg',
                                'slug'  => 'penerapan-nle-picu-penurunan-biaya-logistik-hingga-50-persen'
                            ],
                        ];
                    @endphp

                    <div class="space-y-6">
                        @foreach($latestNews as $item)
                            <a href="{{ route('berita.detail', $item['slug']) }}" class="group block border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                                <div class="overflow-hidden rounded-xl h-28 mb-3">
                                    <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                </div>
                                <h4 class="text-xs font-bold text-[#052B35] group-hover:text-[#FF7A3D] transition line-clamp-3 leading-snug mb-2 uppercase">
                                    {{ $item['title'] }}
                                </h4>
                                <div class="flex items-center gap-1.5 text-[11px] text-[#FF7A3D]">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>{{ $item['date'] }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection