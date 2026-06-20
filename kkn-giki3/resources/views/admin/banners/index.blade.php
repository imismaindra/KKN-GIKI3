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
                                <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover brightness-[0.55] transition-transform duration-[4000ms] ease-out scale-100">
                                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-slate-950/30 to-transparent"></div>
                            </div>
                            
                            <!-- Content -->
                            <div class="relative z-10 w-full max-w-xl pl-8 md:pl-16 pr-8 text-white space-y-3.5 transform translate-y-4 transition-all duration-700 delay-100">
                                <span class="inline-flex items-center gap-1.5 bg-indigo-500/10 backdrop-blur-md px-3 py-1 rounded-full border border-indigo-500/25 text-[10px] text-indigo-300 font-bold tracking-wider uppercase">
                                    <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-pulse"></span>
                                    Urutan ke-{{ $banner->order }}
                                </span>
                                <h1 class="text-xl md:text-3xl lg:text-4xl font-black tracking-tight leading-tight [text-shadow:_0_2px_4px_rgba(0,0,0,0.4)]">
                                    {{ $banner->title }}
                                </h1>
                                <p class="text-slate-300 text-xs md:text-sm max-w-md line-clamp-2 leading-relaxed [text-shadow:_0_1px_2px_rgba(0,0,0,0.3)]">
                                    {{ $banner->subtitle ?? '' }}
                                </p>
                                @if($banner->button_text)
                                    <div class="pt-1.5">
                                        <a href="{{ $banner->button_url ?? '#' }}" target="_blank" class="inline-flex items-center space-x-2 bg-amber-500 hover:bg-amber-600 active:scale-95 text-slate-950 font-bold text-xs px-5 py-2.5 rounded-full shadow-lg transition duration-200">
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
                <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition duration-200 flex flex-col justify-between">
                    <div class="relative aspect-video bg-slate-100">
                        <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-slate-900/80 text-white text-xs px-2.5 py-1 rounded-full font-semibold">
                            Urutan: {{ $banner->order }}
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div class="space-y-2 mb-6">
                            <h4 class="text-lg font-bold text-slate-800 line-clamp-1">{{ $banner->title }}</h4>
                            <p class="text-slate-500 text-sm line-clamp-2">{{ $banner->subtitle ?? 'Tidak ada sub-judul' }}</p>
                            @if($banner->button_text)
                                <div class="inline-flex items-center text-xs bg-slate-100 text-slate-600 px-2.5 py-1 rounded-lg font-medium">
                                    CTA: {{ $banner->button_text }}
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center space-x-2 pt-4 border-t border-slate-50">
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="flex-1 text-center py-2 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 font-semibold rounded-xl text-xs transition duration-150">
                                Edit
                            </a>
                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center py-2 bg-slate-50 hover:bg-red-50 text-slate-600 hover:text-red-600 font-semibold rounded-xl text-xs transition duration-150">
                                    Hapus
                                </button>
                            </form>
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
