@extends('layouts.app')

@section('styles')
<style>
    @keyframes hero-progress {
        from { width: 0%; }
        to   { width: 100%; }
    }
    @keyframes slide-up-in {
        from { opacity: 0; transform: translateY(32px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .img-zoom {
        transition: transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .group:hover .img-zoom,
    .bento-card:hover .img-zoom {
        transform: scale(1.04);
    }

    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    .welcome-slide {
        transition: opacity 1000ms ease-in-out, transform 1000ms ease-in-out;
    }

    #hero-progress-bar {
        position: absolute;
        bottom: 0; left: 0;
        height: 2px;
        background: #F59E0B;
        animation: hero-progress 6s linear infinite;
        z-index: 30;
    }

    .hover-lift {
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                    box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    }

    .major-bento-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: auto;
        gap: 20px;
    }
    @media (max-width: 1023px) {
        .major-bento-grid { grid-template-columns: 1fr 1fr; }
        .major-card-featured { grid-column: span 2; }
    }
    @media (max-width: 639px) {
        .major-bento-grid { grid-template-columns: 1fr; }
        .major-card-featured { grid-column: span 1; }
    }
    .major-card-featured { grid-column: span 2; grid-row: span 1; }

    .major-card {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1),
                    box-shadow 0.45s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .major-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }
    .major-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 280px;
    }
    .major-card-featured .major-card-inner {
        min-height: 340px;
    }
    .major-num {
        font-size: clamp(80px, 10vw, 140px);
        font-weight: 900;
        line-height: 0.85;
        letter-spacing: -0.05em;
        opacity: 0.06;
        position: absolute;
        bottom: -10px;
        right: -10px;
        color: white;
        user-select: none;
        pointer-events: none;
        font-family: 'Outfit', sans-serif;
    }

    .fc-light-card {
        background: #FFFFFF;
        border-radius: 1.5rem;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        border: 1px solid rgba(226,232,240,0.5);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                    box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .fc-light-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    }

    .cta-band {
        background: #18181B;
        position: relative;
        overflow: hidden;
    }

    html.lenis, html.lenis body {
        height: auto;
    }
    .lenis.lenis-smooth {
        scroll-behavior: auto !important;
    }
    .lenis.lenis-smooth [data-lenis-prevent] {
        overscroll-behavior: contain;
    }
    .lenis.lenis-stopped {
        overflow: hidden;
    }
    .lenis.lenis-scrolling iframe {
        pointer-events: none;
    }
</style>
@endsection

@section('content')
    <main class="overflow-hidden">
        <!-- Hero Section -->
        <section class="relative min-h-[100dvh] flex items-center overflow-hidden bg-[#18181B] pt-20">
            <div id="hero-slider" class="absolute inset-0 w-full h-full z-0">
                @foreach($banners as $index => $banner)
                    <div class="welcome-slide absolute inset-0 w-full h-full opacity-0 flex items-center" data-index="{{ $index }}">
                        <div class="absolute inset-0 z-0">
                            @if($banner->image_path)
                                <img alt="{{ $banner->title }}"
                                    class="w-full h-full object-cover scale-100 transition-transform duration-[6000ms] ease-out"
                                    src="{{ Storage::url($banner->image_path) }}"
                                    {{ $index > 0 ? 'loading="lazy"' : '' }}
                                    width="1920" height="1080"
                                    onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');" />
                                <div class="hidden absolute inset-0 bg-[#18181B]"></div>
                            @else
                                <div class="absolute inset-0" style="background: linear-gradient(135deg, #18181B 0%, #27272A 55%, #18181B 100%);"></div>
                                <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle at 1.5px 1.5px, white 1.5px, transparent 0); background-size: 28px 28px;"></div>
                            @endif
                            <div class="absolute inset-0 bg-[#18181B]" style="opacity: {{ ($banner->image_path ? ($banner->overlay_opacity ?? 60) : 0) / 100 }}"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-[#18181B] via-[#18181B]/20 to-transparent"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-[#18181B]/50 via-transparent to-transparent"></div>
                        </div>

                        <div class="max-w-[1400px] mx-auto px-6 md:px-12 relative z-10 w-full">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                                @php
                                    $ctaColorClasses = [
                                        'amber'   => 'bg-[#F59E0B] text-white hover:bg-[#D97706]',
                                        'blue'    => 'bg-blue-600 text-white hover:bg-blue-700',
                                        'emerald' => 'bg-emerald-600 text-white hover:bg-emerald-700',
                                        'red'     => 'bg-[#DC2626] text-white hover:bg-red-700',
                                        'indigo'  => 'bg-indigo-600 text-white hover:bg-indigo-700',
                                        'slate'   => 'bg-zinc-700 text-white hover:bg-zinc-800',
                                    ][$banner->cta_color ?? 'amber'] ?? 'bg-[#F59E0B] text-white hover:bg-[#D97706]';

                                    $alignmentClasses = [
                                        'left'   => 'lg:col-span-9 flex flex-col items-start text-left mr-auto',
                                        'center' => 'lg:col-span-10 lg:col-start-2 flex flex-col items-center text-center mx-auto',
                                        'right'  => 'lg:col-span-9 lg:col-start-4 flex flex-col items-end text-right ml-auto',
                                    ][$banner->alignment ?? 'left'] ?? 'lg:col-span-9 flex flex-col items-start text-left mr-auto';
                                @endphp

                                <div class="{{ $alignmentClasses }} gap-6 transform translate-y-8 opacity-0 transition-all duration-1000">
                                    <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-xl px-4 py-2 rounded-full border border-white/20">
                                        <span class="relative flex h-2 w-2">
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-[#F59E0B]"></span>
                                        </span>
                                        <span class="text-xs text-white/80 tracking-widest uppercase font-semibold" style="font-family: 'Outfit', sans-serif;">SMA GIKI 3 SURABAYA</span>
                                    </div>

                                    <h1 class="text-4xl md:text-6xl font-black leading-[1.1] tracking-tight max-w-3xl"
                                        style="font-family: 'Outfit', sans-serif; color: #FFFFFF; text-shadow: 0 4px 24px rgba(0,0,0,0.4);">
                                        @if($banner->is_default)
                                            Membentuk Karakter,<br />
                                            <span style="color: #F59E0B;">Mengukir Prestasi</span>
                                        @else
                                            {{ $banner->title }}
                                        @endif
                                    </h1>

                                    @if($banner->subtitle)
                                        <p class="text-lg max-w-2xl leading-relaxed"
                                           style="font-family: 'Outfit', sans-serif; font-weight: 400; line-height: 1.6; color: rgba(255,255,255,0.8); text-shadow: 0 2px 12px rgba(0,0,0,0.3);">
                                            {{ $banner->subtitle }}
                                        </p>
                                    @endif

                                    @if($banner->button_text)
                                        <div class="flex flex-wrap gap-4 mt-2">
                                            <a href="{{ $banner->button_url ?? '#' }}"
                                                class="font-bold text-sm px-8 py-4 rounded-full transition-all duration-300 tracking-wide flex items-center gap-3 active:scale-95 {{ $ctaColorClasses }}">
                                                <span>{{ $banner->button_text }}</span>
                                                <span class="material-symbols-outlined text-xl">arrow_forward</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($banners->count() > 1)
                <button id="welcome-prev-btn" class="absolute left-6 z-20 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition border border-white/10 focus:outline-none backdrop-blur-md active:scale-95 duration-200">
                    <span class="material-symbols-outlined text-xl">arrow_back_ios_new</span>
                </button>
                <button id="welcome-next-btn" class="absolute right-6 z-20 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition border border-white/10 focus:outline-none backdrop-blur-md active:scale-95 duration-200">
                    <span class="material-symbols-outlined text-xl">arrow_forward_ios</span>
                </button>

                <div class="absolute bottom-16 left-1/2 -translate-x-1/2 z-20 flex space-x-2 bg-black/40 px-5 py-2.5 rounded-full border border-white/10 backdrop-blur-md">
                    @foreach($banners as $index => $banner)
                        <button class="welcome-dot w-2.5 h-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all focus:outline-none" data-slide-index="{{ $index }}"></button>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Floating Stats Section -->
        <section class="relative z-30 max-w-[1400px] mx-auto px-6 md:px-12 -mt-12 mb-28">
            <div class="bg-white rounded-3xl border border-[rgba(226,232,240,0.5)] shadow-[0_2px_12px_rgba(0,0,0,0.04)] grid grid-cols-1 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-slate-100 relative overflow-hidden">
                <div class="flex items-center gap-4 md:gap-3 lg:gap-5 justify-start md:justify-center p-8 md:py-10 md:px-4 lg:px-6 fade-up">
                    <div class="w-14 h-14 rounded-2xl bg-[#F59E0B]/10 text-[#F59E0B] flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1">group</span>
                    </div>
                    <div>
                        <div class="flex items-baseline">
                            <h2 class="text-4xl lg:text-5xl font-black tracking-tight leading-none counter-value" style="font-family: 'Outfit', sans-serif; color: #18181B;" data-target="{{ $setting->stat_students ?? 1000 }}">0</h2>
                            <span class="text-[#F59E0B] font-black text-2xl lg:text-3xl ml-0.5 leading-none">+</span>
                        </div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.12em] mt-1.5" style="color: #94A3B8;">Siswa Aktif</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 md:gap-3 lg:gap-5 justify-start md:justify-center p-8 md:py-10 md:px-4 lg:px-6 fade-up">
                    <div class="w-14 h-14 rounded-2xl bg-[#F59E0B]/10 text-[#F59E0B] flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1">school</span>
                    </div>
                    <div>
                        <div class="flex items-baseline">
                            <h2 class="text-4xl lg:text-5xl font-black tracking-tight leading-none counter-value" style="font-family: 'Outfit', sans-serif; color: #18181B;" data-target="{{ $setting->stat_teachers ?? 80 }}">0</h2>
                            <span class="text-[#F59E0B] font-black text-2xl lg:text-3xl ml-0.5 leading-none">+</span>
                        </div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.12em] mt-1.5" style="color: #94A3B8;">Tenaga Pengajar</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 md:gap-3 lg:gap-5 justify-start md:justify-center p-8 md:py-10 md:px-4 lg:px-6 fade-up">
                    <div class="w-14 h-14 rounded-2xl bg-[#F59E0B]/10 text-[#F59E0B] flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1">workspace_premium</span>
                    </div>
                    <div>
                        <div class="flex items-baseline">
                            <h2 class="text-4xl lg:text-5xl font-black tracking-tight leading-none counter-value" style="font-family: 'Outfit', sans-serif; color: #18181B;" data-target="{{ $setting->stat_achievements ?? 50 }}">0</h2>
                            <span class="text-[#F59E0B] font-black text-2xl lg:text-3xl ml-0.5 leading-none">+</span>
                        </div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.12em] mt-1.5" style="color: #94A3B8;">Prestasi</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 md:gap-3 lg:gap-5 justify-start md:justify-center p-8 md:py-10 md:px-4 lg:px-6 fade-up">
                    <div class="w-14 h-14 rounded-2xl bg-[#F59E0B]/10 text-[#F59E0B] flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1">calendar_month</span>
                    </div>
                    <div>
                        <div class="flex items-baseline">
                            <h2 class="text-4xl lg:text-5xl font-black tracking-tight leading-none counter-value" style="font-family: 'Outfit', sans-serif; color: #18181B;" data-target="{{ $setting->stat_years ?? 25 }}">0</h2>
                            <span class="text-[#F59E0B] font-black text-2xl lg:text-3xl ml-0.5 leading-none">+</span>
                        </div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.12em] mt-1.5" style="color: #94A3B8;">Tahun Berdiri</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tentang Kami & Visi Misi Section -->
        <section id="profil" class="max-w-[1400px] mx-auto px-6 md:px-12 my-28 scroll-mt-24">
            <div class="mb-16 max-w-3xl fade-up">
                <h2 class="text-3xl md:text-5xl font-black mb-6 mt-1 leading-tight tracking-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                    @if($setting?->about_title)
                        {{ $setting->about_title }}
                    @else
                        Mendidik dengan Hati,<br><span style="color: #F59E0B;">Membangun Karakter Mandiri</span>
                    @endif
                </h2>
                <p class="text-lg leading-relaxed max-w-2xl" style="font-family: 'Outfit', sans-serif; font-weight: 400; line-height: 1.6; color: #71717A;">
                    {{ $setting?->about_description ?? 'SMA GIKI 3 Surabaya mendidik siswa secara komprehensif, memadukan ilmu pengetahuan modern dengan nilai ketakwaan demi mewujudkan generasi yang berkepribadian mulia.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch mb-16">
                <div class="lg:col-span-5 relative flex flex-col justify-center min-h-[400px] fade-up">
                    <div class="relative w-full h-[380px] rounded-[1.5rem] overflow-hidden border border-[rgba(226,232,240,0.5)] group">
                        <img alt="SMA GIKI 3 Surabaya Campus"
                            class="w-full h-full object-cover img-zoom"
                            src="{{ (isset($setting->about_image) && !empty($setting->about_image)) ? Storage::url($setting->about_image) : '' }}"
                            loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                        <div class="absolute bottom-6 left-6 bg-white/95 backdrop-blur-md px-5 py-3.5 rounded-2xl flex items-center gap-3 border border-white/40">
                            <div class="w-10 h-10 rounded-xl bg-[#F59E0B]/10 flex items-center justify-center text-[#F59E0B]">
                                <span class="material-symbols-outlined text-2xl font-bold">calendar_month</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider" style="color: #94A3B8;">Berdiri Sejak</p>
                                <p class="font-extrabold text-sm" style="color: #18181B;">{{ $setting?->about_year_founded ?? '1993' }}</p>
                            </div>
                        </div>

                        <div class="absolute top-6 right-6 bg-[#F59E0B] text-white px-4 py-2.5 rounded-2xl flex items-center gap-2">
                            <span class="material-symbols-outlined text-base font-bold">verified</span>
                            <span class="font-black text-sm tracking-wide">{{ $setting?->about_accreditation ?? 'Akreditasi A' }}</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 flex flex-col justify-between gap-5 fade-up">
                    <div class="bg-white rounded-[1.5rem] p-8 border border-[rgba(226,232,240,0.5)] hover-lift flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-3xl font-bold text-[#F59E0B]">school</span>
                            <h3 class="font-black text-xl tracking-tight" style="color: #18181B;">{{ $setting?->about_card_title ?? 'Pendidikan Holistik & Karakter' }}</h3>
                        </div>
                        <p class="leading-relaxed text-sm md:text-base" style="color: #71717A;">
                            {{ $setting?->about_card_desc ?? 'SMA GIKI 3 Surabaya mendidik siswa secara komprehensif, memadukan ilmu pengetahuan modern dengan nilai ketakwaan demi mewujudkan generasi yang berkepribadian mulia, berbudaya, serta berwawasan kebangsaan dan lingkungan.' }}
                        </p>
                    </div>

                    <div class="bg-white rounded-[1.5rem] p-8 border border-[rgba(226,232,240,0.5)] hover-lift flex flex-col gap-4">
                        <div class="flex items-center gap-3 text-[#F59E0B]">
                            <span class="material-symbols-outlined text-3xl font-bold">lightbulb</span>
                            <h3 class="font-black text-xl tracking-tight" style="color: #18181B;">Visi Sekolah</h3>
                        </div>
                        <p class="leading-relaxed text-sm md:text-base italic font-medium pl-4 border-l-4 border-[#F59E0B]" style="color: #71717A;">
                            "{{ $setting?->vision ?? 'Beriman dan bertaqwa, berilmu pengetahuan dan teknologi, berprestasi unggul, berkepribadian, berbudaya, berwawasan kebangsaan dan lingkungan demi terwujudnya kedamaian dan kesejahteraan.' }}"
                        </p>
                    </div>
                </div>
            </div>

            <div class="fade-up">
                <div class="bg-white rounded-[1.5rem] p-8 md:p-10 border border-[rgba(226,232,240,0.5)] hover-lift flex flex-col gap-6">
                    <div class="flex items-center gap-3 text-[#F59E0B]">
                        <span class="material-symbols-outlined text-3xl font-bold">task_alt</span>
                        <h3 class="font-black text-xl tracking-tight" style="color: #18181B;">Misi Utama Kami</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-2">
                        @if(isset($setting->mission) && !empty($setting->mission))
                            @php
                                $missions = array_filter(array_map('trim', explode("\n", $setting->mission)));
                            @endphp
                            @foreach($missions as $index => $mission)
                                <div class="flex items-start gap-4">
                                    <span class="w-8 h-8 rounded-xl bg-[#F59E0B]/10 text-[#F59E0B] flex items-center justify-center font-black text-sm flex-shrink-0 mt-0.5">
                                        {{ $index + 1 }}
                                    </span>
                                    <p class="text-sm md:text-base leading-relaxed" style="color: #71717A;">
                                        {{ preg_replace('/^\d+\.\s*/', '', $mission) }}
                                    </p>
                                </div>
                            @endforeach
                        @else
                            @php
                                $fallbackMissions = [
                                    'Meningkatkan keimanan dan ketaqwaan terhadap Tuhan Yang Maha Esa.',
                                    'Tanggap dan terampil terhadap perkembangan ilmu pengetahuan dan teknologi.',
                                    'Meningkatkan kualitas sumber daya manusia dan berprestasi unggul.',
                                    'Menanamkan disiplin dan loyalitas kebangsaan kepada almamater dan profesionalisme.'
                                ];
                            @endphp
                            @foreach($fallbackMissions as $index => $mission)
                                <div class="flex items-start gap-4">
                                    <span class="w-8 h-8 rounded-xl bg-[#F59E0B]/10 text-[#F59E0B] flex items-center justify-center font-black text-sm flex-shrink-0 mt-0.5">
                                        {{ $index + 1 }}
                                    </span>
                                    <p class="text-sm md:text-base leading-relaxed" style="color: #71717A;">
                                        {{ $mission }}
                                    </p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Sambutan Kepala Sekolah Section -->
        <section id="sambutan" class="relative my-28 py-24 scroll-mt-24" style="background: #F9FAFB;">
            <div class="max-w-[1400px] mx-auto px-6 md:px-12 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                    <div class="lg:col-span-5 flex justify-center fade-up">
                        <div class="relative w-full max-w-[360px] md:max-w-[400px]">
                            <div class="bg-white p-4 rounded-[1.5rem] shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-[rgba(226,232,240,0.5)] relative overflow-hidden group">
                                <div class="aspect-[4/5] rounded-[1.25rem] overflow-hidden bg-slate-100 relative">
                                    <img alt="{{ $setting?->headmaster_name ?? 'Kepala Sekolah' }} Portrait"
                                         class="w-full h-full object-cover grayscale-[20%] img-zoom group-hover:grayscale-0"
                                          src="{{ (isset($setting->headmaster_photo) && !empty($setting->headmaster_photo)) ? Storage::url($setting->headmaster_photo) : '' }}"
                                         loading="lazy" />
                                </div>
                                <div class="mt-5 text-center">
                                    <p class="font-black text-lg" style="font-family: 'Outfit', sans-serif; color: #18181B;">{{ $setting?->headmaster_name ?? 'Drs. H. M. Zainuri, M.Si' }}</p>
                                    <p class="text-xs font-bold uppercase tracking-[0.15em] mt-1" style="color: #94A3B8;">{{ $setting?->headmaster_title ?? 'Kepala Sekolah SMA GIKI 3 Surabaya' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-7 flex flex-col items-start gap-6 fade-up">
                        <h2 class="text-3xl md:text-5xl font-black mt-1 leading-tight tracking-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                            @if($setting?->headmaster_speech_title)
                                {{ $setting->headmaster_speech_title }}
                            @else
                                Menyiapkan Generasi<br><span style="color: #F59E0B;">Unggul &amp; Berkarakter Mulia</span>
                            @endif
                        </h2>

                        <div class="relative pl-6 md:pl-10 mt-4 border-l-2 border-[#F59E0B]/30">
                            <div class="flex flex-col gap-5 text-sm md:text-base leading-relaxed text-justify" style="font-family: 'Outfit', sans-serif; font-weight: 400; color: #71717A;">
                                @if(isset($setting->headmaster_speech) && !empty($setting->headmaster_speech))
                                    @foreach(array_filter(array_map('trim', explode("\n", $setting->headmaster_speech))) as $paragraph)
                                        <p>{{ $paragraph }}</p>
                                    @endforeach
                                @else
                                    <p class="font-bold" style="color: #18181B;">Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
                                    <p>
                                        Salam sejahtera bagi kita sekalian. Selamat datang di laman resmi portal informasi SMA GIKI 3 Surabaya. Segala puji senantiasa kita panjatkan ke hadirat Allah Subhanahu Wata'ala atas limpahan rahmat, hidayah, serta kekuatan-Nya kepada kita semua.
                                    </p>
                                    <p>
                                        Sebagai institusi pendidikan, SMA GIKI 3 Surabaya mengemban tanggung jawab besar untuk mencetak generasi muda yang cerdas, kompetitif, dan berkarakter mulia. Di era disrupsi digital ini, tantangan bagi peserta didik kian kompleks. Oleh karena itu, kami merancang lingkungan sekolah yang adaptif dan kondusif, memadukan keunggulan ilmu pengetahuan modern dengan pendalaman nilai ketaqwaan serta budi pekerti yang luhur.
                                    </p>
                                    <p>
                                        Didukung oleh jajaran tenaga pendidik yang profesional dan sarana prasarana penunjang yang representatif, kami berkomitmen untuk menuntun setiap siswa mengenali minat, bakat, serta kapasitas terbaiknya demi menyongsong masa depan yang cerah dan kompetitif di kancah global.
                                    </p>
                                    <p class="font-bold" style="color: #18181B;">Wassalamu'alaikum Warahmatullahi Wabarakatuh,</p>
                                @endif
                            </div>

                            <div class="mt-8 flex flex-col items-start gap-1">
                                <div class="h-10 w-auto bg-transparent border-b border-zinc-200 pb-2 mb-2 flex items-center justify-center select-none">
                                    <span class="italic text-lg tracking-widest font-semibold" style="color: #94A3B8;">{{ $setting?->headmaster_name ?? 'Drs. H. M. Zainuri, M.Si' }}</span>
                                </div>
                                <h3 class="font-extrabold text-sm" style="color: #18181B;">{{ $setting?->headmaster_name ?? 'Drs. H. M. Zainuri, M.Si' }}</h3>
                                <p class="text-xs" style="color: #94A3B8;">{{ $setting?->headmaster_title ?? 'Kepala SMA GIKI 3 Surabaya' }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Program Keahlian / Majors Section -->
        <section id="akademik" class="max-w-[1400px] mx-auto px-6 md:px-12 my-28 scroll-mt-24">
            <div class="mb-14 fade-up flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="max-w-xl">
                    <h2 class="text-3xl md:text-5xl font-black mt-1 leading-tight tracking-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                        Pilih Jalanmu,<br><span style="color: #F59E0B;">Ukir Prestasimu</span>
                    </h2>
                </div>
                <p class="text-lg leading-relaxed max-w-md" style="font-family: 'Outfit', sans-serif; font-weight: 400; color: #71717A;">
                    Jalur peminatan kurikulum yang dirancang khusus untuk mengoptimalkan potensi akademis siswa.
                </p>
            </div>

            <div class="major-bento-grid">
                @forelse($majors as $major)
                    @php
                        $bgGradients = [
                            'linear-gradient(145deg, #18181B 0%, #27272A 100%)',
                            'linear-gradient(145deg, #1E3A5F 0%, #1A3A8F 100%)',
                            'linear-gradient(145deg, #3B1A00 0%, #92400E 100%)',
                            'linear-gradient(145deg, #1A3636 0%, #115E59 100%)',
                            'linear-gradient(145deg, #1A2F0A 0%, #3F6212 100%)',
                        ];
                        $tagColors = ['bg-blue-500/20 text-blue-300 border-blue-400/20', 'bg-zinc-500/20 text-zinc-300 border-zinc-400/20', 'bg-amber-500/20 text-amber-300 border-amber-400/20', 'bg-teal-500/20 text-teal-300 border-teal-400/20', 'bg-green-500/20 text-green-300 border-green-400/20'];
                        $bg = $bgGradients[$loop->index % count($bgGradients)];
                        $tag = $tagColors[$loop->index % count($tagColors)];
                        $isFirst = $loop->first;
                    @endphp
                    <div class="major-card {{ $isFirst ? 'major-card-featured' : '' }} fade-up">
                        <div class="major-card-inner flex flex-col justify-between p-8 md:p-10" style="background: {{ $bg }};">
                            <span class="major-num">{{ $loop->iteration }}</span>
                            <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle at 1.5px 1.5px, white 1.5px, transparent 0); background-size: 22px 22px;"></div>
                            <div class="relative z-10 flex items-start justify-between gap-4">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-white/10 border border-white/15 backdrop-blur-sm flex-shrink-0">
                                    @if($major->image_path)
                                        <img src="{{ Storage::url($major->image_path) }}" class="w-10 h-10 object-cover rounded-xl" alt="">
                                    @else
                                        <span class="material-symbols-outlined text-3xl text-white" style="font-variation-settings:'FILL' 1">{{ $major->icon ?: 'school' }}</span>
                                    @endif
                                </div>
                                <span class="text-xs font-bold uppercase tracking-widest border rounded-full px-3 py-1 {{ $tag }}">Peminatan</span>
                            </div>
                            <div class="relative z-10 mt-auto pt-6">
                                <h3 class="font-black text-white leading-tight mb-3 {{ $isFirst ? 'text-2xl md:text-3xl' : 'text-xl' }}">{{ $major->name }}</h3>
                                <p class="text-white/60 text-sm leading-relaxed {{ $isFirst ? 'line-clamp-3' : 'line-clamp-2' }}">{{ $major->description ?? 'Deskripsi kurikulum peminatan belum tersedia.' }}</p>
                                <a href="#contact" class="mt-5 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-white/50 hover:text-white transition-colors group/lnk">
                                    Pelajari Program
                                    <span class="material-symbols-outlined text-base group-hover/lnk:translate-x-1 transition-transform">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    @php
                        $fallbackMajors = [
                            ['name' => 'MIPA', 'icon' => 'science', 'desc' => 'Fokus pada pengembangan nalar saintifik melalui pendalaman ilmu matematika, fisika, kimia, dan biologi.', 'bg' => 'linear-gradient(145deg, #18181B 0%, #27272A 100%)', 'tag' => 'bg-blue-500/20 text-blue-300 border-blue-400/20'],
                            ['name' => 'IPS', 'icon' => 'public', 'desc' => 'Mempelajari interaksi kemanusiaan, ekonomi kreatif, sosiologi praktis, serta sejarah.', 'bg' => 'linear-gradient(145deg, #1E3A5F 0%, #1A3A8F 100%)', 'tag' => 'bg-zinc-500/20 text-zinc-300 border-zinc-400/20'],
                            ['name' => 'Bahasa & Budaya', 'icon' => 'translate', 'desc' => 'Mengasah kemampuan komunikasi multinasional, sastra kreatif, serta kajian budaya.', 'bg' => 'linear-gradient(145deg, #3B1A00 0%, #92400E 100%)', 'tag' => 'bg-amber-500/20 text-amber-300 border-amber-400/20'],
                        ];
                    @endphp
                    @foreach($fallbackMajors as $idx => $major)
                        <div class="major-card {{ $idx === 0 ? 'major-card-featured' : '' }} fade-up">
                            <div class="major-card-inner flex flex-col justify-between p-8 md:p-10" style="background: {{ $major['bg'] }};">
                                <span class="major-num">{{ $idx + 1 }}</span>
                                <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle at 1.5px 1.5px, white 1.5px, transparent 0); background-size: 22px 22px;"></div>
                                <div class="relative z-10 flex items-start justify-between gap-4">
                                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-white/10 border border-white/15">
                                        <span class="material-symbols-outlined text-3xl text-white" style="font-variation-settings:'FILL' 1">{{ $major['icon'] }}</span>
                                    </div>
                                    <span class="text-xs font-bold uppercase tracking-widest border rounded-full px-3 py-1 {{ $major['tag'] }}">Peminatan</span>
                                </div>
                                <div class="relative z-10 mt-auto pt-6">
                                    <h3 class="font-black text-white leading-tight mb-3 {{ $idx === 0 ? 'text-2xl md:text-3xl' : 'text-xl' }}">{{ $major['name'] }}</h3>
                                    <p class="text-white/60 text-sm leading-relaxed">{{ $major['desc'] }}</p>
                                    <a href="#contact" class="mt-5 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-white/50 hover:text-white transition-colors group/lnk">
                                        Pelajari Program
                                        <span class="material-symbols-outlined text-base group-hover/lnk:translate-x-1 transition-transform">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </section>

        <!-- Fasilitas Section -->
        <section id="fasilitas" class="relative my-28 scroll-mt-24">
            <div class="absolute inset-0" style="background: #F9FAFB;"></div>
            <div class="relative max-w-[1400px] mx-auto px-6 md:px-12 py-20">
                <div class="mb-16 max-w-2xl fade-up">
                    <h2 class="text-3xl md:text-5xl font-black mt-1 leading-tight tracking-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                        Fasilitas <span style="color: #F59E0B;">Kelas Dunia</span>
                    </h2>
                    <p class="leading-relaxed text-base mt-4" style="color: #71717A;">
                        Infrastruktur modern yang dirancang untuk memaksimalkan pengalaman belajar siswa setiap hari.
                    </p>
                </div>

                @php
                    $fcAccents = [
                        ['ring' => '#18181B', 'bg' => '#F4F4F5'],
                        ['ring' => '#F59E0B', 'bg' => '#FFFBEB'],
                        ['ring' => '#1A3A8F', 'bg' => '#EEF2FF'],
                        ['ring' => '#115E59', 'bg' => '#F0FDFA'],
                        ['ring' => '#71717A', 'bg' => '#F9FAFB'],
                        ['ring' => '#F59E0B', 'bg' => '#FFFBEB'],
                    ];
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @forelse($facilities as $facility)
                        @php $accent = $fcAccents[$loop->index % count($fcAccents)]; @endphp
                        <div class="fc-light-card fade-up group">
                            <div class="h-1 w-full rounded-t-[1.5rem]" style="background: {{ $accent['ring'] }};"></div>
                            <div class="p-7 flex flex-col gap-5 h-full">
                                <div class="flex items-start justify-between">
                                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-110" style="background: {{ $accent['bg'] }};">
                                        @if($facility->image_path)
                                            <img src="{{ Storage::url($facility->image_path) }}" class="w-9 h-9 object-cover rounded-xl" alt="" loading="lazy">
                                        @else
                                            <span class="material-symbols-outlined text-3xl" style="color: {{ $accent['ring'] }}; font-variation-settings:'FILL' 1">{{ $facility->icon ?: 'business' }}</span>
                                        @endif
                                    </div>
                                    <span class="text-xs font-black tracking-[0.15em] uppercase" style="color: {{ $accent['ring'] }}; opacity: 0.3;">{{ sprintf('%02d', $loop->iteration) }}</span>
                                </div>
                                <div class="flex-grow">
                                    <h3 class="font-black text-lg leading-snug mb-2" style="color: #18181B;">{{ $facility->name }}</h3>
                                    <p class="text-sm leading-relaxed line-clamp-3" style="color: #71717A;">{{ $facility->description ?? 'Fasilitas pendukung proses pembelajaran.' }}</p>
                                </div>
                                <div class="pt-4 border-t border-slate-100 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm" style="color: {{ $accent['ring'] }}">verified</span>
                                    <span class="text-xs font-semibold" style="color: {{ $accent['ring'] }}">Infrastruktur Resmi</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        @php
                            $fallbackFacilities = [
                                ['name' => 'Lab Komputer & Multimedia', 'icon' => 'computer', 'desc' => 'Komputer mutakhir terhubung internet kecepatan tinggi.'],
                                ['name' => 'Perpustakaan Literasi Digital', 'icon' => 'menu_book', 'desc' => 'Ribuan koleksi buku akademis serta portal e-journal.'],
                                ['name' => 'Lapangan Olahraga Terpadu', 'icon' => 'sports_soccer', 'desc' => 'Mendukung berbagai cabang olahraga: basket, voli, futsal.'],
                                ['name' => 'Aula & Auditorium', 'icon' => 'event_seat', 'desc' => 'Aula modern kapasitas besar untuk upacara dan seminar.'],
                                ['name' => 'Laboratorium Sains', 'icon' => 'science', 'desc' => 'Lab fisika, kimia, dan biologi lengkap.'],
                                ['name' => 'Kantin & Area Relaksasi', 'icon' => 'restaurant', 'desc' => 'Kantin bersih bergizi dan area bersantai.'],
                            ];
                        @endphp
                        @foreach($fallbackFacilities as $i => $facility)
                            @php $accent = $fcAccents[$i % count($fcAccents)]; @endphp
                            <div class="fc-light-card fade-up group">
                                <div class="h-1 w-full rounded-t-[1.5rem]" style="background: {{ $accent['ring'] }};"></div>
                                <div class="p-7 flex flex-col gap-5 h-full">
                                    <div class="flex items-start justify-between">
                                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-110" style="background: {{ $accent['bg'] }};">
                                            <span class="material-symbols-outlined text-3xl" style="color: {{ $accent['ring'] }}; font-variation-settings:'FILL' 1">{{ $facility['icon'] }}</span>
                                        </div>
                                        <span class="text-xs font-black tracking-[0.15em] uppercase" style="color: {{ $accent['ring'] }}; opacity: 0.3;">{{ sprintf('%02d', $i + 1) }}</span>
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="font-black text-lg leading-snug mb-2" style="color: #18181B;">{{ $facility['name'] }}</h3>
                                        <p class="text-sm leading-relaxed line-clamp-3" style="color: #71717A;">{{ $facility['desc'] }}</p>
                                    </div>
                                    <div class="pt-4 border-t border-slate-100 flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm" style="color: {{ $accent['ring'] }}">verified</span>
                                        <span class="text-xs font-semibold" style="color: {{ $accent['ring'] }}">Infrastruktur Resmi</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Ekstrakurikuler Carousel Section -->
        <section class="max-w-[1600px] mx-auto px-6 md:px-12 my-28 overflow-hidden">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 fade-up gap-6">
                <div class="max-w-2xl">
                    <h2 class="text-3xl md:text-5xl font-black mb-4 mt-1 leading-tight tracking-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                        Minat &amp; Bakat Ekstrakurikuler
                    </h2>
                    <p class="text-lg leading-relaxed" style="font-family: 'Outfit', sans-serif; font-weight: 400; color: #71717A;">
                        Kami menyediakan beragam jenis ekstrakurikuler guna mengembangkan bakat kepemimpinan, kecerdasan sosial, kreativitas seni, dan kebugaran jasmani siswa di luar kelas formal.
                    </p>
                </div>
                <div class="flex gap-3">
                    <button id="ekskul-prev-btn" class="w-12 h-12 rounded-full border border-[rgba(226,232,240,0.5)] flex items-center justify-center hover:bg-white hover:border-zinc-300 transition-all duration-300 group" style="color: #18181B;">
                        <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
                    </button>
                    <button id="ekskul-next-btn" class="w-12 h-12 rounded-full border border-[rgba(226,232,240,0.5)] flex items-center justify-center hover:bg-white hover:border-zinc-300 transition-all duration-300 group" style="color: #18181B;">
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
            </div>

            <div id="ekskul-slider" class="flex gap-6 overflow-x-auto pb-12 snap-x snap-mandatory hide-scrollbar">
                @forelse($extracurriculars as $ekskul)
                    <div class="min-w-[320px] md:min-w-[460px] h-[500px] rounded-[1.5rem] overflow-hidden relative group snap-center fade-up cursor-pointer" onclick="window.location.href='{{ route('extracurriculars.index.public') }}'">
                        @if($ekskul->image_path)
                            @if(Str::startsWith($ekskul->image_path, 'http'))
                                <img alt="{{ $ekskul->name }}" class="w-full h-full object-cover img-zoom" src="{{ $ekskul->image_path }}" loading="lazy" />
                            @else
                                <img alt="{{ $ekskul->name }}" class="w-full h-full object-cover img-zoom" src="{{ Storage::url($ekskul->image_path) }}" loading="lazy" />
                            @endif
                        @else
                            <div class="w-full h-full bg-[#18181B] flex flex-col items-center justify-center text-white">
                                <span class="material-symbols-outlined text-8xl text-white/20">{{ $ekskul->icon ?: 'sports_soccer' }}</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#18181B]/95 via-[#18181B]/45 to-transparent opacity-85 group-hover:opacity-95 transition-opacity duration-500"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-10 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <div class="w-10 h-1 bg-[#F59E0B] mb-6 rounded-full"></div>
                            <h3 class="text-2xl md:text-3xl text-white font-bold mb-4" style="font-family: 'Outfit', sans-serif;">
                                <span class="font-semibold text-xs text-[#F59E0B] mb-3 block tracking-widest uppercase">{{ $ekskul->category ?: 'Kegiatan Siswa' }}</span>
                                {{ $ekskul->name }}
                            </h3>
                            <p class="text-sm text-white/70 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100 leading-relaxed mb-4">{{ $ekskul->description }}</p>
                            @if($ekskul->pembina)
                                <p class="text-xs text-[#F59E0B] font-medium tracking-wide opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-150 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                    Pembina: {{ $ekskul->pembina }}
                                </p>
                            @endif
                        </div>
                    </div>
                @empty
                    @php
                        $fallbackEkskuls = [
                            ['name' => 'Tari Tradisional', 'cat' => 'Seni Budaya', 'desc' => 'Melestarikan warisan budaya nusantara melalui gerak tari tradisional.'],
                            ['name' => 'Klub Basket Giga', 'cat' => 'Olahraga', 'desc' => 'Membangun sportivitas, daya tahan fisik, dan kerja sama tim.'],
                            ['name' => 'Klub Robotika', 'cat' => 'Sains & Teknologi', 'desc' => 'Pengembangan algoritma program dan pembuatan alat otomatis.'],
                        ];
                    @endphp
                    @foreach($fallbackEkskuls as $ekskul)
                        <div class="min-w-[320px] md:min-w-[460px] h-[500px] rounded-[1.5rem] overflow-hidden relative group snap-center fade-up cursor-pointer">
                            <div class="w-full h-full bg-[#18181B] flex flex-col items-center justify-center text-white">
                                <span class="material-symbols-outlined text-8xl text-white/20">sports_soccer</span>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-[#18181B]/95 via-[#18181B]/45 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-10">
                                <div class="w-10 h-1 bg-[#F59E0B] mb-6 rounded-full"></div>
                                <h3 class="text-2xl md:text-3xl text-white font-bold mb-4" style="font-family: 'Outfit', sans-serif;">
                                    <span class="font-semibold text-xs text-[#F59E0B] mb-3 block tracking-widest uppercase">{{ $ekskul['cat'] }}</span>
                                    {{ $ekskul['name'] }}
                                </h3>
                                <p class="text-sm text-white/70 leading-relaxed">{{ $ekskul['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </section>

        <!-- Teachers & Staff Section -->
        @if(isset($teachers) && !$teachers->isEmpty())
            <section id="guru" class="max-w-[1400px] mx-auto px-6 md:px-12 my-28 scroll-mt-24">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 fade-up gap-6">
                    <div class="max-w-2xl">
                        <h2 class="text-3xl md:text-5xl font-black mb-4 mt-1 leading-tight tracking-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                            Staf &amp; Guru Profesional
                        </h2>
                        <p class="text-lg leading-relaxed" style="font-family: 'Outfit', sans-serif; font-weight: 400; color: #71717A;">
                            Dibimbing oleh para guru ahli di bidangnya, berdedikasi membimbing dan mengarahkan siswa mencapai puncak akademis dan kedewasaan karakter.
                        </p>
                    </div>
                    <div class="flex gap-3 items-center">
                        <a href="{{ route('teachers.index.public') }}" class="hidden sm:inline-flex items-center gap-2 px-6 py-3 rounded-full border border-zinc-200 hover:border-[#F59E0B] hover:text-[#F59E0B] font-bold transition-all duration-300 text-sm" style="color: #18181B;">
                            <span>Semua Guru & Staff</span>
                            <span class="material-symbols-outlined text-sm">open_in_new</span>
                        </a>
                        <button id="guru-prev-btn" class="w-12 h-12 rounded-full border border-[rgba(226,232,240,0.5)] flex items-center justify-center hover:bg-white hover:border-zinc-300 transition-all duration-300 group" style="color: #18181B;">
                            <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
                        </button>
                        <button id="guru-next-btn" class="w-12 h-12 rounded-full border border-[rgba(226,232,240,0.5)] flex items-center justify-center hover:bg-white hover:border-zinc-300 transition-all duration-300 group" style="color: #18181B;">
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                    </div>
                </div>

                <div id="guru-slider" class="flex gap-8 overflow-x-auto pb-10 snap-x snap-mandatory hide-scrollbar">
                    @foreach($teachers->take(5) as $teacher)
                        <div class="min-w-[260px] sm:min-w-[300px] max-w-[320px] aspect-[3/4] rounded-[1.5rem] overflow-hidden border border-[rgba(226,232,240,0.5)] snap-center flex flex-col relative fade-up group cursor-pointer">
                            <div class="absolute inset-0 w-full h-full bg-slate-100">
                                @if($teacher->photo)
                                    <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover img-zoom" loading="lazy">
                                @else
                                    <div class="w-full h-full bg-slate-100 flex flex-col items-center justify-center text-slate-400">
                                        <span class="material-symbols-outlined text-6xl">account_circle</span>
                                    </div>
                                @endif
                            </div>
                            <div class="absolute bottom-4 left-4 bg-[#18181B]/90 backdrop-blur-md px-3 py-1.5 rounded-xl transition-opacity duration-300 group-hover:opacity-0 z-10">
                                <p class="text-[10px] font-bold text-[#F59E0B] tracking-widest uppercase">{{ $teacher->isStaff ? 'STAFF' : 'GURU' }}</p>
                            </div>
                            <div class="absolute inset-0 bg-[#18181B]/80 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6 text-white z-20">
                                <span class="text-[10px] font-bold text-[#F59E0B] tracking-widest uppercase mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75">{{ $teacher->isStaff ? 'STAFF' : 'GURU' }}</span>
                                <h3 class="font-bold text-lg text-white mb-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100 line-clamp-2">{{ $teacher->name }}</h3>
                                <p class="text-xs text-slate-300 leading-relaxed transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-150 line-clamp-3">{{ $teacher->position }}</p>
                            </div>
                        </div>
                    @endforeach

                    @if($teachers->count() > 5)
                        <div class="min-w-[260px] sm:min-w-[300px] max-w-[320px] aspect-[3/4] rounded-[1.5rem] overflow-hidden border-2 border-dashed border-zinc-200 hover:border-[#F59E0B] transition-all duration-300 snap-center flex flex-col justify-center items-center p-8 text-center group cursor-pointer" onclick="window.location.href='{{ route('teachers.index.public') }}'">
                            <div class="w-16 h-16 rounded-full bg-[#F59E0B]/10 flex items-center justify-center text-[#F59E0B] mb-6 group-hover:scale-110 transition-transform duration-300">
                                <span class="material-symbols-outlined text-3xl font-bold">arrow_forward</span>
                            </div>
                            <h3 class="font-bold text-lg mb-2" style="color: #18181B;">Lihat Selengkapnya</h3>
                            <p class="text-xs leading-relaxed mb-6" style="color: #71717A;">Temukan {{ $teachers->count() - 5 }} staf & guru profesional lainnya.</p>
                            <a href="{{ route('teachers.index.public') }}" class="px-5 py-2.5 rounded-full bg-[#18181B] hover:bg-[#27272A] text-white text-xs font-bold transition-all duration-300 flex items-center gap-1.5">
                                <span>Lihat Semua</span>
                                <span class="material-symbols-outlined text-sm">open_in_new</span>
                            </a>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <!-- Gallery Section — Bento Layout -->
        @if(isset($galleries) && !$galleries->isEmpty())
            <section id="galeri" class="max-w-[1400px] mx-auto px-6 md:px-12 my-28 scroll-mt-24">
                <div class="mb-12 fade-up flex flex-col md:flex-row md:items-end justify-between gap-5">
                    <div style="max-width: 560px;">
                        <span style="font-size: 0.6875rem; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: #F59E0B; display: block; margin-bottom: 0.75rem;">Dokumentasi</span>
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-black leading-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                            Kegiatan Sekolah
                        </h2>
                    </div>
                    <p class="text-sm leading-relaxed" style="color: #71717A; max-width: 400px;">
                        Momen berharga aktivitas belajar mengajar, perayaan prestasi siswa, dan pelaksanaan program resmi sekolah.
                    </p>
                </div>

                @php
                    $featuredGallery = $galleries->first();
                    $restGalleries = $galleries->skip(1);
                @endphp

                <!-- Bento Grid: Featured (2fr) + 2 smaller (1fr each) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5">
                    {{-- Featured Gallery (Large) --}}
                    @if($featuredGallery && $featuredGallery->images->first())
                        @php $coverImage = $featuredGallery->images->first()->image_path; @endphp
                        <div class="md:col-span-2 group cursor-pointer bg-white rounded-[1.5rem] overflow-hidden border border-[rgba(226,232,240,0.5)] hover-lift transition-all duration-300 flex flex-col fade-up min-h-[420px]" onclick="openGalleryModal('{{ $featuredGallery->id }}')">
                            <div class="relative flex-grow bg-slate-100 overflow-hidden">
                                <img src="{{ Storage::url($coverImage) }}" alt="{{ $featuredGallery->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" width="800" height="400">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#18181B]/80 via-[#18181B]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400"></div>
                                <div class="absolute bottom-5 left-5 right-5 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-400 opacity-0 group-hover:opacity-100">
                                    <span class="text-white font-bold text-sm flex items-center gap-2 bg-[#F59E0B] px-4 py-2 rounded-full w-fit">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                        Lihat Galeri
                                    </span>
                                </div>
                                <div class="absolute top-4 right-4 bg-[#18181B]/70 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-xs">photo_library</span>
                                    {{ $featuredGallery->images->count() }} Foto
                                </div>
                            </div>
                            <div class="p-6">
                                <h4 class="font-bold text-xl mb-1.5 line-clamp-1 group-hover:text-[#F59E0B] transition-colors duration-200" style="color: #18181B;">{{ $featuredGallery->title }}</h4>
                                <p class="text-sm line-clamp-2 leading-relaxed" style="color: #71717A;">{{ $featuredGallery->description ?? 'Dokumentasi kegiatan resmi.' }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- 2 Smaller Galleries --}}
                    @foreach($restGalleries->take(2) as $gallery)
                        @php $coverImage = $gallery->images->first()?->image_path; @endphp
                        @if($coverImage)
                            <div class="group cursor-pointer bg-white rounded-[1.5rem] overflow-hidden border border-[rgba(226,232,240,0.5)] hover-lift transition-all duration-300 flex flex-col fade-up min-h-[420px]" onclick="openGalleryModal('{{ $gallery->id }}')">
                                <div class="relative flex-grow bg-slate-100 overflow-hidden">
                                    <img src="{{ Storage::url($coverImage) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" width="400" height="300">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#18181B]/80 via-[#18181B]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400"></div>
                                    <div class="absolute bottom-5 left-5 right-5 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-400 opacity-0 group-hover:opacity-100">
                                        <span class="text-white font-bold text-sm flex items-center gap-2 bg-[#F59E0B] px-4 py-2 rounded-full w-fit">
                                            <span class="material-symbols-outlined text-sm">visibility</span>
                                            Lihat Galeri
                                        </span>
                                    </div>
                                    <div class="absolute top-4 right-4 bg-[#18181B]/70 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-xs">photo_library</span>
                                        {{ $gallery->images->count() }} Foto
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h4 class="font-bold text-base mb-1 line-clamp-1 group-hover:text-[#F59E0B] transition-colors duration-200" style="color: #18181B;">{{ $gallery->title }}</h4>
                                    <p class="text-xs line-clamp-2 leading-relaxed" style="color: #71717A;">{{ $gallery->description ?? 'Dokumentasi kegiatan resmi.' }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- Remaining Galleries Row (if more than 3) --}}
                @if($restGalleries->count() > 2)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                        @foreach($restGalleries->skip(2) as $gallery)
                            @php $coverImage = $gallery->images->first()?->image_path; @endphp
                            @if($coverImage)
                                <div class="group cursor-pointer bg-white rounded-[1.25rem] overflow-hidden border border-[rgba(226,232,240,0.5)] hover-lift transition-all duration-300 flex flex-col fade-up" onclick="openGalleryModal('{{ $gallery->id }}')">
                                    <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                                        <img src="{{ Storage::url($coverImage) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" width="400" height="300">
                                        <div class="absolute inset-0 bg-[#18181B]/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <span class="text-white font-bold text-xs flex items-center gap-1.5 bg-[#F59E0B]/90 px-4 py-2 rounded-full transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                                <span class="material-symbols-outlined text-sm">visibility</span>
                                                Lihat Foto
                                            </span>
                                        </div>
                                        <div class="absolute top-3 right-3 bg-[#18181B]/70 backdrop-blur-md text-white text-[9px] font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[10px]">photo_library</span>
                                            {{ $gallery->images->count() }}
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-bold text-sm mb-1 line-clamp-1 group-hover:text-[#F59E0B] transition-colors duration-200" style="color: #18181B;">{{ $gallery->title }}</h4>
                                        <p class="text-xs line-clamp-1" style="color: #71717A;">{{ $gallery->description ?? 'Dokumentasi kegiatan.' }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                @foreach($galleries as $gallery)
                    <div id="gallery-modal-{{ $gallery->id }}" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-6 bg-[#18181B]/80 backdrop-blur-md opacity-0 transition-opacity duration-300">
                        <div class="bg-white rounded-[1.5rem] w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col shadow-2xl transform scale-95 transition-transform duration-300">
                            <div class="px-6 py-5 border-b border-[rgba(226,232,240,0.5)] flex justify-between items-center bg-slate-50">
                                <div>
                                    <h3 class="font-bold text-xl" style="color: #18181B;">{{ $gallery->title }}</h3>
                                    <p class="text-xs mt-1" style="color: #71717A;">Dokumentasi Kegiatan &bull; {{ $gallery->images->count() }} Foto</p>
                                </div>
                                <button onclick="closeGalleryModal('{{ $gallery->id }}')" class="w-10 h-10 rounded-full hover:bg-slate-200 flex items-center justify-center transition focus:outline-none" style="color: #18181B;">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </div>
                            <div class="p-6 md:p-8 overflow-y-auto flex-grow">
                                @if($gallery->description)
                                    <p class="text-sm md:text-base mb-6 leading-relaxed border-l-4 border-[#F59E0B] pl-4" style="color: #71717A;">{{ $gallery->description }}</p>
                                @endif
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 md:gap-6">
                                    @foreach($gallery->images as $index => $image)
                                        <div class="relative aspect-square rounded-2xl overflow-hidden cursor-pointer group shadow-sm hover:shadow-md transition" onclick="openLightbox('{{ $gallery->id }}', {{ $index }})">
                                            <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover img-zoom" loading="lazy">
                                            <div class="absolute inset-0 bg-black/25 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-white text-3xl">zoom_in</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div id="gallery-lightbox" class="fixed inset-0 z-[110] hidden flex flex-col items-center justify-center bg-black/95 transition-opacity duration-300 opacity-0 select-none">
                    <button onclick="closeLightbox()" class="absolute top-6 right-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md focus:outline-none">
                        <span class="material-symbols-outlined text-2xl">close</span>
                    </button>
                    <button onclick="prevLightboxImage()" class="absolute left-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md focus:outline-none">
                        <span class="material-symbols-outlined text-2xl">arrow_back_ios_new</span>
                    </button>
                    <button onclick="nextLightboxImage()" class="absolute right-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md focus:outline-none">
                        <span class="material-symbols-outlined text-2xl">arrow_forward_ios</span>
                    </button>
                    <div class="w-full max-w-4xl max-h-[80vh] px-4 flex items-center justify-center">
                        <img id="lightbox-img" src="" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl transition-transform duration-300 transform scale-95">
                    </div>
                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-center text-white px-6 py-3 bg-white/5 border border-white/10 rounded-full backdrop-blur-md max-w-md w-[90%]">
                        <p id="lightbox-caption" class="text-sm font-semibold truncate"></p>
                        <p id="lightbox-counter" class="text-[10px] text-white/60 mt-0.5 font-bold uppercase tracking-wider"></p>
                    </div>
                </div>
            </section>
        @endif

        <!-- Testimonials Section -->
        @if(isset($testimonials) && !$testimonials->isEmpty())
            <section id="testimoni" class="max-w-[1400px] mx-auto px-6 md:px-12 my-28 scroll-mt-24">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6 fade-up">
                    <div class="max-w-2xl">
                        <h2 class="text-3xl md:text-5xl font-black mb-4 mt-1 leading-tight tracking-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                            Kata Alumni &amp; Orang Tua
                        </h2>
                        <p class="text-lg leading-relaxed" style="font-family: 'Outfit', sans-serif; font-weight: 400; color: #71717A;">
                            Kisah sukses, kesan, serta pesan tulus dari siswa-siswi, alumni, guru, dan para orang tua yang memercayakan pendidikannya di SMA GIKI 3 Surabaya.
                        </p>
                    </div>
                    @if($testimonials->count() > 1)
                        <div class="flex gap-3">
                            <button id="testi-prev-btn" class="w-12 h-12 rounded-full border border-[rgba(226,232,240,0.5)] flex items-center justify-center hover:bg-white hover:border-zinc-300 transition-all duration-300 group" style="color: #18181B;">
                                <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
                            </button>
                            <button id="testi-next-btn" class="w-12 h-12 rounded-full border border-[rgba(226,232,240,0.5)] flex items-center justify-center hover:bg-white hover:border-zinc-300 transition-all duration-300 group" style="color: #18181B;">
                                <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="relative overflow-hidden py-4">
                    <div id="testi-slider" class="flex gap-8 transition-transform duration-500 ease-in-out snap-x snap-mandatory hide-scrollbar overflow-x-auto">
                        @foreach($testimonials as $testimonial)
                            <div class="testi-card min-w-[285px] sm:min-w-[380px] md:min-w-[420px] max-w-[450px] bg-white rounded-[1.5rem] p-8 border border-[rgba(226,232,240,0.5)] hover-lift snap-center flex flex-col justify-between relative group">
                                <div>
                                    @if($testimonial->rating)
                                        <div class="flex items-center gap-1 mb-6">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-[#F59E0B] fill-current' : 'text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.907c.961 0 1.36 1.238.588 1.81l-3.97 2.883a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.971-2.883a1 1 0 00-1.18 0l-3.97 2.883c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118L2.98 9.42c-.771-.572-.372-1.81.588-1.81h4.906a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    @endif
                                    <p class="leading-relaxed italic mb-8 relative z-10 text-sm md:text-base" style="color: #71717A;">
                                        "{{ $testimonial->content }}"
                                    </p>
                                </div>
                                <div class="flex items-center gap-4 mt-auto border-t border-slate-50 pt-6">
                                    <div class="w-12 h-12 rounded-full overflow-hidden border border-slate-100 flex-shrink-0 bg-slate-50 flex items-center justify-center font-bold" style="color: #18181B;">
                                        @if($testimonial->avatar)
                                            <img src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover" loading="lazy">
                                        @else
                                            <span class="text-sm uppercase">{{ substr($testimonial->name ?? '', 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-base" style="color: #18181B;">{{ $testimonial->name }}</h4>
                                        <p class="text-[10px] text-[#F59E0B] font-bold tracking-widest uppercase mt-0.5">{{ $testimonial->relationship }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-8 text-center fade-up">
                    <a href="{{ route('testimonials.create.public') }}" class="inline-flex items-center gap-2 bg-[#F59E0B]/10 hover:bg-[#F59E0B]/20 text-[#F59E0B] font-bold px-6 py-3 rounded-full text-sm transition duration-300">
                        <span class="material-symbols-outlined text-base">rate_review</span>
                        Tulis Testimoni Anda
                    </a>
                </div>
            </section>
        @endif

        <!-- News & Articles Section -->
        <section id="berita" class="max-w-[1400px] mx-auto px-6 md:px-12 my-28 scroll-mt-24">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b-2 border-[rgba(226,232,240,0.5)] pb-6 fade-up gap-6">
                <div>
                    <h2 class="text-3xl md:text-5xl font-black mt-1 leading-tight tracking-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                        Berita &amp; Artikel Terbaru
                    </h2>
                </div>
                <a class="hidden md:inline-flex items-center gap-2 font-bold text-sm hover:text-[#F59E0B] transition-colors group mb-2" style="color: #18181B;" href="{{ route('articles.index') }}">
                    Lihat Semua Berita
                    <span class="material-symbols-outlined transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
            @if($articles->isEmpty())
                <div class="bg-white rounded-[1.5rem] p-16 text-center border border-[rgba(226,232,240,0.5)] flex flex-col items-center justify-center w-full fade-up">
                    <span class="material-symbols-outlined text-5xl text-slate-300 mb-4">newspaper</span>
                    <h3 class="text-lg font-bold" style="color: #71717A;">Belum ada berita terbaru</h3>
                    <p class="text-sm mt-1" style="color: #94A3B8;">Nantikan pembaruan informasi menarik dari kami segera.</p>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 w-full">
                    @php $featured = $articles->first(); @endphp
                    <div class="lg:col-span-6 group cursor-pointer fade-up">
                        <a href="{{ route('articles.show', $featured->slug) }}">
                            <div class="w-full h-80 rounded-[1.5rem] overflow-hidden mb-6 relative bg-slate-100">
                                @if($featured->thumbnail)
                                    <img alt="{{ $featured->title }}" class="w-full h-full object-cover img-zoom" src="{{ Storage::url($featured->thumbnail) }}" loading="lazy" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-[#18181B] text-white/30">
                                        <span class="material-symbols-outlined text-5xl">image</span>
                                    </div>
                                @endif
                                <div class="absolute top-6 left-6">
                                    <span class="bg-[#F59E0B] text-white font-bold px-4 py-2 rounded-full text-xs tracking-wider uppercase">Sorotan Utama</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 mb-4 text-xs font-semibold" style="color: #71717A;">
                                <span class="text-[#F59E0B] tracking-wide uppercase">{{ $featured->published_at ? $featured->published_at->format('d M Y') : $featured->created_at->format('d M Y') }}</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-zinc-300"></span>
                                <span class="uppercase tracking-wider">Oleh Admin</span>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-black mb-4 group-hover:text-[#F59E0B] transition-colors line-clamp-2 leading-snug" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                                {{ $featured->title }}
                            </h3>
                            <p class="line-clamp-3 text-sm leading-relaxed mb-4" style="color: #71717A;">
                                {{ $featured->meta_description ?: strip_tags($featured->content) }}
                            </p>
                            <span class="inline-flex items-center gap-2 text-sm font-bold text-[#F59E0B]">
                                Baca Selengkapnya <span class="material-symbols-outlined text-sm transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </span>
                        </a>
                    </div>
                    <div class="lg:col-span-6 flex flex-col gap-8 fade-up">
                        @foreach($articles->skip(1) as $item)
                            <div class="group cursor-pointer grid grid-cols-1 sm:grid-cols-4 gap-6 items-center">
                                <a href="{{ route('articles.show', $item->slug) }}" class="sm:col-span-1 h-28 rounded-2xl overflow-hidden bg-slate-100 relative block">
                                    @if($item->thumbnail)
                                        <img alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ Storage::url($item->thumbnail) }}" loading="lazy" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400">
                                            <span class="material-symbols-outlined text-3xl">image</span>
                                        </div>
                                    @endif
                                </a>
                                <div class="sm:col-span-3">
                                    <a href="{{ route('articles.show', $item->slug) }}">
                                        <div class="flex items-center gap-3 mb-2 text-xs font-semibold">
                                            <span class="text-[#F59E0B] uppercase tracking-wider">Artikel</span>
                                            <span class="text-xs" style="color: #94A3B8;">&bull;</span>
                                            <span style="color: #71717A;">{{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}</span>
                                        </div>
                                        <h3 class="text-base md:text-lg font-bold mb-2 group-hover:text-[#F59E0B] transition-colors line-clamp-2 leading-snug" style="color: #18181B;">
                                            {{ $item->title }}
                                        </h3>
                                        <p class="text-sm line-clamp-2 leading-relaxed" style="color: #71717A;">
                                            {{ $item->meta_description ?: strip_tags($item->content) }}
                                        </p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <a class="md:hidden inline-flex items-center gap-2 font-bold text-sm hover:text-[#F59E0B] transition-colors group mt-8 fade-up" style="color: #18181B;" href="{{ route('articles.index') }}">
                Lihat Semua Berita
                <span class="material-symbols-outlined transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </a>
        </section>

        <!-- CTA Band -->
        <div class="cta-band mx-6 md:mx-12 rounded-[1.5rem] my-24 px-8 md:px-16 py-14 flex flex-col md:flex-row items-center justify-between gap-8 relative z-10 max-w-[1400px] xl:mx-auto">
            <div class="max-w-xl text-center md:text-left">
                <h3 class="text-2xl md:text-3xl font-black text-white leading-snug mb-3" style="font-family: 'Outfit', sans-serif;">
                    Bergabunglah Bersama Keluarga Besar <span class="text-[#F59E0B]">SMA GIKI 3</span>
                </h3>
                <p class="text-white/60 text-sm leading-relaxed mt-2">Wujudkan masa depan gemilang bersama kami. Pendaftaran siswa baru sudah dibuka.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 flex-shrink-0">
                <a href="https://wa.me/6281381881594" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 bg-[#F59E0B] hover:bg-[#D97706] text-white font-bold px-8 py-4 rounded-full transition-all duration-300 text-sm tracking-wide active:scale-95">
                    <span class="material-symbols-outlined text-base">edit_note</span>
                    Daftar Sekarang
                </a>
                <a href="#contact" class="flex items-center justify-center gap-2 bg-white/10 hover:bg-white/15 text-white border border-white/15 font-bold px-8 py-4 rounded-full transition-all duration-300 text-sm">
                    <span class="material-symbols-outlined text-base">info</span>
                    Informasi Lebih
                </a>
            </div>
        </div>

        <!-- Contact Section -->
        <section id="contact" class="max-w-[1400px] mx-auto px-6 md:px-12 my-32 scroll-mt-24">
            <div class="mb-16 max-w-3xl mx-auto fade-up">
                <h2 class="text-3xl md:text-5xl font-black mb-6 mt-1 leading-tight tracking-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                    Mulai Percakapan Baru
                </h2>
                <p class="text-lg leading-relaxed" style="font-family: 'Outfit', sans-serif; font-weight: 400; color: #71717A;">
                    Ada pertanyaan atau butuh informasi lebih lanjut mengenai pendaftaran, program sekolah, maupun kerja sama? Kirimkan pesan Anda melalui formulir di bawah ini.
                </p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 flex flex-col justify-between gap-8 h-full fade-up">
                    <div class="bg-white rounded-[1.5rem] p-8 border border-[rgba(226,232,240,0.5)] flex flex-col gap-6 flex-grow">
                        <h3 class="font-bold text-xl mb-2" style="color: #18181B;">Informasi Kontak</h3>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-[#F59E0B]/10 text-[#F59E0B] flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined">location_on</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm mb-1" style="color: #18181B;">Alamat Sekolah</h4>
                                <p class="text-sm leading-relaxed" style="color: #71717A;">{{ $setting?->address ?? 'Jl. Klampis Jaya No. 11, Klampis Ngasem, Kec. Sukolilo, Surabaya, Jawa Timur 60117' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-[#F59E0B]/10 text-[#F59E0B] flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined">phone</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm mb-1" style="color: #18181B;">Nomor Telepon</h4>
                                <p class="text-sm leading-relaxed" style="color: #71717A;">{{ $setting?->phone ?? '031-5996405' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-[#F59E0B]/10 text-[#F59E0B] flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined">mail</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm mb-1" style="color: #18181B;">Email Resmi</h4>
                                <p class="text-sm leading-relaxed" style="color: #71717A;">{{ $setting?->email ?? 'info@smagiki3surabaya.sch.id' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-[1.5rem] overflow-hidden border border-[rgba(226,232,240,0.5)] h-64 relative bg-slate-100">
                        <iframe src="{{ ($setting->maps_embed && str_starts_with($setting->maps_embed, 'https://www.google.com/maps/embed')) ? $setting->maps_embed : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5746977797746!2d112.7758784!3d-7.289139399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa6874ca7f79%3A0x6b6c0c29f44ee7bb!2sSMA%20GIKI%203%20Surabaya!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid' }}" class="w-full h-full border-0 absolute inset-0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="lg:col-span-7 bg-white rounded-[1.5rem] p-8 md:p-10 border border-[rgba(226,232,240,0.5)] relative overflow-hidden fade-up">
                    <h3 class="font-bold text-xl mb-6 relative z-10" style="color: #18181B;">Kirim Masukan atau Pertanyaan</h3>
                    <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="space-y-6 relative z-10">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label for="name" class="text-xs font-bold uppercase tracking-wider" style="color: #18181B;">Nama Lengkap</label>
                                <input type="text" id="name" name="name" required placeholder="Contoh: Budi Santoso" class="w-full px-5 py-3 rounded-2xl border border-zinc-200 focus:border-[#F59E0B] focus:ring-1 focus:ring-[#F59E0B] text-sm bg-white shadow-sm transition outline-none" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="email" class="text-xs font-bold uppercase tracking-wider" style="color: #18181B;">Alamat Email</label>
                                <input type="email" id="email" name="email" required placeholder="budi@example.com" class="w-full px-5 py-3 rounded-2xl border border-zinc-200 focus:border-[#F59E0B] focus:ring-1 focus:ring-[#F59E0B] text-sm bg-white shadow-sm transition outline-none" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="subject" class="text-xs font-bold uppercase tracking-wider" style="color: #18181B;">Subjek Pesan</label>
                            <input type="text" id="subject" name="subject" required placeholder="Contoh: Informasi Pendaftaran" class="w-full px-5 py-3 rounded-2xl border border-zinc-200 focus:border-[#F59E0B] focus:ring-1 focus:ring-[#F59E0B] text-sm bg-white shadow-sm transition outline-none" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="message" class="text-xs font-bold uppercase tracking-wider" style="color: #18181B;">Isi Pesan Anda</label>
                            <textarea id="message" name="message" rows="5" required placeholder="Tuliskan pesan Anda secara lengkap di sini..." class="w-full px-5 py-4 rounded-2xl border border-zinc-200 focus:border-[#F59E0B] focus:ring-1 focus:ring-[#F59E0B] text-sm bg-white shadow-sm transition outline-none resize-none"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-[#18181B] hover:bg-[#27272A] text-white font-bold py-4 rounded-full flex items-center justify-center gap-3.5 tracking-wide transition-all duration-300 active:scale-95">
                            <span class="btn-text">Kirim Pesan</span>
                            <svg class="spinner hidden animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="material-symbols-outlined text-xl">send</span>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const lenis = new Lenis({ autoRaf: false, duration: 1.2, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), direction: 'vertical', gestureDirection: 'vertical', smoothWheel: true, wheelMultiplier: 1, touchMultiplier: 2, infinite: false });
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => { lenis.raf(time * 1000); });
    gsap.ticker.lagSmoothing(0);
    window.lenis = lenis;

    document.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        if (!link) return;
        let href = link.getAttribute('href');
        if (!href) return;
        let targetId = '';
        const currentPath = window.location.pathname;
        const isHomePage = currentPath === '/' || currentPath === '' || currentPath.endsWith('/index.php');
        if (href.startsWith('#')) { targetId = href; }
        else if (href === '/' || href === window.location.origin + '/' || href === window.location.origin) { if (isHomePage) targetId = 'body'; }
        else if (href.includes('#')) { const url = new URL(link.href, window.location.href); if (url.pathname === currentPath || (url.pathname === '/' && isHomePage)) { targetId = '#' + href.split('#')[1]; } }
        if (targetId) {
            e.preventDefault();
            const mobileDropdown = document.getElementById('mobileDropdown');
            const mobileMenuIcon = document.getElementById('mobileMenuIcon');
            if (mobileDropdown && mobileDropdown.classList.contains('open')) { mobileDropdown.classList.remove('open'); if (mobileMenuIcon) mobileMenuIcon.innerText = 'menu'; }
            if (targetId === 'body') { lenis.scrollTo(0, { duration: 1.2 }); }
            else { const targetEl = document.querySelector(targetId); if (targetEl) lenis.scrollTo(targetEl, { offset: -80, duration: 1.2 }); }
        }
    });

    gsap.registerPlugin(ScrollTrigger);
    gsap.set('.fade-up', { transition: 'none' });

    gsap.utils.toArray('.fade-up').forEach((el) => {
        const hasCounters = el.querySelectorAll('.counter-value').length > 0;
        const isCounterValue = el.classList.contains('counter-value');
        gsap.fromTo(el, { opacity: 0, y: 35 }, {
            opacity: 1, y: 0, duration: 1.1, ease: 'power3.out',
            scrollTrigger: { trigger: el, start: 'top 88%', toggleActions: 'play none none none',
                onEnter: () => {
                    if (hasCounters) { el.querySelectorAll('.counter-value').forEach(counter => { if (!counter.classList.contains('counted')) { animateCounterGSAP(counter); counter.classList.add('counted'); } }); }
                    if (isCounterValue && !el.classList.contains('counted')) { animateCounterGSAP(el); el.classList.add('counted'); }
                }
            }
        });
    });

    function animateCounterGSAP(el) {
        const target = parseInt(el.getAttribute('data-target'));
        if (isNaN(target)) return;
        const countObj = { val: 0 };
        gsap.to(countObj, { val: target, duration: 2.2, ease: 'power3.out', onUpdate: () => { el.innerText = Math.floor(countObj.val); }, onComplete: () => { el.innerText = target; } });
    }

    const welcomeSlides = document.querySelectorAll('.welcome-slide');
    const welcomeDots = document.querySelectorAll('.welcome-dot');
    const welcomePrevBtn = document.getElementById('welcome-prev-btn');
    const welcomeNextBtn = document.getElementById('welcome-next-btn');
    if (welcomeSlides.length > 0) {
        let currentWelcomeSlide = 0, welcomeSlideInterval;
        function showWelcomeSlide(index) {
            if (index >= welcomeSlides.length) currentWelcomeSlide = 0; else if (index < 0) currentWelcomeSlide = welcomeSlides.length - 1; else currentWelcomeSlide = index;
            welcomeSlides.forEach(slide => { const img = slide.querySelector('img'); const text = slide.querySelector('.transform'); slide.classList.remove('opacity-100', 'z-10'); slide.classList.add('opacity-0', 'z-0'); if (img) { img.classList.remove('scale-105'); img.classList.add('scale-100'); } if (text) { text.classList.remove('translate-y-0', 'opacity-100'); text.classList.add('translate-y-8', 'opacity-0'); } });
            if (welcomeDots.length > 0) { welcomeDots.forEach(dot => { dot.classList.remove('bg-white', 'w-6'); dot.classList.add('bg-white/30'); }); welcomeDots[currentWelcomeSlide].classList.remove('bg-white/30'); welcomeDots[currentWelcomeSlide].classList.add('bg-white', 'w-6'); }
            const activeSlide = welcomeSlides[currentWelcomeSlide]; activeSlide.classList.remove('opacity-0', 'z-0'); activeSlide.classList.add('opacity-100', 'z-10');
            setTimeout(() => { const activeImg = activeSlide.querySelector('img'); const activeText = activeSlide.querySelector('.transform'); if (activeImg) { activeImg.classList.remove('scale-100'); activeImg.classList.add('scale-105'); } if (activeText) { activeText.classList.remove('translate-y-8', 'opacity-0'); activeText.classList.add('translate-y-0', 'opacity-100'); } }, 50);
        }
        function nextWelcomeSlide() { showWelcomeSlide(currentWelcomeSlide + 1); }
        function prevWelcomeSlide() { showWelcomeSlide(currentWelcomeSlide - 1); }
        function startWelcomeAutoSlide() { if (welcomeSlides.length <= 1) return; stopWelcomeAutoSlide(); welcomeSlideInterval = setInterval(nextWelcomeSlide, 6000); }
        function stopWelcomeAutoSlide() { clearInterval(welcomeSlideInterval); }
        showWelcomeSlide(0); startWelcomeAutoSlide();
        if (welcomeNextBtn) welcomeNextBtn.addEventListener('click', () => { nextWelcomeSlide(); startWelcomeAutoSlide(); });
        if (welcomePrevBtn) welcomePrevBtn.addEventListener('click', () => { prevWelcomeSlide(); startWelcomeAutoSlide(); });
        if (welcomeDots.length > 0) welcomeDots.forEach(dot => { dot.addEventListener('click', () => { showWelcomeSlide(parseInt(dot.getAttribute('data-slide-index'))); startWelcomeAutoSlide(); }); });
    }

    let activeGalleryId = null, activeImages = [], currentLightboxIndex = 0;
    const galleryData = { @if(isset($galleries)) @foreach($galleries as $gallery) '{{ $gallery->id }}': { title: @json($gallery->title), images: [ @foreach($gallery->images as $image) @json(Storage::url($image->image_path)), @endforeach ] }, @endforeach @endif };

    window.openGalleryModal = function(id) { const modal = document.getElementById('gallery-modal-' + id); if (!modal) return; modal.classList.remove('hidden'); modal.classList.add('flex'); modal.offsetHeight; modal.classList.remove('opacity-0'); modal.querySelector('.transform').classList.remove('scale-95'); document.body.classList.add('overflow-hidden'); };
    window.closeGalleryModal = function(id) { const modal = document.getElementById('gallery-modal-' + id); if (!modal) return; modal.classList.add('opacity-0'); modal.querySelector('.transform').classList.add('scale-95'); setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); document.body.classList.remove('overflow-hidden'); }, 300); };
    window.openLightbox = function(galleryId, index) { activeGalleryId = galleryId; if (!galleryData[galleryId] || !galleryData[galleryId].images) return; activeImages = galleryData[galleryId].images; currentLightboxIndex = index; const lightbox = document.getElementById('gallery-lightbox'); const img = document.getElementById('lightbox-img'); const caption = document.getElementById('lightbox-caption'); const counter = document.getElementById('lightbox-counter'); img.src = activeImages[currentLightboxIndex]; caption.innerText = galleryData[galleryId].title; counter.innerText = 'Foto ' + (currentLightboxIndex + 1) + ' dari ' + activeImages.length; lightbox.classList.remove('hidden'); lightbox.classList.add('flex'); lightbox.offsetHeight; lightbox.classList.remove('opacity-0'); img.classList.remove('scale-95'); };
    window.closeLightbox = function() { const lightbox = document.getElementById('gallery-lightbox'); const img = document.getElementById('lightbox-img'); lightbox.classList.add('opacity-0'); img.classList.add('scale-95'); setTimeout(() => { lightbox.classList.add('hidden'); lightbox.classList.remove('flex'); }, 300); };
    window.nextLightboxImage = function() { if (activeImages.length <= 1) return; currentLightboxIndex = (currentLightboxIndex + 1) % activeImages.length; const img = document.getElementById('lightbox-img'); const counter = document.getElementById('lightbox-counter'); img.classList.add('scale-95', 'opacity-0'); setTimeout(() => { img.src = activeImages[currentLightboxIndex]; counter.innerText = 'Foto ' + (currentLightboxIndex + 1) + ' dari ' + activeImages.length; img.classList.remove('scale-95', 'opacity-0'); }, 150); };
    window.prevLightboxImage = function() { if (activeImages.length <= 1) return; currentLightboxIndex = (currentLightboxIndex - 1 + activeImages.length) % activeImages.length; const img = document.getElementById('lightbox-img'); const counter = document.getElementById('lightbox-counter'); img.classList.add('scale-95', 'opacity-0'); setTimeout(() => { img.src = activeImages[currentLightboxIndex]; counter.innerText = 'Foto ' + (currentLightboxIndex + 1) + ' dari ' + activeImages.length; img.classList.remove('scale-95', 'opacity-0'); }, 150); };

    document.addEventListener('keydown', (e) => { const lightbox = document.getElementById('gallery-lightbox'); if (lightbox && !lightbox.classList.contains('hidden')) { if (e.key === 'Escape') closeLightbox(); else if (e.key === 'ArrowRight') nextLightboxImage(); else if (e.key === 'ArrowLeft') prevLightboxImage(); } });

    const lightboxEl = document.getElementById('gallery-lightbox');
    if (lightboxEl) { let touchStartX = 0; lightboxEl.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; }, { passive: true }); lightboxEl.addEventListener('touchend', (e) => { const dx = e.changedTouches[0].screenX - touchStartX; if (Math.abs(dx) > 50) { if (dx < 0) nextLightboxImage(); else prevLightboxImage(); } }, { passive: true }); }

    const testiSlider = document.getElementById('testi-slider'), testiPrevBtn = document.getElementById('testi-prev-btn'), testiNextBtn = document.getElementById('testi-next-btn');
    if (testiSlider) { if (testiNextBtn) testiNextBtn.addEventListener('click', () => { testiSlider.scrollBy({ left: 450, behavior: 'smooth' }); }); if (testiPrevBtn) testiPrevBtn.addEventListener('click', () => { testiSlider.scrollBy({ left: -450, behavior: 'smooth' }); }); }
    const ekskulSlider = document.getElementById('ekskul-slider'), ekskulPrevBtn = document.getElementById('ekskul-prev-btn'), ekskulNextBtn = document.getElementById('ekskul-next-btn');
    if (ekskulSlider) { if (ekskulNextBtn) ekskulNextBtn.addEventListener('click', () => { ekskulSlider.scrollBy({ left: 500, behavior: 'smooth' }); }); if (ekskulPrevBtn) ekskulPrevBtn.addEventListener('click', () => { ekskulSlider.scrollBy({ left: -500, behavior: 'smooth' }); }); }
    const guruSlider = document.getElementById('guru-slider'), guruPrevBtn = document.getElementById('guru-prev-btn'), guruNextBtn = document.getElementById('guru-next-btn');
    if (guruSlider) { if (guruNextBtn) guruNextBtn.addEventListener('click', () => { guruSlider.scrollBy({ left: 320, behavior: 'smooth' }); }); if (guruPrevBtn) guruPrevBtn.addEventListener('click', () => { guruSlider.scrollBy({ left: -320, behavior: 'smooth' }); }); }

    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const submitText = submitBtn.querySelector('.btn-text');
            const spinner = submitBtn.querySelector('.spinner');
            submitBtn.disabled = true;
            if (submitText) submitText.innerText = 'Mengirim...';
            if (spinner) spinner.classList.remove('hidden');
            const formData = new FormData(contactForm);
            try {
                const response = await fetch("{{ route('contact.store') }}", { method: 'POST', headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}", 'Accept': 'application/json' }, body: formData });
                const data = await response.json();
                if (response.ok && data.success) { showToast(data.message, 'success'); contactForm.reset(); } else { let errorMsg = 'Terjadi kesalahan saat memproses formulir.'; if (data.errors) { errorMsg = Object.values(data.errors).flat().join('<br>'); } showToast(errorMsg, 'error'); }
            } catch (error) { showToast('Gagal mengirim pesan. Silakan periksa koneksi internet Anda.', 'error'); }
            finally { submitBtn.disabled = false; if (submitText) submitText.innerText = 'Kirim Pesan'; if (spinner) spinner.classList.add('hidden'); }
        });
    }

    function showToast(message, type = 'success') {
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) { toastContainer = document.createElement('div'); toastContainer.id = 'toast-container'; toastContainer.className = 'fixed bottom-5 right-5 z-[200] flex flex-col gap-3 max-w-sm w-[90%] px-4'; document.body.appendChild(toastContainer); }
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-emerald-600' : 'bg-[#DC2626]';
        const icon = type === 'success' ? 'check_circle' : 'error';
        toast.className = bgColor + ' text-white px-5 py-4 rounded-2xl shadow-2xl flex items-start gap-3 transform translate-y-5 opacity-0 transition-all duration-300 backdrop-blur-md border border-white/10';
        toast.innerHTML = '<span class="material-symbols-outlined flex-shrink-0 select-none">' + icon + '</span><div class="text-sm font-semibold leading-relaxed">' + message + '</div>';
        toastContainer.appendChild(toast);
        toast.offsetHeight;
        toast.classList.remove('translate-y-5', 'opacity-0');
        setTimeout(() => { toast.classList.add('opacity-0', 'translate-y-2'); setTimeout(() => { toast.remove(); }, 300); }, 6000);
    }
});
</script>
@endsection
