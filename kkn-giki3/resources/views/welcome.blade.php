<!DOCTYPE html>

<html class="scroll-smooth" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SMA Negeri 1 Surabaya</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&amp;family=Poppins:ital,wght@0,100..900;1,100..900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary": "#0b0d0b",
                        "surface-tint": "#4f5e80",
                        "surface-container-low": "#eef4fc",
                        "primary-container": "#112240",
                        "inverse-on-surface": "#ebf1f9",
                        "outline-variant": "#c5c6ce",
                        "on-primary-container": "#7a8aad",
                        "secondary-fixed-dim": "#ffb59e",
                        "on-primary-fixed": "#091b39",
                        "tertiary-fixed": "#e3e2e0",
                        "surface-container-high": "#e3e9f1",
                        "on-secondary-fixed": "#390b00",
                        "primary": "#112240",
                        "on-tertiary-container": "#8a8a88",
                        "on-primary": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-tertiary-fixed": "#1a1c1a",
                        "on-secondary-fixed-variant": "#7a2f15",
                        "inverse-surface": "#2b3137",
                        "surface-bright": "#FAF9F6",
                        "on-surface-variant": "#44474e",
                        "error": "#ba1a1a",
                        "surface-dim": "#d4dbe2",
                        "surface-container-highest": "#dde3eb",
                        "on-tertiary-fixed-variant": "#464745",
                        "surface-variant": "#dde3eb",
                        "inverse-primary": "#b6c6ed",
                        "on-surface": "#112240",
                        "secondary-container": "#E5A93C",
                        "on-error": "#ffffff",
                        "on-secondary": "#ffffff",
                        "primary-fixed-dim": "#b6c6ed",
                        "on-secondary-container": "#ffffff",
                        "on-primary-fixed-variant": "#374767",
                        "secondary-fixed": "#ffdbd0",
                        "surface": "#FAF9F6",
                        "on-tertiary": "#ffffff",
                        "error-container": "#ffdad6",
                        "secondary": "#E5A93C",
                        "tertiary-fixed-dim": "#c7c6c4",
                        "background": "#FAF9F6",
                        "tertiary-container": "#212321",
                        "outline": "#75777e",
                        "surface-container": "#e8eef6",
                        "on-background": "#112240",
                        "primary-fixed": "#d8e2ff",
                        "surface-container-lowest": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "16px",
                        "container-max": "1280px",
                        "unit": "8px",
                        "margin-desktop": "48px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "headline-sm": [
                            "Poppins"
                        ],
                        "display-lg-mobile": [
                            "Poppins"
                        ],
                        "title-lg": [
                            "Poppins"
                        ],
                        "headline-md": [
                            "Poppins"
                        ],
                        "body-lg": [
                            "Open Sans"
                        ],
                        "label-md": [
                            "Open Sans"
                        ],
                        "display-lg": [
                            "Poppins"
                        ],
                        "body-md": [
                            "Open Sans"
                        ]
                    },
                    "fontSize": {
                        "headline-sm": [
                            "24px",
                            {
                                "lineHeight": "32px",
                                "fontWeight": "600"
                            }
                        ],
                        "display-lg-mobile": [
                            "36px",
                            {
                                "lineHeight": "44px",
                                "letterSpacing": "-0.01em",
                                "fontWeight": "700"
                            }
                        ],
                        "title-lg": [
                            "20px",
                            {
                                "lineHeight": "28px",
                                "fontWeight": "600"
                            }
                        ],
                        "headline-md": [
                            "32px",
                            {
                                "lineHeight": "40px",
                                "fontWeight": "600"
                            }
                        ],
                        "body-lg": [
                            "18px",
                            {
                                "lineHeight": "28px",
                                "fontWeight": "400"
                            }
                        ],
                        "label-md": [
                            "14px",
                            {
                                "lineHeight": "20px",
                                "letterSpacing": "0.05em",
                                "fontWeight": "600"
                            }
                        ],
                        "display-lg": [
                            "48px",
                            {
                                "lineHeight": "56px",
                                "letterSpacing": "-0.02em",
                                "fontWeight": "700"
                            }
                        ],
                        "body-md": [
                            "16px",
                            {
                                "lineHeight": "24px",
                                "fontWeight": "400"
                            }
                        ]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            background-color: #FAF9F6;
            font-family: 'Open Sans', sans-serif;
        }

        .glass-nav {
            background: rgba(250, 249, 246, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-100 {
            transition-delay: 100ms;
        }

        .delay-200 {
            transition-delay: 200ms;
        }

        .delay-300 {
            transition-delay: 300ms;
        }

        .bento-card {
            background-color: #FFFFFF;
            border-radius: 1rem;
            border: 1px solid rgba(17, 34, 64, 0.05);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 20px rgba(17, 34, 64, 0.03);
        }

        .bento-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 48px rgba(17, 34, 64, 0.08);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .btn-primary {
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .btn-primary:active {
            transform: scale(0.95);
        }

        /* Count animation utility */
        @property --num {
            syntax: "<integer>";
            initial-value: 0;
            inherits: false;
        }
    </style>
</head>

<body class="text-on-surface antialiased overflow-x-hidden selection:bg-secondary selection:text-on-secondary">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-outline-variant/30 shadow-sm transition-all duration-300"
        id="navbar">
        <div
            class="flex justify-between items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="flex items-center gap-4">
                <img alt="SMA Negeri 1 Surabaya Logo" class="h-12 w-auto"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAqpOf4qKo00Ysfs_kCWG7fEdWOlEicpvIPopKs1JuAxe7nv2OqYrgsT3NQM1QZCp03sMGGXIpbkWyxJSnxzTzJPUQdkvuKyQijzIhdiWaBWkA2UgTuyDe7K4GO2-nzbxcLZfFWY_nOoBGLqV_kaShHAYwqqPp8p8lgYXTmoURQbJ7Sn2oT7cdsAEU95HPop-ZqU8EAPgnKYwSsejw1zZhUpbS34yfLYKmn41mLHJK4hzcK-SQC_nYUOKoZ_gUKcV-E_j-5AUvt-OMz" />
                <span
                    class="font-display-lg-mobile md:font-display-lg md:text-headline-sm text-primary tracking-tight hidden md:block">SMAN
                    1 Surabaya</span>
            </div>
            <div class="hidden md:flex items-center gap-8">
                <a class="text-title-lg font-semibold text-secondary border-b-2 border-secondary pb-1"
                    href="#">Beranda</a>
                <a class="text-title-lg font-semibold text-on-surface-variant hover:text-secondary transition-colors duration-300"
                    href="#">Profil</a>
                <a class="text-title-lg font-semibold text-on-surface-variant hover:text-secondary transition-colors duration-300"
                    href="#">Akademik</a>
                <a class="text-title-lg font-semibold text-on-surface-variant hover:text-secondary transition-colors duration-300"
                    href="#">Ekstrakurikuler</a>
            </div>
            <button
                class="hidden md:flex btn-primary bg-primary text-on-primary font-label-md text-label-md px-6 py-3 rounded-full border border-primary hover:bg-primary/90 hover:shadow-ambient active:scale-95 duration-200">
                Info PPDB
            </button>
            <button class="md:hidden text-primary p-2">
                <span class="material-symbols-outlined text-3xl">menu</span>
            </button>
        </div>
    </nav>
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
                                    class="w-full h-full object-cover brightness-[0.6] scale-100 transition-transform duration-[6000ms] ease-out"
                                    src="{{ Storage::url($banner->image_path) }}" />
                                <div class="absolute inset-0 bg-gradient-to-r from-[#112240]/90 via-[#112240]/40 to-transparent"></div>
                            </div>
                            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop relative z-10 w-full">
                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                                    <!-- Text Content -->
                                    <div class="lg:col-span-8 flex flex-col items-start gap-6 transform translate-y-6 opacity-0 transition-all duration-1000">
                                        <div class="inline-flex items-center gap-3 bg-white/5 backdrop-blur-xl px-4 py-1.5 rounded-full border border-white/10 shadow-sm">
                                            <span class="relative flex h-2 w-2">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2 bg-secondary"></span>
                                            </span>
                                            <span class="font-label-md text-xs text-on-primary/90 tracking-widest uppercase">SMA GIKI 3 SURABAYA</span>
                                        </div>
                                        <h1 class="font-display-lg-mobile text-4xl md:text-6xl text-on-primary font-black leading-tight tracking-tight [text-shadow:_0_4px_16px_rgba(0,0,0,0.4)]">
                                            {{ $banner->title }}
                                        </h1>
                                        @if($banner->subtitle)
                                            <p class="font-body-lg text-body-lg text-on-primary/80 max-w-2xl leading-relaxed [text-shadow:_0_2px_8px_rgba(0,0,0,0.3)]">
                                                {{ $banner->subtitle }}
                                            </p>
                                        @endif
                                        @if($banner->button_text)
                                            <div class="flex flex-wrap gap-6 mt-2">
                                                <a href="{{ $banner->button_url ?? '#' }}"
                                                    class="btn-primary bg-secondary text-on-secondary font-bold text-label-md px-10 py-4.5 rounded-full shadow-lg hover:shadow-secondary/40 hover:-translate-y-1 active:scale-95 transition-all duration-300 tracking-wide flex items-center gap-2">
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
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhXniWW-W0QWzCOpI77isbjwqCJLjUmfS5v93yUGM19K2GsljhhLqDAmXHCrT-p4HWVn2JRKDi4j-sPfcQc7u6VrC2KwAE3QAFAMZXOFQKDrpKBiO0pjwEcfm_mDgUwMl_7bwSpLvmSX5xD9CRzIXH3OLl36MhmJIp5SFO36xHOETcSMpbJg53gbUcs8u9_dynsyzWDuk6IaFEzF691bY3WO_AsP_Y9xeb2zIeIIYAVH2ixK7ZMv7oJG8vYBR-4imDPYPtncQ_e_dB" />
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
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhXniWW-W0QWzCOpI77isbjwqCJLjUmfS5v93yUGM19K2GsljhhLqDAmXHCrT-p4HWVn2JRKDi4j-sPfcQc7u6VrC2KwAE3QAFAMZXOFQKDrpKBiO0pjwEcfm_mDgUwMl_7bwSpLvmSX5xD9CRzIXH3OLl36MhmJIp5SFO36xHOETcSMpbJg53gbUcs8u9_dynsyzWDuk6IaFEzF691bY3WO_AsP_Y9xeb2zIeIIYAVH2ixK7ZMv7oJG8vYBR-4imDPYPtncQ_e_dB" />
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
                    <span class="text-secondary font-label-md tracking-widest uppercase mb-4 block">Kegiatan
                        Siswa</span>
                    <h2
                        class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-4">
                        Pengembangan Minat &amp; Bakat</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Lebih dari 20+ ekstrakurikuler aktif
                        untuk mengeksplorasi potensi di luar kelas akademik.</p>
                </div>
                <div class="flex gap-4">
                    <button
                        class="w-14 h-14 rounded-full border-2 border-outline-variant/30 flex items-center justify-center text-primary hover:border-secondary hover:text-secondary hover:bg-surface-container-lowest transition-all duration-300 group"><span
                            class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span></button>
                    <button
                        class="btn-primary bg-white/5 backdrop-blur-xl text-on-primary font-bold text-label-md px-10 py-5 rounded-full border border-white/10 hover:bg-white/10 transition-all duration-300"><span
                            class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span></button>
                </div>
            </div>
            <div class="flex gap-8 overflow-x-auto pb-12 snap-x snap-mandatory hide-scrollbar">
                <!-- Card 1 -->
                <div
                    class="min-w-[320px] md:min-w-[480px] h-[600px] rounded-[2rem] overflow-hidden relative group snap-center fade-up visible shadow-lg">
                    <img alt="Traditional Dance Extracurricular"
                        class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCO38iPlrza6vYZYAyX7PQAxDVL--q0_tE-V_UCbUGC-pyQolX8VgYMyo6iv_N-B6rc6XSyZRvI-NVKEhJsCU0038zo9-pIL4hcuBmOlUMAt_sjOCELOOTLqqJ01m1mjAqLnLUFZm6ovBKVj0Rf2dFR-TCG6_Joxy3aHzWCp7rQPkq8iazwqK9H-YdIFRWPeFrm7rsDCdyewWEzqCmZWrjfzYsE75wM8OzERM7JgOZbjm05LBnyVqE2G3HdyEpDYrdLah_a6LIItnQH" />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/50 to-transparent opacity-80 group-hover:opacity-95 transition-opacity duration-500">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 p-10 transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="w-12 h-1 bg-secondary mb-6 rounded-full"></div>
                        <span
                            class="font-label-md text-label-md text-secondary mb-3 block tracking-widest uppercase">Seni
                            Budaya</span>
                        <h3 class="font-display-lg-mobile text-display-lg-mobile text-on-primary mb-4">Tari Tradisional
                        </h3>
                        <p
                            class="font-body-lg text-body-lg text-on-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                            Melestarikan warisan budaya nusantara melalui gerak dan harmoni, tampil di berbagai festival
                            nasional.</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div
                    class="min-w-[320px] md:min-w-[480px] h-[600px] rounded-[2rem] overflow-hidden relative group snap-center fade-up delay-100 visible shadow-lg">
                    <div class="w-full h-full bg-cover bg-center transition-transform duration-1000 group-hover:scale-105"
                        data-alt="A dynamic high-school basketball game in an indoor modern court. Bright, natural lighting streaming through high windows. Students in uniform playing competitively. The mood is energetic and athletic, fitting a modern academic institution's sports program. Color palette includes warm woods and bright whites."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDLT7MEGmBhEANV3w7U9898OXQr0DfDB-zyie1rzCazRqQCp2WDP5C__pIeFuFKDctbpiWNHws6BEY6szXryhToLKbq90tfdE6Y1O6Tn2VuaikLd557R3t7CYRg5y2Zn8RDHsWAysfVM_VGptUagChzGLzg0qNdYxTOerHcCq-UGFxfeKJvymE5ihuagw8igMUdFNuCiTwIonQkf1AcW_gusX6kYXgPFegt2B0KL6lHFNt_mbOpPhOtQNdrgWud58p_QmLn08xv1fi-')">
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/50 to-transparent opacity-80 group-hover:opacity-95 transition-opacity duration-500">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 p-10 transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="w-12 h-1 bg-secondary mb-6 rounded-full"></div>
                        <span
                            class="font-label-md text-label-md text-secondary mb-3 block tracking-widest uppercase">Olahraga</span>
                        <h3 class="font-display-lg-mobile text-display-lg-mobile text-on-primary mb-4">Tim Basket</h3>
                        <p
                            class="font-body-lg text-body-lg text-on-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                            Membangun sportivitas, disiplin, dan kerjasama tim di lapangan kompetisi.</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div
                    class="min-w-[320px] md:min-w-[480px] h-[600px] rounded-[2rem] overflow-hidden relative group snap-center fade-up delay-200 visible shadow-lg">
                    <div class="w-full h-full bg-cover bg-center transition-transform duration-1000 group-hover:scale-105"
                        data-alt="Students gathered around a robotics project in a bright, modern maker space. White tables, technological equipment, focused expressions. The lighting is crisp and cool, emphasizing innovation and STEM education in an academic setting. Soft ivory walls."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuATkTVQBv3VR4_U_-0KyWt1VrqYlg0Oo46X8_esHSTLqZZwhJ5HjQJxpS5TSZtnrVJl0Q84yo_P66zUvitxlE7LEylw4kMDwPPXETHL878Q6NZTYouQSvswKvvHXMQ2qtIOMui0RTxV7pAxX0iuO5kNG3a0VFxo69QUbMTw087TaDgrdgnpLSQPmjIfyoYqAgVDv7UQMQ1bqbXvzFwulLmxV-bpJkcQaWV1G7QblZZiWCuqa0GpXIMS-6mBtMMG5lVz6S0cQwpf50K2')">
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/50 to-transparent opacity-80 group-hover:opacity-95 transition-opacity duration-500">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 p-10 transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="w-12 h-1 bg-secondary mb-6 rounded-full"></div>
                        <span
                            class="font-label-md text-label-md text-secondary mb-3 block tracking-widest uppercase">Sains
                            &amp; Teknologi</span>
                        <h3 class="font-display-lg-mobile text-display-lg-mobile text-on-primary mb-4">Klub Robotika
                        </h3>
                        <p
                            class="font-body-lg text-body-lg text-on-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                            Inovasi teknologi masa depan dirancang hari ini melalui pemecahan masalah praktis.</p>
                    </div>
                </div>
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
        <!-- News & Announcements Redesign -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop my-32 fade-up visible">
            <div class="flex justify-between items-end mb-12 border-b border-outline-variant/30 pb-6">
                <div>
                    <span class="text-secondary font-label-md tracking-widest uppercase mb-4 block">Pusat
                        Informasi</span>
                    <h2
                        class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary">
                        Berita &amp; Artikel Terbaru</h2>
                </div>
                <a class="hidden md:inline-flex items-center gap-2 font-label-md text-label-md text-primary hover:text-secondary transition-colors group mb-2"
                    href="#">
                    Lihat Semua Berita
                    <span
                        class="material-symbols-outlined transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Featured News -->
                <div class="lg:col-span-6 group cursor-pointer">
                    <div class="w-full h-80 rounded-[2rem] overflow-hidden mb-6 relative">
                        <img alt="Students studying"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhXniWW-W0QWzCOpI77isbjwqCJLjUmfS5v93yUGM19K2GsljhhLqDAmXHCrT-p4HWVn2JRKDi4j-sPfcQc7u6VrC2KwAE3QAFAMZXOFQKDrpKBiO0pjwEcfm_mDgUwMl_7bwSpLvmSX5xD9CRzIXH3OLl36MhmJIp5SFO36xHOETcSMpbJg53gbUcs8u9_dynsyzWDuk6IaFEzF691bY3WO_AsP_Y9xeb2zIeIIYAVH2ixK7ZMv7oJG8vYBR-4imDPYPtncQ_e_dB" />
                        <div class="absolute top-6 left-6">
                            <span
                                class="bg-primary text-on-primary font-label-md px-4 py-2 rounded-full text-sm">Akademik</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-on-surface-variant mb-4">
                        <span class="font-label-md text-secondary">12 Okt 2023</span>
                        <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
                        <span class="font-label-md">Oleh Admin SMANISDA</span>
                    </div>
                    <h3
                        class="font-display-lg-mobile text-display-lg-mobile text-primary mb-4 group-hover:text-secondary transition-colors">
                        Jadwal Ujian Tengah Semester Ganjil TA 2023/2024</h3>
                    <p class="font-body-lg text-body-lg text-on-surface-variant line-clamp-3">Persiapkan diri Anda,
                        jadwal lengkap dan tata tertib UTS telah diterbitkan. Harap diperhatikan dengan saksama seluruh
                        ketentuan pelaksanaannya untuk kelancaran proses evaluasi pembelajaran.</p>
                </div>
                <!-- News List -->
                <div class="lg:col-span-6 flex flex-col gap-8">
                    <!-- List Item -->
                    <div class="group cursor-pointer grid grid-cols-1 sm:grid-cols-4 gap-6 items-center">
                        <div class="sm:col-span-1 h-32 rounded-2xl overflow-hidden bg-surface-variant relative">
                            <img alt="Debate competition"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCO38iPlrza6vYZYAyX7PQAxDVL--q0_tE-V_UCbUGC-pyQolX8VgYMyo6iv_N-B6rc6XSyZRvI-NVKEhJsCU0038zo9-pIL4hcuBmOlUMAt_sjOCELOOTLqqJ01m1mjAqLnLUFZm6ovBKVj0Rf2dFR-TCG6_Joxy3aHzWCp7rQPkq8iazwqK9H-YdIFRWPeFrm7rsDCdyewWEzqCmZWrjfzYsE75wM8OzERM7JgOZbjm05LBnyVqE2G3HdyEpDYrdLah_a6LIItnQH" />
                        </div>
                        <div class="sm:col-span-3">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="text-secondary font-label-md text-sm uppercase tracking-wider">Prestasi</span>
                                <span class="text-outline-variant text-xs">•</span>
                                <span class="text-on-surface-variant font-body-md text-sm">05 Okt 2023</span>
                            </div>
                            <h4
                                class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors line-clamp-2">
                                Delegasi SMAN 1 Raih Emas di Lomba Debat Nasional</h4>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2">Selamat kepada tim
                                debat bahasa Inggris yang telah mengharumkan nama sekolah di kancah nasional.</p>
                        </div>
                    </div>
                    <!-- List Item -->
                    <div class="group cursor-pointer grid grid-cols-1 sm:grid-cols-4 gap-6 items-center">
                        <div class="sm:col-span-1 h-32 rounded-2xl overflow-hidden bg-surface-variant relative">
                            <img alt="Art Exhibition"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuATkTVQBv3VR4_U_-0KyWt1VrqYlg0Oo46X8_esHSTLqZZwhJ5HjQJxpS5TSZtnrVJl0Q84yo_P66zUvitxlE7LEylw4kMDwPPXETHL878Q6NZTYouQSvswKvvHXMQ2qtIOMui0RTxV7pAxX0iuO5kNG3a0VFxo69QUbMTw087TaDgrdgnpLSQPmjIfyoYqAgVDv7UQMQ1bqbXvzFwulLmxV-bpJkcQaWV1G7QblZZiWCuqa0GpXIMS-6mBtMMG5lVz6S0cQwpf50K2" />
                        </div>
                        <div class="sm:col-span-3">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="text-secondary font-label-md text-sm uppercase tracking-wider">Kegiatan</span>
                                <span class="text-outline-variant text-xs">•</span>
                                <span class="text-on-surface-variant font-body-md text-sm">28 Sep 2023</span>
                            </div>
                            <h4
                                class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors line-clamp-2">
                                Pameran Karya Seni Tahunan "Artspirasi" Dibuka Untuk Umum</h4>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2">Apresiasi karya
                                siswa-siswi terbaik kami di aula utama. Pameran berlangsung selama 3 hari.</p>
                        </div>
                    </div>
                    <!-- List Item -->
                    <div class="group cursor-pointer grid grid-cols-1 sm:grid-cols-4 gap-6 items-center">
                        <div class="sm:col-span-1 h-32 rounded-2xl overflow-hidden bg-surface-variant relative">
                            <img alt="PPDB"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAqpOf4qKo00Ysfs_kCWG7fEdWOlEicpvIPopKs1JuAxe7nv2OqYrgsT3NQM1QZCp03sMGGXIpbkWyxJSnxzTzJPUQdkvuKyQijzIhdiWaBWkA2UgTuyDe7K4GO2-nzbxcLZfFWY_nOoBGLqV_kaShHAYwqqPp8p8lgYXTmoURQbJ7Sn2oT7cdsAEU95HPop-ZqU8EAPgnKYwSsejw1zZhUpbS34yfLYKmn41mLHJK4hzcK-SQC_nYUOKoZ_gUKcV-E_j-5AUvt-OMz" />
                        </div>
                        <div class="sm:col-span-3">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="text-secondary font-label-md text-sm uppercase tracking-wider">Pengumuman</span>
                                <span class="text-outline-variant text-xs">•</span>
                                <span class="text-on-surface-variant font-body-md text-sm">15 Sep 2023</span>
                            </div>
                            <h4
                                class="font-headline-sm text-headline-sm text-primary mb-2 group-hover:text-secondary transition-colors line-clamp-2">
                                Sosialisasi PPDB Jalur Prestasi dan Zonasi Tahun 2024</h4>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-2">Informasi penting
                                bagi calon pendaftar mengenai persyaratan dan jadwal seleksi penerimaan.</p>
                        </div>
                    </div>
                </div>
                <a class="md:hidden inline-flex items-center gap-2 font-label-md text-label-md text-primary hover:text-secondary transition-colors group mt-8"
                    href="#">
                    Lihat Semua Berita
                    <span
                        class="material-symbols-outlined transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <footer class="w-full bg-primary relative overflow-hidden mt-20 border-t border-outline-variant/10">
        <!-- Subtle Geometric Pattern Overlay -->
        <div class="absolute inset-0 opacity-5 pointer-events-none"
            style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;">
        </div>
        <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Column 1: Brand Info -->
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <img alt="SMAN 1 Surabaya Logo" class="h-12 w-auto brightness-0 invert"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAqpOf4qKo00Ysfs_kCWG7fEdWOlEicpvIPopKs1JuAxe7nv2OqYrgsT3NQM1QZCp03sMGGXIpbkWyxJSnxzTzJPUQdkvuKyQijzIhdiWaBWkA2UgTuyDe7K4GO2-nzbxcLZfFWY_nOoBGLqV_kaShHAYwqqPp8p8lgYXTmoURQbJ7Sn2oT7cdsAEU95HPop-ZqU8EAPgnKYwSsejw1zZhUpbS34yfLYKmn41mLHJK4hzcK-SQC_nYUOKoZ_gUKcV-E_j-5AUvt-OMz" />
                        <span class="font-bold text-headline-sm text-on-primary tracking-tight font-headline-sm">SMAN 1
                            Surabaya</span>
                    </div>
                    <p class="font-body-md text-on-primary/70 leading-relaxed font-body-md">
                        Membentuk karakter unggul dan mengukir prestasi gemilang melalui pendidikan holistik berbasis
                        nilai-nilai luhur bangsa.
                    </p>
                    <div class="flex gap-4">
                        <a class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-on-primary hover:bg-secondary hover:text-primary transition-all duration-300 hover:-translate-y-1"
                            href="#">
                            <span class="material-symbols-outlined">public</span>
                        </a>
                        <a class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-on-primary hover:bg-secondary hover:text-primary transition-all duration-300 hover:-translate-y-1"
                            href="#">
                            <span class="material-symbols-outlined">photo_camera</span>
                        </a>
                        <a class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-on-primary hover:bg-secondary hover:text-primary transition-all duration-300 hover:-translate-y-1"
                            href="#">
                            <span class="material-symbols-outlined">play_arrow</span>
                        </a>
                    </div>
                </div>
                <!-- Column 2: Quick Links -->
                <div>
                    <h4 class="font-bold text-title-lg text-on-primary mb-8 uppercase tracking-widest font-title-lg">
                        Tautan Cepat</h4>
                    <ul class="flex flex-col gap-4">
                        <li class=""><a
                                class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all"
                                href="#">Profil Sekolah</a></li>
                        <li class=""><a
                                class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all"
                                href="#">Visi &amp; Misi</a></li>
                        <li class=""><a
                                class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all"
                                href="#">Fasilitas</a></li>
                    </ul>
                </div>
                <!-- Column 3: Admissions -->
                <div>
                    <h4 class="font-bold text-title-lg text-on-primary mb-8 uppercase tracking-widest font-title-lg">
                        Penerimaan</h4>
                    <ul class="flex flex-col gap-4">
                        <li class=""><a
                                class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all"
                                href="#">PPDB 2024</a></li>
                        <li class=""><a
                                class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all"
                                href="#">Persyaratan</a></li>
                        <li class=""><a
                                class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all"
                                href="#">Jadwal Seleksi</a></li>
                    </ul>
                </div>
                <!-- Column 4: Contact Us -->
                <div class="flex flex-col gap-6">
                    <h4 class="font-bold text-title-lg text-on-primary mb-8 uppercase tracking-widest font-title-lg">
                        Kontak Kami</h4>
                    <ul class="flex flex-col gap-4 font-body-md text-on-primary/80">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary">location_on</span>
                            <span class="">Jl. Wijaya Kusuma No.48, Surabaya</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary">phone</span>
                            <span class="">(031) 5342128</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary">mail</span>
                            <span class="">info@sman1surabaya.sch.id</span>
                        </li>
                    </ul>
                    <div class="w-full h-32 rounded-xl overflow-hidden border border-white/10 mt-2">
                        <img alt="Map Location"
                            class="w-full h-full object-cover opacity-60 hover:opacity-100 transition-opacity duration-500"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAhQ1PkZbY-cI_H0L25IBoLx7AnrSKqTNhkOLmnPmdyLTER89cequojR96WDD838L4CCHFMAAfORVRfq6_BYU-5KXMk8LIn079RUGag7OMS-ugyrzcrAEztskxxSk8J43PE_zfRhMrjcih6lhQa8LUm81fW7PiTNdQe4i_wKWtMxCyhQmvIcb333V1ALZL-e6Y-L_V3hQGGCHtV83oxNzJcQYS4bBTINmp-WozX3iLFc3Ei5NVkuIOqLNJa-ES7XYajXWqoal-qkj7j" />
                    </div>
                </div>
            </div>
            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="font-body-md text-on-primary/50 text-sm">
                    © 2024 SMA Negeri 1 Surabaya. All Rights Reserved.
                </p>
                <button
                    class="btn-primary bg-white/5 backdrop-blur-xl text-on-primary font-bold text-label-md px-10 py-5 rounded-full border border-white/10 hover:bg-white/10 transition-all duration-300"
                    onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                    <span class="font-label-md">Kembali ke Atas</span>
                    <span
                        class="material-symbols-outlined transform group-hover:-translate-y-1 transition-transform">arrow_upward</span>
                </button>
            </div>
        </div>
    </footer>
    <!-- Scripts for Interactions -->
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

            // Navbar scroll effect
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    navbar.classList.add('shadow-md');
                    navbar.classList.replace('bg-surface/80', 'bg-surface/95');
                } else {
                    navbar.classList.remove('shadow-md');
                    navbar.classList.replace('bg-surface/95', 'bg-surface/80');
                }
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
        });
    </script>
</body>

</html>