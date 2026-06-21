@extends('layouts.app')

@section('content')
    <main class="pt-28 pb-section-gap">
        <!-- Hero Section -->
        @if(isset($banners) && !$banners->isEmpty())
            <section class="relative min-h-[90vh] flex items-center overflow-hidden pt-20 bg-slate-950">
                <div id="hero-slider" class="absolute inset-0 w-full h-full z-0">
                    @foreach($banners as $index => $banner)
                        <div class="welcome-slide absolute inset-0 w-full h-full opacity-0 transition-all duration-1000 ease-in-out flex items-center" data-index="{{ $index }}">
                            <!-- Background Image Layer -->
                            <div class="absolute inset-0 z-0">
                                <img alt="{{ $banner->title }}"
                                    class="w-full h-full object-cover scale-100 transition-transform duration-[6000ms] ease-out"
                                    src="{{ Storage::url($banner->image_path) }}"
                                    onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');" />
                                <div class="hidden absolute inset-0 bg-slate-900 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-slate-700/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="absolute inset-0 bg-[#0f172a]" style="opacity: {{ ($banner->overlay_opacity ?? 60) / 100 }}"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/40 via-transparent to-transparent"></div>
                            </div>
                            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop relative z-10 w-full">
                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                                    <!-- Text Content -->
                                    @php
                                        $ctaColorClasses = [
                                            'amber' => 'bg-secondary text-on-secondary hover:shadow-secondary/40',
                                            'blue' => 'bg-blue-600 text-white hover:bg-blue-700 hover:shadow-blue-500/30',
                                            'emerald' => 'bg-emerald-600 text-white hover:bg-emerald-700 hover:shadow-emerald-500/30',
                                            'red' => 'bg-red-600 text-white hover:bg-red-700 hover:shadow-red-500/30',
                                            'indigo' => 'bg-indigo-600 text-white hover:bg-indigo-700 hover:shadow-indigo-500/30',
                                            'slate' => 'bg-slate-700 text-white hover:bg-slate-800 hover:shadow-slate-600/30',
                                        ][$banner->cta_color ?? 'amber'] ?? 'bg-secondary text-on-secondary hover:shadow-secondary/40';

                                        $alignmentClasses = [
                                            'left' => 'lg:col-span-8 flex flex-col items-start text-left mr-auto',
                                            'center' => 'lg:col-span-8 lg:col-start-3 flex flex-col items-center text-center mx-auto',
                                            'right' => 'lg:col-span-8 lg:col-start-5 flex flex-col items-end text-right ml-auto',
                                        ][$banner->alignment ?? 'left'] ?? 'lg:col-span-8 flex flex-col items-start text-left mr-auto';
                                    @endphp
                                    <div class="{{ $alignmentClasses }} gap-6 transform translate-y-6 opacity-0 transition-all duration-1000">
                                        <div class="inline-flex items-center gap-3 bg-white/5 backdrop-blur-xl px-4 py-1.5 rounded-full border border-white/10 shadow-sm">
                                            <span class="relative flex h-2 w-2">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2 bg-secondary"></span>
                                            </span>
                                            <span class="font-label-md text-xs text-on-primary/90 tracking-widest uppercase">SMA GIKI 3 SURABAYA</span>
                                        </div>
                                        <h1 class="font-display-lg-mobile text-4xl md:text-6xl font-black leading-tight tracking-tight [text-shadow:_0_4px_16px_rgba(0,0,0,0.3)]
                                            {{ ($banner->text_color ?? 'light') === 'dark' ? 'text-slate-900' : 'text-on-primary' }}">
                                            {{ $banner->title }}
                                        </h1>
                                        @if($banner->subtitle)
                                            <p class="font-body-lg text-body-lg max-w-2xl leading-relaxed [text-shadow:_0_2px_8px_rgba(0,0,0,0.2)]
                                                {{ ($banner->text_color ?? 'light') === 'dark' ? 'text-slate-700' : 'text-on-primary/80' }}">
                                                {{ $banner->subtitle }}
                                            </p>
                                        @endif
                                        @if($banner->button_text)
                                            <div class="flex flex-wrap gap-6 mt-2">
                                                <a href="{{ $banner->button_url ?? '#' }}"
                                                    class="btn-primary font-bold text-label-md px-10 py-4.5 rounded-full shadow-lg hover:-translate-y-1 active:scale-95 transition-all duration-300 tracking-wide flex items-center gap-2 {{ $ctaColorClasses }}">
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
                    <button id="welcome-prev-btn" class="absolute left-6 z-20 w-12 h-12 rounded-full bg-black/25 hover:bg-black/45 text-white flex items-center justify-center transition border border-white/10 focus:outline-none backdrop-blur-md hover:scale-105 active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-2xl">arrow_back_ios_new</span>
                    </button>
                    <button id="welcome-next-btn" class="absolute right-6 z-20 w-12 h-12 rounded-full bg-black/25 hover:bg-black/45 text-white flex items-center justify-center transition border border-white/10 focus:outline-none backdrop-blur-md hover:scale-105 active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-2xl">arrow_forward_ios</span>
                    </button>
                    
                    <!-- Navigation Dots -->
                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex space-x-2.5 bg-black/30 px-4 py-2 rounded-full border border-white/5 backdrop-blur-md">
                        @foreach($banners as $index => $banner)
                            <button class="welcome-dot w-2.5 h-2.5 rounded-full bg-white/30 hover:bg-white/60 transition-all focus:outline-none" data-slide-index="{{ $index }}"></button>
                        @endforeach
                    </div>
                @endif
            </section>
        @else
            <section class="relative min-h-[90vh] flex items-center overflow-hidden pt-20">
                <!-- Background Image Layer -->
                <div class="absolute inset-0 z-0"><img alt="SMAN 1 Surabaya Campus"
                        class="w-full h-full object-cover brightness-[0.7] scale-105"
                        src="https://lh3.googleusercontent.com/aida/AP1WRLu4U88psAYyd4fbgc6-aLbIJ5EirwXxQ06Dng5_rolXW8Uj455wHUXt1ccq7OZ-lwZqR6BI7GuZqdLYtMtpT7V8Tiz21DZuPeo6g1aoPfmkW4XyipXAZw-3GvVjX43dui0A-6dUh7vwLyHfLw-T-gZFPvnaffjS7bAcJe8-KPT6RVhBZlmKKznSr8kl6AzgKIBHKL_KXrsRsogo_Edgqg16XzKk4CYRO6tWKFIE2jmkNEmi5Tuk_klEz1E" />
                    <div class="absolute inset-0 bg-gradient-to-r from-primary/80 via-primary/20 to-transparent"></div>
                </div>
                <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop relative z-10 w-full">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                        <!-- Text Content -->
                        <div class="lg:col-span-7 flex flex-col items-start gap-8 fade-up visible">
                            <div
                                class="inline-flex items-center gap-3 bg-white/5 backdrop-blur-xl px-4 py-1.5 rounded-full border border-white/10 shadow-sm">
                                <span class="relative flex h-2 w-2"><span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span><span
                                        class="relative inline-flex rounded-full h-2 w-2 bg-secondary"></span></span><span
                                    class="font-label-md text-xs text-on-primary/90 tracking-widest uppercase">Penerimaan
                                    Siswa Baru 2024</span></div>
                            <h1
                                class="font-display-lg-mobile text-5xl md:text-7xl text-on-primary leading-tight tracking-tight [text-shadow:_0_4px_12px_rgba(0,0,0,0.3)]">
                                Membentuk Karakter,<br />
                                <span class="text-secondary italic font-light">Mengukir Prestasi</span>
                            </h1>
                            <p class="font-body-lg text-body-lg text-on-primary/80 max-w-xl leading-relaxed">
                                Berkomitmen pada keunggulan akademis dan pembentukan karakter mulia melalui semangat Merdeka
                                Belajar, mencetak pemimpin masa depan yang berwawasan global.
                            </p>
                            <div class="flex flex-wrap gap-6 mt-4">
                                <button
                                    class="btn-primary bg-secondary text-on-secondary font-bold text-label-md px-12 py-5 rounded-full shadow-lg hover:shadow-secondary/40 hover:-translate-y-1 active:scale-95 transition-all duration-300 tracking-wide">
                                    Jelajahi Program
                                </button>
                                <button
                                    class="btn-primary bg-white/5 backdrop-blur-xl text-on-primary font-bold text-label-md px-10 py-5 rounded-full border border-white/10 hover:bg-white/10 transition-all duration-300">
                                    Tur Virtual Campus
                                </button>
                            </div>
                        </div>
                        <!-- Floating Image Composition -->
                        <div class="lg:col-span-5 relative hidden lg:block h-[500px]"><!-- Main Floating Card (Students) -->
                            <div
                                class="absolute top-10 right-0 w-4/5 aspect-[4/5] rounded-[2rem] overflow-hidden border border-white/10 shadow-2xl transition-transform duration-700 hover:scale-[1.02] group">
                                <img alt="Student Collaboration" class="w-full h-full object-cover"
                                    src="https://lh3.googleusercontent.com/aida/AP1WRLu9shGxS0bZ6dC3SYNyWR_pMpAywQlYdjXo9kiCa2_Mnr_xuLY8x77De4-TTd8mRvX30rRXH3_xh14MOB0jhDSx_biYKF9De1s7Ysv9wAn1ho_XlfEVVtKoev1O-6mhh_NA1sAihCbZcpE-GOJ6ZmXwKf49_Dn4D3OGPrSghwbYck0q2RHl-26CwQdXMT7R0xvkm6yKYRIMxMFOtioTsTlWiJg14zqGo217b_O5VtBIO6MbIsxNR1Y5cBAP" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent">
                                </div>
                                <div class="absolute bottom-8 left-8">
                                    <p class="text-on-primary font-bold text-title-lg tracking-wide">Kolaborasi Aktif</p>
                                    <div class="w-8 h-0.5 bg-secondary mt-2 transition-all group-hover:w-16"></div>
                                </div>
                            </div><!-- Secondary Floating Card (Lab) -->
                            <div
                                class="absolute -bottom-10 -left-10 w-3/5 aspect-video rounded-2xl overflow-hidden border border-white/20 shadow-2xl backdrop-blur-xl bg-white/5 p-2">
                                <div class="w-full h-full rounded-xl overflow-hidden relative"><img alt="Science Lab"
                                        class="w-full h-full object-cover"
                                        src="https://lh3.googleusercontent.com/aida/AP1WRLt962sYmaEOS_drjNKtYyT1RrFWsGCODuXH-ErDx4IPHxxEwsoRywY26TXKCs60fHXiAtn4xkZd7yDU7U1JuoBt2QdfBiu39cLnG7U56CqNaIZEqFsHTMizuATTKijgvz4Xl2Zl0KUtRrSM4rwpHjvMJxBttXvY94KaCtZhqqPJXxxvLrlIJAgeLdRG-x4rlGEEfyOSsWpwwNhcMgG3_M-jnU-dXV3HGHVcHyX6YAfpv8_eJYVCKDDunEQ" />
                                    <div class="absolute inset-0 bg-primary/20"></div>
                                </div>
                            </div><!-- Decorative Element -->
                            <div
                                class="absolute -top-4 -right-4 w-32 h-32 bg-secondary/10 rounded-full blur-3xl animate-pulse">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- Stats Section Redesign -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-20 fade-up visible">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 py-10 border-y border-outline-variant/20 relative">
                <!-- Abstract BG Elements -->
                <div class="absolute top-0 left-1/4 w-32 h-32 bg-secondary/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-1/4 w-32 h-32 bg-primary/5 rounded-full blur-3xl"></div>
                <div
                    class="text-center relative z-10 flex flex-col items-center justify-center p-6 glass-card rounded-2xl hover:-translate-y-2 transition-transform duration-300">
                    <span class="material-symbols-outlined text-secondary text-4xl mb-4">verified</span>
                    <div class="flex items-baseline gap-1 mb-2">
                        <h2 class="font-display-lg text-display-lg text-primary">A</h2>
                        <span class="text-secondary font-bold text-2xl">+</span>
                    </div>
                    <p class="font-title-lg text-title-lg text-on-surface-variant">Akreditasi Institusi</p>
                </div>
                <div
                    class="hidden md:block absolute left-1/3 top-1/2 -translate-y-1/2 w-px h-2/3 bg-gradient-to-b from-transparent via-outline-variant/30 to-transparent">
                </div>
                <div
                    class="text-center relative z-10 flex flex-col items-center justify-center p-6 glass-card rounded-2xl hover:-translate-y-2 transition-transform duration-300 delay-100">
                    <span class="material-symbols-outlined text-secondary text-4xl mb-4">group</span>
                    <div class="flex items-baseline gap-1 mb-2">
                        <h2 class="font-display-lg text-display-lg text-primary counter-value" data-target="1000">1000
                        </h2>
                        <span class="text-secondary font-bold text-2xl">+</span>
                    </div>
                    <p class="font-title-lg text-title-lg text-on-surface-variant">Siswa Aktif</p>
                </div>
                <div
                    class="hidden md:block absolute right-1/3 top-1/2 -translate-y-1/2 w-px h-2/3 bg-gradient-to-b from-transparent via-outline-variant/30 to-transparent">
                </div>
                <div
                    class="text-center relative z-10 flex flex-col items-center justify-center p-6 glass-card rounded-2xl hover:-translate-y-2 transition-transform duration-300 delay-200">
                    <span class="material-symbols-outlined text-secondary text-4xl mb-4">school</span>
                    <div class="flex items-baseline gap-1 mb-2">
                        <h2 class="font-display-lg text-display-lg text-primary counter-value" data-target="98">98</h2>
                        <span class="text-secondary font-bold text-2xl">%</span>
                    </div>
                    <p class="font-title-lg text-title-lg text-on-surface-variant">Lulusan ke PTN</p>
                </div>
            </div>
        </section>
        <!-- Bento Grid: Prestasi & Visi Redesign -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32">
            <div class="mb-16 text-center max-w-3xl mx-auto fade-up visible">
                <span class="text-secondary font-label-md tracking-widest uppercase mb-4 block">Visi &amp; Misi</span>
                <h2
                    class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-6">
                    Membangun Masa Depan</h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant">Pendekatan holistik kami memastikan setiap
                    siswa tidak hanya unggul secara akademis tetapi juga siap menghadapi tantangan dunia nyata dengan
                    integritas.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-3 gap-6 auto-rows-[250px]">
                <!-- Headmaster Quote (Hero Card) -->
                <div
                    class="bento-card md:col-span-2 md:row-span-2 p-10 flex flex-col justify-center relative overflow-hidden fade-up visible bg-primary group">
                    <div
                        class="absolute top-0 right-0 w-96 h-96 bg-secondary/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4 group-hover:bg-secondary/20 transition-colors duration-700">
                    </div>
                    <div class="relative z-10">
                        <span
                            class="material-symbols-outlined text-secondary text-6xl mb-6 opacity-80">format_quote</span>
                        <h3 class="font-display-lg-mobile text-display-lg-mobile text-on-primary mb-8 leading-tight">
                            "Pendidikan bukan sekadar mengisi wadah yang kosong, melainkan menyalakan api
                            keingintahuan."
                        </h3>
                        <div class="flex items-center gap-5 mt-auto">
                            <img alt="Headmaster Portrait"
                                class="w-16 h-16 rounded-full border-2 border-secondary object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhXniWW-W0QWzCOpI77isbjwqCJLjUmfS5v93yUGM19K2GsljhhLqDAmXHCrT-p4HWVn2JRKDi4j-sPfcQc7u6VrC2KwAE3QAFAMZXOFQKDrpKBiO0pjwEcfm_mDgUwMl_7bwSpLvmSX5xD9CRzIXH3OLl36MhmJIp5SFO36xHOETcSMpbJg53gbUcs8u9_dynsyzWDuk6IaFEzF691bY3WO_AsP_Y9xeb2zIeIIYAVH2ixK7ZMv7oJG8vYBR-4imDPYPtncQ_e_dB"
                                loading="lazy" />
                            <div>
                                <p class="font-title-lg text-title-lg text-on-primary">Drs. H. M. Zainuri, M.Si</p>
                                <p class="font-body-md text-body-md text-secondary">Kepala Sekolah</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Academic Achievement Card -->
                <div
                    class="bento-card md:col-span-2 md:row-span-1 p-8 flex flex-col justify-between bg-surface-container-lowest fade-up delay-100 visible">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-14 h-14 bg-surface rounded-2xl flex items-center justify-center text-secondary border border-outline-variant/20">
                            <span class="material-symbols-outlined text-3xl">emoji_events</span>
                        </div>
                        <span
                            class="font-label-md text-label-md text-primary bg-primary/5 px-4 py-1.5 rounded-full border border-primary/10">Prestasi
                            Terbaru</span>
                    </div>
                    <div>
                        <h4 class="font-headline-sm text-headline-sm text-primary mb-2">Juara Umum OSN 2023</h4>
                        <p class="font-body-md text-body-md text-on-surface-variant">Meraih medali emas terbanyak di
                            tingkat provinsi Jawa Timur, mengukuhkan posisi sebagai institusi unggulan.</p>
                    </div>
                </div>
                <!-- Philosophy Card -->
                <div
                    class="bento-card md:col-span-1 md:row-span-2 p-8 flex flex-col bg-surface-container-lowest fade-up delay-200 visible">
                    <div
                        class="w-14 h-14 bg-surface rounded-2xl flex items-center justify-center text-secondary border border-outline-variant/20 mb-6">
                        <span class="material-symbols-outlined text-3xl">psychology</span>
                    </div>
                    <h4 class="font-headline-sm text-headline-sm text-primary mb-4">Merdeka Belajar</h4>
                    <p class="font-body-md text-body-md text-on-surface-variant flex-grow">Di SMAN 1 Surabaya, kurikulum
                        dirancang untuk memfasilitasi eksplorasi mendalam, pemikiran kritis, dan kreativitas tanpa
                        batas.</p>
                    <a class="inline-flex items-center gap-2 font-label-md text-label-md text-secondary hover:text-primary transition-colors group mt-4"
                        href="#">
                        Pelajari Kurikulum
                        <span
                            class="material-symbols-outlined transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>
                <!-- Facilities Image Card -->
                <div
                    class="bento-card md:col-span-1 md:row-span-1 relative group fade-up delay-300 visible overflow-hidden">
                    <img alt="Modern Laboratory Facilities"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhXniWW-W0QWzCOpI77isbjwqCJLjUmfS5v93yUGM19K2GsljhhLqDAmXHCrT-p4HWVn2JRKDi4j-sPfcQc7u6VrC2KwAE3QAFAMZXOFQKDrpKBiO0pjwEcfm_mDgUwMl_7bwSpLvmSX5xD9CRzIXH3OLl36MhmJIp5SFO36xHOETcSMpbJg53gbUcs8u9_dynsyzWDuk6IaFEzF691bY3WO_AsP_Y9xeb2zIeIIYAVH2ixK7ZMv7oJG8vYBR-4imDPYPtncQ_e_dB"
                        loading="lazy" />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity">
                    </div>
                    <div
                        class="absolute bottom-6 left-6 right-6 transform group-hover:-translate-y-2 transition-transform duration-300">
                        <h4 class="font-title-lg text-title-lg text-on-primary mb-1">Fasilitas Modern</h4>
                        <p
                            class="font-body-md text-on-primary/80 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 h-0 group-hover:h-auto overflow-hidden">
                            Laboratorium Terpadu &amp; Maker Space</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Ekstrakurikuler Carousel Redesign -->
        <section class="max-w-[1600px] mx-auto px-margin-mobile md:px-margin-desktop my-32 overflow-hidden">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 fade-up visible gap-6">
                <div class="max-w-2xl">
                    <span class="text-secondary font-label-md tracking-widest uppercase mb-4 block">Kegiatan Siswa</span>
                    <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-4">
                        Pengembangan Minat &amp; Bakat
                    </h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Lebih dari 20+ ekstrakurikuler aktif untuk mengeksplorasi potensi di luar kelas akademik.</p>
                </div>
                <div class="flex gap-4">
                    <button id="ekskul-prev-btn"
                        class="w-14 h-14 rounded-full border-2 border-outline-variant/30 flex items-center justify-center text-primary hover:border-secondary hover:text-secondary hover:bg-surface-container-lowest transition-all duration-300 group">
                        <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
                    </button>
                    <button id="ekskul-next-btn"
                        class="w-14 h-14 rounded-full border-2 border-outline-variant/30 flex items-center justify-center text-primary hover:border-secondary hover:text-secondary hover:bg-surface-container-lowest transition-all duration-300 group">
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
            </div>
            <div id="ekskul-slider" class="flex gap-8 overflow-x-auto pb-12 snap-x snap-mandatory hide-scrollbar">
                @forelse($extracurriculars as $ekskul)
                    <div class="min-w-[320px] md:min-w-[480px] h-[600px] rounded-[2rem] overflow-hidden relative group snap-center fade-up visible shadow-lg cursor-pointer"
                         onclick="window.location.href='{{ route('ekstrakurikuler.index') }}'">
                        @if($ekskul->image_path)
                            @if(Str::startsWith($ekskul->image_path, 'http'))
                                <img alt="{{ $ekskul->name }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="{{ $ekskul->image_path }}" loading="lazy" />
                            @else
                                <img alt="{{ $ekskul->name }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="{{ Storage::url($ekskul->image_path) }}" loading="lazy" />
                            @endif
                        @else
                            <div class="w-full h-full bg-slate-900 flex items-center justify-center text-slate-700">
                                <span class="material-symbols-outlined text-8xl">{{ $ekskul->icon ?: 'sports_soccer' }}</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/50 to-transparent opacity-80 group-hover:opacity-95 transition-opacity duration-500"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-10 transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                            <div class="w-12 h-1 bg-secondary mb-6 rounded-full"></div>
                            <span class="font-label-md text-label-md text-secondary mb-3 block tracking-widest uppercase">{{ $ekskul->category ?: 'Kegiatan' }}</span>
                            <h3 class="font-display-lg-mobile text-display-lg-mobile text-on-primary mb-4">{{ $ekskul->name }}</h3>
                            <p class="font-body-lg text-body-lg text-on-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100 leading-relaxed">
                                {{ $ekskul->description }}
                            </p>
                        </div>
                    </div>
                @empty
                    <!-- Card 1 (Fallback) -->
                    <div class="min-w-[320px] md:min-w-[480px] h-[600px] rounded-[2rem] overflow-hidden relative group snap-center fade-up visible shadow-lg">
                        <img alt="Traditional Dance Extracurricular"
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCO38iPlrza6vYZYAyX7PQAxDVL--q0_tE-V_UCbUGC-pyQolX8VgYMyo6iv_N-B6rc6XSyZRvI-NVKEhJsCU0038zo9-pIL4hcuBmOlUMAt_sjOCELOOTLqqJ01m1mjAqLnLUFZm6ovBKVj0Rf2dFR-TCG6_Joxy3aHzWCp7rQPkq8iazwqK9H-YdIFRWPeFrm7rsDCdyewWEzqCmZWrjfzYsE75wM8OzERM7JgOZbjm05LBnyVqE2G3HdyEpDYrdLah_a6LIItnQH"
                            loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/50 to-transparent opacity-80 group-hover:opacity-95 transition-opacity duration-500"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-10 transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                            <div class="w-12 h-1 bg-secondary mb-6 rounded-full"></div>
                            <span class="font-label-md text-label-md text-secondary mb-3 block tracking-widest uppercase">Seni Budaya</span>
                            <h3 class="font-display-lg-mobile text-display-lg-mobile text-on-primary mb-4">Tari Tradisional</h3>
                            <p class="font-body-lg text-body-lg text-on-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                Melestarikan warisan budaya nusantara melalui gerak dan harmoni, tampil di berbagai festival nasional.
                            </p>
                        </div>
                    </div>
                    <!-- Card 2 (Fallback) -->
                    <div class="min-w-[320px] md:min-w-[480px] h-[600px] rounded-[2rem] overflow-hidden relative group snap-center fade-up delay-100 visible shadow-lg">
                        <img alt="Tim Basket"
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDLT7MEGmBhEANV3w7U9898OXQr0DfDB-zyie1rzCazRqQCp2WDP5C__pIeFuFKDctbpiWNHws6BEY6szXryhToLKbq90tfdE6Y1O6Tn2VuaikLd557R3t7CYRg5y2Zn8RDHsWAysfVM_VGptUagChzGLzg0qNdYxTOerHcCq-UGFxfeKJvymE5ihuagw8igMUdFNuCiTwIonQkf1AcW_gusX6kYXgPFegt2B0KL6lHFNt_mbOpPhOtQNdrgWud58p_QmLn08xv1fi-"
                            loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/50 to-transparent opacity-80 group-hover:opacity-95 transition-opacity duration-500"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-10 transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                            <div class="w-12 h-1 bg-secondary mb-6 rounded-full"></div>
                            <span class="font-label-md text-label-md text-secondary mb-3 block tracking-widest uppercase">Olahraga</span>
                            <h3 class="font-display-lg-mobile text-display-lg-mobile text-on-primary mb-4">Tim Basket</h3>
                            <p class="font-body-lg text-body-lg text-on-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                Membangun sportivitas, disiplin, dan kerjasama tim di lapangan kompetisi.
                            </p>
                        </div>
                    </div>
                    <!-- Card 3 (Fallback) -->
                    <div class="min-w-[320px] md:min-w-[480px] h-[600px] rounded-[2rem] overflow-hidden relative group snap-center fade-up delay-200 visible shadow-lg">
                        <img alt="Klub Robotika"
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuATkTVQBv3VR4_U_-0KyWt1VrqYlg0Oo46X8_esHSTLqZZwhJ5HjQJxpS5TSZtnrVJl0Q84yo_P66zUvitxlE7LEylw4kMDwPPXETHL878Q6NZTYouQSvswKvvHXMQ2qtIOMui0RTxV7pAxX0iuO5kNG3a0VFxo69QUbMTw087TaDgrdgnpLSQPmjIfyoYqAgVDv7UQMQ1bqbXvzFwulLmxV-bpJkcQaWV1G7QblZZiWCuqa0GpXIMS-6mBtMMG5lVz6S0cQwpf50K2"
                            loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/50 to-transparent opacity-80 group-hover:opacity-95 transition-opacity duration-500"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-10 transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                            <div class="w-12 h-1 bg-secondary mb-6 rounded-full"></div>
                            <span class="font-label-md text-label-md text-secondary mb-3 block tracking-widest uppercase">Sains &amp; Teknologi</span>
                            <h3 class="font-display-lg-mobile text-display-lg-mobile text-on-primary mb-4">Klub Robotika</h3>
                            <p class="font-body-lg text-body-lg text-on-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                Inovasi teknologi masa depan dirancang hari ini melalui pemecahan masalah praktis.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
            <style>
                .hide-scrollbar::-webkit-scrollbar {
                    display: none;
                }

                .hide-scrollbar {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
            </style>
        </section>

        <!-- Gallery Section -->
        @if(isset($galleries) && !$galleries->isEmpty())
            <section id="galeri" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32 fade-up">
                <div class="mb-16 text-center max-w-3xl mx-auto">
                    <span class="text-secondary font-label-md tracking-widest uppercase mb-4 block">Dokumentasi</span>
                    <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-6">
                        Galeri Kegiatan Sekolah
                    </h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">
                        Momen-momen berharga dan dokumentasi kegiatan belajar mengajar, ekstrakurikuler, serta acara sekolah kami.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($galleries as $gallery)
                        @php
                            $coverImage = $gallery->images->first()?->image_path;
                        @endphp
                        @if($coverImage)
                            <div class="group cursor-pointer bg-white rounded-3xl overflow-hidden border border-outline-variant/20 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full animate-card"
                                 onclick="openGalleryModal('{{ $gallery->id }}')">
                                <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                                    <img src="{{ Storage::url($coverImage) }}" alt="{{ $gallery->title }}"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                         loading="lazy">
                                    <div class="absolute inset-0 bg-gradient-to-t from-primary/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                        <span class="text-white font-semibold text-sm flex items-center gap-2 bg-secondary/80 backdrop-blur-sm px-4 py-2 rounded-full transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
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
                                            {{ $gallery->description ?? 'Tidak ada deskripsi kegiatan.' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Gallery Modals Data -->
                @foreach($galleries as $gallery)
                    <div id="gallery-modal-{{ $gallery->id }}" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 md:p-6 bg-primary/80 backdrop-blur-md opacity-0 transition-opacity duration-300">
                        <div class="bg-white rounded-3xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col shadow-2xl transform scale-95 transition-transform duration-300">
                            <!-- Header -->
                            <div class="px-6 py-5 border-b border-outline-variant/20 flex justify-between items-center bg-slate-50">
                                <div>
                                    <h3 class="font-bold text-xl text-primary">{{ $gallery->title }}</h3>
                                    <p class="text-on-surface-variant text-xs mt-1">Dokumentasi Kegiatan • {{ $gallery->images->count() }} Foto</p>
                                </div>
                                <button onclick="closeGalleryModal('{{ $gallery->id }}')" class="w-10 h-10 rounded-full hover:bg-slate-200 flex items-center justify-center text-primary transition">
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
                    <!-- Close button -->
                    <button onclick="closeLightbox()" class="absolute top-6 right-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md">
                        <span class="material-symbols-outlined text-2xl">close</span>
                    </button>

                    <!-- Navigation arrows -->
                    <button onclick="prevLightboxImage()" class="absolute left-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md">
                        <span class="material-symbols-outlined text-2xl">arrow_back_ios_new</span>
                    </button>
                    <button onclick="nextLightboxImage()" class="absolute right-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md">
                        <span class="material-symbols-outlined text-2xl">arrow_forward_ios</span>
                    </button>

                    <!-- Image container -->
                    <div class="w-full max-w-4xl max-h-[80vh] px-4 flex items-center justify-center">
                        <img id="lightbox-img" src="" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl transition-transform duration-300 transform scale-95">
                    </div>

                    <!-- Caption & Counter -->
                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-center text-white px-6 py-3 bg-white/5 border border-white/10 rounded-full backdrop-blur-md max-w-md">
                        <p id="lightbox-caption" class="text-sm font-semibold truncate"></p>
                        <p id="lightbox-counter" class="text-[10px] text-white/60 mt-0.5 font-bold uppercase tracking-wider"></p>
                    </div>
                </div>
            </section>
        @endif

        <!-- Testimonials Section -->
        @if(isset($testimonials) && !$testimonials->isEmpty())
            <section id="testimoni" class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32 fade-up">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                    <div class="max-w-2xl">
                        <span class="text-secondary font-label-md tracking-widest uppercase mb-4 block">Testimoni</span>
                        <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-4">
                            Kata Mereka Tentang Kami
                        </h2>
                        <p class="font-body-lg text-body-lg text-on-surface-variant">
                            Ulasan jujur dan cerita inspiratif dari siswa, alumni, guru, serta orang tua/wali murid SMA GIKI 3 Surabaya.
                        </p>
                    </div>
                    @if($testimonials->count() > 1)
                        <div class="flex gap-4">
                            <button id="testi-prev-btn" class="w-14 h-14 rounded-full border-2 border-outline-variant/30 flex items-center justify-center text-primary hover:border-secondary hover:text-secondary hover:bg-surface-container-lowest transition-all duration-300 group">
                                <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
                            </button>
                            <button id="testi-next-btn" class="w-14 h-14 rounded-full border-2 border-outline-variant/30 flex items-center justify-center text-primary hover:border-secondary hover:text-secondary hover:bg-surface-container-lowest transition-all duration-300 group">
                                <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Testimonial Cards Slider Container -->
                <div class="relative overflow-hidden py-4">
                    <div id="testi-slider" class="flex gap-8 transition-transform duration-500 ease-in-out snap-x snap-mandatory hide-scrollbar overflow-x-auto">
                        @foreach($testimonials as $testimonial)
                            <div class="testi-card min-w-[280px] sm:min-w-[380px] md:min-w-[420px] max-w-[450px] bg-white rounded-3xl p-8 border border-outline-variant/10 shadow-md hover:shadow-xl transition-all duration-300 snap-center flex flex-col justify-between relative group hover:-translate-y-1">
                                <!-- Quote Icon Decoration -->
                                <span class="absolute top-6 right-8 text-slate-100 group-hover:text-amber-100/40 text-7xl font-serif select-none transition duration-300">”</span>
                                
                                <div>
                                    <!-- Stars Rating -->
                                    @if($testimonial->rating)
                                        <div class="flex items-center gap-1 mb-6">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-amber-400 fill-current' : 'text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.907c.961 0 1.36 1.238.588 1.81l-3.97 2.883a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.971-2.883a1 1 0 00-1.18 0l-3.97 2.883c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118L2.98 9.42c-.771-.572-.372-1.81.588-1.81h4.906a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    @endif

                                    <!-- Content -->
                                    <p class="font-body-md text-slate-600 leading-relaxed italic mb-8 relative z-10">
                                        "{{ $testimonial->content }}"
                                    </p>
                                </div>

                                <!-- Author Info -->
                                <div class="flex items-center gap-4 mt-auto border-t border-slate-50 pt-6">
                                    <div class="w-12 h-12 rounded-full overflow-hidden border border-slate-100 flex-shrink-0 bg-slate-50 flex items-center justify-center font-bold text-primary">
                                        @if($testimonial->avatar)
                                            <img src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover" loading="lazy">
                                        @else
                                            <span>{{ substr($testimonial->name, 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-title-lg text-base text-primary font-bold">{{ $testimonial->name }}</h4>
                                        <p class="text-xs text-secondary font-semibold mt-0.5 tracking-wider uppercase">{{ $testimonial->relationship }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- News & Announcements Redesign -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32 fade-up visible">
            <div class="flex justify-between items-end mb-12 border-b border-outline-variant/30 pb-6">
                <div>
                    <span class="text-secondary font-label-md tracking-widest uppercase mb-4 block">Pusat Informasi</span>
                    <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary">
                        Berita &amp; Artikel Terbaru
                    </h2>
                </div>
                <a class="hidden md:inline-flex items-center gap-2 font-label-md text-label-md text-primary hover:text-secondary transition-colors group mb-2"
                    href="{{ route('articles.index') }}">
                    Lihat Semua Berita
                    <span class="material-symbols-outlined transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            @if($articles->isEmpty())
                <div class="bg-white rounded-[2rem] p-12 text-center border border-slate-100 shadow-sm flex flex-col items-center justify-center w-full">
                    <span class="material-symbols-outlined text-5xl text-slate-350 mb-3">newspaper</span>
                    <h4 class="text-lg font-bold text-slate-700">Belum ada berita terbaru</h4>
                    <p class="text-slate-400 text-sm mt-1">Nantikan pembaruan informasi menarik dari kami segera.</p>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 w-full">
                    <!-- Featured News -->
                    @php $featured = $articles->first(); @endphp
                    <div class="lg:col-span-6 group cursor-pointer">
                        <a href="{{ route('articles.show', $featured->slug) }}">
                            <div class="w-full h-80 rounded-[2rem] overflow-hidden mb-6 relative bg-slate-100">
                                @if($featured->thumbnail)
                                    <img alt="{{ $featured->title }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                        src="{{ Storage::url($featured->thumbnail) }}"
                                        loading="lazy" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-350">
                                        <span class="material-symbols-outlined text-5xl">image</span>
                                    </div>
                                @endif
                                <div class="absolute top-6 left-6">
                                    <span class="bg-primary text-on-primary font-label-md px-4 py-2 rounded-full text-sm">Terbaru</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-on-surface-variant mb-4 text-xs font-semibold">
                                <span class="text-secondary">{{ $featured->published_at ? $featured->published_at->format('d M Y') : $featured->created_at->format('d M Y') }}</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-outline-variant"></span>
                                <span>Oleh Admin</span>
                            </div>
                            <h3 class="font-display-lg-mobile text-2xl md:text-3xl text-primary font-bold mb-4 group-hover:text-secondary transition-colors line-clamp-2 leading-snug">
                                {{ $featured->title }}
                            </h3>
                            <p class="font-body-lg text-body-lg text-on-surface-variant line-clamp-3 text-sm leading-relaxed">
                                {{ $featured->meta_description ?: strip_tags($featured->content) }}
                            </p>
                        </a>
                    </div>
                    
                    <!-- News List -->
                    <div class="lg:col-span-6 flex flex-col gap-8">
                        @foreach($articles->skip(1) as $item)
                            <div class="group cursor-pointer grid grid-cols-1 sm:grid-cols-4 gap-6 items-center">
                                <a href="{{ route('articles.show', $item->slug) }}" class="sm:col-span-1 h-32 rounded-2xl overflow-hidden bg-slate-150 relative block">
                                    @if($item->thumbnail)
                                        <img alt="{{ $item->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                            src="{{ Storage::url($item->thumbnail) }}"
                                            loading="lazy" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-350">
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
                                        <h4 class="text-lg font-bold text-primary mb-2 group-hover:text-secondary transition-colors line-clamp-2 leading-snug">
                                            {{ $item->title }}
                                        </h4>
                                        <p class="font-body-md text-body-md text-on-surface-variant text-sm line-clamp-2 leading-relaxed">
                                            {{ $item->meta_description ?: strip_tags($item->content) }}
                                        </p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <a class="md:hidden inline-flex items-center gap-2 font-label-md text-label-md text-primary hover:text-secondary transition-colors group mt-8"
                href="{{ route('articles.index') }}">
                Lihat Semua Berita
                <span class="material-symbols-outlined transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </a>
        </section>
    </main>
@endsection

@section('scripts')
<script>
    // Intersection Observer for Fade-Up Animation & Counters
    document.addEventListener("DOMContentLoaded", () => {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const animateCounter = (el) => {
            const target = parseInt(el.getAttribute('data-target'));
            let current = 0;
            const increment = target / 50; // Adjust speed here
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    el.innerText = target;
                    clearInterval(timer);
                } else {
                    el.innerText = Math.ceil(current);
                }
            }, 30);
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
                        text.classList.add('translate-y-6', 'opacity-0');
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
                        activeText.classList.remove('translate-y-6', 'opacity-0');
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
    });
</script>
@endsection