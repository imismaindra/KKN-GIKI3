<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    
    <!-- Dynamic Title & SEO Meta Tags -->
    <title>@yield('title', 'SMA GIKI 3 Surabaya')</title>
    @yield('meta')
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        /* === Core Brand === */
                        /* Deep Navy — harmonis dengan biru logo */
                        "primary": "#0F1F3D",
                        "on-primary": "#ffffff",
                        "primary-container": "#1A3366",
                        "on-primary-container": "#8BA8D4",
                        "primary-fixed": "#D0DCEE",
                        "primary-fixed-dim": "#9BB5D4",
                        "on-primary-fixed": "#071528",
                        "on-primary-fixed-variant": "#2C4872",
                        "inverse-primary": "#9BB5D4",

                        /* Amber Gold — selaras kuning logo */
                        "secondary": "#C8930A",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#E5A93C",
                        "on-secondary-container": "#ffffff",
                        "secondary-fixed": "#FCEEC4",
                        "secondary-fixed-dim": "#F5D475",
                        "on-secondary-fixed": "#3D2600",
                        "on-secondary-fixed-variant": "#7A5200",

                        /* Crimson Accent — selaras merah logo, dipakai sparingly */
                        "accent": "#C41E3A",
                        "accent-light": "#FCEAED",
                        "accent-muted": "#E57B8A",

                        /* === Surface Tokens === */
                        "surface": "#FAFAF5",
                        "surface-bright": "#FFFFFF",
                        "surface-dim": "#DFE0D8",
                        "surface-variant": "#E4E7EF",
                        "surface-container-lowest": "#FFFFFF",
                        "surface-container-low": "#F3F4EF",
                        "surface-container": "#ECEDF0",
                        "surface-container-high": "#E4E5E8",
                        "surface-container-highest": "#DCDDE0",
                        "surface-tint": "#4A6A9E",

                        /* === On-Surface === */
                        "on-surface": "#0F1F3D",
                        "on-surface-variant": "#3E4452",
                        "on-background": "#0F1F3D",

                        /* === Neutrals === */
                        "outline": "#6E7280",
                        "outline-variant": "#C2C4CF",
                        "inverse-surface": "#252C38",
                        "inverse-on-surface": "#ECF0F7",

                        /* === Tertiary / Misc === */
                        "tertiary": "#1A1C1A",
                        "tertiary-fixed": "#E3E2E0",
                        "tertiary-fixed-dim": "#C7C6C4",
                        "on-tertiary": "#ffffff",
                        "on-tertiary-container": "#8A8A88",
                        "on-tertiary-fixed": "#1a1c1a",
                        "on-tertiary-fixed-variant": "#464745",
                        "tertiary-container": "#212321",

                        /* === Error === */
                        "error": "#BA1A1A",
                        "on-error": "#ffffff",
                        "error-container": "#FFDAD6",
                        "on-error-container": "#93000A",

                        /* === Background === */
                        "background": "#FAFAF5"
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
                        "headline-sm": ["Poppins", "sans-serif"],
                        "display-lg-mobile": ["Poppins", "sans-serif"],
                        "title-lg": ["Poppins", "sans-serif"],
                        "headline-md": ["Poppins", "sans-serif"],
                        "body-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "label-md": ["Plus Jakarta Sans", "sans-serif"],
                        "display-lg": ["Poppins", "sans-serif"],
                        "body-md": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    "fontSize": {
                        "headline-sm": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "display-lg-mobile": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "title-lg": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "headline-md": ["32px", { "lineHeight": "40px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "label-md": ["14px", { "lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }]
                    }
                },
            },
        }
    </script>
    <style>
        :root {
            --primary: #0F1F3D;
            --secondary: #C8930A;
            --secondary-light: #E5A93C;
            --accent: #C41E3A;
            --surface: #FAFAF5;
        }

        * { box-sizing: border-box; }

        body {
            background-color: var(--surface);
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Navbar ─────────────────────────────── */
        .glass-nav {
            background: rgba(250, 250, 245, 0.82);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            transition: background 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
        }
        .glass-nav.scrolled {
            background: rgba(250, 250, 245, 0.97);
            box-shadow: 0 2px 20px rgba(15, 31, 61, 0.08);
        }

        /* Navbar progress bar */
        #scroll-progress {
            position: fixed;
            top: 0; left: 0;
            height: 3px;
            width: 0%;
            background: linear-gradient(90deg, var(--accent) 0%, var(--secondary-light) 60%, #F5D475 100%);
            z-index: 9999;
            transition: width 0.1s linear;
            border-radius: 0 2px 2px 0;
        }

        /* Mobile dropdown animation */
        #mobileDropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.38s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
            opacity: 0;
        }
        #mobileDropdown.open {
            max-height: 360px;
            opacity: 1;
        }

        /* ── Cards ───────────────────────────────── */
        .fade-up {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.75s cubic-bezier(0.22, 1, 0.36, 1),
                        transform 0.75s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .fade-up-delay-1 { transition-delay: 100ms; }
        .fade-up-delay-2 { transition-delay: 200ms; }
        .fade-up-delay-3 { transition-delay: 300ms; }
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }

        .bento-card {
            background-color: #FFFFFF;
            border-radius: 1.25rem;
            border: 1px solid rgba(15, 31, 61, 0.06);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 2px 12px rgba(15, 31, 61, 0.04), 0 1px 3px rgba(15, 31, 61, 0.06);
        }
        .bento-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 48px rgba(15, 31, 61, 0.10), 0 4px 12px rgba(15, 31, 61, 0.06);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.55);
        }

        /* Shimmer utility */
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        .shimmer-gold {
            background: linear-gradient(90deg,
                rgba(200, 147, 10, 0) 0%,
                rgba(200, 147, 10, 0.12) 50%,
                rgba(200, 147, 10, 0) 100%);
            background-size: 200% auto;
            animation: shimmer 3s linear infinite;
        }

        /* ── Buttons ─────────────────────────────── */
        .btn-primary {
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1),
                        box-shadow 0.2s ease;
        }
        .btn-primary:hover {
            box-shadow: 0 8px 24px rgba(15, 31, 61, 0.20);
        }
        .btn-primary:active { transform: scale(0.95); }

        /* ── Sticky CTA ──────────────────────────── */
        #sticky-cta {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 80;
            opacity: 0;
            transform: translateY(16px) scale(0.92);
            pointer-events: none;
            transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        #sticky-cta.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        /* ── Section Divider Wave ────────────────── */
        .wave-divider svg { display: block; }

        /* ── Gradient Border Card ────────────────── */
        .gradient-border {
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, rgba(200,147,10,0.6), rgba(196,30,58,0.3), rgba(15,31,61,0.4)) border-box;
            border: 1.5px solid transparent;
        }

        @property --num {
            syntax: "<integer>";
            initial-value: 0;
            inherits: false;
        }

        /* Section label accent */
        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--secondary);
            padding: 4px 14px 4px 10px;
            border-radius: 99px;
            background: rgba(200, 147, 10, 0.10);
            border: 1px solid rgba(200, 147, 10, 0.20);
            margin-bottom: 16px;
        }
        .section-label::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--secondary);
            display: inline-block;
        }

        /* Accent stripe for cards */
        .card-accent-red    { border-top: 3px solid #C41E3A; }
        .card-accent-blue   { border-top: 3px solid #1A3A8F; }
        .card-accent-gold   { border-top: 3px solid #C8930A; }
    </style>
    @yield('styles')
</head>

<body class="text-on-surface antialiased overflow-x-hidden selection:bg-secondary/30 selection:text-primary">
    <!-- Scroll Progress Bar -->
    <div id="scroll-progress"></div>
    <!-- Sticky CTA -->
    <div id="sticky-cta">
        <a href="{{ request()->is('/') ? '#contact' : url('/#contact') }}"
           class="flex items-center gap-2.5 bg-accent hover:bg-red-800 text-white font-bold text-sm px-6 py-3.5 rounded-full shadow-2xl hover:shadow-accent/40 transition-all duration-300 tracking-wide">
            <span class="material-symbols-outlined text-base">edit_note</span>
            Daftar Sekarang
        </a>
    </div>
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-outline-variant/20 transition-all duration-400" id="navbar">
        <div class="flex justify-between items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="relative">
                        <img alt="{{ $setting->school_name ?? 'SMA GIKI 3 Surabaya' }} Logo"
                             class="h-11 w-auto transition-transform duration-300 group-hover:scale-105"
                             src="{{ ($setting && $setting->logo) ? Storage::url($setting->logo) : asset('smagiki3.webp') }}"
                             onerror="this.onerror=null; this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuAqpOf4qKo00Ysfs_kCWG7fEdWOlEicpvIPopKs1JuAxe7nv2OqYrgsT3NQM1QZCp03sMGGXIpbkWyxJSnxzTzJPUQdkvuKyQijzIhdiWaBWkA2UgTuyDe7K4GO2-nzbxcLZfFWY_nOoBGLqV_kaShHAYwqqPp8p8lgYXTmoURQbJ7Sn2oT7cdsAEU95HPop-ZqU8EAPgnKYwSsejw1zZhUpbS34yfLYKmn41mLHJK4hzcK-SQC_nYUOKoZ_gUKcV-E_j-5AUvt-OMz';" />
                    </div>
                    <div class="hidden md:flex flex-col leading-tight">
                        <span class="font-black text-base text-primary tracking-tight">SMA GIKI 3</span>
                        <span class="text-[10px] font-bold text-on-surface-variant tracking-widest uppercase">Surabaya</span>
                    </div>
                </a>
            </div>
            
            <div class="hidden md:flex items-center gap-1">
                @php
                    $navLinks = [
                        ['href' => url('/'), 'label' => 'Beranda', 'active' => request()->is('/')],
                        ['href' => request()->is('/') ? '#profil' : url('/#profil'), 'label' => 'Profil', 'active' => false],
                        ['href' => request()->is('/') ? '#akademik' : url('/#akademik'), 'label' => 'Akademik', 'active' => false],
                        ['href' => request()->is('/') ? '#galeri' : url('/#galeri'), 'label' => 'Galeri', 'active' => false],
                        ['href' => route('articles.index'), 'label' => 'Berita', 'active' => request()->routeIs('articles.*')],
                        ['href' => route('ekstrakurikuler.index'), 'label' => 'Ekskul', 'active' => request()->routeIs('ekstrakurikuler.*')],
                    ];
                @endphp
                @foreach($navLinks as $link)
                    <a href="{{ $link['href'] }}"
                       class="relative px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200
                              {{ $link['active']
                                   ? 'text-secondary bg-secondary/8'
                                   : 'text-on-surface-variant hover:text-primary hover:bg-primary/5' }}">
                        {{ $link['label'] }}
                        @if($link['active'])
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-4 h-0.5 bg-secondary rounded-full"></span>
                        @endif
                    </a>
                @endforeach
            </div>

            <a href="{{ request()->is('/') ? '#contact' : url('/#contact') }}"
               class="hidden md:flex items-center gap-2 btn-primary bg-primary text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-primary/90 active:scale-95 transition-all duration-200 shadow-sm hover:shadow-primary/20">
                <span class="material-symbols-outlined text-base">mail</span>
                Hubungi
            </a>
            <button class="md:hidden text-primary p-2 rounded-xl hover:bg-primary/5 transition" id="mobileMenuBtn" aria-label="Menu">
                <span class="material-symbols-outlined text-3xl" id="mobileMenuIcon">menu</span>
            </button>
        </div>
        <!-- Mobile Dropdown Menu (animated) -->
        <div id="mobileDropdown" class="md:hidden px-margin-mobile pb-5 pt-2 bg-white/98 border-b border-outline-variant/20 flex flex-col gap-1 shadow-lg">
            <a class="flex items-center gap-3 font-semibold text-primary hover:text-secondary hover:bg-secondary/5 px-3 py-2.5 rounded-xl transition" href="{{ url('/') }}">
                <span class="material-symbols-outlined text-lg">home</span> Beranda
            </a>
            <a class="flex items-center gap-3 font-semibold text-on-surface-variant hover:text-secondary hover:bg-secondary/5 px-3 py-2.5 rounded-xl transition" href="{{ url('/#profil') }}">
                <span class="material-symbols-outlined text-lg">school</span> Profil
            </a>
            <a class="flex items-center gap-3 font-semibold text-on-surface-variant hover:text-secondary hover:bg-secondary/5 px-3 py-2.5 rounded-xl transition" href="{{ url('/#akademik') }}">
                <span class="material-symbols-outlined text-lg">menu_book</span> Akademik
            </a>
            <a class="flex items-center gap-3 font-semibold text-on-surface-variant hover:text-secondary hover:bg-secondary/5 px-3 py-2.5 rounded-xl transition" href="{{ request()->is('/') ? '#galeri' : url('/#galeri') }}">
                <span class="material-symbols-outlined text-lg">photo_library</span> Galeri
            </a>
            <a class="flex items-center gap-3 font-semibold text-on-surface-variant hover:text-secondary hover:bg-secondary/5 px-3 py-2.5 rounded-xl transition" href="{{ route('articles.index') }}">
                <span class="material-symbols-outlined text-lg">newspaper</span> Berita & Artikel
            </a>
            <a class="flex items-center gap-3 font-semibold {{ request()->routeIs('ekstrakurikuler.*') ? 'text-secondary' : 'text-on-surface-variant' }} hover:text-secondary hover:bg-secondary/5 px-3 py-2.5 rounded-xl transition" href="{{ route('ekstrakurikuler.index') }}">
                <span class="material-symbols-outlined text-lg">sports</span> Ekstrakurikuler
            </a>
            <div class="mt-2 pt-2 border-t border-outline-variant/20">
                <a class="flex items-center justify-center gap-2 font-bold text-white bg-primary hover:bg-primary/90 px-4 py-3 rounded-xl text-sm transition w-full" href="{{ url('/#contact') }}">
                    <span class="material-symbols-outlined text-base">mail</span> Hubungi Kami
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="w-full relative overflow-hidden mt-20" style="background: linear-gradient(160deg, #0F1F3D 0%, #0A1628 60%, #0D1B3E 100%);">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(200,147,10,0.5) 30%, rgba(196,30,58,0.4) 70%, transparent);"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full opacity-5" style="background: radial-gradient(circle, #C8930A, transparent 70%);"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full opacity-4" style="background: radial-gradient(circle, #1A3A8F, transparent 70%);"></div>
        <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Column 1: Brand Info -->
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <img alt="{{ $setting->school_name ?? 'SMA GIKI 3 Surabaya' }} Logo" class="h-12 w-auto brightness-0 invert" src="{{ ($setting && $setting->logo) ? Storage::url($setting->logo) : asset('smagiki3.webp') }}" onerror="this.onerror=null; this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuAqpOf4qKo00Ysfs_kCWG7fEdWOlEicpvIPopKs1JuAxe7nv2OqYrgsT3NQM1QZCp03sMGGXIpbkWyxJSnxzTzJPUQdkvuKyQijzIhdiWaBWkA2UgTuyDe7K4GO2-nzbxcLZfFWY_nOoBGLqV_kaShHAYwqqPp8p8lgYXTmoURQbJ7Sn2oT7cdsAEU95HPop-ZqU8EAPgnKYwSsejw1zZhUpbS34yfLYKmn41mLHJK4hzcK-SQC_nYUOKoZ_gUKcV-E_j-5AUvt-OMz';" />
                        <span class="font-bold text-headline-sm text-on-primary tracking-tight">{{ $setting->school_name ?? 'SMA GIKI 3 SURABAYA' }}</span>
                    </div>
                    <p class="font-body-md text-on-primary/70 leading-relaxed">
                        Membentuk karakter unggul dan mengukir prestasi gemilang melalui pendidikan holistik berbasis nilai-nilai luhur bangsa.
                    </p>
                    <div class="flex gap-3">
                        <a class="w-10 h-10 rounded-2xl bg-white/8 border border-white/10 flex items-center justify-center text-white/80 hover:bg-secondary hover:text-primary hover:border-secondary/50 transition-all duration-300 hover:-translate-y-1" href="{{ ($setting && $setting->tiktok_url) ? $setting->tiktok_url : 'https://www.tiktok.com/@smagiga_media' }}" target="_blank" title="TikTok">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.02 1.63 4.16 1.02 1.12 2.45 1.79 3.94 1.95v3.91a8.312 8.312 0 0 1-5.18-1.74c-.06 2.42-.02 4.84-.04 7.26-.06 1.83-.56 3.65-1.57 5.16-1.12 1.62-2.91 2.76-4.83 3.16-1.89.37-3.9-.03-5.53-1.07-1.78-1.16-2.95-3.15-3.1-5.26-.26-3.14 1.7-6.22 4.69-7.23.83-.28 1.71-.38 2.58-.33v4.03c-.63-.12-1.3-.06-1.88.21-.86.37-1.48 1.2-1.56 2.12-.13 1.25.75 2.42 1.99 2.58.91.13 1.89-.3 2.32-1.11.23-.42.33-.91.31-1.39-.02-3.86-.01-7.72-.02-11.58-.01-.1-.01-.2-.02-.3-.02-.19-.06-.39-.19-.54-.15-.17-.38-.2-.6-.2H12.525z"/></svg>
                        </a>
                        <a class="w-10 h-10 rounded-2xl bg-white/8 border border-white/10 flex items-center justify-center text-white/80 hover:bg-secondary hover:text-primary hover:border-secondary/50 transition-all duration-300 hover:-translate-y-1" href="{{ ($setting && $setting->instagram_url) ? $setting->instagram_url : 'https://instagram.com/smagiga' }}" target="_blank" title="Instagram">
                            <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                        </a>
                        <a class="w-10 h-10 rounded-2xl bg-white/8 border border-white/10 flex items-center justify-center text-white/80 hover:bg-accent hover:text-white hover:border-accent/50 transition-all duration-300 hover:-translate-y-1" href="{{ ($setting && $setting->youtube_url) ? $setting->youtube_url : 'https://youtube.com/@smagiki3surabaya730' }}" target="_blank" title="YouTube">
                            <span class="material-symbols-outlined text-[18px]">play_arrow</span>
                        </a>
                    </div>
                </div>
                <!-- Column 2: Quick Links -->
                <div>
                    <h4 class="font-bold text-xs text-white/40 mb-6 uppercase tracking-[0.15em]">Tautan Cepat</h4>
                    <ul class="flex flex-col gap-3">
                        <li><a class="text-sm text-white/75 hover:text-secondary flex items-center gap-2 group transition-all duration-200" href="{{ url('/#profil') }}"><span class="w-1 h-1 rounded-full bg-secondary/50 group-hover:bg-secondary transition"></span>Profil Sekolah</a></li>
                        <li><a class="text-sm text-white/75 hover:text-secondary flex items-center gap-2 group transition-all duration-200" href="{{ url('/#profil') }}"><span class="w-1 h-1 rounded-full bg-secondary/50 group-hover:bg-secondary transition"></span>Visi &amp; Misi</a></li>
                        <li><a class="text-sm text-white/75 hover:text-secondary flex items-center gap-2 group transition-all duration-200" href="{{ url('/#fasilitas') }}"><span class="w-1 h-1 rounded-full bg-secondary/50 group-hover:bg-secondary transition"></span>Fasilitas</a></li>
                        <li><a class="text-sm text-white/75 hover:text-secondary flex items-center gap-2 group transition-all duration-200" href="{{ route('articles.index') }}"><span class="w-1 h-1 rounded-full bg-secondary/50 group-hover:bg-secondary transition"></span>Berita & Artikel</a></li>
                        <li><a class="text-sm text-white/75 hover:text-secondary flex items-center gap-2 group transition-all duration-200" href="{{ route('ekstrakurikuler.index') }}"><span class="w-1 h-1 rounded-full bg-secondary/50 group-hover:bg-secondary transition"></span>Ekstrakurikuler</a></li>
                    </ul>
                </div>
                <!-- Column 3: Admissions -->
                <div>
                    <h4 class="font-bold text-xs text-white/40 mb-6 uppercase tracking-[0.15em]">Penerimaan Siswa</h4>
                    <ul class="flex flex-col gap-3">
                        <li><a class="text-sm text-white/75 hover:text-secondary flex items-center gap-2 group transition-all duration-200" href="{{ url('/#contact') }}"><span class="w-1 h-1 rounded-full bg-accent/60 group-hover:bg-accent transition"></span>PPDB 2026/2027</a></li>
                        <li><a class="text-sm text-white/75 hover:text-secondary flex items-center gap-2 group transition-all duration-200" href="{{ url('/#contact') }}"><span class="w-1 h-1 rounded-full bg-accent/60 group-hover:bg-accent transition"></span>Persyaratan</a></li>
                        <li><a class="text-sm text-white/75 hover:text-secondary flex items-center gap-2 group transition-all duration-200" href="{{ url('/#contact') }}"><span class="w-1 h-1 rounded-full bg-accent/60 group-hover:bg-accent transition"></span>Jadwal Seleksi</a></li>
                    </ul>
                </div>
                <!-- Column 4: Contact Us -->
                <div class="flex flex-col gap-5">
                    <h4 class="font-bold text-xs text-white/40 mb-1 uppercase tracking-[0.15em]">Kontak Kami</h4>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-secondary/15 border border-secondary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="material-symbols-outlined text-secondary text-[16px]">location_on</span>
                        </div>
                        <p class="text-sm text-white/70 leading-relaxed">{{ $setting->address ?? 'Jl. Klampis Jaya No. 11, Klampis Ngasem, Kec. Sukolilo, Surabaya' }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-secondary/15 border border-secondary/20 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-secondary text-[16px]">phone</span>
                        </div>
                        <a href="tel:{{ $setting->phone ?? '031-5996405' }}" class="text-sm text-white/70 hover:text-secondary transition">{{ $setting->phone ?? '031-5996405' }}</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-secondary/15 border border-secondary/20 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-secondary text-[16px]">mail</span>
                        </div>
                        <a href="mailto:{{ $setting->email ?? 'info@smagiki3surabaya.sch.id' }}" class="text-sm text-white/70 hover:text-secondary transition">{{ $setting->email ?? 'info@smagiki3surabaya.sch.id' }}</a>
                    </div>
                </div>
            </div>
            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-white/8 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex flex-col md:flex-row items-center gap-3">
                    <p class="text-white/35 text-xs">
                        © {{ date('Y') }} {{ $setting->school_name ?? 'SMA GIKI 3 Surabaya' }}. Hak Cipta Dilindungi.
                    </p>
                    <span class="hidden md:block w-1 h-1 rounded-full bg-white/20"></span>
                    <p class="text-white/25 text-xs">Dikembangkan untuk KKN Universitas</p>
                </div>
                <button class="flex items-center gap-2 text-white/60 hover:text-secondary text-xs font-semibold transition-all duration-200 hover:-translate-y-0.5" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                    <span class="material-symbols-outlined text-base">arrow_upward</span>
                    Kembali ke Atas
                </button>
            </div>
        </div>
    </footer>

    <!-- Scripts for Interactions -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // ── Scroll Progress Bar ──────────────────────
            const progressBar = document.getElementById('scroll-progress');
            const navbar = document.getElementById('navbar');
            const stickyCTA = document.getElementById('sticky-cta');

            window.addEventListener('scroll', () => {
                const scrollTop = window.scrollY;
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;

                if (progressBar) progressBar.style.width = progress + '%';

                // Navbar state
                if (navbar) {
                    if (scrollTop > 30) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                }

                // Sticky CTA visibility
                if (stickyCTA) {
                    if (scrollTop > 400) {
                        stickyCTA.classList.add('visible');
                    } else {
                        stickyCTA.classList.remove('visible');
                    }
                }
            }, { passive: true });

            // ── Mobile Menu Toggle (animated) ───────────
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenuIcon = document.getElementById('mobileMenuIcon');
            const mobileDropdown = document.getElementById('mobileDropdown');
            let menuOpen = false;

            if (mobileMenuBtn && mobileDropdown) {
                mobileMenuBtn.addEventListener('click', () => {
                    menuOpen = !menuOpen;
                    mobileDropdown.classList.toggle('open', menuOpen);
                    if (mobileMenuIcon) {
                        mobileMenuIcon.innerText = menuOpen ? 'close' : 'menu';
                    }
                });

                // Close on nav link click
                mobileDropdown.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        menuOpen = false;
                        mobileDropdown.classList.remove('open');
                        if (mobileMenuIcon) mobileMenuIcon.innerText = 'menu';
                    });
                });
            }
        });
    </script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>
