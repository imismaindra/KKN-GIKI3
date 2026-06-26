@extends('layouts.admin')

@section('title', 'Kelola Banner')
@section('page_title', 'Kelola Banner / Slider')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <p class="text-slate-500 text-sm">Kelola banner promosi yang akan ditampilkan di slider utama landing page.</p>
        <a href="{{ route('admin.banners.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm transition duration-150 shadow-lg shadow-blue-500/10 flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Tambah Banner</span>
        </a>
    </div>
 
    <!-- Interactive Hero Slider Preview -->
    @if(!$banners->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Pratinjau Slider Hero (Live Preview)
                </h3>
                <p class="text-slate-400 text-xs mt-0.5">Tampilan interaktif slider utama di halaman depan website Anda.</p>
            </div>
            
            <div class="relative overflow-hidden rounded-2xl bg-slate-900 border border-slate-800 aspect-[21/9] min-h-[280px] flex items-center shadow-inner">
                <!-- Slider Wrapper -->
                <div id="hero-preview-slider" class="absolute inset-0 w-full h-full">
                    @foreach($banners as $index => $banner)
                        <div class="hero-preview-slide absolute inset-0 w-full h-full opacity-0 transition-all duration-700 ease-in-out flex items-center" data-index="{{ $index }}">
                            <!-- Background Image Layer -->
                            <div class="absolute inset-0 z-0">
                                <img src="{{ Storage::url($banner->image_path) }}" 
                                     onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');"
                                     alt="{{ $banner->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-[4000ms] ease-out scale-100">
                                <div class="hidden absolute inset-0 bg-slate-800 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-slate-600/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="absolute inset-0 bg-[#0f172a]" style="opacity: {{ ($banner->overlay_opacity ?? 60) / 100 }}"></div>
                                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/40 via-transparent to-transparent"></div>
                            </div>
                            
                            <!-- Content -->
                            @php
                                $ctaColorClasses = [
                                    'amber' => 'bg-amber-500 hover:bg-amber-600 text-slate-950',
                                    'blue' => 'bg-blue-600 hover:bg-blue-700 text-white',
                                    'emerald' => 'bg-emerald-600 hover:bg-emerald-700 text-white',
                                    'red' => 'bg-red-600 hover:bg-red-700 text-white',
                                    'indigo' => 'bg-indigo-600 hover:bg-indigo-700 text-white',
                                    'slate' => 'bg-slate-700 hover:bg-slate-800 text-white',
                                ][$banner->cta_color ?? 'amber'] ?? 'bg-amber-500 hover:bg-amber-600 text-slate-950';

                                $alignmentClasses = [
                                    'left' => 'items-start text-left pl-8 md:pl-16 pr-8 mr-auto',
                                    'center' => 'items-center text-center px-8 mx-auto',
                                    'right' => 'items-end text-right pl-8 pr-8 md:pr-16 ml-auto',
                                ][$banner->alignment ?? 'left'] ?? 'items-start text-left pl-8 md:pl-16 pr-8 mr-auto';
                            @endphp
                            <div class="relative z-10 w-full max-w-xl text-white space-y-3.5 transform translate-y-4 transition-all duration-700 delay-100 flex flex-col {{ $alignmentClasses }}">
                                <span class="inline-flex items-center gap-1.5 bg-indigo-500/10 backdrop-blur-md px-3 py-1 rounded-full border border-indigo-500/25 text-[10px] text-indigo-300 font-bold tracking-wider uppercase">
                                    <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-pulse"></span>
                                    Urutan ke-{{ $banner->order }}
                                </span>
                                <h1 class="text-xl md:text-3xl lg:text-4xl font-black tracking-tight leading-tight [text-shadow:_0_2px_4px_rgba(0,0,0,0.3)]
                                    {{ ($banner->text_color ?? 'light') === 'dark' ? 'text-slate-900' : 'text-white' }}">
                                    {{ $banner->title }}
                                </h1>
                                <p class="text-xs md:text-sm max-w-md line-clamp-2 leading-relaxed [text-shadow:_0_1px_2px_rgba(0,0,0,0.2)]
                                    {{ ($banner->text_color ?? 'light') === 'dark' ? 'text-slate-600' : 'text-slate-300' }}">
                                    {{ $banner->subtitle ?? '' }}
                                </p>
                                @if($banner->button_text)
                                    <div class="pt-1.5">
                                        <a href="{{ $banner->button_url ?? '#' }}" target="_blank" class="inline-flex items-center space-x-2 active:scale-95 font-bold text-xs px-5 py-2.5 rounded-full shadow-lg transition duration-200 {{ $ctaColorClasses }}">
                                            <span>{{ $banner->button_text }}</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Controls (Only show if multiple slides) -->
                @if($banners->count() > 1)
                    <!-- Navigation Arrows -->
                    <button id="prev-slide-btn" class="absolute left-4 z-20 w-9 h-9 rounded-full bg-slate-950/40 hover:bg-slate-950/70 text-white flex items-center justify-center transition border border-white/10 focus:outline-none backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button id="next-slide-btn" class="absolute right-4 z-20 w-9 h-9 rounded-full bg-slate-950/40 hover:bg-slate-950/70 text-white flex items-center justify-center transition border border-white/10 focus:outline-none backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                    
                    <!-- Navigation Dots -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex space-x-2 bg-slate-950/40 px-3.5 py-1.5 rounded-full border border-white/5 backdrop-blur-sm">
                        @foreach($banners as $index => $banner)
                            <button class="hero-preview-dot w-2 h-2 rounded-full bg-white/40 hover:bg-white/70 transition-all focus:outline-none" data-slide-index="{{ $index }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Banner Grid -->
    @if($banners->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <h4 class="text-lg font-bold text-slate-700">Belum ada banner</h4>
            <p class="text-slate-400 text-sm mt-1">Tambahkan banner baru untuk memulai menampilkan slider di landing page.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($banners as $banner)
                @php
                    $ctaPreviewClasses = [
                        'amber' => 'bg-amber-500/10 text-amber-700 border-amber-500/20',
                        'blue' => 'bg-blue-500/10 text-blue-700 border-blue-500/20',
                        'emerald' => 'bg-emerald-500/10 text-emerald-700 border-emerald-500/20',
                        'red' => 'bg-red-500/10 text-red-700 border-red-500/20',
                        'indigo' => 'bg-indigo-500/10 text-indigo-700 border-indigo-500/20',
                        'slate' => 'bg-slate-500/10 text-slate-700 border-slate-500/20',
                    ][$banner->cta_color ?? 'amber'] ?? 'bg-amber-500/10 text-amber-700 border-amber-500/20';
                @endphp
                <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition duration-200 flex flex-col justify-between group">
                    <!-- Image container with hover zoom -->
                    <div class="relative aspect-video bg-slate-100 overflow-hidden">
                        <img src="{{ Storage::url($banner->image_path) }}" 
                             onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');"
                             alt="{{ $banner->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        <!-- Beautiful fallback image -->
                        <div class="hidden absolute inset-0 bg-gradient-to-br from-slate-50 to-slate-100 flex flex-col items-center justify-center p-4">
                            <svg class="w-10 h-10 text-slate-300 mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-xs font-medium text-slate-400">Gambar tidak ditemukan</span>
                        </div>

                        <!-- Urutan Badge overlay -->
                        <span class="absolute top-3 left-3 bg-slate-950/60 backdrop-blur-md text-white text-[11px] px-2.5 py-1 rounded-full font-bold border border-white/10 z-10">
                            Urutan: {{ $banner->order }}
                        </span>

                        <!-- Status Badge overlay -->
                        <span class="absolute top-3 right-3 backdrop-blur-md text-white text-[11px] px-2.5 py-1 rounded-full font-bold border border-white/10 z-10 {{ $banner->is_active ? 'bg-emerald-600/85' : 'bg-red-600/85' }}">
                            {{ $banner->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>

                        <!-- Default Banner Badge -->
                        @if($banner->is_default)
                            <span class="absolute bottom-3 left-3 bg-amber-500/90 backdrop-blur-md text-slate-950 text-[10px] px-2.5 py-1 rounded-full font-black border border-amber-300/30 z-10 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                Banner Utama
                            </span>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div class="space-y-4 mb-5">
                            <div>
                                <h4 class="text-base font-bold text-slate-800 line-clamp-1 leading-snug group-hover:text-blue-600 transition-colors" title="{{ $banner->title }}">
                                    {{ $banner->title }}
                                </h4>
                                <p class="text-slate-500 text-xs line-clamp-2 mt-1 leading-relaxed min-h-[2rem]">
                                    {{ $banner->subtitle ?? 'Tidak ada sub-judul' }}
                                </p>
                            </div>

                            <!-- Styled Action Button CTA preview -->
                            @if($banner->button_text)
                                <div class="pt-1">
                                    <span class="text-[10px] font-bold text-slate-400 tracking-wider uppercase block mb-1">Aksi Tombol (CTA)</span>
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold border {{ $ctaPreviewClasses }}">
                                        <span>{{ $banner->button_text }}</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            @endif

                            <!-- Visual Settings Badges -->
                            <div class="flex flex-wrap gap-1.5 pt-3 border-t border-slate-100">
                                <span class="inline-flex items-center gap-1 text-[10px] bg-slate-50 text-slate-600 px-2 py-0.5 rounded-md font-medium border border-slate-100">
                                    @if(($banner->alignment ?? 'left') === 'left')
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h16"></path></svg>
                                        Kiri
                                    @elseif(($banner->alignment ?? 'left') === 'center')
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M7 12h10M4 18h16"></path></svg>
                                        Tengah
                                    @else
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M10 12h10M4 18h16"></path></svg>
                                        Kanan
                                    @endif
                                </span>
                                <span class="inline-flex items-center gap-1 text-[10px] bg-slate-50 text-slate-600 px-2 py-0.5 rounded-md font-medium border border-slate-100">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                                    Teks: {{ ($banner->text_color ?? 'light') === 'dark' ? 'Gelap' : 'Terang' }}
                                </span>
                                <span class="inline-flex items-center gap-1 text-[10px] bg-slate-50 text-slate-600 px-2 py-0.5 rounded-md font-medium border border-slate-100">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    Overlay: {{ $banner->overlay_opacity ?? 60 }}%
                                </span>
                            </div>
                        </div>

                        <!-- Card Actions -->
                        <div class="flex items-center space-x-2 pt-4 border-t border-slate-100">
                            @if($banner->is_default)
                                <!-- Banner default: nonaktifkan & hapus dilarang -->
                                <span class="flex-1 inline-flex items-center justify-center gap-1.5 py-2.5 bg-slate-50 border border-slate-200/60 text-slate-300 font-bold rounded-xl text-xs cursor-not-allowed" title="Banner utama tidak dapat dinonaktifkan">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268-2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                    <span>Nonaktifkan</span>
                                </span>
                            @else
                                <form action="{{ route('admin.banners.toggle-active', $banner->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 bg-slate-50 border border-slate-200/60 font-bold rounded-xl text-xs transition duration-150 active:scale-98 {{ $banner->is_active ? 'hover:bg-amber-50 hover:border-amber-200 text-slate-600 hover:text-amber-600' : 'hover:bg-emerald-50 hover:border-emerald-200 text-slate-600 hover:text-emerald-600' }}">
                                        @if($banner->is_active)
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268-2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                            </svg>
                                            <span>Nonaktifkan</span>
                                        @else
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <span>Aktifkan</span>
                                        @endif
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" 
                               class="flex-1 inline-flex items-center justify-center gap-1.5 py-2.5 bg-slate-50 hover:bg-blue-50 border border-slate-200/60 hover:border-blue-200 text-slate-600 hover:text-blue-600 font-bold rounded-xl text-xs transition duration-150 active:scale-98">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            @if(!$banner->is_default)
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 bg-slate-50 hover:bg-red-50 border border-slate-200/60 hover:border-red-200 text-slate-600 hover:text-red-600 font-bold rounded-xl text-xs transition duration-150 active:scale-98">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            @else
                                <span class="flex-1 inline-flex items-center justify-center gap-1.5 py-2.5 bg-slate-50 border border-slate-200/60 text-slate-300 font-bold rounded-xl text-xs cursor-not-allowed" title="Banner utama tidak dapat dihapus">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    Hapus
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero-preview-slide');
    const dots = document.querySelectorAll('.hero-preview-dot');
    const prevBtn = document.getElementById('prev-slide-btn');
    const nextBtn = document.getElementById('next-slide-btn');
    
    if (slides.length === 0) return;
    
    let currentSlide = 0;
    let slideInterval;
    
    function showSlide(index) {
        if (index >= slides.length) currentSlide = 0;
        else if (index < 0) currentSlide = slides.length - 1;
        else currentSlide = index;
        
        slides.forEach(slide => {
            const img = slide.querySelector('img');
            const text = slide.querySelector('.relative.z-10');
            
            slide.classList.remove('opacity-100', 'z-10');
            slide.classList.add('opacity-0', 'z-0');
            
            if (img) {
                img.classList.remove('scale-105');
                img.classList.add('scale-100');
            }
            if (text) {
                text.classList.remove('translate-y-0');
                text.classList.add('translate-y-4');
            }
        });
        
        if (dots.length > 0) {
            dots.forEach(dot => {
                dot.classList.remove('bg-white', 'w-4');
                dot.classList.add('bg-white/40');
            });
            dots[currentSlide].classList.remove('bg-white/40');
            dots[currentSlide].classList.add('bg-white', 'w-4');
        }
        
        const activeSlide = slides[currentSlide];
        activeSlide.classList.remove('opacity-0', 'z-0');
        activeSlide.classList.add('opacity-100', 'z-10');
        
        const activeImg = activeSlide.querySelector('img');
        const activeText = activeSlide.querySelector('.relative.z-10');
        
        setTimeout(() => {
            if (activeImg) {
                activeImg.classList.remove('scale-100');
                activeImg.classList.add('scale-105');
            }
            if (activeText) {
                activeText.classList.remove('translate-y-4');
                activeText.classList.add('translate-y-0');
            }
        }, 50);
    }
    
    function nextSlide() {
        showSlide(currentSlide + 1);
    }
    
    function prevSlide() {
        showSlide(currentSlide - 1);
    }
    
    function startAutoSlide() {
        if (slides.length <= 1) return;
        stopAutoSlide();
        slideInterval = setInterval(nextSlide, 4500);
    }
    
    function stopAutoSlide() {
        clearInterval(slideInterval);
    }
    
    // Initial display
    showSlide(0);
    startAutoSlide();
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            startAutoSlide();
        });
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            startAutoSlide();
        });
    }
    
    if (dots.length > 0) {
        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const idx = parseInt(dot.getAttribute('data-slide-index'));
                showSlide(idx);
                startAutoSlide();
            });
        });
    }
});
</script>
@endpush
