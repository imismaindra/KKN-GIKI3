@extends('layouts.app')

@section('title', 'Galeri Dokumentasi - SMA GIKI 3 Surabaya')

@section('meta')
    <meta name="description" content="Galeri dokumentasi kegiatan sekolah, momen belajar mengajar, perayaan prestasi, dan program resmi SMA GIKI 3 Surabaya." />
    <meta property="og:title" content="Galeri Dokumentasi - SMA GIKI 3 Surabaya" />
    <meta property="og:description" content="Galeri dokumentasi kegiatan sekolah, momen belajar mengajar, perayaan prestasi, dan program resmi SMA GIKI 3 Surabaya." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('galleries.index.public') }}" />
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

    .gallery-masonry {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-auto-rows: minmax(200px, auto);
        gap: 1.25rem;
    }
    .gallery-masonry .gallery-item-large {
        grid-row: span 2;
    }
    @media (max-width: 1023px) {
        .gallery-masonry {
            grid-template-columns: repeat(2, 1fr);
        }
        .gallery-masonry .gallery-item-large {
            grid-row: span 1;
        }
    }
    @media (max-width: 639px) {
        .gallery-masonry {
            grid-template-columns: 1fr;
        }
        .gallery-masonry .gallery-item-large {
            grid-row: span 1;
        }
    }

    .gallery-card {
        position: relative;
        border-radius: 1.25rem;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                    box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .gallery-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(24, 24, 27, 0.10);
    }

    .section-label {
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #F59E0B;
        display: block;
        margin-bottom: 0.75rem;
    }

    html.lenis, html.lenis body { height: auto; }
    .lenis.lenis-smooth { scroll-behavior: auto !important; }
</style>
@endsection

@section('content')
<main class="pt-28 pb-24 min-h-screen" style="background: #F9FAFB;">
    <div class="max-w-[1400px] mx-auto px-6 md:px-12">

        <!-- Page Header -->
        <div class="mb-14" style="max-width: 640px;">
            <span class="section-label">Dokumentasi</span>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-black mb-4 leading-tight" style="font-family: 'Outfit', sans-serif; color: #18181B;">
                Galeri Kegiatan Sekolah
            </h1>
            <p class="text-sm md:text-base leading-relaxed" style="color: #71717A;">
                Kumpulan momen berharga dari kegiatan belajar mengajar, perayaan prestasi siswa, dan program resmi sekolah.
            </p>
        </div>

        @if($galleries->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-[1.5rem] p-16 text-center border border-[rgba(226,232,240,0.5)] max-w-lg mx-auto">
                <span class="material-symbols-outlined text-6xl mb-4" style="color: #D4D4D8;">photo_library</span>
                <h3 class="text-xl font-bold mb-2" style="color: #18181B;">Belum Ada Dokumentasi</h3>
                <p class="text-sm mb-6 leading-relaxed" style="color: #71717A;">
                    Saat ini belum ada galeri dokumentasi yang tersedia. Silakan kembali lagi nanti.
                </p>
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-sm font-semibold transition duration-150" style="background: #18181B; color: white;">
                    <span class="material-symbols-outlined text-lg">home</span>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        @else
            <!-- Gallery Grid -->
            <div class="gallery-masonry">
                @foreach($galleries as $index => $gallery)
                    @php
                        $coverImage = $gallery->images->first()?->image_path;
                        $isLarge = $index === 0;
                    @endphp
                    @if($coverImage)
                        <div class="gallery-card group {{ $isLarge ? 'gallery-item-large' : '' }}"
                             onclick="openGalleryModal('{{ $gallery->id }}')">
                            <div class="relative w-full h-full bg-slate-100 overflow-hidden" style="min-height: {{ $isLarge ? '420px' : '280px' }};">
                                <img src="{{ Storage::url($coverImage) }}" alt="{{ $gallery->title }}"
                                     class="w-full h-full object-cover img-zoom" loading="lazy" width="{{ $isLarge ? 800 : 400 }}" height="{{ $isLarge ? 420 : 280 }}">

                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-400" style="background: linear-gradient(to top, rgba(24,24,27,0.85), rgba(24,24,27,0.3), transparent);"></div>

                                <!-- Bottom Content (reveals on hover) -->
                                <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-3 group-hover:translate-y-0 transition-transform duration-400 opacity-0 group-hover:opacity-100">
                                    <h3 class="font-bold text-lg text-white mb-1.5 line-clamp-1">{{ $gallery->title }}</h3>
                                    <p class="text-xs text-white/70 line-clamp-2 leading-relaxed mb-3">{{ $gallery->description ?? 'Dokumentasi kegiatan resmi.' }}</p>
                                    <div class="flex items-center gap-2">
                                        <span class="text-white font-bold text-xs flex items-center gap-1.5 bg-[#F59E0B] px-3 py-1.5 rounded-full">
                                            <span class="material-symbols-outlined text-sm">visibility</span>
                                            Lihat Galeri
                                        </span>
                                    </div>
                                </div>

                                <!-- Photo Count Badge -->
                                <div class="absolute top-4 right-4 bg-[#18181B]/60 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1.5 rounded-full flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-xs">photo_library</span>
                                    {{ $gallery->images->count() }} Foto
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-14 border-t border-[rgba(226,232,240,0.5)] pt-8 flex justify-center">
                {{ $galleries->links('vendor.pagination.custom') }}
            </div>
        @endif
    </div>
</main>

<!-- Gallery Modals -->
@foreach($galleries as $gallery)
    <div id="gallery-modal-{{ $gallery->id }}" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-6 bg-[#18181B]/80 backdrop-blur-md opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-[1.5rem] w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col shadow-2xl transform scale-95 transition-transform duration-300">
            <div class="px-6 py-5 border-b border-[rgba(226,232,240,0.5)] flex justify-between items-center" style="background: #F9FAFB;">
                <div>
                    <h3 class="font-bold text-xl" style="color: #18181B;">{{ $gallery->title }}</h3>
                    <p class="text-xs mt-1" style="color: #71717A;">Dokumentasi Kegiatan &bull; {{ $gallery->images->count() }} Foto</p>
                </div>
                <button onclick="closeGalleryModal('{{ $gallery->id }}')" class="w-10 h-10 rounded-full hover:bg-slate-200 flex items-center justify-center transition focus:outline-none" style="color: #18181B;">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6 md:p-8 overflow-y-auto flex-grow">
                @if($gallery->description)
                    <p class="text-sm md:text-base mb-6 leading-relaxed border-l-4 border-[#F59E0B] pl-4" style="color: #71717A;">{{ $gallery->description }}</p>
                @endif
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 md:gap-5">
                    @foreach($gallery->images as $index => $image)
                        <div class="relative aspect-square rounded-xl overflow-hidden cursor-pointer group shadow-sm hover:shadow-md transition" onclick="openLightbox('{{ $gallery->id }}', {{ $index }})">
                            <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover img-zoom" loading="lazy">
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-2xl">zoom_in</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Lightbox -->
<div id="gallery-lightbox" class="fixed inset-0 z-[110] hidden flex flex-col items-center justify-center bg-black/95 transition-opacity duration-300 opacity-0 select-none">
    <button onclick="closeLightbox()" class="absolute top-6 right-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md focus:outline-none">
        <span class="material-symbols-outlined text-2xl">close</span>
    </button>
    <button onclick="prevLightboxImage()" class="absolute left-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md focus:outline-none">
        <span class="material-symbols-outlined text-2xl">arrow_back_ios_new</span>
    </button>
    <button onclick="nextLightboxImage()" class="absolute right-6 z-[120] w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition backdrop-blur-md focus:outline-none">
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
    let activeGalleryId = null;
    let activeImages = [];
    let currentLightboxIndex = 0;

    const galleryData = {
        @foreach($galleries as $gallery)
            '{{ $gallery->id }}': {
                title: @json($gallery->title),
                images: [
                    @foreach($gallery->images as $image)
                        @json(Storage::url($image->image_path)),
                    @endforeach
                ]
            },
        @endforeach
    };

    window.openGalleryModal = function(id) {
        const modal = document.getElementById('gallery-modal-' + id);
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.offsetHeight;
        modal.classList.remove('opacity-0');
        modal.querySelector('.transform').classList.remove('scale-95');
        document.body.classList.add('overflow-hidden');
    };

    window.closeGalleryModal = function(id) {
        const modal = document.getElementById('gallery-modal-' + id);
        if (!modal) return;
        modal.classList.add('opacity-0');
        modal.querySelector('.transform').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    };

    window.openLightbox = function(galleryId, index) {
        activeGalleryId = galleryId;
        if (!galleryData[galleryId] || !galleryData[galleryId].images) return;
        activeImages = galleryData[galleryId].images;
        currentLightboxIndex = index;

        const lightbox = document.getElementById('gallery-lightbox');
        const img = document.getElementById('lightbox-img');
        const caption = document.getElementById('lightbox-caption');
        const counter = document.getElementById('lightbox-counter');

        img.src = activeImages[currentLightboxIndex];
        caption.innerText = galleryData[galleryId].title;
        counter.innerText = 'Foto ' + (currentLightboxIndex + 1) + ' dari ' + activeImages.length;

        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        lightbox.offsetHeight;
        lightbox.classList.remove('opacity-0');
        img.classList.remove('scale-95');
    };

    window.closeLightbox = function() {
        const lightbox = document.getElementById('gallery-lightbox');
        const img = document.getElementById('lightbox-img');
        lightbox.classList.add('opacity-0');
        img.classList.add('scale-95');
        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
        }, 300);
    };

    window.nextLightboxImage = function() {
        if (activeImages.length <= 1) return;
        currentLightboxIndex = (currentLightboxIndex + 1) % activeImages.length;
        const img = document.getElementById('lightbox-img');
        const counter = document.getElementById('lightbox-counter');
        img.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            img.src = activeImages[currentLightboxIndex];
            counter.innerText = 'Foto ' + (currentLightboxIndex + 1) + ' dari ' + activeImages.length;
            img.classList.remove('scale-95', 'opacity-0');
        }, 150);
    };

    window.prevLightboxImage = function() {
        if (activeImages.length <= 1) return;
        currentLightboxIndex = (currentLightboxIndex - 1 + activeImages.length) % activeImages.length;
        const img = document.getElementById('lightbox-img');
        const counter = document.getElementById('lightbox-counter');
        img.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            img.src = activeImages[currentLightboxIndex];
            counter.innerText = 'Foto ' + (currentLightboxIndex + 1) + ' dari ' + activeImages.length;
            img.classList.remove('scale-95', 'opacity-0');
        }, 150);
    };

    document.addEventListener('keydown', (e) => {
        const lightbox = document.getElementById('gallery-lightbox');
        if (lightbox && !lightbox.classList.contains('hidden')) {
            if (e.key === 'Escape') closeLightbox();
            else if (e.key === 'ArrowRight') nextLightboxImage();
            else if (e.key === 'ArrowLeft') prevLightboxImage();
        }
    });

    const lightboxEl = document.getElementById('gallery-lightbox');
    if (lightboxEl) {
        let touchStartX = 0;
        lightboxEl.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
        lightboxEl.addEventListener('touchend', (e) => {
            const dx = e.changedTouches[0].screenX - touchStartX;
            if (Math.abs(dx) > 50) {
                if (dx < 0) nextLightboxImage();
                else prevLightboxImage();
            }
        }, { passive: true });
    }
});
</script>
@endsection
