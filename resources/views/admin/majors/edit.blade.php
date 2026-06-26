@extends('layouts.admin')

@section('title', 'Edit Jurusan')
@section('page_title', 'Edit Jurusan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.majors.index') }}" class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ route('admin.majors.update', $major->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Nama Jurusan / Program Keahlian</label>
            <input type="text" name="name" id="name" value="{{ old('name', $major->name) }}" required autofocus
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Pilih Ikon Jurusan (Opsional)</label>
            <input type="hidden" name="icon" id="icon-input" value="{{ old('icon', $major->icon) }}">

            <div class="flex items-center space-x-4">
                <div id="icon-preview-wrapper" class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-700 shadow-inner">
                    <span id="selected-icon-display" class="material-symbols-outlined text-3xl">{{ old('icon', $major->icon ?? 'help_outline') }}</span>
                </div>
                
                <div class="flex-1 relative">
                    <button type="button" onclick="toggleIconPicker()" class="w-full flex items-center justify-between px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-700 text-left transition duration-150">
                        <span id="selected-icon-text" class="truncate font-medium">{{ old('icon', $major->icon) ? 'Ikon terpilih: ' . old('icon', $major->icon) : 'Pilih dari daftar ikon...' }}</span>
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Visual Icon Picker Panel -->
            <div id="icon-picker-panel" class="hidden mt-3 p-4 bg-white border border-slate-100 rounded-2xl shadow-xl space-y-4 max-h-80 overflow-y-auto z-20 relative">
                <div class="relative">
                    <input type="text" id="icon-search-input" onkeyup="filterIcons()" placeholder="Cari nama ikon (contoh: rpl, teknik, desain)..."
                        class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 text-sm text-slate-700 transition">
                </div>

                <div class="grid grid-cols-4 sm:grid-cols-6 gap-2" id="icon-grid">
                    <button type="button" onclick="selectIcon('school', 'Sekolah')" data-name="school sekolah toga pendidikan akademik" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">school</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Sekolah</span>
                    </button>
                    <button type="button" onclick="selectIcon('menu_book', 'Buku')" data-name="menu_book buku belajar membaca perpustakaan" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">menu_book</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Buku</span>
                    </button>
                    <button type="button" onclick="selectIcon('workspace_premium', 'Prestasi')" data-name="workspace_premium prestasi piala penghargaan piagam" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">workspace_premium</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Prestasi</span>
                    </button>
                    <button type="button" onclick="selectIcon('meeting_room', 'Kelas')" data-name="meeting_room kelas pintu ruangan belajar" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">meeting_room</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Kelas</span>
                    </button>
                    <button type="button" onclick="selectIcon('computer', 'Lab Komputer')" data-name="computer lab komputer pc desktop monitor" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">computer</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Komputer</span>
                    </button>
                    <button type="button" onclick="selectIcon('science', 'Lab IPA')" data-name="science lab ipa kimia sains flask tabung" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">science</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Sains</span>
                    </button>
                    <button type="button" onclick="selectIcon('sports_basketball', 'Olahraga')" data-name="sports_basketball olahraga basket lapangan bola" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">sports_basketball</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Olahraga</span>
                    </button>
                    <button type="button" onclick="selectIcon('sports_soccer', 'Sepak Bola')" data-name="sports_soccer olahraga bola sepak lapangan futsal" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">sports_soccer</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Sepak Bola</span>
                    </button>
                    <button type="button" onclick="selectIcon('mosque', 'Masjid')" data-name="mosque masjid tempat ibadah musholla sholat" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">mosque</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Masjid</span>
                    </button>
                    <button type="button" onclick="selectIcon('restaurant', 'Kantin')" data-name="restaurant kantin makan piring sendok garpu kuliner" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">restaurant</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Kantin</span>
                    </button>
                    <button type="button" onclick="selectIcon('medical_services', 'UKS')" data-name="medical_services uks kesehatan pertolongan pertama obat" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">medical_services</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">UKS</span>
                    </button>
                    <button type="button" onclick="selectIcon('park', 'Taman')" data-name="park taman pohon hijau kebun halaman" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">park</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Taman</span>
                    </button>
                    <button type="button" onclick="selectIcon('code', 'RPL')" data-name="code rpl coding pemrograman komputasi software website IT" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">code</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">RPL / IT</span>
                    </button>
                    <button type="button" onclick="selectIcon('engineering', 'Teknik / Bengkel')" data-name="engineering bengkel mesin teknik perkakas otomotif industri" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">engineering</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Teknik</span>
                    </button>
                    <button type="button" onclick="selectIcon('palette', 'Seni / Desain')" data-name="palette seni lukis multimedia desain gambar fashion" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">palette</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Seni / Desain</span>
                    </button>
                    <button type="button" onclick="selectIcon('theater_comedy', 'Aula')" data-name="theater_comedy aula panggung auditorium seni tari drama" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">theater_comedy</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Aula</span>
                    </button>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center space-x-2">
                    <span class="text-xs text-slate-400 whitespace-nowrap">Atau input nama ikon kustom:</span>
                    <input type="text" id="custom-icon-input" oninput="applyCustomIcon(this.value)" placeholder="contoh: desk, local_library"
                        class="flex-1 px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-blue-500 text-xs text-slate-700">
                </div>
            </div>
            @error('icon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Gambar Sampul Jurusan (Opsional)</label>
            
            <div id="image-dropzone" class="border-2 border-dashed border-slate-200 hover:border-blue-500 rounded-2xl p-6 bg-slate-50 transition cursor-pointer relative flex flex-col items-center justify-center text-center group min-h-[160px]">
                <input type="file" name="image_path" id="image_path" accept="image/*" onchange="previewImage(event)"
                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10">
                
                <div id="image-placeholder-wrapper" class="{{ $major->image_path ? 'hidden' : '' }} space-y-2">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto transition group-hover:scale-110">
                        <span class="material-symbols-outlined text-2xl">add_photo_alternate</span>
                    </div>
                    <div class="text-sm font-semibold text-slate-700">Pilih atau Tarik File Gambar Baru</div>
                    <div class="text-xs text-slate-400">Rasio mendatar diutamakan. Maksimal 2MB.</div>
                </div>

                <div id="image-preview-container" class="{{ $major->image_path ? '' : 'hidden' }} w-full max-w-md aspect-video rounded-xl overflow-hidden relative border border-slate-200">
                    <img id="image-preview-el" src="{{ $major->image_path ? Storage::url($major->image_path) : '' }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 hover:opacity-100 flex items-center justify-center text-white font-semibold text-sm transition">
                        Ganti Gambar
                    </div>
                </div>
            </div>
            <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
            @error('image_path') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Singkat</label>
            <textarea name="description" id="description" rows="4" required
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">{{ old('description', $major->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-50">
            <button type="submit"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition duration-150 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function toggleIconPicker() {
        const panel = document.getElementById('icon-picker-panel');
        panel.classList.toggle('hidden');
    }

    function selectIcon(iconName, friendlyName) {
        document.getElementById('icon-input').value = iconName;
        document.getElementById('selected-icon-display').innerText = iconName;
        document.getElementById('selected-icon-text').innerText = 'Ikon terpilih: ' + iconName + ' (' + friendlyName + ')';
        document.getElementById('icon-picker-panel').classList.add('hidden');
        document.getElementById('custom-icon-input').value = '';
    }

    function applyCustomIcon(iconName) {
        const cleaned = iconName.trim().toLowerCase().replace(/\s+/g, '_');
        document.getElementById('icon-input').value = cleaned;
        document.getElementById('selected-icon-display').innerText = cleaned ? cleaned : 'help_outline';
        document.getElementById('selected-icon-text').innerText = cleaned ? 'Ikon kustom: ' + cleaned : 'Pilih dari daftar ikon...';
    }

    function filterIcons() {
        const query = document.getElementById('icon-search-input').value.toLowerCase();
        const buttons = document.querySelectorAll('.icon-option-btn');
        buttons.forEach(btn => {
            const tags = btn.getAttribute('data-name');
            if (tags.includes(query)) {
                btn.style.display = 'flex';
            } else {
                btn.style.display = 'none';
            }
        });
    }

    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function(){
            const dataURL = reader.result;
            const previewEl = document.getElementById('image-preview-el');
            const previewContainer = document.getElementById('image-preview-container');
            const placeholderWrapper = document.getElementById('image-placeholder-wrapper');
            
            previewEl.src = dataURL;
            previewContainer.classList.remove('hidden');
            placeholderWrapper.classList.add('hidden');
        };
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Close picker when clicking outside
    document.addEventListener('click', function(event) {
        const picker = document.getElementById('icon-picker-panel');
        const trigger = event.target.closest('button[onclick="toggleIconPicker()"]');
        const inside = event.target.closest('#icon-picker-panel');
        if (picker && !picker.classList.contains('hidden') && !trigger && !inside) {
            picker.classList.add('hidden');
        }
    });
</script>
@endpush
