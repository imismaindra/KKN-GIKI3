<!DOCTYPE html>
<html lang="id" class="h-full bg-[#e9eee9]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Halaman Admin SMA GIKI 3 SURABAYA</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full flex overflow-hidden">
    <!-- Main Application Container -->
    <div class="w-full flex bg-[#f8fafc] overflow-hidden">
        
        <!-- Sidebar -->
        <div class="hidden md:flex md:w-64 md:flex-col bg-white border-r border-slate-100 flex-shrink-0">
            <!-- Brand Logo -->
            <div class="h-20 flex items-center px-6 border-b border-slate-50">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('smagiki3.webp') }}" alt="Logo SMA GIKI 3 SURABAYA" class="w-9 h-9 object-contain">
                    <div class="flex flex-col leading-tight">
                        <span class="text-[10px] font-bold text-emerald-600 tracking-wider uppercase">Halaman Admin</span>
                        <span class="text-sm font-black text-slate-900 tracking-tight">SMA GIKI 3 SURABAYA</span>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 flex flex-col justify-between overflow-y-auto px-4 py-6 space-y-8">
                <nav class="space-y-1.5">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center space-x-3.5 px-3 py-1.5 rounded-2xl transition duration-150 {{ request()->routeIs('admin.dashboard') ? 'text-slate-900 font-bold' : 'text-slate-400 hover:text-slate-700 font-medium group' }}">
                        <span class="w-10 h-10 flex items-center justify-center rounded-2xl transition duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10' : 'bg-slate-50 text-slate-400 group-hover:bg-slate-100 group-hover:text-slate-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                        </span>
                        <span class="text-sm">Dashboard</span>
                    </a>

                    <!-- Pengaturan Sekolah -->
                    <a href="{{ route('admin.settings.edit') }}" 
                       class="flex items-center space-x-3.5 px-3 py-1.5 rounded-2xl transition duration-150 {{ request()->routeIs('admin.settings.edit') ? 'text-slate-900 font-bold' : 'text-slate-400 hover:text-slate-700 font-medium group' }}">
                        <span class="w-10 h-10 flex items-center justify-center rounded-2xl transition duration-150 {{ request()->routeIs('admin.settings.edit') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10' : 'bg-slate-50 text-slate-400 group-hover:bg-slate-100 group-hover:text-slate-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                        </span>
                        <span class="text-sm font-sans">Pengaturan Sekolah</span>
                    </a>

                    <!-- Banner / Slider -->
                    <a href="{{ route('admin.banners.index') }}" 
                       class="flex items-center space-x-3.5 px-3 py-1.5 rounded-2xl transition duration-150 {{ request()->routeIs('admin.banners.*') ? 'text-slate-900 font-bold' : 'text-slate-400 hover:text-slate-700 font-medium group' }}">
                        <span class="w-10 h-10 flex items-center justify-center rounded-2xl transition duration-150 {{ request()->routeIs('admin.banners.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10' : 'bg-slate-50 text-slate-400 group-hover:bg-slate-100 group-hover:text-slate-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </span>
                        <span class="text-sm">Banner / Slider</span>
                    </a>

                    <!-- Jurusan Sekolah -->
                    <a href="{{ route('admin.majors.index') }}" 
                       class="flex items-center space-x-3.5 px-3 py-1.5 rounded-2xl transition duration-150 {{ request()->routeIs('admin.majors.*') ? 'text-slate-900 font-bold' : 'text-slate-400 hover:text-slate-700 font-medium group' }}">
                        <span class="w-10 h-10 flex items-center justify-center rounded-2xl transition duration-150 {{ request()->routeIs('admin.majors.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10' : 'bg-slate-50 text-slate-400 group-hover:bg-slate-100 group-hover:text-slate-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </span>
                        <span class="text-sm">Jurusan Sekolah</span>
                    </a>

                    <!-- Fasilitas -->
                    <a href="{{ route('admin.facilities.index') }}" 
                       class="flex items-center space-x-3.5 px-3 py-1.5 rounded-2xl transition duration-150 {{ request()->routeIs('admin.facilities.*') ? 'text-slate-900 font-bold' : 'text-slate-400 hover:text-slate-700 font-medium group' }}">
                        <span class="w-10 h-10 flex items-center justify-center rounded-2xl transition duration-150 {{ request()->routeIs('admin.facilities.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10' : 'bg-slate-50 text-slate-400 group-hover:bg-slate-100 group-hover:text-slate-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </span>
                        <span class="text-sm">Fasilitas</span>
                    </a>

                    <!-- Guru & Staf -->
                    <a href="{{ route('admin.teachers.index') }}" 
                       class="flex items-center space-x-3.5 px-3 py-1.5 rounded-2xl transition duration-150 {{ request()->routeIs('admin.teachers.*') ? 'text-slate-900 font-bold' : 'text-slate-400 hover:text-slate-700 font-medium group' }}">
                        <span class="w-10 h-10 flex items-center justify-center rounded-2xl transition duration-150 {{ request()->routeIs('admin.teachers.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10' : 'bg-slate-50 text-slate-400 group-hover:bg-slate-100 group-hover:text-slate-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </span>
                        <span class="text-sm">Guru & Staf</span>
                    </a>

                    <!-- Berita & Artikel -->
                    <a href="{{ route('admin.articles.index') }}" 
                       class="flex items-center space-x-3.5 px-3 py-1.5 rounded-2xl transition duration-150 {{ request()->routeIs('admin.articles.*') ? 'text-slate-900 font-bold' : 'text-slate-400 hover:text-slate-700 font-medium group' }}">
                        <span class="w-10 h-10 flex items-center justify-center rounded-2xl transition duration-150 {{ request()->routeIs('admin.articles.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10' : 'bg-slate-50 text-slate-400 group-hover:bg-slate-100 group-hover:text-slate-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </span>
                        <span class="text-sm">Berita & Artikel</span>
                    </a>

                    <!-- Galeri -->
                    <a href="{{ route('admin.galleries.index') }}" 
                       class="flex items-center space-x-3.5 px-3 py-1.5 rounded-2xl transition duration-150 {{ request()->routeIs('admin.galleries.*') ? 'text-slate-900 font-bold' : 'text-slate-400 hover:text-slate-700 font-medium group' }}">
                        <span class="w-10 h-10 flex items-center justify-center rounded-2xl transition duration-150 {{ request()->routeIs('admin.galleries.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10' : 'bg-slate-50 text-slate-400 group-hover:bg-slate-100 group-hover:text-slate-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </span>
                        <span class="text-sm">Galeri</span>
                    </a>

                    <!-- Testimoni -->
                    <a href="{{ route('admin.testimonials.index') }}" 
                       class="flex items-center space-x-3.5 px-3 py-1.5 rounded-2xl transition duration-150 {{ request()->routeIs('admin.testimonials.*') ? 'text-slate-900 font-bold' : 'text-slate-400 hover:text-slate-700 font-medium group' }}">
                        <span class="w-10 h-10 flex items-center justify-center rounded-2xl transition duration-150 {{ request()->routeIs('admin.testimonials.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10' : 'bg-slate-50 text-slate-400 group-hover:bg-slate-100 group-hover:text-slate-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        </span>
                        <span class="text-sm">Testimoni</span>
                    </a>

                    <!-- Pesan Masuk -->
                    <a href="{{ route('admin.contact-messages.index') }}" 
                       class="flex items-center space-x-3.5 px-3 py-1.5 rounded-2xl transition duration-150 {{ request()->routeIs('admin.contact-messages.*') ? 'text-slate-900 font-bold' : 'text-slate-400 hover:text-slate-700 font-medium group' }}">
                        <span class="w-10 h-10 flex items-center justify-center rounded-2xl transition duration-150 {{ request()->routeIs('admin.contact-messages.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10' : 'bg-slate-50 text-slate-400 group-hover:bg-slate-100 group-hover:text-slate-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </span>
                        <span class="text-sm">Pesan Masuk</span>
                    </a>
                </nav>

                <!-- Profile and Logout Widget -->
                <div class="border-t border-slate-100 pt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="relative w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center font-bold text-slate-700 text-sm">
                            {{ substr(auth()->user()->name, 0, 2) }}
                            <span class="absolute -top-0.5 -right-0.5 w-3 h-3 bg-pink-500 border-2 border-white rounded-full"></span>
                        </div>
                        <div class="truncate max-w-[110px]">
                            <p class="text-sm font-bold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST" class="flex-shrink-0">
                        @csrf
                        <button type="submit" class="p-2.5 bg-slate-50 hover:bg-red-50 text-slate-400 hover:text-red-500 rounded-2xl transition duration-150">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Workspace -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header bar -->
            <header class="h-20 bg-white border-b border-slate-50 flex items-center justify-between px-8">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">@yield('page_title')</h2>
                </div>
                <!-- Action / Shortcuts widget -->
                <div class="flex items-center space-x-4">
                    <!-- Quick Notification / Mail trigger (Stylistic) -->
                    <div class="hidden sm:flex items-center space-x-2">
                        <span class="p-2.5 bg-slate-50 hover:bg-slate-100 text-slate-500 rounded-full transition cursor-pointer relative">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            @if(\App\Models\ContactMessage::where('is_read', false)->count() > 0)
                                <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-indigo-500 rounded-full border border-white"></span>
                            @endif
                        </span>
                    </div>

                    <!-- Upgrade plan / Visit Site style button -->
                    <a href="/" target="_blank" 
                       class="bg-slate-900 hover:bg-slate-800 text-white text-xs px-5 py-2.5 rounded-full font-bold transition shadow-md shadow-slate-950/10 flex items-center space-x-2">
                        <span>Lihat Website</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>
            </header>

            <!-- Main Scrollable Content area -->
            <main class="flex-1 overflow-y-auto p-8 bg-[#f8fafc]">
                <!-- Alert Messages -->
                @if (session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-800 px-5 py-4 rounded-3xl text-sm flex items-center space-x-3 shadow-sm">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
