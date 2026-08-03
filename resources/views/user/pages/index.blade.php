@extends('user.layouts.app')

@section('content')
  {{-- ============ HERO SLIDER SECTION ============ --}}
  <section class="relative h-[550px] overflow-hidden" x-data="{
      active: 0,
      slides: [
          { image: 'fastlog1.png' },
          { image: 'fastlog2.jpg' },
          { image: 'fastlog3.png' }
      ]
  }" x-init="setInterval(() => { active = (active + 1) % slides.length }, 5000)">

    {{-- Slides (fade transition) --}}
    <template x-for="(slide, index) in slides" :key="index">
      <div class="absolute inset-0 transition-opacity duration-1000"
        :class="active === index ? 'opacity-100' : 'opacity-0'">
        <img :src="`{{ asset('images/front-end') }}/${slide.image}`" alt="Cargo Solutions"
          class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#052B35]/90 via-[#052B35]/40 to-[#052B35]/10"></div>
      </div>
    </template>

    {{-- Text --}}
    <div class="relative h-full flex flex-col justify-center max-w-7xl mx-auto px-6 lg:px-8">
      <h1 class="text-white text-3xl md:text-4xl font-bold mb-3 max-w-xl leading-tight">
        Safe & Reliable Cargo Solutions
      </h1>
      <p class="text-white/90 text-base max-w-lg">
        Perusahaan Ekspedisi dan logistik yang selalu mengutamakan Kepuasan dan Loyalitas Kepada Pelanggan
      </p>
    </div>

    {{-- Dots indicator --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
      <template x-for="(slide, index) in slides" :key="index">
        <button @click="active = index" class="w-2.5 h-2.5 rounded-full transition"
          :class="active === index ? 'bg-[#FF7A3D]' : 'bg-white/40'">
        </button>
      </template>
    </div>

  </section>

  {{-- ============ 2 INFO BOXES ============ --}}
  <section class="relative z-10 -mt-16 mb-10">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 rounded-2xl overflow-hidden shadow-xl">

        <div class="bg-white p-6 flex gap-4">
          <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-[#FF7A3D]" fill="none" viewBox="0 0 24 24" stroke="currentColor"
              stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
            </svg>
          </div>
          <div>
            <h3 class="text-base font-bold text-[#052B35] mb-1.5">Layanan Logistik</h3>
            <p class="text-gray-500 text-sm mb-3 leading-relaxed">
              Sea freight, air freight, FCL, LCL, ex-work, pengiriman ulang antar pulau. Mencakup seluruh pengiriman
              logistik
            </p>
            <a href="#services"
              class="inline-flex items-center gap-2 text-[#FF7A3D] font-semibold text-xs hover:gap-3 transition-all">
              Explore More
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
            </a>
          </div>
        </div>

        <div class="bg-[#083C4A] p-6 flex gap-4">
          <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-[#FF7A3D]" fill="none" viewBox="0 0 24 24" stroke="currentColor"
              stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18z" />
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 12h18M12 3c2.5 2.5 3.75 5.5 3.75 9s-1.25 6.5-3.75 9c-2.5-2.5-3.75-5.5-3.75-9S9.5 5.5 12 3z" />
            </svg>
          </div>
          <div>
            <h3 class="text-base font-bold text-white mb-1.5">Destinasi Pengiriman</h3>
            <p class="text-white/70 text-sm mb-3 leading-relaxed">
              Kirim Barang Ke Berbagai Belahan Dunia
            </p>
            <a href="#destination"
              class="inline-flex items-center gap-2 text-[#FF7A3D] font-semibold text-xs hover:gap-3 transition-all">
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

  {{-- ============ ABOUT + STATS SECTION ============ --}}
  <section id="about" class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

        {{-- Image + Stats Box (kiri) --}}
        <div class="relative">
          <img src="{{ asset('images/front-end/fastlog1.png') }}" alt="Tentang Fastlog Era Mandiri"
            class="w-full h-[420px] object-cover rounded-2xl">

          {{-- Stats box, nempel di pojok kiri-bawah foto --}}
          <div
            class="absolute -bottom-8 left-0 md:left-8 bg-[#052B35] rounded-2xl px-8 py-7 shadow-xl grid grid-cols-3 gap-6 w-[calc(100%-2rem)] md:w-auto">
            <div>
              <p class="text-3xl md:text-4xl font-bold text-white mb-1">22</p>
              <p class="text-white/70 text-xs md:text-sm leading-snug">Years<br>Experience</p>
            </div>
            <div>
              <p class="text-3xl md:text-4xl font-bold text-white mb-1">45</p>
              <p class="text-white/70 text-xs md:text-sm leading-snug">Trusted<br>Clients</p>
            </div>
            <div>
              <p class="text-3xl md:text-4xl font-bold text-white mb-1">1970</p>
              <p class="text-white/70 text-xs md:text-sm leading-snug">Delivery<br>Completed</p>
            </div>
          </div>
        </div>

        {{-- Text (kanan) --}}
        <div class="mt-10 lg:mt-0">
          <span class="text-[#FF7A3D] font-semibold tracking-widest text-sm">TENTANG KAMI</span>
          <h2 class="text-3xl md:text-4xl font-bold text-[#052B35] mt-3 mb-6 leading-tight">
            Solusi Logistik & Transportasi Andalan Anda
          </h2>

          <p class="text-gray-500 mb-8 leading-relaxed">
            Kami menyediakan layanan sea freight, air freight, FCL, LCL, ex-work, re-stuffing antar pulau, CIF, CNF, FOB
            dan sebagainya. Customs clearance dan penanganan dokumen ke pelabuhan di seluruh dunia.
          </p>

          <a href="#services"
            class="inline-block bg-[#FF7A3D] hover:bg-orange-600 text-white font-semibold text-sm px-8 py-4 rounded-xl transition">
            Explore More
          </a>
        </div>

      </div>
    </div>
  </section>
  <section id="why-us" class="relative py-24 bg-fixed bg-center bg-cover"
    style="background-image: url('{{ asset('images/front-end/fastlog2.jpg') }}')">
    {{-- Overlay gelap --}}
    <div class="absolute inset-0 bg-[#052B35]/85"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
      <div class="text-center mb-14">
        <span class="text-[#FF7A3D] font-semibold tracking-widest text-sm">WHY CHOOSE US</span>
        <h2 class="text-3xl md:text-4xl font-bold text-white mt-3">
          Menyediakan Layanan dengan Kualitas Tinggi
        </h2>
        <p class="text-white/70 max-w-2xl mx-auto mt-4">
          Kami menawarkan pelayanan prima dalam memenuhi seluruh kebutuhan pelanggan dan kami selalu mencoba memberikan
          yang terbaik.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
          $whyChooseUs = [
              [
                  'title' => 'Pelayanan Terbaik',
                  'desc' => 'Kami memiliki tim dan tenaga ahli yang siap siaga memenuhi setiap kebutuhan customer',
              ],
              [
                  'title' => 'Respon Cepat',
                  'desc' => 'Respon cepat adalah keharusan dalam memberikan pelayanan yang terbaik',
              ],
              [
                  'title' => 'Amanah',
                  'desc' =>
                      'Setiap layanan yang kami berikan kepada customer selalu kami kerjakan dengan sungguh-sungguh dan amanah',
              ],
              ['title' => 'Harga Bersaing', 'desc' => 'Kami memberikan pelayanan terbaik dengan harga bersaing'],
          ];
        @endphp

        @foreach ($whyChooseUs as $item)
          <div
            class="bg-white/10 backdrop-blur-sm border border-white/10 p-6 rounded-2xl hover:bg-white/15 transition text-center">
            <div class="w-14 h-14 mx-auto rounded-full bg-[#FF7A3D]/20 flex items-center justify-center mb-4">
              <svg class="w-7 h-7 text-[#FF7A3D]" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="font-bold text-white mb-2">{{ $item['title'] }}</h3>
            <p class="text-sm text-white/60">{{ $item['desc'] }}</p>
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
          PT. Fastlog Era Mandiri mengerti setiap kebutuhan anda dengan menyediakan berbagai macam pelayanan yang akan
          memudahkan anda mengirim barang ke berbagai belahan dunia dengan mudah.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
          $layanan = [
              [
                  'title' => 'Custom Clearance',
                  'desc' =>
                      'Kami memiliki ahli yang memahami betul seluruh peraturan dan prosedur kepabeanan baik untuk ekspor dan impor.',
                  'bg' => 'fastlog1.png',
                  'icon' =>
                      '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l1.5 1.5 3-3" />',
              ],
              [
                  'title' => 'Reefer Logistic',
                  'desc' => 'Mencakup seluruh pengiriman logistik berpendingin termasuk restuffing dalam keadaan beku.',
                  'bg' => 'fastlog2.jpg',
                  'icon' =>
                      '<path stroke-linecap="round" stroke-linejoin="round" d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM19 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5h1.5m0 0V7a1 1 0 011-1h9.5a1 1 0 011 1v2m-11.5 7.5h8m0 0V9m0 7.5h3m2.5 0H17m2.5 0V11a1 1 0 00-1-1h-3" />',
              ],
              [
                  'title' => 'Freight Forwarding',
                  'desc' =>
                      'Menyediakan layanan sea freight, air freight, FCL, LCL, ex-work, pengiriman ulang antar pulau.',
                  'bg' => 'fastlog3.png',
                  'icon' =>
                      '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l1.5-4.5h16.5l1.5 4.5m-19.5 0v3a1.5 1.5 0 001.5 1.5h16.5a1.5 1.5 0 001.5-1.5v-3m-19.5 0h19.5M6 11.25V6a1.5 1.5 0 011.5-1.5h9A1.5 1.5 0 0118 6v5.25" />',
              ],
              [
                  'title' => 'Inland Transport',
                  'desc' =>
                      'Pengiriman dalam dan luar pulau melalui berbagai jalur pengiriman menggunakan kapal, truk dan kereta api.',
                  'bg' => 'fastlog1.png',
                  'icon' =>
                      '<path stroke-linecap="round" stroke-linejoin="round" d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM12 9.75V13.5m0 0V17.25a2.25 2.25 0 002.25 2.25h.75m-3-2.25v-5.25m0 0h1.5m3.75 5.25a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0" />',
              ],
          ];
        @endphp

        @foreach ($layanan as $item)
          <div class="group relative rounded-2xl border border-gray-100 overflow-hidden cursor-pointer h-72">

            {{-- Background Image (muncul pas hover) --}}
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
              <img src="{{ asset('images/front-end/' . $item['bg']) }}" alt="{{ $item['title'] }}"
                class="w-full h-full object-cover">
              <div class="absolute inset-0 bg-[#052B35]/75"></div>
            </div>

            {{-- Content --}}
            <div class="relative p-8 h-full flex flex-col">
              <svg class="w-10 h-10 text-[#FF7A3D] group-hover:text-white transition-colors duration-300 mb-6"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                {!! $item['icon'] !!}
              </svg>

              <h3 class="font-bold text-lg text-[#052B35] group-hover:text-white transition-colors duration-300 mb-3">
                {{ $item['title'] }}
              </h3>

              <p class="text-sm text-gray-500 group-hover:text-white/90 transition-colors duration-300 mb-4">
                {{ $item['desc'] }}
              </p>

              <a href="#"
                class="mt-auto inline-flex items-center gap-2 text-[#FF7A3D] group-hover:text-white font-semibold text-sm transition-colors duration-300">
                Read More
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
              </a>
            </div>

          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section id="gallery" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="text-center mb-14">
        <span class="text-[#FF7A3D] font-semibold">Gallery</span>
        <h2 class="text-3xl md:text-4xl font-bold text-[#052B35] mt-2">
          Gallery Terbaru
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

        <a href="#"
          class="group rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition block">
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
              PT. Fastlog Era Mandiri melakukan handling export container reefer 40 feet ALL-IN dari Surabaya menuju USA -
              Los Angeles Port.
            </p>
          </div>
        </a>

        <a href="#"
          class="group rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition block">
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
        <a href="#"
          class="inline-block bg-[#FF7A3D] hover:bg-orange-600 text-white font-semibold px-8 py-3 rounded-xl transition">
          Lihat Semua Berita
        </a>
      </div>
    </div>
  </section>
@endsection
