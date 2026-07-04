@extends('layouts.app')

@section('title', 'Ekstrakurikuler - SMA GIKI 3 Surabaya')

@section('meta')
    <meta name="description" content="Eksplorasi bakat dan minat siswa melalui berbagai program ekstrakurikuler unggulan di bidang Olahraga, Seni, Teknologi, Kepanduan, dan Keagamaan di SMA GIKI 3 Surabaya." />
    <meta name="keywords" content="ekstrakurikuler sma giki 3, ekskul giki 3, kegiatan siswa, surabaya, olahraga, seni" />
    <meta property="og:title" content="Ekstrakurikuler - SMA GIKI 3 Surabaya" />
    <meta property="og:description" content="Eksplorasi bakat dan minat siswa melalui berbagai program ekstrakurikuler unggulan di bidang Olahraga, Seni, Teknologi, Kepanduan, dan Keagamaan di SMA GIKI 3 Surabaya." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('ekstrakurikuler.index') }}" />
@endsection

@section('content')
<main class="pt-32 pb-24 bg-[#FAF9F6] min-h-screen">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <!-- Page Header -->
        <div class="mb-16 text-center max-w-3xl mx-auto">
            <span class="text-secondary font-label-md tracking-widest uppercase mb-4 block">Kegiatan Non-Akademik</span>
            <h1 class="font-display-lg text-4xl md:text-5xl text-primary font-bold mb-6">Program Ekstrakurikuler</h1>
            <p class="font-body-lg text-slate-500 text-base leading-relaxed">
                Kami berkomitmen mendukung perkembangan holistik siswa melalui 20+ cabang ekstrakurikuler aktif yang dirancang untuk mengasah minat, bakat, kepemimpinan, dan kerjasama tim.
            </p>
        </div>

        @if($extracurriculars->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-3xl p-16 text-center border border-slate-100 shadow-sm max-w-lg mx-auto">
                <span class="material-symbols-outlined text-6xl text-slate-300 mb-4">sports_soccer</span>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Ekstrakurikuler</h3>
                <p class="text-slate-500 text-sm mb-6 leading-relaxed">
                    Maaf, saat ini daftar ekstrakurikuler belum ditambahkan oleh administrator. Silakan kembali beberapa saat lagi.
                </p>
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-full text-sm font-semibold hover:bg-primary/95 transition duration-150">
                    <span class="material-symbols-outlined text-lg">home</span>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        @else
            <!-- Filter Tabs -->
            @php
                $categories = ['Semua', 'Olahraga', 'Seni & Budaya', 'Sains & Teknologi', 'Kepanduan', 'Sosial & Kesehatan', 'Keagamaan', 'Akademik'];
            @endphp
            <div class="flex flex-wrap items-center justify-center gap-2 mb-12 max-w-5xl mx-auto">
                @foreach($categories as $cat)
                    <button onclick="filterEkskul('{{ $cat }}')"
                            id="filter-btn-{{ Str::slug($cat) }}"
                            class="filter-tab-btn px-6 py-2.5 rounded-full text-sm font-bold border transition-all duration-300
                                   {{ $cat == 'Semua' 
                                      ? 'bg-secondary text-on-secondary border-secondary shadow-md' 
                                      : 'bg-white text-slate-600 border-slate-200 hover:border-secondary hover:text-secondary' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>

            <!-- Card Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="ekskul-grid">
                @foreach($extracurriculars as $ekskul)
                    <div class="ekskul-card bento-card bg-white flex flex-col h-full border border-slate-100/50 hover:shadow-xl transition-all duration-300 cursor-pointer animate-card"
                         data-category="{{ $ekskul->category ?: 'Akademik' }}"
                         onclick="openEkskulModal('{{ $ekskul->id }}')">
                        
                        <!-- Image Cover -->
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100 flex-shrink-0 group">
                            @if($ekskul->image_path)
                                @if(Str::startsWith($ekskul->image_path, 'http'))
                                    <img src="{{ $ekskul->image_path }}" alt="{{ $ekskul->name }}" class="w-full h-full object-cover img-zoom" loading="lazy" />
                                @else
                                    <img src="{{ Storage::url($ekskul->image_path) }}" alt="{{ $ekskul->name }}" class="w-full h-full object-cover img-zoom" loading="lazy" />
                                @endif
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-100">
                                    <span class="material-symbols-outlined text-6xl text-slate-350">{{ $ekskul->icon ?: 'sports_soccer' }}</span>
                                </div>
                            @endif

                            @if($ekskul->category)
                                <div class="absolute bottom-4 left-4">
                                    <span class="px-3 py-1 bg-primary/95 text-on-primary rounded-full text-[10px] font-bold tracking-wider uppercase">
                                        {{ $ekskul->category }}
                                    </span>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm w-10 h-10 rounded-full flex items-center justify-center border border-slate-100 shadow-sm">
                                <span class="material-symbols-outlined text-slate-700 text-xl">{{ $ekskul->icon ?: 'groups' }}</span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6 flex flex-col flex-grow justify-between">
                            <div>
                                <h3 class="text-xl font-extrabold text-primary mb-3 hover:text-secondary transition-colors line-clamp-1">
                                    {{ $ekskul->name }}
                                </h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3">
                                    {{ $ekskul->description }}
                                </p>
                            </div>

                            <!-- Footer Metadata -->
                            <div class="pt-4 border-t border-slate-100 flex flex-col gap-2.5 text-xs text-slate-500">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base text-secondary flex-shrink-0">person</span>
                                    <span class="truncate"><strong>Pembina:</strong> {{ $ekskul->pembina ?: 'Akan diumumkan' }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base text-secondary flex-shrink-0">schedule</span>
                                    <span class="truncate"><strong>Jadwal:</strong> {{ $ekskul->schedule ?: 'Fleksibel' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Modals Detail Data -->
            @foreach($extracurriculars as $ekskul)
                <div id="ekskul-modal-{{ $ekskul->id }}" 
                     class="ekskul-modal-overlay fixed inset-0 z-[100] hidden flex items-center justify-center p-4 md:p-6 bg-primary/80 backdrop-blur-md opacity-0 transition-opacity duration-300">
                    <div class="bg-white rounded-3xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col shadow-2xl transform scale-95 transition-transform duration-300">
                        
                        <!-- Header -->
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50 flex-shrink-0">
                            <div>
                                <h3 class="font-extrabold text-xl text-primary">{{ $ekskul->name }}</h3>
                                @if($ekskul->category)
                                    <span class="text-secondary text-xs font-bold uppercase tracking-wider">{{ $ekskul->category }}</span>
                                @endif
                            </div>
                            <button onclick="closeEkskulModal('{{ $ekskul->id }}')" class="w-10 h-10 rounded-full hover:bg-slate-200 flex items-center justify-center text-primary transition">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        
                        <!-- Body -->
                        <div class="overflow-y-auto p-6 md:p-8 flex-grow space-y-6">
                            <!-- Large Image Cover -->
                            <div class="aspect-video w-full rounded-2xl overflow-hidden bg-slate-100 border border-slate-200">
                                @if($ekskul->image_path)
                                    @if(Str::startsWith($ekskul->image_path, 'http'))
                                        <img src="{{ $ekskul->image_path }}" alt="{{ $ekskul->name }}" class="w-full h-full object-cover" loading="lazy" />
                                    @else
                                        <img src="{{ Storage::url($ekskul->image_path) }}" alt="{{ $ekskul->name }}" class="w-full h-full object-cover" loading="lazy" />
                                    @endif
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 gap-2">
                                        <span class="material-symbols-outlined text-6xl text-slate-350">{{ $ekskul->icon ?: 'sports_soccer' }}</span>
                                        <span class="text-xs font-semibold text-slate-400">Pratinjau Foto Kegiatan</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Meta Info Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4.5 bg-slate-50 border border-slate-100 rounded-2xl">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-white border border-slate-200/50 flex items-center justify-center text-secondary flex-shrink-0">
                                        <span class="material-symbols-outlined text-xl">person</span>
                                    </div>
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-slate-400">Pembina / Pelatih</p>
                                        <p class="text-sm font-semibold text-slate-800">{{ $ekskul->pembina ?: 'Akan diumumkan' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-white border border-slate-200/50 flex items-center justify-center text-secondary flex-shrink-0">
                                        <span class="material-symbols-outlined text-xl">schedule</span>
                                    </div>
                                    <div>
                                        <p class="text-[10px] uppercase font-bold text-slate-400">Jadwal Latihan</p>
                                        <p class="text-sm font-semibold text-slate-800">{{ $ekskul->schedule ?: 'Menyesuaikan / Fleksibel' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <h3 class="font-bold text-slate-700 mb-2 border-b border-slate-100 pb-1.5 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-lg text-secondary">info</span>
                                    Tentang Kegiatan
                                </h3>
                                <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">
                                    {{ $ekskul->description }}
                                </p>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex justify-end flex-shrink-0">
                            <button onclick="closeEkskulModal('{{ $ekskul->id }}')" class="px-5 py-2 bg-primary text-white text-xs font-bold rounded-full hover:bg-primary/90 transition shadow-md">
                                Tutup Detail
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</main>
@endsection

@section('scripts')
<script>
    // Client-side instant category filtering
    function filterEkskul(category) {
        const cards = document.querySelectorAll('.ekskul-card');
        const buttons = document.querySelectorAll('.filter-tab-btn');
        const slugged = category.toLowerCase().replace(/[^a-z0-9]+/g, '-');
        const activeBtn = document.getElementById('filter-btn-' + slugged);

        // Update active tab styles
        buttons.forEach(btn => {
            btn.classList.remove('bg-secondary', 'text-on-secondary', 'border-secondary', 'shadow-md');
            btn.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
        });
        
        if (activeBtn) {
            activeBtn.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');
            activeBtn.classList.add('bg-secondary', 'text-on-secondary', 'border-secondary', 'shadow-md');
        }

        // Show/hide cards with fade animation
        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (category === 'Semua' || cardCat === category) {
                card.style.display = 'flex';
                // Trigger CSS animation reflow
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                }, 50);
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Modal Control Logic
    function openEkskulModal(id) {
        const modal = document.getElementById('ekskul-modal-' + id);
        if (!modal) return;

        const body = modal.querySelector('div');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Disable document scroll
        document.body.classList.add('overflow-hidden');

        // Animation timing
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            if (body) {
                body.classList.remove('scale-95');
                body.classList.add('scale-100');
            }
        }, 50);
    }

    function closeEkskulModal(id) {
        const modal = document.getElementById('ekskul-modal-' + id);
        if (!modal) return;

        const body = modal.querySelector('div');
        modal.classList.add('opacity-0');
        if (body) {
            body.classList.remove('scale-100');
            body.classList.add('scale-95');
        }

        // Re-enable document scroll
        document.body.classList.remove('overflow-hidden');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    // Close modal clicking outside
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('ekskul-modal-overlay')) {
            const modalId = event.target.id.replace('ekskul-modal-', '');
            closeEkskulModal(modalId);
        }
    });

    // Close modal pressing Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const activeModal = document.querySelector('.ekskul-modal-overlay:not(.hidden)');
            if (activeModal) {
                const modalId = activeModal.id.replace('ekskul-modal-', '');
                closeEkskulModal(modalId);
            }
        }
    });
</script>
@endsection
