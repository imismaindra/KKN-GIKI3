<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    
    <!-- Dynamic Title & SEO Meta Tags -->
    <title>@yield('title', 'SMA GIKI 3 Surabaya')</title>
    @yield('meta')
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Poppins:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    @yield('styles')
</head>

<body class="text-on-surface antialiased overflow-x-hidden selection:bg-secondary/30 selection:text-primary">
    <!-- Scroll Progress Bar -->
    <div id="scroll-progress"></div>
    <!-- Sticky CTA -->
    <div id="sticky-cta">
        <a href="https://wa.me/6281381881594" target="_blank" rel="noopener noreferrer"
           class="flex items-center gap-2.5 bg-accent hover:bg-red-800 text-white font-bold text-sm px-6 py-3.5 rounded-full shadow-2xl hover:shadow-accent/40 transition-all duration-300 tracking-wide">
            <span class="material-symbols-outlined text-base">edit_note</span>
            Daftar Sekarang
        </a>
    </div>
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 transition-all duration-400 border-b border-outline-variant/10 {{ request()->is('/') ? 'glass-nav-transparent' : 'glass-nav scrolled' }}" id="navbar">
        <div class="flex justify-between items-center h-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="flex items-center gap-4">
<a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="relative">
                        <img alt="{{ $setting?->school_name ?? 'SMA GIKI 3 Surabaya' }} Logo"
                             class="h-11 w-auto img-zoom"
                             src="{{ ($setting && $setting->logo) ? Storage::url($setting->logo) : asset('smagiki3.webp') }}" />
                      </div>
                     <div class="flex flex-col leading-tight">
                         <span class="font-black text-base tracking-tight logo-title">SMA GIKI 3</span>
                        <span class="text-[10px] font-bold tracking-widest uppercase logo-sub">Surabaya</span>
                    </div>
                </a>
            </div>
            
            <div class="hidden md:flex items-center gap-1">
                @php
                    $navLinks = [
                        ['href' => url('/'), 'label' => 'Beranda', 'active' => request()->is('/')],
                        ['href' => request()->is('/') ? '#profil' : url('/#profil'), 'label' => 'Profil', 'active' => false],
                        ['href' => request()->is('/') ? '#akademik' : url('/#akademik'), 'label' => 'Akademik', 'active' => false],
                        ['href' => route('galleries.index.public'), 'label' => 'Galeri', 'active' => request()->routeIs('galleries.*')],
                        ['href' => route('articles.index'), 'label' => 'Berita', 'active' => request()->routeIs('articles.*')],
                        ['href' => route('extracurriculars.index.public'), 'label' => 'Ekskul', 'active' => request()->routeIs('extracurriculars.index.*')],
                        ['href' => route('teachers.index.public'), 'label' => 'Guru & Staff', 'active' => request()->routeIs('teachers.index.public')],
                    ];
                @endphp
                @foreach($navLinks as $link)
                    <a href="{{ $link['href'] }}"
                       class="relative px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 nav-link-item
                              {{ $link['active'] ? 'active-nav' : '' }}">
                        {{ $link['label'] }}
                        <span class="nav-indicator absolute bottom-0 left-1/2 -translate-x-1/2 w-4 h-0.5 bg-secondary rounded-full"></span>
                    </a>
                @endforeach
            </div>

            <div class="hidden md:flex items-center gap-2">
                <!-- E-Rapor Button -->
                <a href="{{ ($setting && $setting->erapor_url) ? $setting->erapor_url : '#' }}" 
                   class="flex items-center gap-1.5 px-3.5 py-2 rounded-full border text-xs font-bold tracking-wide transition-all duration-200 hover:-translate-y-0.5 shadow-sm active:scale-95 btn-erapor">
                    <span class="material-symbols-outlined text-sm">menu_book</span>
                    E-Rapor
                </a>
                <!-- Ujian Login Button -->
                <a href="{{ ($setting && $setting->ujian_url) ? $setting->ujian_url : '#' }}" 
                   class="flex items-center gap-1.5 px-3.5 py-2 rounded-full bg-accent text-white hover:bg-red-700 text-xs font-bold tracking-wide transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-accent/20 active:scale-95">
                    <span class="material-symbols-outlined text-sm">lock_open</span>
                    Ujian Login
                </a>
                <!-- Hubungi Button -->
                <a href="{{ request()->is('/') ? '#contact' : url('/#contact') }}"
                   class="flex items-center gap-1.5 px-3.5 py-2 rounded-full text-xs font-bold tracking-wide transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg active:scale-95 btn-hubungi">
                    <span class="material-symbols-outlined text-sm">mail</span>
                    Hubungi
                </a>
            </div>
            <button class="md:hidden p-2 rounded-xl hover:bg-primary/5 transition" id="mobileMenuBtn" aria-label="Menu">
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
            <a class="flex items-center gap-3 font-semibold {{ request()->routeIs('galleries.*') ? 'text-secondary' : 'text-on-surface-variant' }} hover:text-secondary hover:bg-secondary/5 px-3 py-2.5 rounded-xl transition" href="{{ route('galleries.index.public') }}">
                <span class="material-symbols-outlined text-lg">photo_library</span> Galeri
            </a>
            <a class="flex items-center gap-3 font-semibold text-on-surface-variant hover:text-secondary hover:bg-secondary/5 px-3 py-2.5 rounded-xl transition" href="{{ route('articles.index') }}">
                <span class="material-symbols-outlined text-lg">newspaper</span> Berita & Artikel
            </a>
            <a class="flex items-center gap-3 font-semibold {{ request()->routeIs('extracurriculars.index.*') ? 'text-secondary' : 'text-on-surface-variant' }} hover:text-secondary hover:bg-secondary/5 px-3 py-2.5 rounded-xl transition" href="{{ route('extracurriculars.index.public') }}">
                <span class="material-symbols-outlined text-lg">sports</span> Ekstrakurikuler
            </a>
            <a class="flex items-center gap-3 font-semibold {{ request()->routeIs('teachers.index.public') ? 'text-secondary' : 'text-on-surface-variant' }} hover:text-secondary hover:bg-secondary/5 px-3 py-2.5 rounded-xl transition" href="{{ route('teachers.index.public') }}">
                <span class="material-symbols-outlined text-lg">group</span> Guru & Staff
            </a>
            <div class="mt-3 pt-3 border-t border-outline-variant/20 flex flex-col gap-2">
                <a class="flex items-center justify-center gap-2 font-bold text-secondary border border-secondary/20 hover:bg-secondary/5 px-4 py-2.5 rounded-xl text-sm transition w-full" href="{{ ($setting && $setting->erapor_url) ? $setting->erapor_url : '#' }}">
                    <span class="material-symbols-outlined text-base">menu_book</span> E-Rapor
                </a>
                <a class="flex items-center justify-center gap-2 font-bold text-white bg-accent hover:bg-red-700 px-4 py-2.5 rounded-xl text-sm transition w-full" href="{{ ($setting && $setting->ujian_url) ? $setting->ujian_url : '#' }}">
                    <span class="material-symbols-outlined text-base">lock_open</span> Login Ujian
                </a>
                <a class="flex items-center justify-center gap-2 font-bold text-white bg-primary hover:bg-primary/90 px-4 py-2.5 rounded-xl text-sm transition w-full" href="{{ url('/#contact') }}">
                    <span class="material-symbols-outlined text-base">mail</span> Hubungi Kami
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="w-full relative overflow-hidden mt-20" style="background: linear-gradient(160deg, #0A1F3D 0%, #0A1628 60%, #0D1B3E 100%);">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 28px 28px;"></div>
        <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(200,147,10,0.5) 30%, rgba(196,30,58,0.4) 70%, transparent);"></div>
        <div class="relative z-10 max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Column 1: Brand Info -->
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <img alt="{{ $setting->school_name ?? 'SMA GIKI 3 Surabaya' }} Logo" class="h-12 w-auto" src="{{ ($setting && $setting->logo) ? Storage::url($setting->logo) : asset('smagiki3.webp') }}" />
                        <span class="font-bold text-headline-sm text-on-primary tracking-tight">{{ $setting?->school_name ?? 'SMA GIKI 3 SURABAYA' }}</span>
                    </div>
                    <p class="font-body-md text-on-primary/70 leading-relaxed">
                        Membentuk karakter unggul dan mengukir prestasi gemilang melalui pendidikan holistik berbasis nilai-nilai luhur bangsa.
                    </p>
                    <div class="flex gap-3">
                        <!-- TikTok -->
                        <a class="w-10 h-10 rounded-2xl bg-white/8 border border-white/10 flex items-center justify-center text-white/80 hover:bg-slate-900 hover:text-white hover:border-slate-800 transition-all duration-300 hover:-translate-y-1 shadow-sm"
                           href="{{ ($setting && $setting->tiktok_url) ? $setting->tiktok_url : 'https://www.tiktok.com/@smagiga_media' }}" 
                           target="_blank" 
                           title="TikTok">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.02 1.63 4.16 1.02 1.12 2.45 1.79 3.94 1.95v3.91a8.312 8.312 0 0 1-5.18-1.74c-.06 2.42-.02 4.84-.04 7.26-.06 1.83-.56 3.65-1.57 5.16-1.12 1.62-2.91 2.76-4.83 3.16-1.89.37-3.9-.03-5.53-1.07-1.78-1.16-2.95-3.15-3.1-5.26-.26-3.14 1.7-6.22 4.69-7.23.83-.28 1.71-.38 2.58-.33v4.03c-.63-.12-1.3-.06-1.88.21-.86.37-1.48 1.2-1.56 2.12-.13 1.25.75 2.42 1.99 2.58.91.13 1.89-.3 2.32-1.11.23-.42.33-.91.31-1.39-.02-3.86-.01-7.72-.02-11.58-.01-.1-.01-.2-.02-.3-.02-.19-.06-.39-.19-.54-.15-.17-.38-.2-.6-.2H12.525z"/>
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a class="w-10 h-10 rounded-2xl bg-white/8 border border-white/10 flex items-center justify-center text-white/80 hover:bg-gradient-to-tr hover:from-rose-500 hover:to-orange-500 hover:text-white hover:border-transparent transition-all duration-300 hover:-translate-y-1 shadow-sm"
                           href="{{ ($setting && $setting->instagram_url) ? $setting->instagram_url : 'https://instagram.com/smagiga' }}" 
                           target="_blank" 
                           title="Instagram">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204 0-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
                            </svg>
                        </a>
                        <!-- YouTube -->
                        <a class="w-10 h-10 rounded-2xl bg-white/8 border border-white/10 flex items-center justify-center text-white/80 hover:bg-red-600 hover:text-white hover:border-red-500 transition-all duration-300 hover:-translate-y-1 shadow-sm"
                           href="{{ ($setting && $setting->youtube_url) ? $setting->youtube_url : 'https://youtube.com/@smagiki3surabaya730' }}" 
                           target="_blank" 
                           title="YouTube">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.517 0-9.388.508a3.003 3.003 0 0 0-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 0 0 2.11 2.11c1.871.508 9.388.508 9.388.508s7.517 0 9.388-.508a3.003 3.003 0 0 0 2.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
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
                        <li><a class="text-sm text-white/75 hover:text-secondary flex items-center gap-2 group transition-all duration-200" href="{{ route('extracurriculars.index.public') }}"><span class="w-1 h-1 rounded-full bg-secondary/50 group-hover:bg-secondary transition"></span>Ekstrakurikuler</a></li>
                        <li><a class="text-sm text-white/75 hover:text-secondary flex items-center gap-2 group transition-all duration-200" href="{{ route('teachers.index.public') }}"><span class="w-1 h-1 rounded-full bg-secondary/50 group-hover:bg-secondary transition"></span>Guru &amp; Staff</a></li>
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
                        <p class="text-sm text-white/70 leading-relaxed">{{ $setting?->address ?? 'Jl. Klampis Jaya No. 11, Klampis Ngasem, Kec. Sukolilo, Surabaya' }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-secondary/15 border border-secondary/20 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-secondary text-[16px]">phone</span>
                        </div>
                        <a href="tel:{{ $setting?->phone ?? '031-5996405' }}" class="text-sm text-white/70 hover:text-secondary transition">{{ $setting?->phone ?? '031-5996405' }}</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-secondary/15 border border-secondary/20 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-secondary text-[16px]">mail</span>
                        </div>
                        <a href="mailto:{{ $setting?->email ?? 'info@smagiki3surabaya.sch.id' }}" class="text-sm text-white/70 hover:text-secondary transition">{{ $setting?->email ?? 'info@smagiki3surabaya.sch.id' }}</a>
                    </div>
                </div>
            </div>
            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-white/8 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex flex-col md:flex-row items-center gap-3">
                    <p class="text-white/35 text-xs">
                        © {{ date('Y') }} {{ $setting?->school_name ?? 'SMA GIKI 3 Surabaya' }}. Hak Cipta Dilindungi.
                    </p>
                    <span class="hidden md:block w-1 h-1 rounded-full bg-white/20"></span>
                    <p class="text-white/25 text-xs">Dikembangkan oleh Kelomopok 3 KKN ITATS</p>
                </div>
                <button class="flex items-center gap-2 text-white/60 hover:text-secondary text-xs font-semibold transition-all duration-200 hover:-translate-y-0.5" onclick="if(window.lenis) { window.lenis.scrollTo(0); } else { window.scrollTo({top: 0, behavior: 'smooth'}); }">
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

                if (progressBar) progressBar.style.transform = `scaleX(${progress / 100})`;

                // Navbar state
                if (navbar) {
                    if (scrollTop > 30) {
                        navbar.classList.add('scrolled');
                    } else {
                        @if(request()->is('/'))
                            navbar.classList.remove('scrolled');
                        @endif
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

            // ── Scrollspy & Dynamic Active Navbar Links ──
            const scrollspyHandler = () => {
                const profilEl = document.getElementById('profil');
                if (!profilEl) return; // Only run scrollspy on pages that have home sections (homepage)

                const scrollPos = window.scrollY + 150; // offset for fixed header
                let currentLabel = 'Beranda';

                if (window.scrollY < 120) {
                    currentLabel = 'Beranda';
                } else {
                    const sections = [
                        { id: 'profil', label: 'Profil' },
                        { id: 'sambutan', label: 'Profil' },
                        { id: 'akademik', label: 'Akademik' },
                        { id: 'fasilitas', label: 'Akademik' },
                        { id: 'guru', label: 'Akademik' },
                        { id: 'galeri', label: 'Galeri' },
                        { id: 'testimoni', label: 'Galeri' },
                        { id: 'berita', label: 'Galeri' },
                        { id: 'contact', label: 'Galeri' }
                    ];

                    for (const sec of sections) {
                        const el = document.getElementById(sec.id);
                        if (el) {
                            const top = el.offsetTop;
                            if (scrollPos >= top) {
                                currentLabel = sec.label;
                            }
                        }
                    }
                }

                // Update active classes for desktop navbar link items
                const navLinks = document.querySelectorAll('.nav-link-item');
                navLinks.forEach(link => {
                    const labelText = link.textContent.trim();
                    if (['Beranda', 'Profil', 'Akademik', 'Galeri'].includes(labelText)) {
                        if (labelText === currentLabel) {
                            link.classList.add('active-nav');
                        } else {
                            link.classList.remove('active-nav');
                        }
                    }
                });
            };

            window.addEventListener('scroll', scrollspyHandler, { passive: true });
            // Run scrollspy handler initially to set correct state
            scrollspyHandler();

            // ── Mobile Menu Toggle (animated) ───────────
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenuIcon = document.getElementById('mobileMenuIcon');
            const mobileDropdown = document.getElementById('mobileDropdown');
            let menuOpen = false;

            function closeMobileMenu() {
                menuOpen = false;
                mobileDropdown.classList.remove('open');
                mobileDropdown.style.overflowY = 'hidden';
                mobileDropdown.style.height = '0';
                navbar.classList.remove('menu-open');
                if (mobileMenuIcon) mobileMenuIcon.innerText = 'menu';
                if (mobileMenuBtn) mobileMenuBtn.focus();
            }

            if (mobileMenuBtn && mobileDropdown) {
                mobileMenuBtn.addEventListener('click', () => {
                    menuOpen = !menuOpen;
                    if (menuOpen) {
                        mobileDropdown.classList.add('open');
                        var dh = Math.min(mobileDropdown.scrollHeight, window.innerHeight - 80);
                        mobileDropdown.style.height = dh + 'px';
                        mobileDropdown.style.overflowY = 'auto';
                        navbar.classList.add('menu-open');
                        // Focus first link in dropdown
                        const firstLink = mobileDropdown.querySelector('a');
                        if (firstLink) firstLink.focus();
                    } else {
                        closeMobileMenu();
                    }
                    if (mobileMenuIcon) {
                        mobileMenuIcon.innerText = menuOpen ? 'close' : 'menu';
                    }
                });

                // Close on Escape key
                mobileDropdown.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && menuOpen) {
                        closeMobileMenu();
                    }
                });

                // Close on nav link click
                mobileDropdown.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        closeMobileMenu();
                    });
                });
            }
        });
    </script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>
