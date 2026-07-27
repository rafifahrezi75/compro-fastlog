@extends('user.layouts.app')

@section('content')

{{-- ============ HERO SECTION ============ --}}
<section class="relative h-[650px] flex items-end">
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-cargo.jpg') }}" alt="Cargo Solutions" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#052B35]/90 via-[#052B35]/40 to-[#052B35]/10"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 w-full pb-24">
        <h1 class="text-white text-4xl md:text-5xl font-bold mb-4 max-w-2xl">
            Safe & Reliable Cargo Solutions
        </h1>
        <p class="text-white/90 text-lg max-w-xl">
            Perusahaan Ekspedisi dan logistik yang selalu mengutamakan Kepuasan dan Loyalitas Kepada Pelanggan
        </p>
    </div>
</section>

{{-- ============ 2 INFO BOXES ============ --}}
<section class="relative z-10 -mt-16 mb-10">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 rounded-2xl overflow-hidden shadow-xl">

            <div class="bg-white p-8 flex gap-5">
                <div class="w-16 h-16 rounded-full bg-orange-50 flex items-center justify-center shrink-0">
                    <svg class="w-8 h-8 text-[#FF7A3D]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-[#052B35] mb-2">Layanan Logistik</h3>
                    <p class="text-gray-500 text-sm mb-4 leading-relaxed">
                        Sea freight, air freight, FCL, LCL, ex-work, pengiriman ulang antar pulau. Mencakup seluruh pengiriman logistik berpendingin termasuk restuffing dalam keadaan beku. Custom Clearence
                    </p>
                    <a href="#services" class="inline-flex items-center gap-2 text-[#FF7A3D] font-semibold text-sm hover:gap-3 transition-all">
                        Explore More
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bg-[#083C4A] p-8 flex gap-5">
                <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                    <svg class="w-8 h-8 text-[#FF7A3D]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M12 3c2.5 2.5 3.75 5.5 3.75 9s-1.25 6.5-3.75 9c-2.5-2.5-3.75-5.5-3.75-9S9.5 5.5 12 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-2">Destinasi Pengiriman</h3>
                    <p class="text-white/70 text-sm mb-4 leading-relaxed">
                        Kirim Barang Ke Berbagai Belahan Dunia
                    </p>
                    <a href="#destination" class="inline-flex items-center gap-2 text-[#FF7A3D] font-semibold text-sm hover:gap-3 transition-all">
                        Explore More
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="about" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-[#FF7A3D] font-semibold">Why Choose Us</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#052B35] mt-2">
                Menyediakan Layanan dengan Kualitas Tinggi
            </h2>
            <p class="text-gray-500 max-w-2xl mx-auto mt-4">
                Kami menawarkan pelayanan prima dalam memenuhi seluruh kebutuhan pelanggan dan kami selalu mencoba memberikan yang terbaik.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $whyChooseUs = [
                    ['title' => 'Pelayanan Terbaik', 'desc' => 'Kami memiliki tim dan tenaga ahli yang siap siaga memenuhi setiap kebutuhan customer'],
                    ['title' => 'Respon Cepat', 'desc' => 'Respon cepat adalah keharusan dalam memberikan pelayanan yang terbaik'],
                    ['title' => 'Amanah', 'desc' => 'Setiap layanan yang kami berikan kepada customer selalu kami kerjakan dengan sungguh-sungguh dan amanah'],
                    ['title' => 'Harga Bersaing', 'desc' => 'Kami memberikan pelayanan terbaik dengan harga bersaing'],
                ];
            @endphp

            @foreach ($whyChooseUs as $item)
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-14 h-14 mx-auto rounded-full bg-orange-50 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-[#FF7A3D]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-[#052B35] mb-2">{{ $item['title'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="services" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-[#FF7A3D] font-semibold">Layanan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#052B35] mt-2">
                Layanan yang Kami Tawarkan
            </h2>
            <p class="text-gray-500 max-w-2xl mx-auto mt-4">
                PT. Fastlog Era Mandiri mengerti setiap kebutuhan anda dengan menyediakan berbagai macam pelayanan yang akan memudahkan anda mengirim barang ke berbagai belahan dunia dengan mudah.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $layanan = [
                    ['title' => 'Custom Clearance', 'desc' => 'Kami memiliki ahli yang memahami betul seluruh peraturan dan prosedur kepabeanan baik untuk ekspor dan impor.'],
                    ['title' => 'Reefer Logistic', 'desc' => 'Mencakup seluruh pengiriman logistik berpendingin termasuk restuffing dalam keadaan beku.'],
                    ['title' => 'Freight Forwarding', 'desc' => 'Menyediakan layanan sea freight, air freight, FCL, LCL, ex-work, pengiriman ulang antar pulau.'],
                    ['title' => 'Inland Transport', 'desc' => 'Pengiriman dalam dan luar pulau melalui berbagai jalur pengiriman menggunakan kapal, truk dan kereta api.'],
                ];
            @endphp

            @foreach ($layanan as $item)
                <div class="group p-8 rounded-2xl border border-gray-100 hover:bg-[#FF7A3D] hover:border-transparent transition-all duration-300 cursor-pointer">
                    <svg class="w-10 h-10 text-[#FF7A3D] group-hover:text-white transition mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <h3 class="font-bold text-lg text-[#052B35] group-hover:text-white transition mb-3">{{ $item['title'] }}</h3>
                    <p class="text-sm text-gray-500 group-hover:text-white/90 transition">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="gallery" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-[#FF7A3D] font-semibold">Galeri</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#052B35] mt-2">
                Galeri Terbaru
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $gallery = [
                    ['title' => 'Komisaris & Direksi', 'image' => 'gallery-1.jpg'],
                    ['title' => '2nd Anniversary', 'image' => 'gallery-2.jpg'],
                    ['title' => 'Outbond 2022', 'image' => 'gallery-3.jpg'],
                ];
            @endphp

            @foreach ($gallery as $item)
                <a href="#" class="group relative rounded-2xl overflow-hidden aspect-[4/3] block">
                    <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['title'] }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#052B35]/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-5">
                        <p class="text-white font-semibold text-lg">{{ $item['title'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section id="news" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-[#FF7A3D] font-semibold">Berita</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#052B35] mt-2">
                Berita & Event
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <a href="#" class="group rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition block">
                <div class="aspect-[16/9] overflow-hidden">
                    <img src="{{ asset('images/news-1.jpg') }}" alt="Handling Reefer Container"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6">
                    <p class="text-xs text-gray-400 mb-2">Rabu, 15 Nov 2023</p>
                    <h3 class="font-bold text-[#052B35] mb-3 leading-snug group-hover:text-[#FF7A3D] transition">
                        Handling Reefer Container dari Surabaya ke Los Angeles, USA Komoditi Frozen Yellowfin Tuna Ground Meat
                    </h3>
                    <p class="text-sm text-gray-500 line-clamp-2">
                        PT. Fastlog Era Mandiri melakukan handling export container reefer 40 feet ALL-IN dari Surabaya menuju USA - Los Angeles Port.
                    </p>
                </div>
            </a>

            <a href="#" class="group rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition block">
                <div class="aspect-[16/9] overflow-hidden">
                    <img src="{{ asset('images/news-2.jpg') }}" alt="Penerapan NLE"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6">
                    <p class="text-xs text-gray-400 mb-2">Selasa, 05 Jul 2022</p>
                    <h3 class="font-bold text-[#052B35] mb-3 leading-snug group-hover:text-[#FF7A3D] transition">
                        Penerapan NLE Picu Penurunan Biaya Logistik hingga 50 Persen
                    </h3>
                    <p class="text-sm text-gray-500 line-clamp-2">
                        Pemerintah mengoptimalkan pengoperasian Inaportnet di pelabuhan untuk mengurangi biaya logistik nasional.
                    </p>
                </div>
            </a>

        </div>

        <div class="text-center mt-10">
            <a href="#" class="inline-block bg-[#FF7A3D] hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-xl transition">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>


@endsection