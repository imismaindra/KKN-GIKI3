@extends('layouts.admin')

@section('title', 'Edit Banner')
@section('page_title', 'Edit Banner')

@section('content')
<div class="space-y-6">
    <div class="mb-6">
        <a href="{{ route('admin.banners.index') }}" class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Form (Left Column) -->
        <div class="lg:col-span-6">
            <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-1">Judul Utama Banner</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}" required autofocus
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="subtitle" class="block text-sm font-semibold text-slate-700 mb-1">Sub-judul / Deskripsi Pendek</label>
                    <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $banner->subtitle) }}"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    @error('subtitle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="image_path" class="block text-sm font-semibold text-slate-700 mb-1">Ganti Gambar Banner (Opsional)</label>
                    <input type="file" name="image_path" id="image_path" accept="image/*"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-150 cursor-pointer">
                    <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengganti gambar. Maksimal 2MB.</p>
                    @error('image_path') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="button_text" class="block text-sm font-semibold text-slate-700 mb-1">Teks Tombol CTA (Opsional)</label>
                        <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $banner->button_text) }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                        @error('button_text') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="button_url" class="block text-sm font-semibold text-slate-700 mb-1">Tautan Tombol CTA (Opsional)</label>
                        <input type="url" name="button_url" id="button_url" value="{{ old('button_url', $banner->button_url) }}"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                        @error('button_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="order" class="block text-sm font-semibold text-slate-700 mb-1">Nomor Urutan Tampil</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $banner->order) }}" min="0" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                        <p class="text-xs text-slate-400 mt-1">Urutan tampil terkecil akan dimunculkan paling pertama.</p>
                        @error('order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col justify-center">
                        <span class="block text-sm font-semibold text-slate-700 mb-2">Status Publikasi</span>
                        <label class="relative inline-flex items-center cursor-pointer mt-1">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-slate-600">Aktifkan Banner</span>
                        </label>
                        <p class="text-xs text-slate-400 mt-1.5">Banner nonaktif tidak akan ditampilkan di slider beranda.</p>
                        @error('is_active') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Custom Styling Selectors -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6 border-t border-slate-100">
                    <div>
                        <label for="alignment" class="block text-sm font-semibold text-slate-700 mb-1">Penyelarasan Teks & Tombol</label>
                        <select name="alignment" id="alignment" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                            <option value="left" {{ old('alignment', $banner->alignment) === 'left' ? 'selected' : '' }}>Kiri (Default)</option>
                            <option value="center" {{ old('alignment', $banner->alignment) === 'center' ? 'selected' : '' }}>Tengah</option>
                            <option value="right" {{ old('alignment', $banner->alignment) === 'right' ? 'selected' : '' }}>Kanan</option>
                        </select>
                        @error('alignment') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="cta_color" class="block text-sm font-semibold text-slate-700 mb-1">Warna Tombol CTA</label>
                        <select name="cta_color" id="cta_color" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                            <option value="amber" {{ old('cta_color', $banner->cta_color) === 'amber' ? 'selected' : '' }}>Amber / Kuning</option>
                            <option value="blue" {{ old('cta_color', $banner->cta_color) === 'blue' ? 'selected' : '' }}>Biru / Blue</option>
                            <option value="emerald" {{ old('cta_color', $banner->cta_color) === 'emerald' ? 'selected' : '' }}>Hijau / Emerald</option>
                            <option value="red" {{ old('cta_color', $banner->cta_color) === 'red' ? 'selected' : '' }}>Merah / Red</option>
                            <option value="indigo" {{ old('cta_color', $banner->cta_color) === 'indigo' ? 'selected' : '' }}>Indigo</option>
                            <option value="slate" {{ old('cta_color', $banner->cta_color) === 'slate' ? 'selected' : '' }}>Slate / Abu-abu</option>
                        </select>
                        @error('cta_color') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="overlay_opacity" class="block text-sm font-semibold text-slate-700 mb-1">Kekuatan Gelap Latar Belakang</label>
                        <select name="overlay_opacity" id="overlay_opacity" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                            <option value="20" {{ old('overlay_opacity', $banner->overlay_opacity) == 20 ? 'selected' : '' }}>Sangat Terang (20%)</option>
                            <option value="40" {{ old('overlay_opacity', $banner->overlay_opacity) == 40 ? 'selected' : '' }}>Sedang (40%)</option>
                            <option value="60" {{ old('overlay_opacity', $banner->overlay_opacity) == 60 ? 'selected' : '' }}>Gelap (60% - Default)</option>
                            <option value="80" {{ old('overlay_opacity', $banner->overlay_opacity) == 80 ? 'selected' : '' }}>Sangat Gelap (80%)</option>
                        </select>
                        @error('overlay_opacity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="text_color" class="block text-sm font-semibold text-slate-700 mb-1">Tema Warna Tulisan</label>
                        <select name="text_color" id="text_color" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                            <option value="light" {{ old('text_color', $banner->text_color) === 'light' ? 'selected' : '' }}>Terang / Putih (Default)</option>
                            <option value="dark" {{ old('text_color', $banner->text_color) === 'dark' ? 'selected' : '' }}>Gelap / Hitam (Slate)</option>
                        </select>
                        @error('text_color') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-slate-50">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition duration-150 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Live Preview (Right Column) -->
        <div class="lg:col-span-6 lg:sticky lg:top-6">
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Pratinjau Instan (Real-time Preview)
                    </h3>
                    <p class="text-slate-400 text-xs mt-0.5">Tampilan banner secara langsung saat Anda mengedit formulir.</p>
                </div>
                
                <div class="relative overflow-hidden rounded-xl bg-slate-900 border border-slate-800 aspect-[16/10] flex items-center p-6 md:p-8 shadow-inner">
                    <!-- Background Image Layer -->
                    <div class="absolute inset-0 z-0">
                        <img id="live-preview-bg" src="{{ Storage::url($banner->image_path) }}" class="w-full h-full object-cover brightness-[0.55]">
                        <div id="live-preview-placeholder" class="absolute inset-0 flex flex-col items-center justify-center text-slate-500 bg-slate-950/90 border border-dashed border-slate-800 rounded-xl hidden">
                            <svg class="w-10 h-10 text-slate-700 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-xs font-semibold text-slate-600">Pilih gambar untuk melihat latar belakang</span>
                        </div>
                        <!-- Inline overlay div to dynamically adjust opacity via JS -->
                        <div id="live-preview-overlay" class="absolute inset-0 bg-[#0f172a] transition-all duration-300"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/40 via-transparent to-transparent"></div>
                    </div>
                    
                    <!-- Content -->
                    <div id="live-preview-content" class="relative z-10 w-full text-white space-y-3 flex flex-col items-start text-left">
                        <span id="live-preview-order-tag" class="inline-flex items-center gap-1.5 bg-indigo-500/10 backdrop-blur-md px-3 py-1 rounded-full border border-indigo-500/25 text-[10px] text-indigo-300 font-bold tracking-wider uppercase">
                            <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-ping"></span>
                            Urutan ke-<span id="live-preview-order">{{ $banner->order }}</span>
                        </span>
                        <h1 id="live-preview-title" class="text-xl md:text-2xl font-black tracking-tight leading-tight break-words [text-shadow:_0_2px_4px_rgba(0,0,0,0.5)]">
                            {{ $banner->title }}
                        </h1>
                        <p id="live-preview-subtitle" class="text-slate-300 text-xs md:text-sm line-clamp-3 leading-relaxed break-words [text-shadow:_0_1px_2px_rgba(0,0,0,0.4)]">
                            {{ $banner->subtitle ?? 'Deskripsi pendek atau sub-judul banner.' }}
                        </p>
                        <div id="live-preview-cta-container" class="pt-2 {{ $banner->button_text ? '' : 'hidden' }}">
                            <span id="live-preview-cta" class="inline-flex items-center space-x-1.5 bg-amber-500 text-slate-950 font-bold text-[10px] md:text-xs px-5 py-2.5 rounded-full shadow-lg transition duration-200">
                                <span id="live-preview-cta-text">{{ $banner->button_text ?? 'Tombol CTA' }}</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const subtitleInput = document.getElementById('subtitle');
    const orderInput = document.getElementById('order');
    const buttonTextInput = document.getElementById('button_text');
    const imageInput = document.getElementById('image_path');
    
    // Style settings inputs
    const alignmentInput = document.getElementById('alignment');
    const ctaColorInput = document.getElementById('cta_color');
    const overlayOpacityInput = document.getElementById('overlay_opacity');
    const textColorInput = document.getElementById('text_color');
    
    // Live preview elements
    const previewTitle = document.getElementById('live-preview-title');
    const previewSubtitle = document.getElementById('live-preview-subtitle');
    const previewOrder = document.getElementById('live-preview-order');
    const previewCtaText = document.getElementById('live-preview-cta-text');
    const previewCtaContainer = document.getElementById('live-preview-cta-container');
    const previewCta = document.getElementById('live-preview-cta');
    const previewBg = document.getElementById('live-preview-bg');
    const previewPlaceholder = document.getElementById('live-preview-placeholder');
    const previewOverlay = document.getElementById('live-preview-overlay');
    const previewContent = document.getElementById('live-preview-content');
    
    // CTA Colors Mapping
    const ctaColors = {
        amber: 'bg-amber-500 text-slate-950 hover:bg-amber-600',
        blue: 'bg-blue-600 text-white hover:bg-blue-700',
        emerald: 'bg-emerald-600 text-white hover:bg-emerald-700',
        red: 'bg-red-600 text-white hover:bg-red-700',
        indigo: 'bg-indigo-600 text-white hover:bg-indigo-700',
        slate: 'bg-slate-700 text-white hover:bg-slate-800'
    };

    // Update Functions
    function updateTexts() {
        previewTitle.textContent = titleInput.value || 'Judul Utama Banner';
        previewSubtitle.textContent = subtitleInput.value || '';
        previewOrder.textContent = orderInput.value || '0';
        
        if (buttonTextInput.value.trim() !== '') {
            previewCtaText.textContent = buttonTextInput.value;
            previewCtaContainer.classList.remove('hidden');
        } else {
            previewCtaContainer.classList.add('hidden');
        }
    }
    
    function updateStyles() {
        // 1. Text alignment
        const alignment = alignmentInput.value;
        previewContent.classList.remove('items-start', 'text-left', 'items-center', 'text-center', 'items-end', 'text-right');
        
        if (alignment === 'left') {
            previewContent.classList.add('items-start', 'text-left');
        } else if (alignment === 'center') {
            previewContent.classList.add('items-center', 'text-center');
        } else if (alignment === 'right') {
            previewContent.classList.add('items-end', 'text-right');
        }
        
        // 2. CTA Color
        const ctaColor = ctaColorInput.value;
        previewCta.className = 'inline-flex items-center space-x-1.5 font-bold text-[10px] md:text-xs px-5 py-2.5 rounded-full shadow-lg transition duration-200';
        const colorClasses = ctaColors[ctaColor] || ctaColors.amber;
        colorClasses.split(' ').forEach(cls => previewCta.classList.add(cls));
        
        // 3. Overlay Darkness
        const opacity = parseInt(overlayOpacityInput.value);
        previewOverlay.style.backgroundColor = `rgba(15, 23, 42, ${opacity / 100})`;
        
        // 4. Text Color Theme
        const textColor = textColorInput.value;
        previewTitle.classList.remove('text-white', 'text-slate-900');
        previewSubtitle.classList.remove('text-slate-300', 'text-slate-600');
        
        if (textColor === 'light') {
            previewTitle.classList.add('text-white');
            previewSubtitle.classList.add('text-slate-300');
        } else {
            previewTitle.classList.add('text-slate-900');
            previewSubtitle.classList.add('text-slate-600');
        }
    }

    // Add event listeners for text inputs
    [titleInput, subtitleInput, orderInput, buttonTextInput].forEach(input => {
        input.addEventListener('input', updateTexts);
    });
    
    // Add event listeners for style selects
    [alignmentInput, ctaColorInput, overlayOpacityInput, textColorInput].forEach(select => {
        select.addEventListener('change', updateStyles);
    });

    // Image reader for background
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewBg.src = e.target.result;
                previewBg.classList.remove('hidden');
                if (previewPlaceholder) {
                    previewPlaceholder.classList.add('hidden');
                }
            }
            reader.readAsDataURL(file);
        }
    });

    // Run initial rendering
    updateTexts();
    updateStyles();
});
</script>
@endpush
