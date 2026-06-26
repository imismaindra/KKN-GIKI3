@extends('layouts.admin')

@section('title', 'Pengaturan Sekolah')
@section('page_title', 'Pengaturan Profil Sekolah')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    
    <!-- Top Dashboard Header Panel -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 p-6 md:p-8 rounded-3xl text-white shadow-xl relative overflow-hidden">
        <!-- Ambient Glow Backdrops -->
        <div class="absolute -right-12 -top-12 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -left-12 -bottom-12 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl"></div>
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
            <div class="flex items-center gap-4.5">
                <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md border border-white/10 flex items-center justify-center p-2.5 shadow-inner">
                    <img src="{{ ($setting && $setting->logo) ? Storage::url($setting->logo) : asset('smagiki3.webp') }}" alt="Logo" class="max-w-full max-h-full object-contain">
                </div>
                <div>
                    <span class="text-[9px] font-extrabold uppercase tracking-widest text-blue-400">Panel Konfigurasi</span>
                    <h1 class="text-xl md:text-2xl font-black tracking-tight text-white mt-0.5">Pengaturan Profil Sekolah</h1>
                    <p class="text-xs text-slate-300 mt-1 max-w-xl">Ubah konten landing page secara dinamis seperti Visi, Misi, Informasi Kontak, Google Maps, tentang sekolah, dan sambutan Kepala Sekolah.</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ url('/') }}" target="_blank" class="px-4.5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-bold text-xs rounded-xl transition flex items-center gap-2 border border-white/10 backdrop-blur-sm">
                    <span class="material-symbols-outlined text-sm">open_in_new</span>
                    <span>Lihat Landing Page</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Tab Container and Form Layout -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start pb-20">
        @csrf
        @method('PUT')

        <!-- Hidden input for mission builder serialization -->
        <textarea name="mission" id="mission" class="hidden">{{ old('mission', $setting->mission ?? '') }}</textarea>

        <!-- Left Sidebar Navigation -->
        <div class="lg:col-span-3 space-y-4 lg:sticky lg:top-6">
            <div class="bg-white p-2.5 rounded-2xl border border-slate-100/80 shadow-[0_4px_20px_rgba(0,0,0,0.015)] flex flex-row lg:flex-col gap-1 overflow-x-auto lg:overflow-x-visible no-scrollbar">
                
                <button type="button" onclick="switchTab('umum')" id="tab-btn-umum" 
                    class="flex-1 lg:flex-none text-left py-3.5 px-4 font-bold text-xs rounded-xl transition flex items-center gap-3 w-full group whitespace-nowrap">
                    <span class="material-symbols-outlined text-lg flex-shrink-0 group-hover:scale-110 transition duration-150">settings</span>
                    <div class="hidden lg:block">
                        <div class="font-bold text-xs">Umum &amp; Kontak</div>
                        <div class="text-[10px] font-normal text-slate-400 group-hover:text-slate-500 mt-0.5">Identitas, sosmed, &amp; peta</div>
                    </div>
                    <span class="lg:hidden">Umum</span>
                </button>

                <button type="button" onclick="switchTab('visi-misi')" id="tab-btn-visi-misi" 
                    class="flex-1 lg:flex-none text-left py-3.5 px-4 font-bold text-xs rounded-xl transition flex items-center gap-3 w-full group whitespace-nowrap">
                    <span class="material-symbols-outlined text-lg flex-shrink-0 group-hover:scale-110 transition duration-150">assignment</span>
                    <div class="hidden lg:block">
                        <div class="font-bold text-xs">Visi &amp; Misi</div>
                        <div class="text-[10px] font-normal text-slate-400 group-hover:text-slate-500 mt-0.5">Visi dan poin misi</div>
                    </div>
                    <span class="lg:hidden">Visi &amp; Misi</span>
                </button>

                <button type="button" onclick="switchTab('tentang')" id="tab-btn-tentang" 
                    class="flex-1 lg:flex-none text-left py-3.5 px-4 font-bold text-xs rounded-xl transition flex items-center gap-3 w-full group whitespace-nowrap">
                    <span class="material-symbols-outlined text-lg flex-shrink-0 group-hover:scale-110 transition duration-150">info</span>
                    <div class="hidden lg:block">
                        <div class="font-bold text-xs">Tentang Kami</div>
                        <div class="text-[10px] font-normal text-slate-400 group-hover:text-slate-500 mt-0.5">Sejarah &amp; akreditasi</div>
                    </div>
                    <span class="lg:hidden">Tentang Kami</span>
                </button>

                <button type="button" onclick="switchTab('sambutan')" id="tab-btn-sambutan" 
                    class="flex-1 lg:flex-none text-left py-3.5 px-4 font-bold text-xs rounded-xl transition flex items-center gap-3 w-full group whitespace-nowrap">
                    <span class="material-symbols-outlined text-lg flex-shrink-0 group-hover:scale-110 transition duration-150">record_voice_over</span>
                    <div class="hidden lg:block">
                        <div class="font-bold text-xs">Sambutan Kepala</div>
                        <div class="text-[10px] font-normal text-slate-400 group-hover:text-slate-500 mt-0.5">Kepala sekolah &amp; teks</div>
                    </div>
                    <span class="lg:hidden">Sambutan</span>
                </button>
            </div>

            <!-- Sync Status Dashboard (Desktop Only) -->
            <div class="hidden lg:block bg-gradient-to-br from-blue-50/50 to-indigo-50/50 border border-blue-100/50 p-5 rounded-2xl shadow-sm">
                <div class="flex items-center gap-2 text-blue-700 font-bold text-xs">
                    <span class="material-symbols-outlined text-sm font-bold">bolt</span>
                    <span>Status Integrasi</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-2.5 leading-relaxed">
                    Perubahan data yang berhasil disimpan akan langsung menggantikan tulisan hardcode pada halaman web pengunjung utama SMA GIKI 3 Surabaya secara instan.
                </p>
                <div class="mt-4 pt-4 border-t border-blue-100/50 flex items-center justify-between text-[10px] text-slate-400">
                    <span>Terakhir Diubah</span>
                    <span class="font-mono bg-blue-100/50 px-2 py-0.5 rounded text-blue-700 font-semibold">{{ $setting && $setting->updated_at ? $setting->updated_at->diffForHumans() : 'Belum pernah' }}</span>
                </div>
            </div>
        </div>

        <!-- Right Content Panels Area -->
        <div class="lg:col-span-9 space-y-6">

            <!-- TAB PANEL 1: UMUM & KONTAK -->
            <div id="tab-panel-umum" class="tab-panel space-y-6 transition-all duration-300">
                
                <!-- Card 1.1: Informasi Utama -->
                <div class="bg-white rounded-3xl border border-slate-100/80 p-6 md:p-8 shadow-[0_8px_30px_rgba(0,0,0,0.015)] space-y-6">
                    <div class="flex items-center gap-4.5 border-b border-slate-50 pb-5">
                        <div class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-xl font-bold">school</span>
                        </div>
                        <div>
                            <h3 class="text-base font-black text-slate-800 tracking-tight">Informasi Utama Sekolah</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Identitas inti, alamat fisik, dan nomor kontak utama operasional sekolah.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5.5">
                        <div class="md:col-span-2">
                            <label for="school_name" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Nama Sekolah</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">apartment</span>
                                <input type="text" name="school_name" id="school_name" value="{{ old('school_name', $setting->school_name ?? '') }}" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50/90 focus:bg-white border border-slate-200/80 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 transition duration-150 text-sm">
                            </div>
                            @error('school_name')
                                <span class="flex items-center gap-1 text-rose-600 text-[11px] mt-1.5 ml-1 font-semibold animate-fade-in">
                                    <span class="material-symbols-outlined text-xs">error</span>
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Email Resmi</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">mail</span>
                                <input type="email" name="email" id="email" value="{{ old('email', $setting->email ?? '') }}" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50/90 focus:bg-white border border-slate-200/80 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 transition duration-150 text-sm">
                            </div>
                            @error('email')
                                <span class="flex items-center gap-1 text-rose-600 text-[11px] mt-1.5 ml-1 font-semibold animate-fade-in">
                                    <span class="material-symbols-outlined text-xs">error</span>
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Nomor Telepon</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">call</span>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone ?? '') }}" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50/90 focus:bg-white border border-slate-200/80 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 transition duration-150 text-sm">
                            </div>
                            @error('phone')
                                <span class="flex items-center gap-1 text-rose-600 text-[11px] mt-1.5 ml-1 font-semibold animate-fade-in">
                                    <span class="material-symbols-outlined text-xs">error</span>
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Alamat Fisik Sekolah</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-5 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">location_on</span>
                                <textarea name="address" id="address" rows="3.5" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50/90 focus:bg-white border border-slate-200/80 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 transition duration-150 text-sm leading-relaxed">{{ old('address', $setting->address ?? '') }}</textarea>
                            </div>
                            @error('address')
                                <span class="flex items-center gap-1 text-rose-600 text-[11px] mt-1.5 ml-1 font-semibold animate-fade-in">
                                    <span class="material-symbols-outlined text-xs">error</span>
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Card 1.2: Logo Sekolah -->
                <div class="bg-white rounded-3xl border border-slate-100/80 p-6 md:p-8 shadow-[0_8px_30px_rgba(0,0,0,0.015)] space-y-6">
                    <div class="flex items-center gap-4.5 border-b border-slate-50 pb-5">
                        <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-xl font-bold">image</span>
                        </div>
                        <div>
                            <h3 class="text-base font-black text-slate-800 tracking-tight">Logo Resmi Sekolah</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Logo berformat transparan yang akan dimuat di navigasi atas dan footer website.</p>
                        </div>
                    </div>

                    <!-- Drag and Drop Zone Logo -->
                    <div class="drag-drop-zone relative border-2 border-dashed border-slate-200 hover:border-blue-500/40 rounded-2xl bg-slate-50/30 p-6 flex flex-col items-center justify-center text-center cursor-pointer transition-all duration-200"
                        id="dropzone-logo"
                        onclick="document.getElementById('logo').click()"
                        ondragover="handleDragOver(event, 'dropzone-logo')"
                        ondragleave="handleDragLeave(event, 'dropzone-logo')"
                        ondrop="handleDrop(event, 'logo', 'logo-preview-img', 'logo-preview-placeholder', 'dropzone-logo')">
                        
                        <input type="file" name="logo" id="logo" accept="image/*" class="hidden" onchange="previewImage(this, 'logo-preview-img', 'logo-preview-placeholder')">
                        
                        <div class="flex flex-col md:flex-row items-center gap-6 w-full max-w-md">
                            <div class="w-22 h-22 rounded-xl bg-white border border-slate-150 shadow-sm overflow-hidden flex items-center justify-center p-2 relative flex-shrink-0">
                                <!-- Transparency Grid Decor -->
                                <div class="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:16px_16px] opacity-15"></div>
                                <img id="logo-preview-img" src="{{ ($setting && $setting->logo) ? Storage::url($setting->logo) : '' }}" alt="Logo" 
                                    class="max-w-full max-h-full object-contain relative z-10 {{ ($setting && $setting->logo) ? '' : 'hidden' }}">
                                <div id="logo-preview-placeholder" class="text-slate-350 flex flex-col items-center gap-1 relative z-10 {{ ($setting && $setting->logo) ? 'hidden' : '' }}">
                                    <span class="material-symbols-outlined text-2xl">add_photo_alternate</span>
                                    <span class="text-[8px] font-bold uppercase tracking-wider text-slate-400">No Image</span>
                                </div>
                            </div>
                            <div class="text-left space-y-1">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 font-bold text-[10px] rounded-lg border border-blue-100/50 shadow-sm">
                                    <span class="material-symbols-outlined text-xs">cloud_upload</span>
                                    <span>Pilih Berkas</span>
                                </span>
                                <p class="text-xs text-slate-600 font-semibold mt-1">Seret logo di sini atau klik untuk memilih file</p>
                                <p class="text-[10px] text-slate-400 leading-normal">Direkomendasikan berkas PNG transparan dengan resolusi square, maksimal ukuran 2MB.</p>
                            </div>
                        </div>
                    </div>
                    @error('logo')
                        <span class="flex items-center gap-1 text-rose-600 text-[11px] mt-1.5 ml-1 font-semibold animate-fade-in">
                            <span class="material-symbols-outlined text-xs">error</span>
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <!-- Card 1.3: Sosmed & Integrasi Aplikasi -->
                <div class="bg-white rounded-3xl border border-slate-100/80 p-6 md:p-8 shadow-[0_8px_30px_rgba(0,0,0,0.015)] space-y-6">
                    <div class="flex items-center gap-4.5 border-b border-slate-50 pb-5">
                        <div class="w-11 h-11 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-xl font-bold">share</span>
                        </div>
                        <div>
                            <h3 class="text-base font-black text-slate-800 tracking-tight">Sosmed &amp; Integrasi Portal</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Tautan jejaring sosial resmi, Google Maps, dan tombol login portal internal akademis.</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        
                        <!-- Sosmed inputs with verification buttons -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label for="tiktok_url" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Tautan TikTok</label>
                                <div class="relative group flex items-center gap-2">
                                    <div class="relative flex-1">
                                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-450 transition-colors duration-150 material-symbols-outlined text-base">link</span>
                                        <input type="url" name="tiktok_url" id="tiktok_url" value="{{ old('tiktok_url', $setting->tiktok_url ?? '') }}" placeholder="https://tiktok.com/@..."
                                            class="w-full pl-10 pr-3 py-3 bg-slate-50/50 hover:bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 text-slate-850 text-xs transition duration-150">
                                    </div>
                                    <button type="button" onclick="testLink('tiktok_url')" class="p-3 bg-slate-100 hover:bg-slate-200/75 border border-slate-200 rounded-xl transition flex items-center justify-center flex-shrink-0" title="Uji Tautan">
                                        <span class="material-symbols-outlined text-base text-slate-500">open_in_new</span>
                                    </button>
                                </div>
                                @error('tiktok_url') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="instagram_url" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Tautan Instagram</label>
                                <div class="relative group flex items-center gap-2">
                                    <div class="relative flex-1">
                                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-450 transition-colors duration-150 material-symbols-outlined text-base">link</span>
                                        <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $setting->instagram_url ?? '') }}" placeholder="https://instagram.com/..."
                                            class="w-full pl-10 pr-3 py-3 bg-slate-50/50 hover:bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 text-slate-850 text-xs transition duration-150">
                                    </div>
                                    <button type="button" onclick="testLink('instagram_url')" class="p-3 bg-slate-100 hover:bg-slate-200/75 border border-slate-200 rounded-xl transition flex items-center justify-center flex-shrink-0" title="Uji Tautan">
                                        <span class="material-symbols-outlined text-base text-slate-500">open_in_new</span>
                                    </button>
                                </div>
                                @error('instagram_url') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="youtube_url" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Tautan YouTube</label>
                                <div class="relative group flex items-center gap-2">
                                    <div class="relative flex-1">
                                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-450 transition-colors duration-150 material-symbols-outlined text-base">video_library</span>
                                        <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $setting->youtube_url ?? '') }}" placeholder="https://youtube.com/..."
                                            class="w-full pl-10 pr-3 py-3 bg-slate-50/50 hover:bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 text-slate-850 text-xs transition duration-150">
                                    </div>
                                    <button type="button" onclick="testLink('youtube_url')" class="p-3 bg-slate-100 hover:bg-slate-200/75 border border-slate-200 rounded-xl transition flex items-center justify-center flex-shrink-0" title="Uji Tautan">
                                        <span class="material-symbols-outlined text-base text-slate-500">open_in_new</span>
                                    </button>
                                </div>
                                @error('youtube_url') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Maps Embed link and live interactive preview -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-4.5 border-t border-slate-100">
                            <div class="space-y-2">
                                <label for="maps_embed" class="block text-xs font-bold uppercase tracking-wider text-slate-400">Google Maps Embed Link (iframe src)</label>
                                <div class="relative group">
                                    <span class="absolute left-4 top-4.5 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">map</span>
                                    <textarea name="maps_embed" id="maps_embed" rows="4.5" placeholder="Masukkan URL embed google maps (https://www.google.com/maps/embed?...)"
                                        class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50/90 focus:bg-white border border-slate-200/80 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 transition duration-150 text-xs leading-normal">{{ old('maps_embed', $setting->maps_embed ?? '') }}</textarea>
                                </div>
                                <p class="text-[10px] text-slate-400 leading-normal">Bagikan peta dari Google Maps, pilih opsi "Sematkan peta", dan salin tautan URL di dalam parameter tag <code>src="..."</code>.</p>
                                @error('maps_embed') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="space-y-2.5">
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400">Pratinjau Peta Lokasi</label>
                                <div class="w-full h-[126px] md:h-[135px] rounded-2xl border border-slate-200/80 overflow-hidden relative bg-slate-50 shadow-inner flex items-center justify-center" id="maps-preview-container">
                                    <iframe id="maps-preview-iframe" src="" class="w-full h-full border-none hidden" allowfullscreen="" loading="lazy"></iframe>
                                    <div id="maps-preview-placeholder" class="text-slate-400 flex flex-col items-center gap-1.5 p-4 text-center">
                                        <span class="material-symbols-outlined text-2xl text-slate-300">location_off</span>
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-550">Belum ada peta lokasi</span>
                                        <p class="text-[9px] text-slate-450 max-w-xs leading-normal">Silakan isi teks kolom kiri untuk memuat peta disini.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Login portals internal integration -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-4.5 border-t border-slate-100">
                            <div>
                                <label for="erapor_url" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Tautan Aplikasi E-Rapor</label>
                                <div class="relative group flex items-center gap-2">
                                    <div class="relative flex-1">
                                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-450 transition-colors duration-150 material-symbols-outlined text-base">menu_book</span>
                                        <input type="url" name="erapor_url" id="erapor_url" value="{{ old('erapor_url', $setting->erapor_url ?? '') }}" placeholder="https://erapor.smagiki3surabaya.sch.id..."
                                            class="w-full pl-10 pr-3 py-3 bg-slate-50/50 hover:bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 text-slate-850 text-xs transition duration-150">
                                    </div>
                                    <button type="button" onclick="testLink('erapor_url')" class="p-3 bg-slate-100 hover:bg-slate-200/75 border border-slate-200 rounded-xl transition flex items-center justify-center flex-shrink-0" title="Uji Tautan">
                                        <span class="material-symbols-outlined text-base text-slate-500">open_in_new</span>
                                    </button>
                                </div>
                                @error('erapor_url') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="ujian_url" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Tautan Portal Ujian Online</label>
                                <div class="relative group flex items-center gap-2">
                                    <div class="relative flex-1">
                                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-450 transition-colors duration-150 material-symbols-outlined text-base">lock_open</span>
                                        <input type="url" name="ujian_url" id="ujian_url" value="{{ old('ujian_url', $setting->ujian_url ?? '') }}" placeholder="https://ujian.smagiki3surabaya.sch.id..."
                                            class="w-full pl-10 pr-3 py-3 bg-slate-50/50 hover:bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 text-slate-850 text-xs transition duration-150">
                                    </div>
                                    <button type="button" onclick="testLink('ujian_url')" class="p-3 bg-slate-100 hover:bg-slate-200/75 border border-slate-200 rounded-xl transition flex items-center justify-center flex-shrink-0" title="Uji Tautan">
                                        <span class="material-symbols-outlined text-base text-slate-500">open_in_new</span>
                                    </button>
                                </div>
                                @error('ujian_url') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB PANEL 2: VISI & MISI -->
            <div id="tab-panel-visi-misi" class="tab-panel space-y-6 hidden transition-all duration-300">
                <div class="bg-white rounded-3xl border border-slate-100/80 p-6 md:p-8 shadow-[0_8px_30px_rgba(0,0,0,0.015)] space-y-6">
                    <div class="flex items-center gap-4.5 border-b border-slate-50 pb-5">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-xl font-bold">assignment</span>
                        </div>
                        <div>
                            <h3 class="text-base font-black text-slate-800 tracking-tight">Visi &amp; Misi Sekolah</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Tujuan jangka panjang dan poin misi operasional yang dicapai sekolah.</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        
                        <!-- Vision field -->
                        <div>
                            <label for="vision" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Visi Sekolah</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-5 text-slate-350 group-focus-within:text-emerald-500 transition-colors duration-150 material-symbols-outlined text-lg">lightbulb</span>
                                <textarea name="vision" id="vision" rows="3.5" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50/90 focus:bg-white border border-slate-200/80 rounded-2xl focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 text-slate-800 transition duration-150 text-sm leading-relaxed">{{ old('vision', $setting->vision ?? '') }}</textarea>
                            </div>
                            @error('vision')
                                <span class="flex items-center gap-1 text-rose-600 text-[11px] mt-1.5 ml-1 font-semibold animate-fade-in">
                                    <span class="material-symbols-outlined text-xs">error</span>
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>

                        <!-- Misi Interactive Builder Section -->
                        <div class="space-y-3 pt-4 border-t border-slate-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-450">Daftar Misi Sekolah</label>
                                    <p class="text-[10px] text-slate-400 mt-0.5">Tambahkan, ubah, atau hapus item misi secara interaktif di bawah.</p>
                                </div>
                                <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2.5 py-1 rounded-lg" id="misi-counter-badge">Misi: 0</span>
                            </div>

                            <!-- List Container -->
                            <div id="mission-list-container" class="space-y-2.5 max-h-[350px] overflow-y-auto pr-1">
                                <!-- Loaded dynamically via JS -->
                            </div>

                            <!-- Add Misi Control -->
                            <div class="flex gap-2 pt-2.5">
                                <input type="text" id="add-mission-input" placeholder="Ketik kalimat misi sekolah yang baru disini..."
                                    class="flex-1 px-4 py-3 bg-slate-50 hover:bg-slate-100/70 focus:bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-500 text-xs transition duration-150"
                                    onkeydown="if(event.key === 'Enter') { event.preventDefault(); addMission(); }">
                                <button type="button" onclick="addMission()" id="add-mission-btn"
                                    class="px-4.5 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-xl transition duration-150 flex items-center gap-1.5 shadow-md shadow-emerald-600/10">
                                    <span class="material-symbols-outlined text-sm font-bold">add</span>
                                    <span>Tambah</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB PANEL 3: TENTANG KAMI -->
            <div id="tab-panel-tentang" class="tab-panel space-y-6 hidden transition-all duration-300">
                <div class="bg-white rounded-3xl border border-slate-100/80 p-6 md:p-8 shadow-[0_8px_30px_rgba(0,0,0,0.015)] space-y-6">
                    <div class="flex items-center gap-4.5 border-b border-slate-50 pb-5">
                        <div class="w-11 h-11 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-xl font-bold">info</span>
                        </div>
                        <div>
                            <h3 class="text-base font-black text-slate-800 tracking-tight">Profil &amp; Tentang Sekolah</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Sejarah berdirinya sekolah, detail akreditasi, serta visual gedung penunjang.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5.5">
                        <div class="md:col-span-2">
                            <label for="about_title" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Judul Utama Tentang Kami</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">title</span>
                                <input type="text" name="about_title" id="about_title" value="{{ old('about_title', $setting->about_title ?? '') }}" placeholder="Contoh: Mendidik dengan Hati, Membangun Karakter Mandiri"
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50/90 focus:bg-white border border-slate-200/80 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 transition duration-150 text-sm">
                            </div>
                            @error('about_title') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="about_description" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Deskripsi Ringkasan Tentang Kami</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-5 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">description</span>
                                <textarea name="about_description" id="about_description" rows="4" placeholder="Tuliskan sejarah singkat atau profil utama sekolah..."
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50/90 focus:bg-white border border-slate-200/80 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 transition duration-150 text-sm leading-relaxed">{{ old('about_description', $setting->about_description ?? '') }}</textarea>
                            </div>
                            @error('about_description') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="about_year_founded" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Tahun Berdiri</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">calendar_today</span>
                                <input type="text" name="about_year_founded" id="about_year_founded" value="{{ old('about_year_founded', $setting->about_year_founded ?? '1993') }}"
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 text-sm transition duration-150">
                            </div>
                            @error('about_year_founded') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="about_accreditation" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Akreditasi BAN-S/M</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">verified</span>
                                <input type="text" name="about_accreditation" id="about_accreditation" value="{{ old('about_accreditation', $setting->about_accreditation ?? 'Akreditasi A') }}"
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 text-sm transition duration-150">
                            </div>
                            @error('about_accreditation') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2 pt-4.5 border-t border-slate-100">
                            <label for="about_card_title" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Judul Kartu Detail (Keypoint)</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">badge</span>
                                <input type="text" name="about_card_title" id="about_card_title" value="{{ old('about_card_title', $setting->about_card_title ?? 'Pendidikan Holistik & Karakter') }}"
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 text-sm transition duration-150">
                            </div>
                            @error('about_card_title') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="about_card_desc" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Isi Ringkasan Kartu Detail</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-5 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">article</span>
                                <textarea name="about_card_desc" id="about_card_desc" rows="3" placeholder="Tulis deskripsi poin keunggulan..."
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50/90 focus:bg-white border border-slate-200/80 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 text-xs transition duration-150 leading-relaxed">{{ old('about_card_desc', $setting->about_card_desc ?? '') }}</textarea>
                            </div>
                            @error('about_card_desc') <p class="text-rose-600 text-[10px] mt-1 ml-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <!-- Drag and Drop Zone About Image -->
                        <div class="md:col-span-2 pt-4 border-t border-slate-100">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Foto Visual Tentang Kami</label>
                            <div class="drag-drop-zone relative border-2 border-dashed border-slate-200 hover:border-blue-500/40 rounded-2xl bg-slate-50/30 p-6 flex flex-col items-center justify-center text-center cursor-pointer transition-all duration-200"
                                id="dropzone-about"
                                onclick="document.getElementById('about_image').click()"
                                ondragover="handleDragOver(event, 'dropzone-about')"
                                ondragleave="handleDragLeave(event, 'dropzone-about')"
                                ondrop="handleDrop(event, 'about_image', 'about-preview-img', 'about-preview-placeholder', 'dropzone-about')">
                                
                                <input type="file" name="about_image" id="about_image" accept="image/*" class="hidden" onchange="previewImage(this, 'about-preview-img', 'about-preview-placeholder')">
                                
                                <div class="flex flex-col md:flex-row items-center gap-6 w-full max-w-lg">
                                    <div class="w-36 h-22 rounded-xl bg-white border border-slate-150 shadow-sm overflow-hidden flex items-center justify-center p-1 relative flex-shrink-0">
                                        <img id="about-preview-img" src="{{ ($setting && $setting->about_image) ? Storage::url($setting->about_image) : '' }}" alt="About" 
                                            class="w-full h-full object-cover rounded-lg relative z-10 {{ ($setting && $setting->about_image) ? '' : 'hidden' }}">
                                        <div id="about-preview-placeholder" class="text-slate-350 flex flex-col items-center gap-1 relative z-10 {{ ($setting && $setting->about_image) ? 'hidden' : '' }}">
                                            <span class="material-symbols-outlined text-2xl">image</span>
                                            <span class="text-[8px] font-bold uppercase tracking-wider text-slate-400">Landscape View</span>
                                        </div>
                                    </div>
                                    <div class="text-left space-y-1">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 font-bold text-[10px] rounded-lg border border-blue-100/50 shadow-sm">
                                            <span class="material-symbols-outlined text-xs">cloud_upload</span>
                                            <span>Unggah Foto</span>
                                        </span>
                                        <p class="text-xs text-slate-600 font-semibold mt-1">Seret gambar bangunan/sekolah ke sini atau klik</p>
                                        <p class="text-[10px] text-slate-400 leading-normal">Direkomendasikan foto rasio landscape (4:3 atau 16:9), maksimal ukuran 2MB.</p>
                                    </div>
                                </div>
                            </div>
                            @error('about_image')
                                <span class="flex items-center gap-1 text-rose-600 text-[11px] mt-1.5 ml-1 font-semibold animate-fade-in">
                                    <span class="material-symbols-outlined text-xs">error</span>
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB PANEL 4: SAMBUTAN KEPALA -->
            <div id="tab-panel-sambutan" class="tab-panel space-y-6 hidden transition-all duration-300">
                <div class="bg-white rounded-3xl border border-slate-100/80 p-6 md:p-8 shadow-[0_8px_30px_rgba(0,0,0,0.015)] space-y-6">
                    <div class="flex items-center gap-4.5 border-b border-slate-50 pb-5">
                        <div class="w-11 h-11 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-xl font-bold">record_voice_over</span>
                        </div>
                        <div>
                            <h3 class="text-base font-black text-slate-800 tracking-tight">Sambutan Kepala Sekolah</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Teks kata pengantar resmi dan foto formal Kepala Sekolah SMA GIKI 3 Surabaya.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5.5">
                        <div>
                            <label for="headmaster_name" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Nama Kepala Sekolah</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">person</span>
                                <input type="text" name="headmaster_name" id="headmaster_name" value="{{ old('headmaster_name', $setting->headmaster_name ?? 'Drs. H. M. Zainuri, M.Si') }}" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 text-sm transition duration-150">
                            </div>
                            @error('headmaster_name') <p class="text-rose-600 text-[10px] mt-1.5 ml-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="headmaster_title" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Jabatan / Gelar</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">badge</span>
                                <input type="text" name="headmaster_title" id="headmaster_title" value="{{ old('headmaster_title', $setting->headmaster_title ?? 'Kepala SMA GIKI 3 Surabaya') }}" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 text-sm transition duration-150">
                            </div>
                            @error('headmaster_title') <p class="text-rose-600 text-[10px] mt-1.5 ml-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2 pt-4 border-t border-slate-100">
                            <label for="headmaster_speech_title" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Judul Teks Sambutan</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">title</span>
                                <input type="text" name="headmaster_speech_title" id="headmaster_speech_title" value="{{ old('headmaster_speech_title', $setting->headmaster_speech_title ?? 'Menyiapkan Generasi Unggul & Berkarakter Mulia') }}" required
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 text-sm transition duration-150">
                            </div>
                            @error('headmaster_speech_title') <p class="text-rose-600 text-[10px] mt-1.5 ml-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="headmaster_speech" class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2.5">Isi Teks Sambutan Lengkap</label>
                            <div class="relative group">
                                <span class="absolute left-4 top-5 text-slate-350 group-focus-within:text-blue-500 transition-colors duration-150 material-symbols-outlined text-lg">speech_to_text</span>
                                <textarea name="headmaster_speech" id="headmaster_speech" rows="7.5" placeholder="Tulis pesan sambutan kepala sekolah..."
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 hover:bg-slate-50/90 focus:bg-white border border-slate-200/80 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-800 text-xs transition duration-150 leading-relaxed">{{ old('headmaster_speech', $setting->headmaster_speech ?? '') }}</textarea>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-2">Tekan Enter untuk memisahkan paragraf. Sambutan akan dirender rapi di front page.</p>
                            @error('headmaster_speech') <p class="text-rose-600 text-[10px] mt-1.5 ml-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <!-- Drag and Drop Zone Headmaster Photo -->
                        <div class="md:col-span-2 pt-4 border-t border-slate-100">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Foto Resmi Kepala Sekolah</label>
                            <div class="drag-drop-zone relative border-2 border-dashed border-slate-200 hover:border-purple-500/40 rounded-2xl bg-slate-50/30 p-6 flex flex-col items-center justify-center text-center cursor-pointer transition-all duration-200"
                                id="dropzone-headmaster"
                                onclick="document.getElementById('headmaster_photo').click()"
                                ondragover="handleDragOver(event, 'dropzone-headmaster')"
                                ondragleave="handleDragLeave(event, 'dropzone-headmaster')"
                                ondrop="handleDrop(event, 'headmaster_photo', 'headmaster-preview-img', 'headmaster-preview-placeholder', 'dropzone-headmaster')">
                                
                                <input type="file" name="headmaster_photo" id="headmaster_photo" accept="image/*" class="hidden" onchange="previewImage(this, 'headmaster-preview-img', 'headmaster-preview-placeholder')">
                                
                                <div class="flex flex-col md:flex-row items-center gap-6 w-full max-w-lg">
                                    <div class="w-24 h-32 rounded-xl bg-white border border-slate-150 shadow-sm overflow-hidden flex items-center justify-center p-1 relative flex-shrink-0">
                                        <img id="headmaster-preview-img" src="{{ ($setting && $setting->headmaster_photo) ? Storage::url($setting->headmaster_photo) : '' }}" alt="Kepala Sekolah" 
                                            class="w-full h-full object-cover rounded-lg relative z-10 {{ ($setting && $setting->headmaster_photo) ? '' : 'hidden' }}">
                                        <div id="headmaster-preview-placeholder" class="text-slate-350 flex flex-col items-center gap-1 relative z-10 {{ ($setting && $setting->headmaster_photo) ? 'hidden' : '' }}">
                                            <span class="material-symbols-outlined text-2xl">person</span>
                                            <span class="text-[8px] font-bold uppercase tracking-wider text-slate-400">Portrait Frame</span>
                                        </div>
                                    </div>
                                    <div class="text-left space-y-1">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-50 text-purple-700 font-bold text-[10px] rounded-lg border border-purple-100/50 shadow-sm">
                                            <span class="material-symbols-outlined text-xs">cloud_upload</span>
                                            <span>Unggah Foto</span>
                                        </span>
                                        <p class="text-xs text-slate-600 font-semibold mt-1">Seret foto Kepala Sekolah ke sini atau klik</p>
                                        <p class="text-[10px] text-slate-400 leading-normal">Direkomendasikan berkas rasio portrait formal (4:5 atau 3:4) dengan latar bersih, maksimal ukuran 2MB.</p>
                                    </div>
                                </div>
                            </div>
                            @error('headmaster_photo')
                                <span class="flex items-center gap-1 text-rose-600 text-[11px] mt-1.5 ml-1 font-semibold animate-fade-in">
                                    <span class="material-symbols-outlined text-xs">error</span>
                                    <span>{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Standard Bottom Sticky Save Bar trigger (fallback action button) -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="px-8 py-3.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl transition duration-150 shadow-md active:scale-[0.98] flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">save</span>
                    <span>Simpan Semua Pengaturan</span>
                </button>
            </div>
        </div>

        <!-- FLOATING SAVE ACTIONS PANEL -->
        <div id="floating-save-bar" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-40 bg-slate-900/95 backdrop-blur-md px-6 py-4 rounded-2xl border border-slate-800 shadow-[0_20px_50px_rgba(0,0,0,0.3)] flex items-center gap-6 translate-y-24 opacity-0 transition-all duration-300 pointer-events-auto">
            <div class="flex flex-col">
                <span class="text-[9px] font-extrabold text-blue-400 uppercase tracking-widest">Perubahan Terdeteksi</span>
                <span class="text-xs text-slate-300 font-bold mt-0.5">Ada data yang belum Anda simpan ke server.</span>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" onclick="resetForm()" class="px-3.5 py-2 text-xs font-bold text-slate-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-xl transition shadow-md shadow-blue-600/20 active:scale-95 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm font-bold">save</span>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </div>

    </form>
</div>

<!-- Toast Container -->
<div id="custom-toast" class="fixed top-6 right-6 z-50 translate-y-[-100px] opacity-0 transition-all duration-300 pointer-events-none">
    <div id="toast-container" class="flex items-center gap-3 px-5 py-3 rounded-2xl border backdrop-blur-md shadow-lg min-w-[280px] max-w-sm pointer-events-auto">
        <span id="toast-icon" class="material-symbols-outlined">check_circle</span>
        <div class="flex-1">
            <p id="toast-text" class="text-xs font-bold leading-snug"></p>
        </div>
        <button type="button" onclick="hideToast()" class="text-slate-400 hover:text-white transition">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Live image preview helper script
    function previewImage(input, previewId, placeholderId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById(previewId);
                const placeholder = document.getElementById(placeholderId);
                
                if (previewImg) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                }
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Drag and Drop helpers
    function handleDragOver(e, id) {
        e.preventDefault();
        const zone = document.getElementById(id);
        if (zone) {
            zone.classList.remove('border-slate-200', 'bg-slate-50/30');
            zone.classList.add('border-blue-500', 'bg-blue-50/20');
        }
    }

    function handleDragLeave(e, id) {
        e.preventDefault();
        const zone = document.getElementById(id);
        if (zone) {
            zone.classList.remove('border-blue-500', 'bg-blue-50/20');
            zone.classList.add('border-slate-200', 'bg-slate-50/30');
        }
    }

    function handleDrop(e, inputId, previewId, placeholderId, zoneId) {
        e.preventDefault();
        const zone = document.getElementById(zoneId);
        if (zone) {
            zone.classList.remove('border-blue-500', 'bg-blue-50/20');
            zone.classList.add('border-slate-200', 'bg-slate-50/30');
        }
        
        const input = document.getElementById(inputId);
        if (input && e.dataTransfer.files && e.dataTransfer.files[0]) {
            input.files = e.dataTransfer.files;
            previewImage(input, previewId, placeholderId);
            checkDirtyState();
        }
    }

    // Link Verification
    function testLink(inputId) {
        const input = document.getElementById(inputId);
        if (input && input.value.trim()) {
            let url = input.value.trim();
            if (!/^https?:\/\//i.test(url)) {
                url = 'https://' + url;
            }
            window.open(url, '_blank');
        } else {
            showToast('warning', 'Tautan masih kosong! Isi tautan valid terlebih dahulu.');
        }
    }

    // Google Maps URL parser and preview
    function extractMapsUrl(embedString) {
        if (!embedString) return '';
        if (embedString.includes('<iframe')) {
            const match = embedString.match(/src=["']([^"']+)["']/);
            if (match && match[1]) {
                return match[1];
            }
        }
        return embedString.trim();
    }

    function initMapsEmbedPreview() {
        const mapsInput = document.getElementById('maps_embed');
        const mapsIframe = document.getElementById('maps-preview-iframe');
        const mapsPlaceholder = document.getElementById('maps-preview-placeholder');
        
        if (!mapsInput) return;
        
        const embedValue = mapsInput.value;
        const url = extractMapsUrl(embedValue);
        
        if (url) {
            mapsIframe.src = url;
            mapsIframe.classList.remove('hidden');
            mapsPlaceholder.classList.add('hidden');
        } else {
            mapsIframe.src = '';
            mapsIframe.classList.add('hidden');
            mapsPlaceholder.classList.remove('hidden');
        }
    }

    // Misi list builder interactive engine
    const missionTextarea = document.getElementById('mission');
    const missionListContainer = document.getElementById('mission-list-container');
    const addMissionInput = document.getElementById('add-mission-input');
    const misiCounterBadge = document.getElementById('misi-counter-badge');
    
    let missions = [];

    function initMissions() {
        if (missionTextarea) {
            const rawValue = missionTextarea.value.trim();
            if (rawValue) {
                missions = rawValue.split('\n').map(item => item.trim()).filter(item => item.length > 0);
            } else {
                missions = [];
            }
        }
        renderMissions();
    }

    function renderMissions() {
        if (!missionListContainer) return;
        missionListContainer.innerHTML = '';
        
        // Update badge count
        if (misiCounterBadge) {
            misiCounterBadge.textContent = `Misi: ${missions.length}`;
        }

        if (missions.length === 0) {
            missionListContainer.innerHTML = `
                <div class="flex flex-col items-center justify-center p-8 bg-slate-50/50 border border-dashed border-slate-200 rounded-2xl text-slate-400">
                    <span class="material-symbols-outlined text-2xl text-slate-350">task_alt</span>
                    <p class="text-xs font-bold text-slate-650 mt-1.5">Belum ada misi sekolah</p>
                    <p class="text-[9px] text-slate-400 mt-0.5">Ketik poin misi baru di input bawah, lalu tekan tombol Tambah.</p>
                </div>
            `;
            return;
        }

        missions.forEach((mission, index) => {
            const item = document.createElement('div');
            item.className = "flex items-start justify-between gap-3 p-3 bg-slate-50 hover:bg-slate-100/60 border border-slate-150 rounded-2xl group transition duration-150";
            item.innerHTML = `
                <div class="flex items-start gap-2.5 flex-1 min-w-0">
                    <span class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-[10px] font-bold mt-0.5 flex-shrink-0 shadow-sm border border-emerald-100/50">${index + 1}</span>
                    <p class="text-xs text-slate-700 leading-relaxed font-semibold break-words w-full mt-0.5" id="mission-text-${index}">${escapeHtml(mission)}</p>
                    <textarea class="hidden w-full text-xs text-slate-700 bg-white border border-blue-500 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-blue-100" id="mission-edit-input-${index}" rows="2">${escapeHtml(mission)}</textarea>
                </div>
                <div class="flex items-center gap-0.5 flex-shrink-0 opacity-80 group-hover:opacity-100 transition">
                    <button type="button" onclick="editMissionItem(${index})" id="btn-edit-${index}" class="p-1.5 text-slate-450 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition duration-100">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </button>
                    <button type="button" onclick="saveMissionItem(${index})" id="btn-save-${index}" class="hidden p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg transition duration-100">
                        <span class="material-symbols-outlined text-sm">check</span>
                    </button>
                    <button type="button" onclick="deleteMission(${index})" class="p-1.5 text-slate-450 hover:text-red-650 hover:bg-red-50 rounded-lg transition duration-100">
                        <span class="material-symbols-outlined text-sm">delete</span>
                    </button>
                </div>
            `;
            missionListContainer.appendChild(item);
        });
    }

    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function addMission() {
        if (!addMissionInput) return;
        const val = addMissionInput.value.trim();
        if (val) {
            missions.push(val);
            addMissionInput.value = '';
            updateTextarea();
            renderMissions();
            checkDirtyState();
        }
    }

    function deleteMission(index) {
        missions.splice(index, 1);
        updateTextarea();
        renderMissions();
        checkDirtyState();
    }

    function editMissionItem(index) {
        const textElement = document.getElementById(`mission-text-${index}`);
        const inputElement = document.getElementById(`mission-edit-input-${index}`);
        const btnEdit = document.getElementById(`btn-edit-${index}`);
        const btnSave = document.getElementById(`btn-save-${index}`);
        
        if (textElement && inputElement && btnEdit && btnSave) {
            textElement.classList.add('hidden');
            inputElement.classList.remove('hidden');
            btnEdit.classList.add('hidden');
            btnSave.classList.remove('hidden');
            inputElement.focus();
        }
    }

    function saveMissionItem(index) {
        const input = document.getElementById(`mission-edit-input-${index}`);
        if (input) {
            const val = input.value.trim();
            if (val) {
                missions[index] = val;
                updateTextarea();
                renderMissions();
                checkDirtyState();
            }
        }
    }

    function updateTextarea() {
        if (missionTextarea) {
            missionTextarea.value = missions.join('\n');
        }
    }

    // Tab switcher logic
    function switchTab(tabId) {
        document.querySelectorAll('.tab-panel').forEach(panel => {
            panel.classList.add('hidden');
        });
        
        document.querySelectorAll('[id^="tab-btn-"]').forEach(btn => {
            btn.classList.remove('bg-slate-900', 'text-white', 'shadow-[0_4px_12px_rgba(0,0,0,0.06)]');
            btn.classList.add('text-slate-500', 'hover:text-slate-700', 'hover:bg-slate-50/50');
            
            const icon = btn.querySelector('.material-symbols-outlined');
            if (icon) {
                icon.classList.remove('text-blue-400', 'text-emerald-400', 'text-sky-400', 'text-purple-400');
            }
        });
        
        const activePanel = document.getElementById(`tab-panel-${tabId}`);
        if (activePanel) {
            activePanel.classList.remove('hidden');
            activePanel.classList.remove('animate-fade-in');
            void activePanel.offsetWidth;
            activePanel.classList.add('animate-fade-in');
        }
        
        const activeBtn = document.getElementById(`tab-btn-${tabId}`);
        if (activeBtn) {
            activeBtn.classList.remove('text-slate-500', 'hover:text-slate-700', 'hover:bg-slate-50/50');
            activeBtn.classList.add('bg-slate-900', 'text-white', 'shadow-[0_4px_12px_rgba(0,0,0,0.06)]');
            
            const icon = activeBtn.querySelector('.material-symbols-outlined');
            if (icon) {
                if (tabId === 'umum') icon.classList.add('text-blue-400');
                if (tabId === 'visi-misi') icon.classList.add('text-emerald-400');
                if (tabId === 'tentang') icon.classList.add('text-sky-400');
                if (tabId === 'sambutan') icon.classList.add('text-purple-400');
            }
        }
        
        localStorage.setItem('active_setting_tab', tabId);
    }

    // Dirty changes tracking mechanisms
    let isDirty = false;
    const initialValues = {};
    const settingForm = document.querySelector('form');
    const floatingSaveBar = document.getElementById('floating-save-bar');

    function captureInitialValues() {
        if (!settingForm) return;
        const inputs = settingForm.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            if (input.type === 'file') return;
            initialValues[input.id || input.name] = input.value;
            
            input.addEventListener('input', checkDirtyState);
            input.addEventListener('change', checkDirtyState);
        });
        
        // Save initial state for missions textarea specifically
        if (missionTextarea) {
            initialValues['mission'] = missionTextarea.value;
        }
    }

    function checkDirtyState() {
        if (!settingForm) return;
        let dirty = false;
        const inputs = settingForm.querySelectorAll('input, textarea, select');
        
        for (const input of inputs) {
            if (input.type === 'file') {
                if (input.files && input.files.length > 0) {
                    dirty = true;
                    break;
                }
                continue;
            }
            
            const initialVal = initialValues[input.id || input.name];
            if (initialVal !== undefined && input.value !== initialVal) {
                dirty = true;
                break;
            }
        }
        
        // Check if missions serialization matches initial
        const initialM = (initialValues['mission'] || '').trim();
        const currentM = (missionTextarea ? missionTextarea.value : '').trim();
        if (initialM !== currentM) {
            dirty = true;
        }
        
        isDirty = dirty;
        updateFloatingBar();
    }

    function updateFloatingBar() {
        if (floatingSaveBar) {
            if (isDirty) {
                floatingSaveBar.classList.remove('translate-y-24', 'opacity-0');
                floatingSaveBar.classList.add('translate-y-0', 'opacity-100');
            } else {
                floatingSaveBar.classList.remove('translate-y-0', 'opacity-100');
                floatingSaveBar.classList.add('translate-y-24', 'opacity-0');
            }
        }
    }

    function resetForm() {
        if (!settingForm) return;
        
        const inputs = settingForm.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            if (input.type === 'file') {
                input.value = '';
                
                // Reset visual previews to DB defaults
                if (input.id === 'logo') {
                    const img = document.getElementById('logo-preview-img');
                    const placeholder = document.getElementById('logo-preview-placeholder');
                    const defaultSrc = "{{ ($setting && $setting->logo) ? Storage::url($setting->logo) : '' }}";
                    if (defaultSrc) {
                        img.src = defaultSrc;
                        img.classList.remove('hidden');
                        placeholder.classList.add('hidden');
                    } else {
                        img.classList.add('hidden');
                        placeholder.classList.remove('hidden');
                    }
                }
                
                if (input.id === 'about_image') {
                    const img = document.getElementById('about-preview-img');
                    const placeholder = document.getElementById('about-preview-placeholder');
                    const defaultSrc = "{{ ($setting && $setting->about_image) ? Storage::url($setting->about_image) : '' }}";
                    if (defaultSrc) {
                        img.src = defaultSrc;
                        img.classList.remove('hidden');
                        placeholder.classList.add('hidden');
                    } else {
                        img.classList.add('hidden');
                        placeholder.classList.remove('hidden');
                    }
                }

                if (input.id === 'headmaster_photo') {
                    const img = document.getElementById('headmaster-preview-img');
                    const placeholder = document.getElementById('headmaster-preview-placeholder');
                    const defaultSrc = "{{ ($setting && $setting->headmaster_photo) ? Storage::url($setting->headmaster_photo) : '' }}";
                    if (defaultSrc) {
                        img.src = defaultSrc;
                        img.classList.remove('hidden');
                        placeholder.classList.add('hidden');
                    } else {
                        img.classList.add('hidden');
                        placeholder.classList.remove('hidden');
                    }
                }
                return;
            }
            
            const initialVal = initialValues[input.id || input.name];
            if (initialVal !== undefined) {
                input.value = initialVal;
            }
        });
        
        // Reset missions list
        initMissions();
        // Reset Google maps embed preview
        initMapsEmbedPreview();
        
        isDirty = false;
        updateFloatingBar();
        showToast('success', 'Semua perubahan isian dibatalkan.');
    }

    // Toast show helper
    function showToast(type, message) {
        const toast = document.getElementById('custom-toast');
        const toastText = document.getElementById('toast-text');
        const toastIcon = document.getElementById('toast-icon');
        const toastContainer = document.getElementById('toast-container');
        
        if (!toast || !toastText) return;
        
        if (type === 'success') {
            toastContainer.className = "flex items-center gap-3 px-5 py-3 rounded-2xl border backdrop-blur-md shadow-lg min-w-[280px] max-w-sm bg-emerald-900/95 border-emerald-800 text-emerald-100";
            toastIcon.className = "material-symbols-outlined text-emerald-400 text-lg";
            toastIcon.textContent = "check_circle";
        } else if (type === 'warning') {
            toastContainer.className = "flex items-center gap-3 px-5 py-3 rounded-2xl border backdrop-blur-md shadow-lg min-w-[280px] max-w-sm bg-amber-900/95 border-amber-800 text-amber-100";
            toastIcon.className = "material-symbols-outlined text-amber-400 text-lg";
            toastIcon.textContent = "warning";
        } else {
            toastContainer.className = "flex items-center gap-3 px-5 py-3 rounded-2xl border backdrop-blur-md shadow-lg min-w-[280px] max-w-sm bg-rose-900/95 border-rose-800 text-rose-100";
            toastIcon.className = "material-symbols-outlined text-rose-400 text-lg";
            toastIcon.textContent = "error";
        }
        
        toastText.textContent = message;
        
        toast.classList.remove('translate-y-[-100px]', 'opacity-0', 'pointer-events-none');
        toast.classList.add('translate-y-0', 'opacity-100');
        
        setTimeout(() => {
            hideToast();
        }, 4000);
    }

    function hideToast() {
        const toast = document.getElementById('custom-toast');
        if (toast) {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-[-100px]', 'opacity-0', 'pointer-events-none');
        }
    }

    // Initialization routine
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize missions list
        initMissions();

        // Initialize Google Maps Embed preview
        initMapsEmbedPreview();
        
        // Listen for maps_embed typing
        const mapsInput = document.getElementById('maps_embed');
        if (mapsInput) {
            mapsInput.addEventListener('input', initMapsEmbedPreview);
        }

        // Capture initial values for dirty changes tracking
        captureInitialValues();

        // Check if there are active errors to open appropriate tab
        let tabWithError = null;
        const panels = ['umum', 'visi-misi', 'tentang', 'sambutan'];
        for (const tab of panels) {
            const panel = document.getElementById(`tab-panel-${tab}`);
            if (panel && panel.querySelector('.text-rose-600')) {
                tabWithError = tab;
                break;
            }
        }
        
        if (tabWithError) {
            switchTab(tabWithError);
            showToast('error', 'Ada beberapa data masukan yang tidak valid.');
        } else {
            const savedTab = localStorage.getItem('active_setting_tab');
            if (savedTab && panels.includes(savedTab)) {
                switchTab(savedTab);
            } else {
                switchTab('umum');
            }
        }
    });
</script>
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            showToast('success', "{{ session('success') }}");
        });
    </script>
@endif
@if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            showToast('error', 'Silakan periksa kembali kesalahan pengisian data pada form.');
        });
    </script>
@endif
<style>
    /* Styling adjustments for horizontal scrollbars inside tabs bar on mobile */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.28s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>
@endpush

