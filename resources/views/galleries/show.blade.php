@extends('layouts.app')

@section('title', $gallery->title . ' - Galeri SMA GIKI 3 Surabaya')

@section('meta')
    <meta name="description" content="{{ $gallery->description ?? 'Dokumentasi kegiatan ' . $gallery->title . ' - SMA GIKI 3 Surabaya' }}" />
    <meta property="og:title" content="{{ $gallery->title }} - Galeri SMA GIKI 3 Surabaya" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('galleries.show.public', $gallery->id) }}" />
@endsection

@section('styles')
<style>
    .img-zoom {
        transition: transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .group:hover .img-zoom {
        transform: scale(1.05);
    }
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    .section-label {
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #F59E0B;
        display: block;
        margin-bottom: 0.75rem;
    }
</style>
@endsection

@section('content')
<main class="pt-28 pb-24 min-h-screen" style="background: #F9FAFB;">
    <div class="max-w-[1400px] mx-auto px-6 md:px-12">

        <!-- Breadcrumb -->
        <nav class="mb-8 flex items-center gap-2 text-xs font-semibold" style="color: #71717A;">
            <a href="{{ url('/') }}" class="hover:text-[#F59E0B] transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <a href="{{ route('galleries.index.public') }}" class="hover:text-[#F59E0B] transition-colors">Galeri</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span style="color: #18181B;">{{ $gallery->title }}</span>
        </nav>

        <!-- Gallery Header -->
        <div class="mb-10">
            <span class="section-label">Dokumentasi</span>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-black mb-4 leading-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                {{ $gallery->title }}
            </h1>
            <div class="flex items-center gap-4 text-sm" style="color: #71717A;">
                <span class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base">photo_library</span>
                    {{ $gallery->images->count() }} Foto
                </span>
                <span class="w-1 h-1 rounded-full" style="background: #D4D4D8;"></span>
                <span>{{ $gallery->created_at->format('d M Y') }}</span>
            </div>
        </div>

        @if($gallery->description)
            <div class="mb-10 max-w-3xl">
                <p class="text-sm md:text-base leading-relaxed" style="color: #52525B; border-left: 3px solid #F59E0B; padding-left: 1rem;">
                    {{ $gallery->description }}
                </p>
            </div>
        @endif

        <!-- Photo Grid -->
        @if($gallery->images->isEmpty())
            <div class="bg-white rounded-[1.5rem] p-16 text-center border border-[rgba(226,232,240,0.5)] max-w-lg mx-auto">
                <span class="material-symbols-outlined text-6xl mb-4" style="color: #D4D4D8;">photo_library</span>
                <h3 class="text-xl font-bold mb-2" style="color: #18181B;">Belum Ada Foto</h3>
                <p class="text-sm" style="color: #71717A;">Galeri ini belum memiliki foto.</p>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 md:gap-5">
                @foreach($gallery->images as $index => $image)
                    <div class="relative aspect-square rounded-xl overflow-hidden cursor-pointer group shadow-sm hover:shadow-lg transition-all duration-300"
                         onclick="openLightbox({{ $index }})">
                        <img src="{{ Storage::url($image->image_path) }}"
                             class="w-full h-full object-cover img-zoom"
                             loading="lazy"
                             alt="{{ $gallery->title }} - Foto {{ $index + 1 }}">
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: rgba(24,24,27,0.2);"></div>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="material-symbols-outlined text-white text-3xl drop-shadow-lg">zoom_in</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Related Galleries -->
        @if($relatedGalleries->isNotEmpty())
            <div class="mt-20">
                <div class="mb-8 flex items-end justify-between gap-5">
                    <div style="max-width: 560px;">
                        <span class="section-label">Lainnya</span>
                        <h2 class="text-2xl md:text-3xl font-black leading-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                            Galeri Terkait
                        </h2>
                    </div>
                    <a href="{{ route('galleries.index.public') }}" class="inline-flex items-center gap-2 text-sm font-bold transition-colors group" style="color: #18181B;">
                        Semua Galeri
                        <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach($relatedGalleries as $related)
                        @php $coverImage = $related->images->first()?->image_path; @endphp
                        @if($coverImage)
                            <a href="{{ route('galleries.show.public', $related->id) }}"
                               class="group rounded-[1.25rem] overflow-hidden relative block min-h-[220px] shadow-sm hover:shadow-lg transition-all duration-300">
                                <img src="{{ Storage::url($coverImage) }}" alt="{{ $related->title }}"
                                     class="absolute inset-0 w-full h-full object-cover img-zoom" loading="lazy">
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: linear-gradient(to top, rgba(24,24,27,0.8), transparent);"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300 opacity-0 group-hover:opacity-100">
                                    <h3 class="font-bold text-sm text-white line-clamp-1">{{ $related->title }}</h3>
                                    <p class="text-[10px] text-white/70 mt-0.5">{{ $related->images->count() }} Foto</p>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</main>

<!-- Lightbox -->
<div id="gallery-lightbox" class="fixed inset-0 z-[110] hidden flex flex-col items-center justify-center bg-black/95 transition-opacity duration-300 opacity-0 select-none">
    <button onclick="closeLightbox()" class="absolute top-6 right-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md focus:outline-none">
        <span class="material-symbols-outlined text-2xl">close</span>
    </button>
    <button onclick="prevImage()" class="absolute left-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md focus:outline-none">
        <span class="material-symbols-outlined text-2xl">arrow_back_ios_new</span>
    </button>
    <button onclick="nextImage()" class="absolute right-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md focus:outline-none">
        <span class="material-symbols-outlined text-2xl">arrow_forward_ios</span>
    </button>
    <div class="w-full max-w-4xl max-h-[80vh] px-4 flex items-center justify-center">
        <img id="lightbox-img" src="" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl transition-transform duration-300 transform scale-95">
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-center text-white px-6 py-3 bg-white/5 border border-white/10 rounded-full backdrop-blur-md max-w-md w-[90%]">
        <p id="lightbox-caption" class="text-sm font-semibold truncate"></p>
        <p id="lightbox-counter" class="text-[10px] text-white/60 mt-0.5 font-bold uppercase tracking-wider"></p>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const images = [
        @foreach($gallery->images as $image)
            @json(Storage::url($image->image_path)),
        @endforeach
    ];
    let currentIndex = 0;

    window.openLightbox = function(index) {
        currentIndex = index;
        updateLightbox();
        const lightbox = document.getElementById('gallery-lightbox');
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        lightbox.offsetHeight;
        lightbox.classList.remove('opacity-0');
        document.getElementById('lightbox-img').classList.remove('scale-95');
        document.body.classList.add('overflow-hidden');
    };

    window.closeLightbox = function() {
        const lightbox = document.getElementById('gallery-lightbox');
        const img = document.getElementById('lightbox-img');
        lightbox.classList.add('opacity-0');
        img.classList.add('scale-95');
        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    };

    window.nextImage = function() {
        currentIndex = (currentIndex + 1) % images.length;
        animateLightbox();
    };

    window.prevImage = function() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        animateLightbox();
    };

    function updateLightbox() {
        const img = document.getElementById('lightbox-img');
        const caption = document.getElementById('lightbox-caption');
        const counter = document.getElementById('lightbox-counter');
        img.src = images[currentIndex];
        caption.innerText = @json($gallery->title);
        counter.innerText = 'Foto ' + (currentIndex + 1) + ' dari ' + images.length;
    }

    function animateLightbox() {
        const img = document.getElementById('lightbox-img');
        img.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            updateLightbox();
            img.classList.remove('scale-95', 'opacity-0');
        }, 150);
    }

    document.addEventListener('keydown', (e) => {
        const lightbox = document.getElementById('gallery-lightbox');
        if (lightbox && !lightbox.classList.contains('hidden')) {
            if (e.key === 'Escape') closeLightbox();
            else if (e.key === 'ArrowRight') nextImage();
            else if (e.key === 'ArrowLeft') prevImage();
        }
    });

    const lightboxEl = document.getElementById('gallery-lightbox');
    if (lightboxEl) {
        let touchStartX = 0;
        lightboxEl.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
        lightboxEl.addEventListener('touchend', (e) => {
            const dx = e.changedTouches[0].screenX - touchStartX;
            if (Math.abs(dx) > 50) {
                if (dx < 0) nextImage();
                else prevImage();
            }
        }, { passive: true });
    }
});
</script>
@endsection
