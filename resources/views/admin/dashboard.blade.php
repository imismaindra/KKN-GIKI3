@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Analytics Overview')

@section('content')
<div class="space-y-8">
    
    <!-- Welcome Promo Banner -->
    <div class="bg-slate-900 rounded-[24px] p-6 md:p-8 text-white shadow-xl shadow-slate-900/10 flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
        <div>
            <h3 class="text-xl md:text-2xl font-extrabold tracking-tight">Selamat Datang di Admin Panel, {{ auth()->user()->name }}!</h3>
            <p class="text-slate-400 text-sm mt-1">Kelola konten, halaman depan, informasi profil, berita, dan pesan pengunjung.</p>
        </div>
        <a href="{{ route('admin.settings.edit') }}" class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-bold rounded-full text-xs transition duration-150">
            Edit Profil Sekolah
        </a>
    </div>

    <!-- Stats Pastels Grid (Flusync Style) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Card 1: Unread Messages (Lavender Pastel) -->
        <div class="bg-[#cdd3fc] rounded-[24px] p-6 shadow-sm flex flex-col justify-between h-40 group hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <span class="text-xs font-bold text-indigo-900/80 uppercase tracking-wider">Pesan Baru</span>
                <span class="p-2 bg-white/40 text-indigo-950 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </span>
            </div>
            <div>
                <h4 class="text-4xl font-extrabold tracking-tight text-indigo-950">{{ \App\Models\ContactMessage::where('is_read', false)->count() }}</h4>
                <p class="text-xs font-semibold text-indigo-900/60 mt-1">Belum ditinjau</p>
            </div>
        </div>

        <!-- Card 2: Total Articles (Soft Mint Pastel) -->
        <div class="bg-[#d2ebd9] rounded-[24px] p-6 shadow-sm flex flex-col justify-between h-40 group hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <span class="text-xs font-bold text-emerald-900/80 uppercase tracking-wider">Total Artikel</span>
                <span class="p-2 bg-white/40 text-emerald-950 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </span>
            </div>
            <div>
                <h4 class="text-4xl font-extrabold tracking-tight text-emerald-950">{{ \App\Models\Article::count() }}</h4>
                <p class="text-xs font-semibold text-emerald-900/60 mt-1">Aktif tayang</p>
            </div>
        </div>

        <!-- Card 3: Total Teachers (Soft Pink/Rose Pastel) -->
        <div class="bg-[#fcdde0] rounded-[24px] p-6 shadow-sm flex flex-col justify-between h-40 group hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <span class="text-xs font-bold text-rose-900/80 uppercase tracking-wider">Jumlah Guru</span>
                <span class="p-2 bg-white/40 text-rose-950 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </span>
            </div>
            <div>
                <h4 class="text-4xl font-extrabold tracking-tight text-rose-950">{{ \App\Models\Teacher::count() }}</h4>
                <p class="text-xs font-semibold text-rose-900/60 mt-1">Staf akademik</p>
            </div>
        </div>

        <!-- Card 4: Majors (Lime Yellow Pastel) -->
        <div class="bg-[#eefb82] rounded-[24px] p-6 shadow-sm flex flex-col justify-between h-40 group hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <span class="text-xs font-bold text-slate-800/80 uppercase tracking-wider">Program Jurusan</span>
                <span class="p-2 bg-white/40 text-slate-900 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </span>
            </div>
            <div>
                <h4 class="text-4xl font-extrabold tracking-tight text-slate-900">{{ \App\Models\Major::count() }}</h4>
                <p class="text-xs font-semibold text-slate-700/60 mt-1">Keahlian aktif</p>
            </div>
        </div>

    </div>

    <!-- Quick Actions and Recent Activity Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left: Quick Links (Span 2) -->
        <div class="lg:col-span-2 bg-white rounded-[24px] border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
            <h3 class="text-lg font-bold text-slate-800">Akses Cepat Pengelolaan</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <a href="{{ route('admin.banners.create') }}" class="flex items-center justify-between p-5 rounded-2xl border border-slate-50 hover:bg-slate-50 transition group">
                    <div class="flex items-center space-x-4">
                        <span class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition duration-150">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </span>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Tambah Banner Baru</p>
                            <p class="text-xs text-slate-400">Unggah foto promo halaman depan</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

                <a href="{{ route('admin.articles.create') }}" class="flex items-center justify-between p-5 rounded-2xl border border-slate-50 hover:bg-slate-50 transition group">
                    <div class="flex items-center space-x-4">
                        <span class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition duration-150">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </span>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Tulis Berita Baru</p>
                            <p class="text-xs text-slate-400">Bagikan artikel/pengumuman sekolah</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

                <a href="{{ route('admin.teachers.create') }}" class="flex items-center justify-between p-5 rounded-2xl border border-slate-50 hover:bg-slate-50 transition group">
                    <div class="flex items-center space-x-4">
                        <span class="p-3 bg-rose-50 text-rose-600 rounded-xl group-hover:bg-rose-600 group-hover:text-white transition duration-150">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </span>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Tambah Guru/Staf</p>
                            <p class="text-xs text-slate-400">Perbarui profil tenaga kependidikan</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

                <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center justify-between p-5 rounded-2xl border border-slate-50 hover:bg-slate-50 transition group">
                    <div class="flex items-center space-x-4">
                        <span class="p-3 bg-amber-50 text-amber-600 rounded-xl group-hover:bg-amber-600 group-hover:text-white transition duration-150">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        </span>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Pesan Hubungi Kami</p>
                            <p class="text-xs text-slate-400">Lihat kotak masuk dari pengunjung</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>

            </div>
        </div>

        <!-- Right: Recent Messages (Span 1) -->
        <div class="bg-white rounded-[24px] border border-slate-100 p-6 md:p-8 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-6">Pesan Terbaru</h3>
                <div class="space-y-4">
                    @forelse(\App\Models\ContactMessage::latest()->take(3)->get() as $msg)
                        <div class="p-4 rounded-2xl border border-slate-50 space-y-1.5 relative">
                            @if(!$msg->is_read)
                                <span class="absolute top-4 right-4 w-2 h-2 bg-blue-600 rounded-full"></span>
                            @endif
                            <p class="text-xs font-bold text-slate-800">{{ $msg->name }}</p>
                            <p class="text-xs text-slate-400">{{ $msg->created_at->diffForHumans() }}</p>
                            <p class="text-xs text-slate-500 line-clamp-1">"{{ $msg->message }}"</p>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-400 text-xs">
                            Tidak ada pesan masuk.
                        </div>
                    @endforelse
                </div>
            </div>
            
            <a href="{{ route('admin.contact-messages.index') }}" class="block text-center mt-6 text-xs font-bold text-slate-500 hover:text-blue-600 transition">
                Lihat Semua Pesan &rarr;
            </a>
        </div>

    </div>

</div>
@endsection
