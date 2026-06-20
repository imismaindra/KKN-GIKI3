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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
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
                        "headline-sm": ["Poppins"],
                        "display-lg-mobile": ["Poppins"],
                        "title-lg": ["Poppins"],
                        "headline-md": ["Poppins"],
                        "body-lg": ["Open Sans"],
                        "label-md": ["Open Sans"],
                        "display-lg": ["Poppins"],
                        "body-md": ["Open Sans"]
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

        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }

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

        @property --num {
            syntax: "<integer>";
            initial-value: 0;
            inherits: false;
        }
    </style>
    @yield('styles')
</head>

<body class="text-on-surface antialiased overflow-x-hidden selection:bg-secondary selection:text-on-secondary">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-outline-variant/30 shadow-sm transition-all duration-300" id="navbar">
        <div class="flex justify-between items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" class="flex items-center gap-4">
                    <img alt="SMA GIKI 3 Surabaya Logo" class="h-12 w-auto" src="{{ asset('smagiki3.webp') }}" onerror="this.onerror=null; this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuAqpOf4qKo00Ysfs_kCWG7fEdWOlEicpvIPopKs1JuAxe7nv2OqYrgsT3NQM1QZCp03sMGGXIpbkWyxJSnxzTzJPUQdkvuKyQijzIhdiWaBWkA2UgTuyDe7K4GO2-nzbxcLZfFWY_nOoBGLqV_kaShHAYwqqPp8p8lgYXTmoURQbJ7Sn2oT7cdsAEU95HPop-ZqU8EAPgnKYwSsejw1zZhUpbS34yfLYKmn41mLHJK4hzcK-SQC_nYUOKoZ_gUKcV-E_j-5AUvt-OMz';" />
                    <span class="font-display-lg-mobile md:font-display-lg md:text-headline-sm text-primary tracking-tight hidden md:block">
                        SMA GIKI 3 Surabaya
                    </span>
                </a>
            </div>
            
            <div class="hidden md:flex items-center gap-8">
                <a class="text-title-lg font-semibold {{ request()->is('/') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-secondary transition-colors duration-300' }}" href="{{ url('/') }}">
                    Beranda
                </a>
                <a class="text-title-lg font-semibold text-on-surface-variant hover:text-secondary transition-colors duration-300" href="{{ request()->is('/') ? '#profil' : url('/#profil') }}">
                    Profil
                </a>
                <a class="text-title-lg font-semibold text-on-surface-variant hover:text-secondary transition-colors duration-300" href="{{ request()->is('/') ? '#akademik' : url('/#akademik') }}">
                    Akademik
                </a>
                <a class="text-title-lg font-semibold {{ request()->routeIs('articles.*') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-secondary transition-colors duration-300' }}" href="{{ route('articles.index') }}">
                    Berita & Artikel
                </a>
            </div>
            <a href="{{ request()->is('/') ? '#contact' : url('/#contact') }}" class="hidden md:flex btn-primary bg-primary text-on-primary font-label-md text-label-md px-6 py-3 rounded-full border border-primary hover:bg-primary/90 hover:shadow-ambient active:scale-95 duration-200">
                Hubungi Kami
            </a>
            <button class="md:hidden text-primary p-2" id="mobileMenuBtn">
                <span class="material-symbols-outlined text-3xl">menu</span>
            </button>
        </div>
        <!-- Mobile Dropdown Menu -->
        <div id="mobileDropdown" class="hidden md:hidden px-margin-mobile pb-6 pt-2 bg-white/95 border-b border-outline-variant/30 flex flex-col space-y-3.5 shadow-md">
            <a class="font-semibold text-primary hover:text-secondary py-1" href="{{ url('/') }}">Beranda</a>
            <a class="font-semibold text-primary hover:text-secondary py-1" href="{{ url('/#profil') }}">Profil</a>
            <a class="font-semibold text-primary hover:text-secondary py-1" href="{{ url('/#akademik') }}">Akademik</a>
            <a class="font-semibold text-primary hover:text-secondary py-1" href="{{ route('articles.index') }}">Berita & Artikel</a>
            <a class="font-semibold text-secondary py-1" href="{{ url('/#contact') }}">Hubungi Kami</a>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="w-full bg-primary relative overflow-hidden mt-20 border-t border-outline-variant/10">
        <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
        <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Column 1: Brand Info -->
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <img alt="SMA GIKI 3 Surabaya Logo" class="h-12 w-auto brightness-0 invert" src="{{ asset('smagiki3.webp') }}" onerror="this.onerror=null; this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuAqpOf4qKo00Ysfs_kCWG7fEdWOlEicpvIPopKs1JuAxe7nv2OqYrgsT3NQM1QZCp03sMGGXIpbkWyxJSnxzTzJPUQdkvuKyQijzIhdiWaBWkA2UgTuyDe7K4GO2-nzbxcLZfFWY_nOoBGLqV_kaShHAYwqqPp8p8lgYXTmoURQbJ7Sn2oT7cdsAEU95HPop-ZqU8EAPgnKYwSsejw1zZhUpbS34yfLYKmn41mLHJK4hzcK-SQC_nYUOKoZ_gUKcV-E_j-5AUvt-OMz';" />
                        <span class="font-bold text-headline-sm text-on-primary tracking-tight">SMA GIKI 3</span>
                    </div>
                    <p class="font-body-md text-on-primary/70 leading-relaxed">
                        Membentuk karakter unggul dan mengukir prestasi gemilang melalui pendidikan holistik berbasis nilai-nilai luhur bangsa.
                    </p>
                    <div class="flex gap-4">
                        <a class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-on-primary hover:bg-secondary hover:text-primary transition-all duration-300 hover:-translate-y-1" href="#">
                            <span class="material-symbols-outlined">public</span>
                        </a>
                        <a class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-on-primary hover:bg-secondary hover:text-primary transition-all duration-300 hover:-translate-y-1" href="#">
                            <span class="material-symbols-outlined">photo_camera</span>
                        </a>
                        <a class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-on-primary hover:bg-secondary hover:text-primary transition-all duration-300 hover:-translate-y-1" href="#">
                            <span class="material-symbols-outlined">play_arrow</span>
                        </a>
                    </div>
                </div>
                <!-- Column 2: Quick Links -->
                <div>
                    <h4 class="font-bold text-title-lg text-on-primary mb-8 uppercase tracking-widest">Tautan Cepat</h4>
                    <ul class="flex flex-col gap-4">
                        <li><a class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all" href="{{ url('/#profil') }}">Profil Sekolah</a></li>
                        <li><a class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all" href="{{ url('/#profil') }}">Visi &amp; Misi</a></li>
                        <li><a class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all" href="{{ url('/#fasilitas') }}">Fasilitas</a></li>
                    </ul>
                </div>
                <!-- Column 3: Admissions -->
                <div>
                    <h4 class="font-bold text-title-lg text-on-primary mb-8 uppercase tracking-widest">Penerimaan</h4>
                    <ul class="flex flex-col gap-4">
                        <li><a class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all" href="#">PPDB 2024</a></li>
                        <li><a class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all" href="#">Persyaratan</a></li>
                        <li><a class="font-body-md text-on-primary/80 hover:text-secondary hover:translate-x-1 inline-block transition-all" href="#">Jadwal Seleksi</a></li>
                    </ul>
                </div>
                <!-- Column 4: Contact Us -->
                <div class="flex flex-col gap-6">
                    <h4 class="font-bold text-title-lg text-on-primary mb-8 uppercase tracking-widest">Kontak Kami</h4>
                    <ul class="flex flex-col gap-4 font-body-md text-on-primary/80">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary">location_on</span>
                            <span>Jl. Raya Kertajaya Indah No.10, Surabaya</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary">phone</span>
                            <span>(031) 5945133</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary">mail</span>
                            <span>info@smagiki3surabaya.sch.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="font-body-md text-on-primary/50 text-sm">
                    © 2024 SMA GIKI 3 Surabaya. All Rights Reserved.
                </p>
                <button class="btn-primary bg-white/5 backdrop-blur-xl text-on-primary font-bold text-label-md px-10 py-5 rounded-full border border-white/10 hover:bg-white/10 transition-all duration-300" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                    <span class="font-label-md">Kembali ke Atas</span>
                    <span class="material-symbols-outlined">arrow_upward</span>
                </button>
            </div>
        </div>
    </footer>

    <!-- Scripts for Interactions -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Navbar scroll effect
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    navbar.classList.add('shadow-md');
                } else {
                    navbar.classList.remove('shadow-md');
                }
            });

            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileDropdown = document.getElementById('mobileDropdown');
            if (mobileMenuBtn && mobileDropdown) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileDropdown.classList.toggle('hidden');
                });
            }
        });
    </script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>
