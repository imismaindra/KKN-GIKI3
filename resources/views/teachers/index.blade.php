@extends('layouts.app')

@section('title', 'Direktori Guru & Staf - SMA GIKI 3 Surabaya')

@section('meta')
    <meta name="description" content="Kenali lebih dekat jajaran guru dan staf profesional SMA GIKI 3 Surabaya yang berdedikasi tinggi dalam mendidik dan membimbing siswa." />
    <meta name="keywords" content="guru sma giki 3, staf sma giki 3, pengajar giki 3 surabaya, guru terbaik" />
    <meta property="og:title" content="Direktori Guru & Staf - SMA GIKI 3 Surabaya" />
    <meta property="og:description" content="Kenali lebih dekat jajaran guru dan staf profesional SMA GIKI 3 Surabaya yang berdedikasi tinggi dalam mendidik dan membimbing siswa." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('teachers.index.public') }}" />
@endsection

@section('content')
<main class="pt-32 pb-24 bg-[#FAF9F6] min-h-screen">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <!-- Page Header -->
        <div class="mb-16 text-center max-w-3xl mx-auto">
            <span class="text-secondary font-label-md tracking-widest uppercase mb-4 block">Tenaga Pendidik & Kependidikan</span>
            <h1 class="font-display-lg text-4xl md:text-5xl text-primary font-bold mb-6">Guru & Staff</h1>
            <p class="font-body-lg text-slate-500 text-base leading-relaxed">
                Profil jajaran guru pengajar dan staf administrasi SMA GIKI 3 Surabaya yang siap melayani dan mendukung kesuksesan proses akademis siswa.
            </p>
        </div>

        @if($teachers->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-3xl p-16 text-center border border-slate-100 shadow-sm max-w-lg mx-auto">
                <span class="material-symbols-outlined text-6xl text-slate-350 mb-4">group</span>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Data Guru & Staff</h3>
                <p class="text-slate-500 text-sm mb-6 leading-relaxed">
                    Maaf, saat ini daftar guru dan staff belum tersedia. Silakan kembali beberapa saat lagi.
                </p>
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-full text-sm font-semibold hover:bg-primary/95 transition duration-150">
                    <span class="material-symbols-outlined text-lg">home</span>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        @else
            <!-- Search & Filter Controls -->
            <div class="flex flex-col md:flex-row gap-6 justify-between items-center mb-12 max-w-5xl mx-auto w-full">
                <!-- Tabs Filters -->
                <div class="flex gap-2">
                    <button onclick="filterType('Semua')"
                            id="filter-btn-semua"
                            class="filter-tab-btn px-6 py-2.5 rounded-full text-sm font-bold border transition-all duration-300 bg-secondary text-white border-secondary shadow-md">
                        Semua
                    </button>
                    <button onclick="filterType('Guru')"
                            id="filter-btn-guru"
                            class="filter-tab-btn px-6 py-2.5 rounded-full text-sm font-bold border transition-all duration-300 bg-white text-slate-600 border-slate-200 hover:border-secondary hover:text-secondary">
                        Guru / Pendidik
                    </button>
                    <button onclick="filterType('Staf')"
                            id="filter-btn-staf"
                            class="filter-tab-btn px-6 py-2.5 rounded-full text-sm font-bold border transition-all duration-300 bg-white text-slate-600 border-slate-200 hover:border-secondary hover:text-secondary">
                        Staf / Tata Usaha
                    </button>
                </div>

                <!-- Live Search Bar -->
                <div class="relative w-full md:w-80">
                    <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                        <span class="material-symbols-outlined text-xl">search</span>
                    </span>
                    <input type="text"
                           id="teacher-search"
                           placeholder="Cari nama atau jabatan..."
                           onkeyup="searchTeachers()"
                           class="w-full pl-12 pr-4 py-3 rounded-full border border-slate-200 focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary text-sm bg-white text-slate-700 transition duration-300 shadow-sm">
                </div>
            </div>

            <!-- Card Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" id="teacher-grid">
                @foreach($teachers as $teacher)
                    @php
                        $isStaff = Str::contains(strtolower($teacher->position), ['staf', 'tata usaha', 'pustakawan', 'perpustakaan', 'administrasi', 'karyawan']);
                        $category = $isStaff ? 'Staf' : 'Guru';
                    @endphp
                    <div class="teacher-card rounded-[2rem] aspect-[3/4] overflow-hidden border border-outline-variant/20 shadow-sm relative group cursor-pointer hover-lift transition-all duration-300"
                         data-category="{{ $category }}"
                         data-name="{{ strtolower($teacher->name) }}"
                         data-position="{{ strtolower($teacher->position) }}">
                        
                        <!-- Photo -->
                        <div class="absolute inset-0 w-full h-full bg-slate-100">
                            @if($teacher->photo)
                                <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover img-zoom" loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 flex flex-col items-center justify-center text-slate-400">
                                    <span class="material-symbols-outlined text-6xl">account_circle</span>
                                </div>
                            @endif
                        </div>

                        <!-- Role badge (fades out on hover) -->
                        <div class="absolute bottom-4 left-4 bg-primary/95 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/10 shadow-md transition-opacity duration-300 group-hover:opacity-0 z-10">
                            <p class="text-[10px] font-bold text-secondary tracking-widest uppercase">{{ $category == 'Guru' ? 'PENDIDIK' : 'TATA USAHA' }}</p>
                        </div>

                        <!-- Hover Overlay (Blur and reveal name/position) -->
                        <div class="absolute inset-0 bg-primary/80 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6 text-white z-20 hover:backdrop-blur-md">
                            <span class="text-[10px] font-bold text-secondary tracking-widest uppercase mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75">
                                {{ $category == 'Guru' ? 'GIGA TEACHER' : 'GIGA STAFF' }}
                            </span>
                            <h3 class="font-bold text-lg text-white mb-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100 line-clamp-2">
                                {{ $teacher->name }}
                            </h3>
                            <p class="text-xs text-slate-200 leading-relaxed transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-150 line-clamp-3">
                                {{ $teacher->position }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- No results view -->
            <div id="no-results" class="hidden bg-white rounded-3xl p-16 text-center border border-slate-100 shadow-sm max-w-lg mx-auto mt-8">
                <span class="material-symbols-outlined text-6xl text-slate-350 mb-4">search_off</span>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Tidak Ditemukan</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Maaf, tidak ada guru atau staff dengan kata kunci tersebut.
                </p>
            </div>
        @endif
    </div>
</main>
@endsection

@section('scripts')
<script>
    let activeCategory = 'Semua';
    let searchQuery = '';

    function filterType(category) {
        activeCategory = category;
        const buttons = document.querySelectorAll('.filter-tab-btn');
        
        buttons.forEach(btn => {
            btn.classList.remove('bg-secondary', 'text-white', 'border-secondary', 'shadow-md');
            btn.classList.add('bg-white', 'text-slate-600', 'border-slate-200');
        });

        const activeBtn = document.getElementById('filter-btn-' + category.toLowerCase());
        if (activeBtn) {
            activeBtn.classList.remove('bg-white', 'text-slate-600', 'border-slate-200');
            activeBtn.classList.add('bg-secondary', 'text-white', 'border-secondary', 'shadow-md');
        }

        applyFilters();
    }

    function searchTeachers() {
        searchQuery = document.getElementById('teacher-search').value.toLowerCase().trim();
        applyFilters();
    }

    function applyFilters() {
        const cards = document.querySelectorAll('.teacher-card');
        const noResults = document.getElementById('no-results');
        let visibleCount = 0;

        cards.forEach(card => {
            const category = card.getAttribute('data-category');
            const name = card.getAttribute('data-name');
            const position = card.getAttribute('data-position');

            const matchesCategory = (activeCategory === 'Semua' || category === activeCategory);
            const matchesSearch = (name.includes(searchQuery) || position.includes(searchQuery));

            if (matchesCategory && matchesSearch) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }
</script>
@endsection
