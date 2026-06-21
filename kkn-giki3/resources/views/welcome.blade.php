@extends('layouts.app')

@section('styles')
<style>
    /* ── Core Keyframes ───────────────────────── */
    @keyframes float-gentle {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(0.4deg); }
    }
    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    @keyframes hero-progress {
        from { width: 0%; }
        to   { width: 100%; }
    }
    @keyframes slide-up-in {
        from { opacity: 0; transform: translateY(32px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes ping-slow {
        75%, 100% { transform: scale(1.8); opacity: 0; }
    }
    @keyframes stripe-move {
        0%   { background-position: 0 0; }
        100% { background-position: 40px 40px; }
    }

    /* ── Utility Classes ──────────────────────── */
    .animate-float   { animation: float-gentle 6s ease-in-out infinite; }
    .animate-ping-slow { animation: ping-slow 2s cubic-bezier(0, 0, 0.2, 1) infinite; }

    .gradient-gold-text {
        background: linear-gradient(135deg, #C8930A 0%, #F5D475 45%, #E5A93C 75%, #C8930A 100%);
        background-size: 250% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradient-shift 5s ease infinite;
    }

    /* ── Glass Variants ──────────────────────── */
    .glass-card-dark {
        background: rgba(15, 31, 61, 0.78);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .glass-card-light {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(15, 31, 61, 0.05);
    }

    /* ── Scrollbar ───────────────────────────── */
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    /* ── Slider ──────────────────────────────── */
    .welcome-slide {
        transition: opacity 1000ms ease-in-out, transform 1000ms ease-in-out;
    }
    /* Hero slider progress bar */
    #hero-progress-bar {
        position: absolute;
        bottom: 0; left: 0;
        height: 2px;
        background: linear-gradient(90deg, #C41E3A, #C8930A, #F5D475);
        animation: hero-progress 6s linear infinite;
        z-index: 30;
    }

    /* ── Card Interactions ───────────────────── */
    .hover-lift {
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                    box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hover-lift:hover {
        transform: translateY(-7px);
        box-shadow: 0 24px 48px -12px rgba(15, 31, 61, 0.14);
    }
    .glow-gold-hover:hover {
        box-shadow: 0 0 0 4px rgba(200, 147, 10, 0.2), 0 8px 24px rgba(200, 147, 10, 0.25);
    }

    /* ── Stripe Pattern (Principal Card) ──────── */
    .diagonal-stripe {
        background-image: repeating-linear-gradient(
            45deg,
            rgba(255,255,255,0.03) 0px,
            rgba(255,255,255,0.03) 2px,
            transparent 2px,
            transparent 20px
        );
        animation: stripe-move 8s linear infinite;
    }

    /* ── Stats Card Glow ─────────────────────── */
    .stats-icon-ring {
        position: relative;
    }
    .stats-icon-ring::after {
        content: '';
        position: absolute;
        inset: -3px;
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(200,147,10,0.3), rgba(196,30,58,0.15));
        z-index: -1;
    }

    /* ── CTA Band ────────────────────────────── */
    .cta-band {
        background: linear-gradient(135deg, #0F1F3D 0%, #1A3366 40%, #0D1B3E 100%);
        position: relative;
        overflow: hidden;
    }
    .cta-band::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: repeating-linear-gradient(
            -45deg,
            transparent,
            transparent 30px,
            rgba(200,147,10,0.03) 30px,
            rgba(200,147,10,0.03) 60px
        );
    }
</style>
@endsection

@section('content')
    <main class="overflow-hidden">
        <!-- Hero Section -->
        @if(isset($banners) && !$banners->isEmpty())
            <section class="relative min-h-[92vh] flex items-center overflow-hidden bg-slate-950 pt-20">
                <div id="hero-slider" class="absolute inset-0 w-full h-full z-0">
                    @foreach($banners as $index => $banner)
                        <div class="welcome-slide absolute inset-0 w-full h-full opacity-0 flex items-center" data-index="{{ $index }}">
                            <!-- Background Image Layer -->
                            <div class="absolute inset-0 z-0">
                                <img alt="{{ $banner->title }}"
                                    class="w-full h-full object-cover scale-100 transition-transform duration-[6000ms] ease-out"
                                    src="{{ Storage::url($banner->image_path) }}"
                                    onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');" />
                                <div class="hidden absolute inset-0 bg-slate-900 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-slate-700 text-6xl">image</span>
                                </div>
                                <div class="absolute inset-0 bg-slate-950" style="opacity: {{ ($banner->overlay_opacity ?? 60) / 100 }}"></div>
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/50 via-transparent to-transparent"></div>
                            </div>
                            
                            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop relative z-10 w-full">
                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                                    <!-- Text Content -->
                                    @php
                                        $ctaColorClasses = [
                                            'amber' => 'bg-secondary text-on-secondary hover:shadow-secondary/30 hover:bg-amber-500',
                                            'blue' => 'bg-blue-600 text-white hover:bg-blue-700 hover:shadow-blue-500/30',
                                            'emerald' => 'bg-emerald-600 text-white hover:bg-emerald-700 hover:shadow-emerald-500/30',
                                            'red' => 'bg-red-600 text-white hover:bg-red-700 hover:shadow-red-500/30',
                                            'indigo' => 'bg-indigo-600 text-white hover:bg-indigo-700 hover:shadow-indigo-500/30',
                                            'slate' => 'bg-slate-750 text-white hover:bg-slate-800 hover:shadow-slate-650/30',
                                        ][$banner->cta_color ?? 'amber'] ?? 'bg-secondary text-on-secondary hover:shadow-secondary/30 hover:bg-amber-500';

                                        $alignmentClasses = [
                                            'left' => 'lg:col-span-9 flex flex-col items-start text-left mr-auto',
                                            'center' => 'lg:col-span-10 lg:col-start-2 flex flex-col items-center text-center mx-auto',
                                            'right' => 'lg:col-span-9 lg:col-start-4 flex flex-col items-end text-right ml-auto',
                                        ][$banner->alignment ?? 'left'] ?? 'lg:col-span-9 flex flex-col items-start text-left mr-auto';
                                    @endphp
                                    
                                    <div class="{{ $alignmentClasses }} gap-6 transform translate-y-8 opacity-0 transition-all duration-1000">
                                        <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-xl px-4 py-2 rounded-full border border-white/25 shadow-lg">
                                            <span class="relative flex h-2 w-2">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2 bg-secondary"></span>
                                            </span>
                                            <span class="font-label-md text-xs text-white tracking-widest uppercase font-semibold">SMA GIKI 3 SURABAYA</span>
                                        </div>
                                        
                                        <h1 class="font-display-lg-mobile text-4xl md:text-6xl font-black leading-tight tracking-tight [text-shadow:_0_4px_24px_rgba(0,0,0,0.5)]
                                            {{ ($banner->text_color ?? 'light') === 'dark' ? 'text-slate-900' : 'text-white' }}">
                                            {{ $banner->title }}
                                        </h1>
                                        
                                        @if($banner->subtitle)
                                            <p class="font-body-lg text-body-lg md:text-xl max-w-3xl leading-relaxed [text-shadow:_0_2px_12px_rgba(0,0,0,0.4)]
                                                {{ ($banner->text_color ?? 'light') === 'dark' ? 'text-slate-700' : 'text-white/85' }}">
                                                {{ $banner->subtitle }}
                                            </p>
                                        @endif
                                        
                                        @if($banner->button_text)
                                            <div class="flex flex-wrap gap-6 mt-4">
                                                <a href="{{ $banner->button_url ?? '#' }}"
                                                    class="btn-primary font-bold text-label-md px-10 py-4.5 rounded-full shadow-xl hover:-translate-y-1 active:scale-95 transition-all duration-300 tracking-wide flex items-center gap-3.5 glow-gold-hover {{ $ctaColorClasses }}">
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
                
                <!-- Slider Controls -->
                @if($banners->count() > 1)
                    <!-- Navigation Arrows -->
                    <button id="welcome-prev-btn" class="absolute left-6 z-20 w-14 h-14 rounded-full bg-white/5 hover:bg-white/15 text-white flex items-center justify-center transition border border-white/15 focus:outline-none backdrop-blur-md hover:scale-105 active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-2xl">arrow_back_ios_new</span>
                    </button>
                    <button id="welcome-next-btn" class="absolute right-6 z-20 w-14 h-14 rounded-full bg-white/5 hover:bg-white/15 text-white flex items-center justify-center transition border border-white/15 focus:outline-none backdrop-blur-md hover:scale-105 active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-2xl">arrow_forward_ios</span>
                    </button>
                    
                    <!-- Navigation Dots -->
                    <div class="absolute bottom-16 left-1/2 -translate-x-1/2 z-20 flex space-x-3 bg-black/40 px-5 py-2.5 rounded-full border border-white/10 backdrop-blur-md">
                        @foreach($banners as $index => $banner)
                            <button class="welcome-dot w-3 h-3 rounded-full bg-white/30 hover:bg-white/60 transition-all focus:outline-none" data-slide-index="{{ $index }}"></button>
                        @endforeach
                    </div>
                @endif

                <!-- Scroll Down Indicator -->
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-25 flex flex-col items-center gap-1 opacity-70 animate-bounce pointer-events-none">
                    <span class="text-xs text-white/60 uppercase tracking-widest font-semibold">Scroll</span>
                    <span class="material-symbols-outlined text-white text-base">keyboard_arrow_down</span>
                </div>
            </section>
        @else
            <!-- Fallback Hero -->
            <section class="relative min-h-[92vh] flex items-center overflow-hidden bg-slate-950 pt-20">
                <div class="absolute inset-0 z-0">
                    <img alt="SMAN 3 Surabaya Campus"
                        class="w-full h-full object-cover brightness-[0.4] scale-105"
                        src="https://lh3.googleusercontent.com/aida/AP1WRLu4U88psAYyd4fbgc6-aLbIJ5EirwXxQ06Dng5_rolXW8Uj455wHUXt1ccq7OZ-lwZqR6BI7GuZqdLYtMtpT7V8Tiz21DZuPeo6g1aoPfmkW4XyipXAZw-3GvVjX43dui0A-6dUh7vwLyHfLw-T-gZFPvnaffjS7bAcJe8-KPT6RVhBZlmKKznSr8kl6AzgKIBHKL_KXrsRsogo_Edgqg16XzKk4CYRO6tWKFIE2jmkNEmi5Tuk_klEz1E" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                </div>
                <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop relative z-10 w-full">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                        <div class="lg:col-span-8 flex flex-col items-start gap-6">
                            <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-xl px-4 py-2 rounded-full border border-white/20 shadow-md">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-secondary"></span>
                                </span>
                                <span class="font-label-md text-xs text-white tracking-widest uppercase font-semibold">Penerimaan Siswa Baru 2026</span>
                            </div>
                            <h1 class="font-display-lg-mobile text-3xl sm:text-5xl md:text-7xl text-white leading-tight tracking-tight font-black [text-shadow:_0_4px_20px_rgba(0,0,0,0.6)]">
                                Membentuk Karakter,<br />
                                <span class="gradient-gold-text">Mengukir Prestasi</span>
                            </h1>
                            <p class="font-body-lg text-body-lg text-white/80 max-w-2xl leading-relaxed">
                                Berkomitmen pada keunggulan akademis dan pembentukan karakter mulia melalui semangat Merdeka Belajar, mencetak pemimpin masa depan yang berwawasan global.
                            </p>
                            <div class="flex flex-wrap gap-6 mt-4">
                                <a href="#profil" class="btn-primary bg-secondary text-on-secondary font-bold text-label-md px-10 py-4.5 rounded-full shadow-lg hover:shadow-secondary/40 hover:-translate-y-1 active:scale-95 transition-all duration-300 tracking-wide flex items-center gap-2">
                                    Jelajahi Profil
                                </a>
                                <a href="#contact" class="btn-primary bg-white/5 backdrop-blur-xl text-white font-bold text-label-md px-10 py-4.5 rounded-full border border-white/20 hover:bg-white/10 transition-all duration-300">
                                    Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Floating Stats Section -->
        <section class="relative z-30 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop -mt-10 mb-24">
            <div class="gradient-border rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-primary/8 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-4 relative overflow-hidden bg-white">
                <!-- Shimmer overlay -->
                <div class="absolute inset-0 shimmer-gold pointer-events-none rounded-[2.5rem]"></div>
                <!-- Decorative glows -->
                <div class="absolute -top-16 -left-16 w-56 h-56 bg-secondary/6 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-16 -right-16 w-56 h-56 bg-accent/4 rounded-full blur-3xl"></div>

                <!-- Stat 1: Akreditasi -->
                <div class="text-center relative z-10 flex flex-col items-center justify-center p-4 fade-up">
                    <div class="w-16 h-16 stats-icon-ring bg-gradient-to-br from-secondary/15 to-secondary/5 rounded-2xl flex items-center justify-center text-secondary mb-5 shadow-sm">
                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1">verified</span>
                    </div>
                    <div class="flex items-baseline gap-1 mb-2">
                        <h2 class="font-display-lg text-5xl md:text-6xl text-primary font-black tracking-tight">A</h2>
                        <span class="text-secondary font-black text-3xl">+</span>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-[0.15em] text-on-surface-variant">Akreditasi Institusi</p>
                </div>

                <!-- Divider -->
                <div class="hidden md:flex absolute left-1/3 top-1/2 -translate-y-1/2 flex-col items-center gap-1" style="height:55%">
                    <div class="flex-1 w-px bg-gradient-to-b from-transparent via-outline-variant/50 to-transparent"></div>
                </div>

                <!-- Stat 2: Siswa -->
                <div class="text-center relative z-10 flex flex-col items-center justify-center p-4 fade-up">
                    <div class="w-16 h-16 stats-icon-ring bg-gradient-to-br from-accent/12 to-accent/4 rounded-2xl flex items-center justify-center text-accent mb-5 shadow-sm">
                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1">group</span>
                    </div>
                    <div class="flex items-baseline gap-1 mb-2">
                        <h2 class="font-display-lg text-5xl md:text-6xl text-primary font-black tracking-tight counter-value" data-target="1200">0</h2>
                        <span class="text-secondary font-black text-3xl">+</span>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-[0.15em] text-on-surface-variant">Siswa Aktif</p>
                </div>

                <!-- Divider -->
                <div class="hidden md:flex absolute right-1/3 top-1/2 -translate-y-1/2 flex-col items-center" style="height:55%">
                    <div class="flex-1 w-px bg-gradient-to-b from-transparent via-outline-variant/50 to-transparent"></div>
                </div>

                <!-- Stat 3: Lulusan -->
                <div class="text-center relative z-10 flex flex-col items-center justify-center p-4 fade-up">
                    <div class="w-16 h-16 stats-icon-ring bg-gradient-to-br from-primary/12 to-primary/4 rounded-2xl flex items-center justify-center text-primary mb-5 shadow-sm">
                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1">school</span>
                    </div>
                    <div class="flex items-baseline gap-1 mb-2">
                        <h2 class="font-display-lg text-5xl md:text-6xl text-primary font-black tracking-tight counter-value" data-target="98">0</h2>
                        <span class="text-secondary font-black text-3xl">%</span>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-[0.15em] text-on-surface-variant">Lulusan ke PTN</p>
                </div>
            </div>
        </section>

        <!-- Profile & Visi Misi Section -->
        <section id="profil" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32 scroll-mt-24">
            <div class="mb-16 text-center max-w-3xl mx-auto fade-up">
                <span class="section-label">Sambutan &amp; Profil</span>
                <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary font-black mb-6 mt-1">
                    Menyalakan Api Keingintahuan
                </h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                    SMA GIKI 3 Surabaya mendidik siswa secara komprehensif, memadukan ilmu pengetahuan modern dengan nilai ketakwaan demi mewujudkan generasi yang berkepribadian mulia.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">
                <!-- Principal Card (Left column) -->
                <div class="lg:col-span-5 rounded-3xl p-8 md:p-10 flex flex-col justify-between relative overflow-hidden text-white shadow-2xl min-h-[500px] fade-up"
                     style="background: linear-gradient(145deg, #0F1F3D 0%, #1A3366 60%, #0A1830 100%);">
                    <!-- Diagonal stripe texture -->
                    <div class="diagonal-stripe absolute inset-0"></div>
                    <!-- Gold glow top-right -->
                    <div class="absolute -top-12 -right-12 w-56 h-56 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(200,147,10,0.18), transparent 70%);"></div>
                    <!-- Crimson glow bottom-left -->
                    <div class="absolute -bottom-12 -left-12 w-48 h-48 rounded-full blur-3xl" style="background: radial-gradient(circle, rgba(196,30,58,0.10), transparent 70%);"></div>
                    <!-- Top accent line -->
                    <div class="absolute top-0 left-0 right-0 h-0.5" style="background: linear-gradient(90deg, transparent, #C8930A 40%, #C41E3A 80%, transparent);"></div>

                    <div class="relative z-10 flex flex-col h-full justify-between gap-8">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-secondary/15 border border-secondary/25 flex items-center justify-center mb-6">
                                <span class="material-symbols-outlined text-secondary text-3xl" style="font-variation-settings:'FILL' 1">format_quote</span>
                            </div>
                            <p class="text-xl md:text-2xl font-semibold leading-relaxed tracking-wide text-white/90 italic">
                                "Pendidikan bukan sekadar mengisi wadah yang kosong, melainkan menyalakan api keingintahuan."
                            </p>
                        </div>

                        <div class="flex items-center gap-5 mt-auto pt-6 border-t border-white/10">
                            <div class="relative w-20 h-20 rounded-2xl overflow-hidden border-2 border-secondary/50 flex-shrink-0 animate-float shadow-lg">
                                <img alt="Kepala Sekolah Portrait"
                                    class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhXniWW-W0QWzCOpI77isbjwqCJLjUmfS5v93yUGM19K2GsljhhLqDAmXHCrT-p4HWVn2JRKDi4j-sPfcQc7u6VrC2KwAE3QAFAMZXOFQKDrpKBiO0pjwEcfm_mDgUwMl_7bwSpLvmSX5xD9CRzIXH3OLl36MhmJIp5SFO36xHOETcSMpbJg53gbUcs8u9_dynsyzWDuk6IaFEzF691bY3WO_AsP_Y9xeb2zIeIIYAVH2ixK7ZMv7oJG8vYBR-4imDPYPtncQ_e_dB"
                                    loading="lazy" />
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-white">Drs. H. M. Zainuri, M.Si</h4>
                                <p class="text-xs text-secondary font-bold uppercase tracking-[0.12em] mt-0.5">Kepala Sekolah</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vision Mission Content (Right column) -->
                <div class="lg:col-span-7 flex flex-col justify-between gap-8 fade-up">
                    <!-- Visi Card -->
                    <div class="glass-card-light rounded-3xl p-8 border border-outline-variant/20 hover-lift flex flex-col gap-4">
                        <div class="flex items-center gap-3 text-secondary">
                            <span class="material-symbols-outlined text-3xl">lightbulb</span>
                            <h3 class="font-bold text-xl text-primary tracking-tight">Visi Sekolah</h3>
                        </div>
                        <p class="text-slate-600 leading-relaxed text-base md:text-lg italic font-medium pl-4 border-l-4 border-secondary">
                            "{{ $setting->vision ?? 'Beriman dan bertaqwa, berilmu pengetahuan dan teknologi, berprestasi unggul, berkepribadian, berbudaya, berwawasan kebangsaan dan lingkungan demi terwujudnya kedamaian dan kesejahteraan.' }}"
                        </p>
                    </div>

                    <!-- Misi Card -->
                    <div class="glass-card-light rounded-3xl p-8 border border-outline-variant/20 hover-lift flex flex-col gap-4">
                        <div class="flex items-center gap-3 text-secondary">
                            <span class="material-symbols-outlined text-3xl">task_alt</span>
                            <h3 class="font-bold text-xl text-primary tracking-tight">Misi Utama Kami</h3>
                        </div>
                        
                        <div class="flex flex-col gap-4 mt-2">
                            @if(isset($setting->mission) && !empty($setting->mission))
                                @php
                                    $missions = array_filter(array_map('trim', explode("\n", $setting->mission)));
                                @endphp
                                @foreach($missions as $index => $mission)
                                    <!-- Dynamic mission format -->
                                    <div class="flex items-start gap-4">
                                        <span class="w-7 h-7 rounded-full bg-secondary/15 text-secondary flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5 shadow-sm border border-secondary/10">
                                            {{ $index + 1 }}
                                        </span>
                                        <p class="text-slate-600 text-sm md:text-base leading-relaxed">
                                            {{ preg_replace('/^\d+\.\s*/', '', $mission) }}
                                        </p>
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback missions -->
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
                                        <span class="w-7 h-7 rounded-full bg-secondary/15 text-secondary flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">
                                            {{ $index + 1 }}
                                        </span>
                                        <p class="text-slate-600 text-sm md:text-base leading-relaxed">
                                            {{ $mission }}
                                        </p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Program Keahlian / Majors Section -->
        <section id="akademik" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32 scroll-mt-24">
            <div class="mb-16 text-center max-w-3xl mx-auto fade-up">
                <span class="section-label">Program Akademik</span>
                <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary font-black mb-6 mt-1">
                    Program Peminatan Keahlian
                </h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                    Kami menawarkan jalur peminatan kurikulum yang dirancang khusus untuk mengoptimalkan potensi akademis siswa menuju pendidikan tinggi dan industri masa depan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($majors as $major)
                    @php $accentClasses = ['card-accent-red', 'card-accent-blue', 'card-accent-gold']; $accentClass = $accentClasses[$loop->index % 3]; @endphp
                    <div class="glass-card-light rounded-3xl overflow-hidden border border-outline-variant/15 hover-lift group shadow-sm flex flex-col justify-between h-full fade-up {{ $accentClass }}">
                        <div class="relative h-56 bg-slate-100 overflow-hidden">
                            @if($major->image_path)
                                <img src="{{ Storage::url($major->image_path) }}" alt="{{ $major->name }}" class="w-full h-full object-cover transition-transform duration-750 group-hover:scale-105" loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary to-indigo-950 flex flex-col items-center justify-center text-white relative">
                                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 16px 16px;"></div>
                                    <span class="material-symbols-outlined text-5xl text-secondary animate-float">{{ $major->icon ?: 'science' }}</span>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm text-primary w-11 h-11 rounded-2xl flex items-center justify-center shadow-md border border-slate-100">
                                <span class="material-symbols-outlined text-secondary">{{ $major->icon ?: 'menu_book' }}</span>
                            </div>
                        </div>
                        
                        <div class="p-8 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-xl text-primary mb-3 group-hover:text-secondary transition-colors duration-200">{{ $major->name }}</h3>
                                <p class="text-sm text-on-surface-variant leading-relaxed line-clamp-4 mb-6">
                                    {{ $major->description ?? 'Deskripsi kurikulum peminatan belum tersedia.' }}
                                </p>
                            </div>
                            
                            <a href="#contact" class="inline-flex items-center gap-2 text-sm font-semibold text-secondary hover:text-primary transition-colors group/link border-t border-slate-50 pt-4 mt-auto">
                                <span>Hubungi Pendaftaran</span>
                                <span class="material-symbols-outlined text-sm transform group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <!-- Fallback Majors -->
                    @php
                        $fallbackMajors = [
                            ['name' => 'MIPA (Matematika & Ilmu Pengetahuan Alam)', 'icon' => 'science', 'desc' => 'Fokus pada pengembangan nalar saintifik melalui pendalaman ilmu matematika, fisika, kimia, dan biologi terapan.'],
                            ['name' => 'IPS (Ilmu Pengetahuan Sosial)', 'icon' => 'public', 'desc' => 'Mempelajari interaksi kemanusiaan, ekonomi kreatif, sosiologi praktis, serta sejarah kebudayaan global.'],
                            ['name' => 'Bahasa & Budaya', 'icon' => 'translate', 'desc' => 'Mengasah kemampuan komunikasi multinasional, sastra kreatif, serta kajian budaya antropologi daerah maupun internasional.']
                        ];
                    @endphp
                    @foreach($fallbackMajors as $major)
                        <div class="glass-card-light rounded-3xl overflow-hidden border border-outline-variant/20 hover-lift group shadow-sm flex flex-col justify-between h-full fade-up">
                            <div class="relative h-56 bg-gradient-to-br from-primary to-indigo-950 flex flex-col items-center justify-center text-white">
                                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 16px 16px;"></div>
                                <span class="material-symbols-outlined text-5xl text-secondary animate-float">{{ $major['icon'] }}</span>
                                <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm text-primary w-11 h-11 rounded-2xl flex items-center justify-center shadow-md border border-slate-100">
                                    <span class="material-symbols-outlined text-secondary">{{ $major['icon'] }}</span>
                                </div>
                            </div>
                            <div class="p-8 flex-grow flex flex-col justify-between">
                                <div>
                                    <h3 class="font-bold text-xl text-primary mb-3 group-hover:text-secondary transition-colors duration-200">{{ $major['name'] }}</h3>
                                    <p class="text-sm text-on-surface-variant leading-relaxed line-clamp-4 mb-6">
                                        {{ $major['desc'] }}
                                    </p>
                                </div>
                                <a href="#contact" class="inline-flex items-center gap-2 text-sm font-semibold text-secondary hover:text-primary transition-colors group/link border-t border-slate-50 pt-4 mt-auto">
                                    <span>Tanyakan Program</span>
                                    <span class="material-symbols-outlined text-sm transform group-hover/link:translate-x-1 transition-transform">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </section>

        <!-- Fasilitas Section -->
        <section id="fasilitas" class="relative my-32 scroll-mt-24" style="background: linear-gradient(180deg, #FAFAF5 0%, #F3F4EF 50%, #FAFAF5 100%);">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-16">
            <div class="mb-16 text-center max-w-3xl mx-auto fade-up">
                <span class="section-label">Sarana &amp; Prasarana</span>
                <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary font-black mb-6 mt-1">
                    Fasilitas Pendukung Belajar
                </h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                    Kami menyediakan lingkungan belajar yang aman, nyaman, dan representatif lengkap dengan infrastruktur teknologi modern guna mendukung segala bentuk aktivitas pendidikan siswa.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($facilities as $facility)
                    <div class="glass-card-light rounded-3xl overflow-hidden border border-outline-variant/20 hover-lift group shadow-sm flex flex-col h-full fade-up">
                        <div class="relative h-64 bg-slate-100 overflow-hidden">
                            @if($facility->image_path)
                                <img src="{{ Storage::url($facility->image_path) }}" alt="{{ $facility->name }}" class="w-full h-full object-cover transition-transform duration-750 group-hover:scale-105" loading="lazy">
                            @else
                                <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400">
                                    <span class="material-symbols-outlined text-6xl animate-float">{{ $facility->icon ?: 'business' }}</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                <span class="text-white text-xs font-bold tracking-wider uppercase flex items-center gap-1.5 bg-secondary/80 backdrop-blur-sm px-3.5 py-1.5 rounded-full">
                                    <span class="material-symbols-outlined text-sm">info</span>
                                    Infrastruktur Resmi
                                </span>
                            </div>
                            <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md text-white w-10 h-10 rounded-2xl flex items-center justify-center shadow-lg">
                                <span class="material-symbols-outlined text-secondary text-xl">{{ $facility->icon ?: 'home' }}</span>
                            </div>
                        </div>
                        <div class="p-8 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-xl text-primary mb-3">{{ $facility->name }}</h3>
                                <p class="text-sm text-on-surface-variant leading-relaxed line-clamp-3">
                                    {{ $facility->description ?? 'Deskripsi fasilitas pendukung belum diunggah.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback Facilities -->
                    @php
                        $fallbackFacilities = [
                            ['name' => 'Laboratorium Komputer & Multimedia', 'icon' => 'computer', 'desc' => 'Disediakan komputer mutakhir terhubung internet kecepatan tinggi untuk ujian, riset mandiri, dan materi informatika.'],
                            ['name' => 'Perpustakaan Literasi Digital', 'icon' => 'menu_book', 'desc' => 'Menyimpan ribuan koleksi buku akademis cetak serta portal akses e-journal dan e-book gratis bagi siswa.'],
                            ['name' => 'Lapangan Olahraga Terpadu', 'icon' => 'sports_soccer', 'desc' => 'Lapangan luas yang mendukung berbagai cabang olahraga seperti basket, voli, futsal, dan aktivitas atletik.']
                        ];
                    @endphp
                    @foreach($fallbackFacilities as $facility)
                        <div class="glass-card-light rounded-3xl overflow-hidden border border-outline-variant/20 hover-lift group shadow-sm flex flex-col h-full fade-up">
                            <div class="relative h-64 bg-slate-900 flex flex-col items-center justify-center text-white">
                                <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 16px 16px;"></div>
                                <span class="material-symbols-outlined text-6xl text-secondary animate-float">{{ $facility['icon'] }}</span>
                                <div class="absolute top-4 right-4 bg-white/95 text-primary w-10 h-10 rounded-2xl flex items-center justify-center shadow-lg border border-slate-100">
                                    <span class="material-symbols-outlined text-secondary text-xl">{{ $facility['icon'] }}</span>
                                </div>
                            </div>
                            <div class="p-8 flex-grow flex flex-col justify-between">
                                <div>
                                    <h3 class="font-bold text-xl text-primary mb-3">{{ $facility['name'] }}</h3>
                                    <p class="text-sm text-on-surface-variant leading-relaxed line-clamp-3">
                                        {{ $facility['desc'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
            </div>
        </section>

        <!-- Ekstrakurikuler Carousel Section -->
        <section class="max-w-[1600px] mx-auto px-margin-mobile md:px-margin-desktop my-32 overflow-hidden">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 fade-up gap-6">
                <div class="max-w-2xl">
                    <span class="section-label">Pengembangan Karakter</span>
                    <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary font-black mb-4 mt-1">
                        Minat &amp; Bakat Ekstrakurikuler
                    </h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                        Kami menyediakan beragam jenis ekstrakurikuler guna mengembangkan bakat kepemimpinan, kecerdasan sosial, kreativitas seni, dan kebugaran jasmani siswa di luar kelas formal.
                    </p>
                </div>
                <div class="flex gap-4">
                    <button id="ekskul-prev-btn"
                        class="w-14 h-14 rounded-full border-2 border-outline-variant/40 flex items-center justify-center text-primary hover:border-secondary hover:text-secondary hover:bg-white/80 hover:shadow-lg transition-all duration-300 group">
                        <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
                    </button>
                    <button id="ekskul-next-btn"
                        class="w-14 h-14 rounded-full border-2 border-outline-variant/40 flex items-center justify-center text-primary hover:border-secondary hover:text-secondary hover:bg-white/80 hover:shadow-lg transition-all duration-300 group">
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
            </div>
            
            <div id="ekskul-slider" class="flex gap-8 overflow-x-auto pb-12 snap-x snap-mandatory hide-scrollbar">
                @forelse($extracurriculars as $ekskul)
                    <div class="min-w-[320px] md:min-w-[460px] h-[550px] rounded-[2.5rem] overflow-hidden relative group snap-center fade-up shadow-lg cursor-pointer"
                         onclick="window.location.href='{{ route('ekstrakurikuler.index') }}'">
                        @if($ekskul->image_path)
                            @if(Str::startsWith($ekskul->image_path, 'http'))
                                <img alt="{{ $ekskul->name }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="{{ $ekskul->image_path }}" loading="lazy" />
                            @else
                                <img alt="{{ $ekskul->name }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="{{ Storage::url($ekskul->image_path) }}" loading="lazy" />
                            @endif
                        @else
                            <div class="w-full h-full bg-gradient-to-tr from-primary to-indigo-950 flex flex-col items-center justify-center text-white">
                                <span class="material-symbols-outlined text-8xl text-secondary/30 animate-float">{{ $ekskul->icon ?: 'sports_soccer' }}</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/45 to-transparent opacity-85 group-hover:opacity-95 transition-opacity duration-500"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-10 transform translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
                            <div class="w-14 h-1.5 bg-secondary mb-6 rounded-full"></div>
                            <span class="font-semibold text-xs text-secondary mb-3 block tracking-widest uppercase">{{ $ekskul->category ?: 'Kegiatan Siswa' }}</span>
                            <h3 class="font-display-lg-mobile text-2xl md:text-3xl text-white font-bold mb-4">{{ $ekskul->name }}</h3>
                            <p class="text-sm text-white/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100 leading-relaxed mb-4">
                                {{ $ekskul->description }}
                            </p>
                            @if($ekskul->pembina)
                                <p class="text-xs text-secondary font-medium tracking-wide opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-150 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                    Pembina: {{ $ekskul->pembina }}
                                </p>
                            @endif
                        </div>
                    </div>
                @empty
                    <!-- Fallback Extracurriculars -->
                    @php
                        $fallbackEkskuls = [
                            ['name' => 'Tari Tradisional', 'cat' => 'Seni Budaya', 'desc' => 'Melestarikan warisan budaya nusantara melalui gerak tari tradisional, tampil di berbagai festival.', 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCO38iPlrza6vYZYAyX7PQAxDVL--q0_tE-V_UCbUGC-pyQolX8VgYMyo6iv_N-B6rc6XSyZRvI-NVKEhJsCU0038zo9-pIL4hcuBmOlUMAt_sjOCELOOTLqqJ01m1mjAqLnLUFZm6ovBKVj0Rf2dFR-TCG6_Joxy3aHzWCp7rQPkq8iazwqK9H-YdIFRWPeFrm7rsDCdyewWEzqCmZWrjfzYsE75wM8OzERM7JgOZbjm05LBnyVqE2G3HdyEpDYrdLah_a6LIItnQH'],
                            ['name' => 'Klub Basket Giga', 'cat' => 'Olahraga', 'desc' => 'Membangun sportivitas, daya tahan fisik, dan kerja sama tim dalam kompetisi basket regional.', 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDLT7MEGmBhEANV3w7U9898OXQr0DfDB-zyie1rzCazRqQCp2WDP5C__pIeFuFKDctbpiWNHws6BEY6szXryhToLKbq90tfdE6Y1O6Tn2VuaikLd557R3t7CYRg5y2Zn8RDHsWAysfVM_VGptUagChzGLzg0qNdYxTOerHcCq-UGFxfeKJvymE5ihuagw8igMUdFNuCiTwIonQkf1AcW_gusX6kYXgPFegt2B0KL6lHFNt_mbOpPhOtQNdrgWud58p_QmLn08xv1fi-'],
                            ['name' => 'Klub Robotika', 'cat' => 'Sains & Teknologi', 'desc' => 'Pengembangan algoritma program, pemecahan logika pemrograman, serta pembuatan alat otomatis.', 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuATkTVQBv3VR4_U_-0KyWt1VrqYlg0Oo46X8_esHSTLqZZwhJ5HjQJxpS5TSZtnrVJl0Q84yo_P66zUvitxlE7LEylw4kMDwPPXETHL878Q6NZTYouQSvswKvvHXMQ2qtIOMui0RTxV7pAxX0iuO5kNG3a0VFxo69QUbMTw087TaDgrdgnpLSQPmjIfyoYqAgVDv7UQMQ1bqbXvzFwulLmxV-bpJkcQaWV1G7QblZZiWCuqa0GpXIMS-6mBtMMG5lVz6S0cQwpf50K2']
                        ];
                    @endphp
                    @foreach($fallbackEkskuls as $ekskul)
                        <div class="min-w-[320px] md:min-w-[460px] h-[550px] rounded-[2.5rem] overflow-hidden relative group snap-center fade-up shadow-lg cursor-pointer">
                            <img alt="{{ $ekskul['name'] }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="{{ $ekskul['img'] }}" loading="lazy" />
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/45 to-transparent opacity-85 group-hover:opacity-95 transition-opacity duration-500"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-10 transform translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
                                <div class="w-14 h-1.5 bg-secondary mb-6 rounded-full"></div>
                                <span class="font-semibold text-xs text-secondary mb-3 block tracking-widest uppercase">{{ $ekskul['cat'] }}</span>
                                <h3 class="font-display-lg-mobile text-2xl md:text-3xl text-white font-bold mb-4">{{ $ekskul['name'] }}</h3>
                                <p class="text-sm text-white/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100 leading-relaxed">
                                    {{ $ekskul['desc'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </section>

        <!-- Teachers & Staff Section -->
        @if(isset($teachers) && !$teachers->isEmpty())
            <section id="guru" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32 scroll-mt-24">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 fade-up gap-6">
                    <div class="max-w-2xl">
                        <span class="section-label">Tenaga Pendidik</span>
                        <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary font-black mb-4 mt-1">
                            Staf &amp; Guru Profesional
                        </h2>
                        <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                            Dibimbing oleh para guru ahli di bidangnya, berdedikasi membimbing dan mengarahkan siswa mencapai puncak akademis dan kedewasaan karakter.
                        </p>
                    </div>
                    <div class="flex gap-4">
                        <button id="guru-prev-btn"
                            class="w-14 h-14 rounded-full border-2 border-outline-variant/40 flex items-center justify-center text-primary hover:border-secondary hover:text-secondary hover:bg-white/80 hover:shadow-lg transition-all duration-300 group">
                            <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
                        </button>
                        <button id="guru-next-btn"
                            class="w-14 h-14 rounded-full border-2 border-outline-variant/40 flex items-center justify-center text-primary hover:border-secondary hover:text-secondary hover:bg-white/80 hover:shadow-lg transition-all duration-300 group">
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                    </div>
                </div>

                <div id="guru-slider" class="flex gap-8 overflow-x-auto pb-10 snap-x snap-mandatory hide-scrollbar">
                    @foreach($teachers as $teacher)
                        <div class="min-w-[260px] sm:min-w-[300px] max-w-[320px] bg-white rounded-3xl overflow-hidden border border-outline-variant/20 shadow-sm hover-lift snap-center flex flex-col h-full fade-up">
                            <div class="relative aspect-square bg-slate-100 overflow-hidden">
                                @if($teacher->photo)
                                    <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" loading="lazy">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-slate-400">
                                        <span class="material-symbols-outlined text-6xl">account_circle</span>
                                    </div>
                                @endif
                                <div class="absolute bottom-4 left-4 bg-primary/90 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/10 shadow-md">
                                    <p class="text-[10px] font-bold text-secondary tracking-widest uppercase">GIGA STAFF</p>
                                </div>
                            </div>
                            <div class="p-6 flex-grow flex flex-col justify-between border-t border-slate-50">
                                <div>
                                    <h4 class="font-bold text-base text-primary mb-1 line-clamp-1">{{ $teacher->name }}</h4>
                                    <p class="text-xs text-on-surface-variant leading-relaxed line-clamp-2">{{ $teacher->position }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Gallery Section -->
        @if(isset($galleries) && !$galleries->isEmpty())
            <section id="galeri" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32 scroll-mt-24">
                <div class="mb-16 text-center max-w-3xl mx-auto fade-up">
                    <span class="section-label">Galeri Dokumentasi</span>
                    <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary font-black mb-6 mt-1">
                        Dokumentasi Kegiatan Sekolah
                    </h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                        Momen berharga aktivitas belajar mengajar, perayaan prestasi siswa, dan pelaksanaan program resmi sekolah.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($galleries as $gallery)
                        @php
                            $coverImage = $gallery->images->first()?->image_path;
                        @endphp
                        @if($coverImage)
                            <div class="group cursor-pointer bg-white rounded-3xl overflow-hidden border border-outline-variant/20 shadow-sm hover:shadow-xl hover-lift transition-all duration-300 flex flex-col h-full fade-up"
                                 onclick="openGalleryModal('{{ $gallery->id }}')">
                                <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                                    <img src="{{ Storage::url($coverImage) }}" alt="{{ $gallery->title }}"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                         loading="lazy">
                                    <div class="absolute inset-0 bg-primary/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <span class="text-white font-bold text-sm flex items-center gap-2 bg-secondary/90 px-5 py-2.5 rounded-full transform translate-y-3 group-hover:translate-y-0 transition-transform duration-300 shadow-lg">
                                            <span class="material-symbols-outlined text-sm">visibility</span>
                                            Lihat Foto
                                        </span>
                                    </div>
                                    <div class="absolute top-4 right-4 bg-primary/80 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm">
                                        <span class="material-symbols-outlined text-xs">photo_library</span>
                                        {{ $gallery->images->count() }} Foto
                                    </div>
                                </div>
                                <div class="p-6 flex-grow flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-bold text-lg text-primary mb-2 line-clamp-1 group-hover:text-secondary transition-colors duration-200">
                                            {{ $gallery->title }}
                                        </h4>
                                        <p class="text-on-surface-variant text-sm line-clamp-2 leading-relaxed">
                                            {{ $gallery->description ?? 'Dokumentasi kegiatan resmi.' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Gallery Modals Data -->
                @foreach($galleries as $gallery)
                    <div id="gallery-modal-{{ $gallery->id }}" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-6 bg-primary/80 backdrop-blur-md opacity-0 transition-opacity duration-300">
                        <div class="bg-white rounded-3xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col shadow-2xl transform scale-95 transition-transform duration-300">
                            <!-- Header -->
                            <div class="px-6 py-5 border-b border-outline-variant/20 flex justify-between items-center bg-slate-50">
                                <div>
                                    <h3 class="font-bold text-xl text-primary">{{ $gallery->title }}</h3>
                                    <p class="text-on-surface-variant text-xs mt-1">Dokumentasi Kegiatan • {{ $gallery->images->count() }} Foto</p>
                                </div>
                                <button onclick="closeGalleryModal('{{ $gallery->id }}')" class="w-10 h-10 rounded-full hover:bg-slate-200 flex items-center justify-center text-primary transition focus:outline-none">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </div>
                            
                            <!-- Body -->
                            <div class="p-6 md:p-8 overflow-y-auto flex-grow">
                                @if($gallery->description)
                                    <p class="text-on-surface-variant text-sm md:text-base mb-6 leading-relaxed border-l-4 border-secondary pl-4">
                                        {{ $gallery->description }}
                                    </p>
                                @endif
                                
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 md:gap-6">
                                    @foreach($gallery->images as $index => $image)
                                        <div class="relative aspect-square rounded-2xl overflow-hidden cursor-pointer group shadow-sm hover:shadow-md transition"
                                             onclick="openLightbox('{{ $gallery->id }}', {{ $index }})">
                                            <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
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

                <!-- Lightbox Shell (Shared across all galleries) -->
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
            <section id="testimoni" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32 scroll-mt-24">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6 fade-up">
                    <div class="max-w-2xl">
                        <span class="section-label">Ulasan &amp; Cerita</span>
                        <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary font-black mb-4 mt-1">
                            Kata Alumni &amp; Orang Tua
                        </h2>
                        <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                            Kisah sukses, kesan, serta pesan tulus dari siswa-siswi, alumni, guru, dan para orang tua yang memercayakan pendidikannya di SMA GIKI 3 Surabaya.
                        </p>
                    </div>
                    @if($testimonials->count() > 1)
                        <div class="flex gap-4">
                            <button id="testi-prev-btn" class="w-14 h-14 rounded-full border-2 border-outline-variant/40 flex items-center justify-center text-primary hover:border-secondary hover:text-secondary hover:bg-white/80 hover:shadow-lg transition-all duration-300 group">
                                <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
                            </button>
                            <button id="testi-next-btn" class="w-14 h-14 rounded-full border-2 border-outline-variant/40 flex items-center justify-center text-primary hover:border-secondary hover:text-secondary hover:bg-white/80 hover:shadow-lg transition-all duration-300 group">
                                <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </button>
                        </div>
                    @endif
                </div>

                <div class="relative overflow-hidden py-4">
                    <div id="testi-slider" class="flex gap-8 transition-transform duration-500 ease-in-out snap-x snap-mandatory hide-scrollbar overflow-x-auto">
                        @foreach($testimonials as $testimonial)
                            <div class="testi-card min-w-[285px] sm:min-w-[380px] md:min-w-[420px] max-w-[450px] bg-white rounded-3xl p-8 border border-outline-variant/10 shadow-md hover:shadow-xl hover-lift snap-center flex flex-col justify-between relative group">
                                <span class="absolute top-6 right-8 text-slate-100 group-hover:text-amber-100/40 text-7xl font-serif select-none transition duration-300">”</span>
                                
                                <div>
                                    @if($testimonial->rating)
                                        <div class="flex items-center gap-1 mb-6">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-amber-400 fill-current' : 'text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.907c.961 0 1.36 1.238.588 1.81l-3.97 2.883a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.971-2.883a1 1 0 00-1.18 0l-3.97 2.883c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118L2.98 9.42c-.771-.572-.372-1.81.588-1.81h4.906a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    @endif

                                    <p class="text-slate-650 leading-relaxed italic mb-8 relative z-10 text-sm md:text-base">
                                        "{{ $testimonial->content }}"
                                    </p>
                                </div>

                                <div class="flex items-center gap-4 mt-auto border-t border-slate-50 pt-6">
                                    <div class="w-12 h-12 rounded-full overflow-hidden border border-slate-100 flex-shrink-0 bg-slate-50 flex items-center justify-center font-bold text-primary">
                                        @if($testimonial->avatar)
                                            <img src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover" loading="lazy">
                                        @else
                                            <span class="text-sm uppercase">{{ substr($testimonial->name, 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-base text-primary">{{ $testimonial->name }}</h4>
                                        <p class="text-[10px] text-secondary font-bold tracking-widest uppercase mt-0.5">{{ $testimonial->relationship }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 text-center fade-up">
                    <a href="{{ route('testimonials.create.public') }}" class="inline-flex items-center gap-2 bg-secondary/15 hover:bg-secondary/25 text-secondary font-bold px-6 py-3 rounded-full text-sm transition duration-300">
                        <span class="material-symbols-outlined text-base">rate_review</span>
                        Tulis Testimoni Anda
                    </a>
                </div>
            </section>
        @endif

        <!-- News & Announcements Section -->
        <section id="berita" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32 scroll-mt-24">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b-2 border-outline-variant/20 pb-6 fade-up gap-6">
                <div>
                    <span class="section-label">Pusat Informasi</span>
                    <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary font-black mt-1">
                        Berita &amp; Artikel Terbaru
                    </h2>
                </div>
                <a class="hidden md:inline-flex items-center gap-2 font-bold text-sm text-primary hover:text-secondary transition-colors group mb-2"
                    href="{{ route('articles.index') }}">
                    Lihat Semua Berita
                    <span class="material-symbols-outlined transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            @if($articles->isEmpty())
                <div class="bg-white rounded-3xl p-16 text-center border border-slate-100 shadow-sm flex flex-col items-center justify-center w-full fade-up">
                    <span class="material-symbols-outlined text-5xl text-slate-300 mb-4 animate-float">newspaper</span>
                    <h4 class="text-lg font-bold text-slate-700">Belum ada berita terbaru</h4>
                    <p class="text-slate-400 text-sm mt-1">Nantikan pembaruan informasi menarik dari kami segera.</p>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 w-full">
                    <!-- Featured News -->
                    @php $featured = $articles->first(); @endphp
                    <div class="lg:col-span-6 group cursor-pointer fade-up">
                        <a href="{{ route('articles.show', $featured->slug) }}">
                            <div class="w-full h-80 rounded-[2.5rem] overflow-hidden mb-6 relative bg-slate-100 shadow-md">
                                @if($featured->thumbnail)
                                    <img alt="{{ $featured->title }}"
                                        class="w-full h-full object-cover transition-transform duration-750 group-hover:scale-105"
                                        src="{{ Storage::url($featured->thumbnail) }}"
                                        loading="lazy" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary to-indigo-950 text-white/30">
                                        <span class="material-symbols-outlined text-5xl">image</span>
                                    </div>
                                @endif
                                <div class="absolute top-6 left-6">
                                    <span class="bg-secondary text-on-secondary font-bold px-4.5 py-2 rounded-full text-xs shadow-md tracking-wider uppercase">Sorotan Utama</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-on-surface-variant mb-4 text-xs font-semibold">
                                <span class="text-secondary tracking-wide uppercase">{{ $featured->published_at ? $featured->published_at->format('d M Y') : $featured->created_at->format('d M Y') }}</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-outline-variant"></span>
                                <span class="uppercase tracking-wider">Oleh Admin</span>
                            </div>
                            <h3 class="font-display-lg-mobile text-2xl md:text-3xl text-primary font-black mb-4 group-hover:text-secondary transition-colors line-clamp-2 leading-snug">
                                {{ $featured->title }}
                            </h3>
                            <p class="font-body-lg text-body-lg text-on-surface-variant line-clamp-3 text-sm leading-relaxed mb-4">
                                {{ $featured->meta_description ?: strip_tags($featured->content) }}
                            </p>
                            <span class="inline-flex items-center gap-2 text-sm font-bold text-secondary">
                                Baca Selengkapnya <span class="material-symbols-outlined text-sm transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </span>
                        </a>
                    </div>
                    
                    <!-- News List -->
                    <div class="lg:col-span-6 flex flex-col gap-8 fade-up">
                        @foreach($articles->skip(1) as $item)
                            <div class="group cursor-pointer grid grid-cols-1 sm:grid-cols-4 gap-6 items-center">
                                <a href="{{ route('articles.show', $item->slug) }}" class="sm:col-span-1 h-28 rounded-2xl overflow-hidden bg-slate-100 relative block shadow-sm">
                                    @if($item->thumbnail)
                                        <img alt="{{ $item->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                            src="{{ Storage::url($item->thumbnail) }}"
                                            loading="lazy" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400">
                                            <span class="material-symbols-outlined text-3xl">image</span>
                                        </div>
                                    @endif
                                </a>
                                <div class="sm:col-span-3">
                                    <a href="{{ route('articles.show', $item->slug) }}">
                                        <div class="flex items-center gap-3 mb-2 text-xs font-semibold">
                                            <span class="text-secondary uppercase tracking-wider">Artikel</span>
                                            <span class="text-outline-variant text-xs">•</span>
                                            <span class="text-on-surface-variant">{{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}</span>
                                        </div>
                                        <h4 class="text-base md:text-lg font-bold text-primary mb-2 group-hover:text-secondary transition-colors line-clamp-2 leading-snug">
                                            {{ $item->title }}
                                        </h4>
                                        <p class="font-body-md text-on-surface-variant text-sm line-clamp-2 leading-relaxed">
                                            {{ $item->meta_description ?: strip_tags($item->content) }}
                                        </p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <a class="md:hidden inline-flex items-center gap-2 font-bold text-sm text-primary hover:text-secondary transition-colors group mt-8 fade-up"
                href="{{ route('articles.index') }}">
                Lihat Semua Berita
                <span class="material-symbols-outlined transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </a>
        </section>

        <!-- CTA Band -->
        <div class="cta-band mx-margin-mobile md:mx-margin-desktop rounded-3xl my-24 px-8 md:px-16 py-14 flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl shadow-primary/20 relative z-10">
            <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(200,147,10,0.5) 30%, rgba(196,30,58,0.4) 70%, transparent);"></div>
            <div class="max-w-xl text-center md:text-left">
                <p class="text-xs font-bold tracking-[0.15em] uppercase text-secondary/80 mb-3">Tahun Ajaran 2026/2027</p>
                <h3 class="text-2xl md:text-3xl font-black text-white leading-snug mb-3">Bergabunglah Bersama Keluarga Besar <span class="text-secondary">SMA GIKI 3</span></h3>
                <p class="text-white/65 text-sm leading-relaxed">Wujudkan masa depan gemilang bersama kami. Pendaftaran siswa baru sudah dibuka — jangan lewatkan kesempatan emas ini.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 flex-shrink-0">
                <a href="#contact" class="flex items-center justify-center gap-2 bg-secondary hover:bg-amber-400 text-white font-bold px-8 py-4 rounded-full transition-all duration-300 shadow-lg hover:shadow-secondary/40 hover:-translate-y-0.5 text-sm tracking-wide">
                    <span class="material-symbols-outlined text-base">edit_note</span>
                    Daftar Sekarang
                </a>
                <a href="#contact" class="flex items-center justify-center gap-2 bg-white/8 hover:bg-white/15 text-white border border-white/15 font-bold px-8 py-4 rounded-full transition-all duration-300 text-sm">
                    <span class="material-symbols-outlined text-base">info</span>
                    Informasi Lebih
                </a>
            </div>
        </div>

        <!-- Contact Section -->
        <section id="contact" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32 scroll-mt-24">
            <div class="mb-16 text-center max-w-3xl mx-auto fade-up">
                <span class="section-label">Hubungi Kami</span>
                <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary font-black mb-6 mt-1">
                    Mulai Percakapan Baru
                </h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                    Ada pertanyaan atau butuh informasi lebih lanjut mengenai pendaftaran, program sekolah, maupun kerja sama? Kirimkan pesan Anda melalui formulir di bawah ini.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch items-center">
                <!-- Contact Details & Map (Left Column) -->
                <div class="lg:col-span-5 flex flex-col justify-between gap-8 h-full fade-up">
                    <div class="glass-card-light rounded-3xl p-8 border border-outline-variant/20 shadow-sm flex flex-col gap-6 flex-grow">
                        <h3 class="font-bold text-xl text-primary mb-2">Informasi Kontak</h3>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-secondary/15 text-secondary flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined">location_on</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-primary mb-1">Alamat Sekolah</h4>
                                <p class="text-sm text-on-surface-variant leading-relaxed">
                                    {{ $setting->address ?? 'Jl. Klampis Jaya No. 11, Klampis Ngasem, Kec. Sukolilo, Surabaya, Jawa Timur 60117' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-secondary/15 text-secondary flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined">phone</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-primary mb-1">Nomor Telepon</h4>
                                <p class="text-sm text-on-surface-variant leading-relaxed">
                                    {{ $setting->phone ?? '031-5996405' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-secondary/15 text-secondary flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined">mail</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-primary mb-1">Email Resmi</h4>
                                <p class="text-sm text-on-surface-variant leading-relaxed">
                                    {{ $setting->email ?? 'info@smagiki3surabaya.sch.id' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Interactive Google Map Frame -->
                    <div class="rounded-3xl overflow-hidden shadow-md border border-outline-variant/20 h-64 relative bg-slate-100">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5746977797746!2d112.7758784!3d-7.289139399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa6874ca7f79%3A0x6b6c0c29f44ee7bb!2sSMA%20GIKI%203%20Surabaya!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                            class="w-full h-full border-0 absolute inset-0"
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Contact Form Card (Right Column) -->
                <div class="lg:col-span-7 glass-card-light rounded-3xl p-8 md:p-10 border border-outline-variant/20 shadow-xl relative overflow-hidden fade-up">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/5 rounded-full blur-2xl"></div>
                    
                    <h3 class="font-bold text-xl text-primary mb-6 relative z-10">Kirim Masukan atau Pertanyaan</h3>
                    
                    <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="space-y-6 relative z-10">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label for="name" class="text-xs font-bold text-primary uppercase tracking-wider">Nama Lengkap</label>
                                <input type="text" id="name" name="name" required placeholder="Contoh: Budi Santoso"
                                    class="w-full px-5 py-3 rounded-2xl border border-outline-variant/30 focus:border-secondary focus:ring-1 focus:ring-secondary text-sm bg-white/70 shadow-sm transition outline-none" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="email" class="text-xs font-bold text-primary uppercase tracking-wider">Alamat Email</label>
                                <input type="email" id="email" name="email" required placeholder="budi@example.com"
                                    class="w-full px-5 py-3 rounded-2xl border border-outline-variant/30 focus:border-secondary focus:ring-1 focus:ring-secondary text-sm bg-white/70 shadow-sm transition outline-none" />
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="subject" class="text-xs font-bold text-primary uppercase tracking-wider">Subjek Pesan</label>
                            <input type="text" id="subject" name="subject" required placeholder="Contoh: Informasi Pendaftaran"
                                class="w-full px-5 py-3 rounded-2xl border border-outline-variant/30 focus:border-secondary focus:ring-1 focus:ring-secondary text-sm bg-white/70 shadow-sm transition outline-none" />
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="message" class="text-xs font-bold text-primary uppercase tracking-wider">Isi Pesan Anda</label>
                            <textarea id="message" name="message" rows="5" required placeholder="Tuliskan pesan Anda secara lengkap di sini..."
                                class="w-full px-5 py-4 rounded-2xl border border-outline-variant/30 focus:border-secondary focus:ring-1 focus:ring-secondary text-sm bg-white/70 shadow-sm transition outline-none resize-none"></textarea>
                        </div>

                        <button type="submit"
                            class="btn-primary w-full bg-primary hover:bg-primary/95 text-white font-bold text-label-md py-4.5 rounded-full shadow-lg flex items-center justify-center gap-3.5 tracking-wide transition-all duration-300">
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
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Intersection Observer for Fade-Up Animation & Counters
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.08
        };

        const animateCounter = (el) => {
            const target = parseInt(el.getAttribute('data-target'));
            if (isNaN(target)) return;
            let current = 0;
            const duration = 1500; // ms
            const stepTime = 25; // ms
            const steps = duration / stepTime;
            const increment = target / steps;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    el.innerText = target;
                    clearInterval(timer);
                } else {
                    el.innerText = Math.ceil(current);
                }
            }, stepTime);
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');

                    // Check for counters within the intersecting element
                    const counters = entry.target.querySelectorAll('.counter-value');
                    counters.forEach(counter => {
                        if (!counter.classList.contains('counted')) {
                            animateCounter(counter);
                            counter.classList.add('counted');
                        }
                    });

                    // Check if the element itself is a counter
                    if (entry.target.classList.contains('counter-value') && !entry.target.classList.contains('counted')) {
                        animateCounter(entry.target);
                        entry.target.classList.add('counted');
                    }

                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-up').forEach(el => {
            observer.observe(el);
        });

        // Homepage dynamic slider logic
        const welcomeSlides = document.querySelectorAll('.welcome-slide');
        const welcomeDots = document.querySelectorAll('.welcome-dot');
        const welcomePrevBtn = document.getElementById('welcome-prev-btn');
        const welcomeNextBtn = document.getElementById('welcome-next-btn');
        
        if (welcomeSlides.length > 0) {
            let currentWelcomeSlide = 0;
            let welcomeSlideInterval;
            
            function showWelcomeSlide(index) {
                if (index >= welcomeSlides.length) currentWelcomeSlide = 0;
                else if (index < 0) currentWelcomeSlide = welcomeSlides.length - 1;
                else currentWelcomeSlide = index;
                
                welcomeSlides.forEach(slide => {
                    const img = slide.querySelector('img');
                    const text = slide.querySelector('.transform');
                    
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0', 'z-0');
                    
                    if (img) {
                        img.classList.remove('scale-105');
                        img.classList.add('scale-100');
                    }
                    if (text) {
                        text.classList.remove('translate-y-0', 'opacity-100');
                        text.classList.add('translate-y-8', 'opacity-0');
                    }
                });
                
                if (welcomeDots.length > 0) {
                    welcomeDots.forEach(dot => {
                        dot.classList.remove('bg-white', 'w-6');
                        dot.classList.add('bg-white/30');
                    });
                    welcomeDots[currentWelcomeSlide].classList.remove('bg-white/30');
                    welcomeDots[currentWelcomeSlide].classList.add('bg-white', 'w-6');
                }
                
                const activeSlide = welcomeSlides[currentWelcomeSlide];
                activeSlide.classList.remove('opacity-0', 'z-0');
                activeSlide.classList.add('opacity-100', 'z-10');
                
                const activeImg = activeSlide.querySelector('img');
                const activeText = activeSlide.querySelector('.transform');
                
                setTimeout(() => {
                    if (activeImg) {
                        activeImg.classList.remove('scale-100');
                        activeImg.classList.add('scale-105');
                    }
                    if (activeText) {
                        activeText.classList.remove('translate-y-8', 'opacity-0');
                        activeText.classList.add('translate-y-0', 'opacity-100');
                    }
                }, 50);
            }
            
            function nextWelcomeSlide() {
                showWelcomeSlide(currentWelcomeSlide + 1);
            }
            
            function prevWelcomeSlide() {
                showWelcomeSlide(currentWelcomeSlide - 1);
            }
            
            function startWelcomeAutoSlide() {
                if (welcomeSlides.length <= 1) return;
                stopWelcomeAutoSlide();
                welcomeSlideInterval = setInterval(nextWelcomeSlide, 6000);
            }
            
            function stopWelcomeAutoSlide() {
                clearInterval(welcomeSlideInterval);
            }
            
            // Init
            showWelcomeSlide(0);
            startWelcomeAutoSlide();
            
            if (welcomeNextBtn) {
                welcomeNextBtn.addEventListener('click', () => {
                    nextWelcomeSlide();
                    startWelcomeAutoSlide();
                });
            }
            
            if (welcomePrevBtn) {
                welcomePrevBtn.addEventListener('click', () => {
                    prevWelcomeSlide();
                    startWelcomeAutoSlide();
                });
            }
            
            if (welcomeDots.length > 0) {
                welcomeDots.forEach(dot => {
                    dot.addEventListener('click', () => {
                        const idx = parseInt(dot.getAttribute('data-slide-index'));
                        showWelcomeSlide(idx);
                        startWelcomeAutoSlide();
                    });
                });
            }
        }

        // Gallery Modals & Lightbox JavaScript
        let activeGalleryId = null;
        let activeImages = [];
        let currentLightboxIndex = 0;

        // Define globally accessible gallery images data
        const galleryData = {
            @if(isset($galleries))
                @foreach($galleries as $gallery)
                    '{{ $gallery->id }}': {
                        title: '{{ addslashes($gallery->title) }}',
                        images: [
                            @foreach($gallery->images as $image)
                                '{{ Storage::url($image->image_path) }}',
                            @endforeach
                        ]
                    },
                @endforeach
            @endif
        };

        window.openGalleryModal = function(id) {
            const modal = document.getElementById(`gallery-modal-${id}`);
            if (!modal) return;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Force reflow for transitions
            modal.offsetHeight;
            
            modal.classList.remove('opacity-0');
            modal.querySelector('.transform').classList.remove('scale-95');
            
            // Prevent body scroll
            document.body.classList.add('overflow-hidden');
        };

        window.closeGalleryModal = function(id) {
            const modal = document.getElementById(`gallery-modal-${id}`);
            if (!modal) return;
            
            modal.classList.add('opacity-0');
            modal.querySelector('.transform').classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        };

        window.openLightbox = function(galleryId, index) {
            activeGalleryId = galleryId;
            activeImages = galleryData[galleryId].images;
            currentLightboxIndex = index;

            const lightbox = document.getElementById('gallery-lightbox');
            const img = document.getElementById('lightbox-img');
            const caption = document.getElementById('lightbox-caption');
            const counter = document.getElementById('lightbox-counter');

            img.src = activeImages[currentLightboxIndex];
            caption.innerText = galleryData[galleryId].title;
            counter.innerText = `Foto ${currentLightboxIndex + 1} dari ${activeImages.length}`;

            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            
            // Force reflow
            lightbox.offsetHeight;
            
            lightbox.classList.remove('opacity-0');
            img.classList.remove('scale-95');
        };

        window.closeLightbox = function() {
            const lightbox = document.getElementById('gallery-lightbox');
            const img = document.getElementById('lightbox-img');

            lightbox.classList.add('opacity-0');
            img.classList.add('scale-95');

            setTimeout(() => {
                lightbox.classList.add('hidden');
                lightbox.classList.remove('flex');
            }, 300);
        };

        window.nextLightboxImage = function() {
            if (activeImages.length <= 1) return;
            currentLightboxIndex = (currentLightboxIndex + 1) % activeImages.length;
            
            const img = document.getElementById('lightbox-img');
            const counter = document.getElementById('lightbox-counter');
            
            img.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                img.src = activeImages[currentLightboxIndex];
                counter.innerText = `Foto ${currentLightboxIndex + 1} dari ${activeImages.length}`;
                img.classList.remove('scale-95', 'opacity-0');
            }, 150);
        };

        window.prevLightboxImage = function() {
            if (activeImages.length <= 1) return;
            currentLightboxIndex = (currentLightboxIndex - 1 + activeImages.length) % activeImages.length;
            
            const img = document.getElementById('lightbox-img');
            const counter = document.getElementById('lightbox-counter');
            
            img.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                img.src = activeImages[currentLightboxIndex];
                counter.innerText = `Foto ${currentLightboxIndex + 1} dari ${activeImages.length}`;
                img.classList.remove('scale-95', 'opacity-0');
            }, 150);
        };

        // Keyboard support for Lightbox
        document.addEventListener('keydown', (e) => {
            const lightbox = document.getElementById('gallery-lightbox');
            if (lightbox && !lightbox.classList.contains('hidden')) {
                if (e.key === 'Escape') closeLightbox();
                else if (e.key === 'ArrowRight') nextLightboxImage();
                else if (e.key === 'ArrowLeft') prevLightboxImage();
            }
        });

        // Touch Swipe Support for Lightbox (Mobile)
        const lightboxEl = document.getElementById('gallery-lightbox');
        if (lightboxEl) {
            let touchStartX = 0;
            let touchStartY = 0;
            lightboxEl.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
                touchStartY = e.changedTouches[0].screenY;
            }, { passive: true });
            lightboxEl.addEventListener('touchend', (e) => {
                const dx = e.changedTouches[0].screenX - touchStartX;
                const dy = e.changedTouches[0].screenY - touchStartY;
                if (Math.abs(dx) > Math.abs(dy) && Math.abs(dx) > 50) {
                    if (dx < 0) nextLightboxImage();
                    else prevLightboxImage();
                }
            }, { passive: true });
        }

        // Testimonials Slider Navigation
        const testiSlider = document.getElementById('testi-slider');
        const testiPrevBtn = document.getElementById('testi-prev-btn');
        const testiNextBtn = document.getElementById('testi-next-btn');

        if (testiSlider) {
            const scrollAmount = 450; // Approximated card width + gap
            
            if (testiNextBtn) {
                testiNextBtn.addEventListener('click', () => {
                    testiSlider.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });
            }

            if (testiPrevBtn) {
                testiPrevBtn.addEventListener('click', () => {
                    testiSlider.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                });
            }
        }

        // Extracurriculars Slider Navigation
        const ekskulSlider = document.getElementById('ekskul-slider');
        const ekskulPrevBtn = document.getElementById('ekskul-prev-btn');
        const ekskulNextBtn = document.getElementById('ekskul-next-btn');

        if (ekskulSlider) {
            const scrollAmount = 500; // Approximated card width + gap
            
            if (ekskulNextBtn) {
                ekskulNextBtn.addEventListener('click', () => {
                    ekskulSlider.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });
            }

            if (ekskulPrevBtn) {
                ekskulPrevBtn.addEventListener('click', () => {
                    ekskulSlider.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                });
            }
        }

        // Teachers Slider Navigation
        const guruSlider = document.getElementById('guru-slider');
        const guruPrevBtn = document.getElementById('guru-prev-btn');
        const guruNextBtn = document.getElementById('guru-next-btn');

        if (guruSlider) {
            const scrollAmount = 320; // Approximated card width + gap
            
            if (guruNextBtn) {
                guruNextBtn.addEventListener('click', () => {
                    guruSlider.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });
            }

            if (guruPrevBtn) {
                guruPrevBtn.addEventListener('click', () => {
                    guruSlider.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                });
            }
        }

        // Public Contact Form AJAX submission with dynamic toast notifications
        const contactForm = document.getElementById('contact-form');
        
        if (contactForm) {
            contactForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const submitBtn = contactForm.querySelector('button[type="submit"]');
                const submitText = submitBtn.querySelector('.btn-text');
                const spinner = submitBtn.querySelector('.spinner');
                
                // Show loading state
                submitBtn.disabled = true;
                if (submitText) submitText.innerText = 'Mengirim...';
                if (spinner) spinner.classList.remove('hidden');
                
                const formData = new FormData(contactForm);
                
                try {
                    const response = await fetch("{{ route('contact.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        },
                        body: formData
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok && data.success) {
                        showToast(data.message, 'success');
                        contactForm.reset();
                    } else {
                        let errorMsg = 'Terjadi kesalahan saat memproses formulir.';
                        if (data.errors) {
                            errorMsg = Object.values(data.errors).flat().join('<br>');
                        }
                        showToast(errorMsg, 'error');
                    }
                } catch (error) {
                    showToast('Gagal mengirim pesan. Silakan periksa koneksi internet Anda.', 'error');
                } finally {
                    // Restore button state
                    submitBtn.disabled = false;
                    if (submitText) submitText.innerText = 'Kirim Pesan';
                    if (spinner) spinner.classList.add('hidden');
                }
            });
        }

        // Custom Toast Notifications
        function showToast(message, type = 'success') {
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'fixed bottom-5 right-5 z-[200] flex flex-col gap-3 max-w-sm w-[90%] px-4';
                document.body.appendChild(toastContainer);
            }
            
            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-emerald-600' : 'bg-red-600';
            const icon = type === 'success' ? 'check_circle' : 'error';
            
            toast.className = `${bgColor} text-white px-5 py-4 rounded-2xl shadow-2xl flex items-start gap-3 transform translate-y-5 opacity-0 transition-all duration-300 backdrop-blur-md border border-white/10`;
            toast.innerHTML = `
                <span class="material-symbols-outlined flex-shrink-0 select-none">${icon}</span>
                <div class="text-sm font-semibold leading-relaxed">${message}</div>
            `;
            
            toastContainer.appendChild(toast);
            
            // Force reflow and animate in
            toast.offsetHeight;
            toast.classList.remove('translate-y-5', 'opacity-0');
            
            // Dismiss after 6 seconds
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 6000);
        }
    });
</script>
@endsection