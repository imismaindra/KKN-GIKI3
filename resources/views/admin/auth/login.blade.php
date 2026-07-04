<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMA GIKI 3 SURABAYA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- GSAP CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }

        .hero-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #0e7490 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            pointer-events: none;
            will-change: transform;
        }

        .blob-1 {
            width: 380px; height: 380px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.35) 0%, transparent 70%);
            top: -100px; left: -100px;
        }

        .blob-2 {
            width: 320px; height: 320px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.3) 0%, transparent 70%);
            bottom: -80px; right: -80px;
        }

        .blob-3 {
            width: 240px; height: 240px;
            background: radial-gradient(circle, rgba(34, 211, 238, 0.2) 0%, transparent 70%);
            bottom: 35%; left: 15%;
        }

        .dot-grid {
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1.5px, transparent 1.5px);
            background-size: 28px 28px;
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 60%, #0e7490 100%);
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 700;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            letter-spacing: 0.02em;
            position: relative;
            overflow: hidden;
            transition: transform 0.15s ease, box-shadow 0.2s ease;
            box-shadow: 0 8px 24px rgba(14, 116, 144, 0.25);
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(14, 116, 144, 0.35);
        }

        .btn-submit:hover::before { opacity: 1; }
        .btn-submit:active { transform: translateY(0); }

        .feature-pill {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 999px;
            font-size: 0.78rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            backdrop-filter: blur(4px);
        }

        .feature-icon {
            width: 1.5rem; height: 1.5rem;
            background: rgba(6, 182, 212, 0.2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.65rem;
        }

        .logo-ring {
            padding: 0.875rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 20px;
            display: inline-flex;
            backdrop-filter: blur(8px);
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
            background: none;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
            transition: color 0.2s ease;
        }

        .toggle-password:hover { color: #0e7490; }

        /* Initial state to prevent FOUC (Flash of Unstyled Content) */
        .gsap-reveal {
            opacity: 0;
        }
    </style>
</head>
<body class="h-full flex bg-slate-100 overflow-hidden">

    {{-- ===== LEFT PANEL: Branding ===== --}}
    <div id="left-panel" class="hidden lg:flex lg:w-1/2 hero-gradient relative flex-col justify-between p-12 overflow-hidden">

        {{-- Decorative blobs --}}
        <div class="blob blob-1" id="blob1"></div>
        <div class="blob blob-2" id="blob2"></div>
        <div class="blob blob-3" id="blob3"></div>

        {{-- Dot grid overlay --}}
        <div class="absolute inset-0 dot-grid opacity-60"></div>

        {{-- Top: Logo + brand --}}
        <div class="relative z-10 flex items-center gap-3 gsap-reveal" id="brand-logo">
            <div class="logo-ring">
                <img src="{{ asset('smagiki3.webp') }}" alt="Logo SMA GIKI 3" class="w-10 h-10 object-contain">
            </div>
            <div>
                <p class="text-white font-bold text-sm leading-tight">SMA GIKI 3</p>
                <p class="text-cyan-300 font-medium text-xs">SURABAYA</p>
            </div>
        </div>

        {{-- Center: Hero text --}}
        <div class="relative z-10 space-y-6">
            <div class="space-y-3">
                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-cyan-400/20 border border-cyan-400/30 rounded-full text-cyan-300 text-xs font-semibold tracking-wider uppercase gsap-reveal" id="hero-badge">
                    <span class="w-1.5 h-1.5 bg-cyan-400 rounded-full animate-pulse"></span>
                    Portal Admin
                </span>
                <h1 class="text-4xl xl:text-5xl font-black text-white leading-tight gsap-reveal" id="hero-title">
                    Selamat Datang<br>
                    <span class="text-cyan-300 font-extrabold drop-shadow-[0_0_12px_rgba(34,211,238,0.4)]">
                        Kembali
                    </span>
                </h1>
                <p class="text-slate-300 text-base leading-relaxed max-w-sm gsap-reveal" id="hero-desc">
                    Kelola data sekolah, kegiatan, dan informasi akademik dengan mudah dan efisien.
                </p>
            </div>

            {{-- Feature pills --}}
            <div class="flex flex-wrap gap-2 gsap-reveal" id="hero-pills">
                <div class="feature-pill">
                    <div class="feature-icon">📊</div>
                    Dashboard Lengkap
                </div>
                <div class="feature-pill">
                    <div class="feature-icon">🔒</div>
                    Akses Aman
                </div>
                <div class="feature-pill">
                    <div class="feature-icon">⚡</div>
                    Real-time Data
                </div>
            </div>
        </div>

        {{-- Bottom: stats --}}
        <div class="relative z-10 glass-card rounded-2xl p-5 flex items-center justify-between gap-4 gsap-reveal" id="hero-stats">
            <div class="text-center">
                <p class="text-white font-black text-2xl leading-none">1000+</p>
                <p class="text-slate-400 text-xs mt-1">Siswa Aktif</p>
            </div>
            <div class="w-px h-10 bg-white/10"></div>
            <div class="text-center">
                <p class="text-white font-black text-2xl leading-none">80+</p>
                <p class="text-slate-400 text-xs mt-1">Tenaga Pengajar</p>
            </div>
            <div class="w-px h-10 bg-white/10"></div>
            <div class="text-center">
                <p class="text-white font-black text-2xl leading-none">50+</p>
                <p class="text-slate-400 text-xs mt-1">Prestasi</p>
            </div>
            <div class="w-px h-10 bg-white/10"></div>
            <div class="text-center">
                <p class="text-white font-black text-2xl leading-none">25+</p>
                <p class="text-slate-400 text-xs mt-1">Tahun Berdiri</p>
            </div>
        </div>
    </div>

    {{-- ===== RIGHT PANEL: Login Form ===== --}}
    <div class="flex-1 flex items-center justify-center p-6 lg:p-12 bg-white relative">
        <div class="w-full max-w-md">

            {{-- Mobile logo (shown only on small screens) --}}
            <div class="lg:hidden flex items-center gap-3 mb-8 gsap-reveal" id="mobile-logo">
                <img src="{{ asset('smagiki3.webp') }}" alt="Logo SMA GIKI 3" class="w-10 h-10 object-contain">
                <div>
                    <p class="font-bold text-slate-900 text-sm">SMA GIKI 3 SURABAYA</p>
                    <p class="text-slate-400 text-xs">Portal Admin</p>
                </div>
            </div>

            {{-- Heading --}}
            <div class="space-y-2 mb-8 gsap-reveal" id="form-heading">
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Masuk ke Akun</h2>
                <p class="text-slate-500 text-sm">Gunakan kredensial admin untuk melanjutkan.</p>
            </div>

            {{-- Error alert --}}
            @if ($errors->any())
                <div class="flex items-start gap-3 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3.5 rounded-2xl text-sm font-medium mb-6 gsap-reveal" id="error-alert">
                    <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 9a1 1 0 01-1-1v-4a1 1 0 112 0v4a1 1 0 01-1 1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div class="space-y-2 gsap-reveal" id="form-field-1">
                    <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input type="email" name="email" id="email"
                            value="{{ old('email') }}" required autofocus
                            placeholder="admin@sekolah.sch.id"
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:bg-white focus:ring-4 focus:ring-cyan-600/10 focus:border-cyan-600 text-slate-800 text-sm placeholder:text-slate-400 transition-all duration-200">
                    </div>
                </div>

                {{-- Password --}}
                <div class="space-y-2 gsap-reveal" id="form-field-2">
                    <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" name="password" id="password"
                            required placeholder="••••••••"
                            class="w-full pl-11 pr-12 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:bg-white focus:ring-4 focus:ring-cyan-600/10 focus:border-cyan-600 text-slate-800 text-sm placeholder:text-slate-400 transition-all duration-200">
                        <button type="button" class="toggle-password" onclick="togglePassword()" id="toggleBtn" aria-label="Tampilkan password">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember me --}}
                <div class="flex items-center justify-between gsap-reveal" id="form-field-3">
                    <label class="flex items-center gap-2.5 cursor-pointer group">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded-md border-slate-300 text-cyan-600 focus:ring-cyan-500 focus:ring-2 accent-cyan-600">
                        <span class="text-sm text-slate-500 group-hover:text-slate-700 transition-colors select-none">
                            Ingat saya
                        </span>
                    </label>
                </div>

                {{-- Submit --}}
                <div class="pt-1 gsap-reveal" id="form-submit">
                    <button type="submit" class="btn-submit flex items-center justify-center gap-2">
                        <span>Masuk ke Dashboard</span>
                        <svg class="w-4 h-4 transition-transform duration-300 ease-out" id="submit-arrow" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </div>
            </form>

            {{-- Footer --}}
            <p class="mt-8 text-center text-xs text-slate-400 gsap-reveal" id="form-footer">
                &copy; {{ date('Y') }} SMA GIKI 3 Surabaya. Hak cipta dilindungi.
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.innerHTML = isHidden
                ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"`
                : `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }

        // GSAP Animations
        document.addEventListener('DOMContentLoaded', () => {
            // Main animation timeline
            const tl = gsap.timeline({ defaults: { ease: 'power4.out', duration: 1.2 } });

            // Animate background blobs first (scale up + floating)
            gsap.fromTo('#blob1', { scale: 0, opacity: 0 }, { scale: 1, opacity: 1, duration: 2, ease: 'elastic.out(1, 0.75)' });
            gsap.fromTo('#blob2', { scale: 0, opacity: 0 }, { scale: 1, opacity: 1, duration: 2.2, ease: 'elastic.out(1, 0.75)', delay: 0.15 });
            gsap.fromTo('#blob3', { scale: 0, opacity: 0 }, { scale: 1, opacity: 1, duration: 2.4, ease: 'elastic.out(1, 0.75)', delay: 0.3 });

            // Subtle continuous floating effect for blobs
            gsap.to('#blob1', { x: '+=20', y: '-=30', rotation: 10, duration: 6, ease: 'sine.inOut', repeat: -1, yoyo: true });
            gsap.to('#blob2', { x: '-=15', y: '+=25', rotation: -12, duration: 8, ease: 'sine.inOut', repeat: -1, yoyo: true });
            gsap.to('#blob3', { x: '+=10', y: '+=20', duration: 7, ease: 'sine.inOut', repeat: -1, yoyo: true });

            // Slide & Fade in Left panel contents
            tl.fromTo('#brand-logo', { opacity: 0, y: -20 }, { opacity: 1, y: 0, duration: 0.8 }, 0.2);
            tl.fromTo('#hero-badge', { opacity: 0, scale: 0.85 }, { opacity: 1, scale: 1, duration: 0.6 }, 0.4);
            tl.fromTo('#hero-title', { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 1 }, 0.5);
            tl.fromTo('#hero-desc', { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 1 }, 0.6);
            tl.fromTo('#hero-pills', { opacity: 0, y: 15 }, { opacity: 1, y: 0, duration: 0.8 }, 0.7);
            tl.fromTo('#hero-stats', { opacity: 0, y: 40, scale: 0.95 }, { opacity: 1, y: 0, scale: 1, ease: 'back.out(1.2)', duration: 1.1 }, 0.8);

            // Slide & Fade in Right panel form contents
            tl.fromTo('#mobile-logo', { opacity: 0, y: -20 }, { opacity: 1, y: 0, duration: 0.8 }, 0.3);
            tl.fromTo('#form-heading', { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 1 }, 0.4);
            
            if (document.getElementById('error-alert')) {
                tl.fromTo('#error-alert', { opacity: 0, scale: 0.9, y: 15 }, { opacity: 1, scale: 1, y: 0, ease: 'back.out(1.5)', duration: 0.6 }, 0.55);
            }
            
            tl.fromTo('#form-field-1', { opacity: 0, y: 25 }, { opacity: 1, y: 0, duration: 0.9 }, 0.6);
            tl.fromTo('#form-field-2', { opacity: 0, y: 25 }, { opacity: 1, y: 0, duration: 0.9 }, 0.7);
            tl.fromTo('#form-field-3', { opacity: 0, y: 15 }, { opacity: 1, y: 0, duration: 0.8 }, 0.8);
            tl.fromTo('#form-submit', { opacity: 0, y: 30 }, { opacity: 1, y: 0, ease: 'back.out(1.4)', duration: 1 }, 0.9);
            tl.fromTo('#form-footer', { opacity: 0 }, { opacity: 1, duration: 1.2 }, 1.1);

            // Interactive parallax effect on Left Panel (mouse move)
            const leftPanel = document.getElementById('left-panel');
            leftPanel.addEventListener('mousemove', (e) => {
                const { width, height } = leftPanel.getBoundingClientRect();
                const moveX = (e.clientX - width / 2) / width;
                const moveY = (e.clientY - height / 2) / height;

                gsap.to('#blob1', { x: moveX * 45, y: moveY * 45, duration: 1, ease: 'power2.out' });
                gsap.to('#blob2', { x: moveX * -35, y: moveY * -35, duration: 1, ease: 'power2.out' });
                gsap.to('#blob3', { x: moveX * 25, y: moveY * 25, duration: 1, ease: 'power2.out' });
            });

            // Interactive submit button animations
            const submitBtn = document.querySelector('.btn-submit');
            const submitArrow = document.getElementById('submit-arrow');
            
            submitBtn.addEventListener('mouseenter', () => {
                gsap.to(submitArrow, { x: 4, ease: 'power2.out', duration: 0.3 });
            });
            submitBtn.addEventListener('mouseleave', () => {
                gsap.to(submitArrow, { x: 0, ease: 'power2.out', duration: 0.3 });
            });
        });
    </script>
</body>
</html>
