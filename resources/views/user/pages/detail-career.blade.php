@extends('user.layouts.app')

@section('title', $job->nama_karir . ' - ' . __('Career') . ' Fastlog')

@section('content')

{{-- HERO --}}
<section class="relative bg-[#052B35] pt-36 pb-16 text-white bg-cover bg-center bg-fixed"
         style="background-image: url('{{ asset('images/front-end/fastlog2.jpg') }}');">

    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-[#052B35]/80"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm text-white/70 mb-4">
            <a href="{{ route('home') }}" class="hover:text-[#FF7A3D] transition">{{ __('Home') }}</a>
            <span>/</span>
            <a href="{{ route('career') }}" class="hover:text-[#FF7A3D] transition">{{ __('Career') }}</a>
            <span>/</span>
            <span class="text-[#FF7A3D] font-medium">{{ $job->nama_karir }}</span>
        </nav>

        <div class="flex flex-wrap items-center gap-3 mb-3">
            <span class="bg-[#FF7A3D] text-white text-xs font-semibold px-3 py-1 rounded-full">
                {{ $job->departemen }}
            </span>
            <span class="bg-white/10 text-white text-xs font-semibold px-3 py-1 rounded-full">
                {{ $job->tipe_pekerjaan }}
            </span>
        </div>

        <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $job->nama_karir }}</h1>
        <p class="text-white/80 text-sm md:text-base flex items-center gap-2">
            <svg class="w-4 h-4 text-[#FF7A3D]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            {{ $job->kota }}, {{ $job->provinsi }}
        </p>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        {{-- Alert Notifikasi Simulasi Sukses --}}
        @if(session('success'))
        <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-4 flex items-center gap-3">
            <svg class="w-6 h-6 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm md:text-base font-medium">{{ session('success') }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- KIRI: RINCIAN PEKERJAAN --}}
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 space-y-8">
                
                <div>
                    <h2 class="text-2xl font-bold text-[#052B35] mb-4">{{ __('Job Description & Responsibilities') }}</h2>
                    <p class="text-gray-600 leading-relaxed text-base">
                        {!! nl2br(e($job->deskripsi)) !!}
                    </p>
                </div>

                <hr class="border-gray-100">

                <div>
                    <h2 class="text-xl font-bold text-[#052B35] mb-4">{{ __('Qualifications & Requirements') }}</h2>
                    <p class="text-gray-600 leading-relaxed text-base">
                        {!! nl2br(e($job->kualifikasi)) !!}
                    </p>
                </div>

            </div>

            {{-- KANAN: FORM APPLY LAMARAN --}}
            <div class="lg:sticky lg:top-28">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold text-[#052B35] mb-1">{{ __('Apply for this Position') }}</h3>
                    <p class="text-gray-500 text-xs mb-4">{{ __('Fill out the form below and upload your latest CV.') }}</p>

                    @if(session('success'))
                        <div class="mb-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <strong class="font-semibold block text-emerald-900">{{ __('Application Sent!') }}</strong>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                            <strong class="font-semibold block text-rose-900 mb-1">{{ __('Failed to send application:') }}</strong>
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('career.apply') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="karir_id" value="{{ $job->id }}">
                        <input type="hidden" name="job_title" value="{{ $job->nama_karir }}">

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">{{ __('Full Name') }} *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="{{ __('Example: Budi Santoso') }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF7A3D] transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">{{ __('Email') }} *</label>
                            <input type="email" name="email" required placeholder="budi@gmail.com"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF7A3D] transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">{{ __('WhatsApp Number') }} *</label>
                            <input type="tel" name="phone" required placeholder="081234567890"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF7A3D] transition">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">{{ __('Upload CV / Resume (PDF)') }} *</label>
                            <input type="file" name="cv" accept=".pdf" required
                                class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#FF7A3D]/10 file:text-[#FF7A3D] hover:file:bg-[#FF7A3D]/20 cursor-pointer">
                            <span class="text-[10px] text-gray-400 mt-1 block">{{ __('Maximum file size: 2MB (.pdf)') }}</span>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">{{ __('Message / Note (Optional)') }}</label>
                            <textarea name="message" rows="3" placeholder="{{ __('Write a short introduction about yourself...') }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF7A3D] transition"></textarea>
                        </div>

                        <button type="button" id="btn-show-captcha" class="w-full bg-[#FF7A3D] hover:bg-orange-600 text-white font-semibold py-3 rounded-xl transition duration-200 shadow-md text-sm mt-2">
                            {{ __('Submit Application Now') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- MODAL CAPTCHA --}}
<div id="captcha-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" style="display:none;">
    <div class="bg-white p-6 rounded-2xl shadow-xl relative mx-4" style="width:360px;max-width:100%;">
        <button id="btn-close-captcha" type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h4 class="text-lg font-bold text-[#052B35] mb-1 text-center">{{ __('Security Verification') }}</h4>
        <p class="text-xs text-gray-400 mb-5 text-center">{{ __('Slide the puzzle to the correct position to continue.') }}</p>
        <div id="captcha-container"></div>
    </div>
</div>

{{-- Local Slider Captcha Library --}}
<link href="{{ asset('libs/slidercaptcha/slidercaptcha.css') }}?v={{ time() }}" rel="stylesheet">
<script src="{{ asset('libs/slidercaptcha/slidercaptcha.js') }}?v={{ time() }}"></script>
<script>
    (function () {
        var modal = document.getElementById('captcha-modal');
        var btnShow = document.getElementById('btn-show-captcha');
        var btnClose = document.getElementById('btn-close-captcha');
        var form = document.querySelector('form[action="{{ route('career.apply') }}"]');
        var captchaInstance = null;

        function openModal() {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            if (!captchaInstance) {
                captchaInstance = new SliderCaptcha({
                    el: 'captcha-container',
                    images: [
                        'https://picsum.photos/300/150?random=10',
                        'https://picsum.photos/300/150?random=20',
                        'https://picsum.photos/300/150?random=30',
                        'https://picsum.photos/300/150?random=40',
                    ],
                    onSuccess: function () {
                        setTimeout(function () {
                            closeModal();
                            form.submit();
                        }, 600);
                    },
                    onFail: function () {
                        // auto retry handled inside captcha
                    }
                });
            } else {
                captchaInstance.refresh();
            }
        }

        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }

        btnShow.addEventListener('click', function () {
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            openModal();
        });

        btnClose.addEventListener('click', closeModal);

        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });
    })();
</script>

@endsection