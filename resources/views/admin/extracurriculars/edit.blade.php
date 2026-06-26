@extends('layouts.admin')

@section('title', 'Edit Ekstrakurikuler')
@section('page_title', 'Edit Ekstrakurikuler')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.extracurriculars.index') }}" class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ route('admin.extracurriculars.update', $extracurricular->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Nama Ekstrakurikuler</label>
            <input type="text" name="name" id="name" value="{{ old('name', $extracurricular->name) }}" required placeholder="Contoh: Futsal, Paduan Suara, PMR"
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="category" class="block text-sm font-semibold text-slate-700 mb-1">Kategori</label>
                <select name="category" id="category" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Olahraga" {{ old('category', $extracurricular->category) == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                    <option value="Seni & Budaya" {{ old('category', $extracurricular->category) == 'Seni & Budaya' ? 'selected' : '' }}>Seni & Budaya</option>
                    <option value="Sains & Teknologi" {{ old('category', $extracurricular->category) == 'Sains & Teknologi' ? 'selected' : '' }}>Sains & Teknologi</option>
                    <option value="Kepanduan" {{ old('category', $extracurricular->category) == 'Kepanduan' ? 'selected' : '' }}>Kepanduan</option>
                    <option value="Sosial & Kesehatan" {{ old('category', $extracurricular->category) == 'Sosial & Kesehatan' ? 'selected' : '' }}>Sosial & Kesehatan</option>
                    <option value="Keagamaan" {{ old('category', $extracurricular->category) == 'Keagamaan' ? 'selected' : '' }}>Keagamaan</option>
                    <option value="Akademik" {{ old('category', $extracurricular->category) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                </select>
                @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="pembina" class="block text-sm font-semibold text-slate-700 mb-1">Pembina / Pelatih</label>
                <input type="text" name="pembina" id="pembina" value="{{ old('pembina', $extracurricular->pembina) }}" placeholder="Contoh: Dra. Sri Utami / Coach Rudy"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                @error('pembina') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="schedule" class="block text-sm font-semibold text-slate-700 mb-1">Jadwal Latihan</label>
            <input type="text" name="schedule" id="schedule" value="{{ old('schedule', $extracurricular->schedule) }}" placeholder="Contoh: Sabtu, 08.00 - 10.00 WIB"
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            @error('schedule') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Pilih Ikon (Opsional)</label>
            <input type="hidden" name="icon" id="icon-input" value="{{ old('icon', $extracurricular->icon) }}">

            <div class="flex items-center space-x-4">
                <div id="icon-preview-wrapper" class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-700 shadow-inner">
                    <span id="selected-icon-display" class="material-symbols-outlined text-3xl">{{ old('icon', $extracurricular->icon ?: 'help_outline') }}</span>
                </div>
                
                <div class="flex-1 relative">
                    <button type="button" onclick="toggleIconPicker()" class="w-full flex items-center justify-between px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-700 text-left transition duration-150">
                        <span id="selected-icon-text" class="truncate font-medium">
                            {{ old('icon', $extracurricular->icon) ? 'Ikon terpilih: ' . old('icon', $extracurricular->icon) : 'Pilih dari daftar ikon...' }}
                        </span>
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Visual Icon Picker Panel -->
            <div id="icon-picker-panel" class="hidden mt-3 p-4 bg-white border border-slate-100 rounded-2xl shadow-xl space-y-4 max-h-80 overflow-y-auto z-20 relative">
                <div class="relative">
                    <input type="text" id="icon-search-input" onkeyup="filterIcons()" placeholder="Cari nama ikon (contoh: bola, tari, musik)..."
                        class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 text-sm text-slate-700 transition">
                </div>

                <div class="grid grid-cols-4 sm:grid-cols-6 gap-2" id="icon-grid">
                    <button type="button" onclick="selectIcon('sports_basketball', 'Basket')" data-name="sports_basketball olahraga basket bola lapangan" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">sports_basketball</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Basket</span>
                    </button>
                    <button type="button" onclick="selectIcon('sports_soccer', 'Futsal')" data-name="sports_soccer olahraga futsal sepakbola bola" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">sports_soccer</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Futsal</span>
                    </button>
                    <button type="button" onclick="selectIcon('palette', 'Seni')" data-name="palette tari lukis seni lukis gambar lukisan" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">palette</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Seni Lukis</span>
                    </button>
                    <button type="button" onclick="selectIcon('music_note', 'Musik')" data-name="music_note musik lagu paduan suara padus menyanyi" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">music_note</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Musik</span>
                    </button>
                    <button type="button" onclick="selectIcon('precision_manufacturing', 'Robotika')" data-name="precision_manufacturing robotika robot teknologi komputer pemrograman" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">precision_manufacturing</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Robotika</span>
                    </button>
                    <button type="button" onclick="selectIcon('forest', 'Pramuka')" data-name="forest pramuka kemah rimba kepanduan outdoor alam" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">forest</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Pramuka</span>
                    </button>
                    <button type="button" onclick="selectIcon('medical_services', 'PMR')" data-name="medical_services pmr kesehatan obat pertolongan pertama p3k medis uks" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">medical_services</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">PMR</span>
                    </button>
                    <button type="button" onclick="selectIcon('military_tech', 'Paskibra')" data-name="military_tech paskibra baris upacara bendera kepemimpinan" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">military_tech</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Paskibra</span>
                    </button>
                    <button type="button" onclick="selectIcon('self_improvement', 'Pencak Silat')" data-name="self_improvement bela diri pencak silat silat karate taekwondo olahraga" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">self_improvement</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Silat</span>
                    </button>
                    <button type="button" onclick="selectIcon('public', 'Karya Ilmiah')" data-name="public karya ilmiah remaja kir penelitian sains akademik" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">public</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">KIR</span>
                    </button>
                    <button type="button" onclick="selectIcon('theater_comedy', 'Teater')" data-name="theater_comedy teater drama seni panggung komedi akting" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">theater_comedy</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Teater</span>
                    </button>
                    <button type="button" onclick="selectIcon('menu_book', 'Jurnalistik')" data-name="menu_book jurnalistik nulis artikel majalah mading sekolah" class="icon-option-btn p-3 rounded-xl hover:bg-blue-50 border border-transparent hover:border-blue-100 flex flex-col items-center gap-1 group transition">
                        <span class="material-symbols-outlined text-2xl text-slate-600 group-hover:text-blue-600">menu_book</span>
                        <span class="text-[10px] text-slate-400 group-hover:text-blue-500 text-center truncate w-full">Mading</span>
                    </button>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center space-x-2">
                    <span class="text-xs text-slate-400 whitespace-nowrap">Atau input nama ikon kustom:</span>
                    <input type="text" id="custom-icon-input" oninput="applyCustomIcon(this.value)" placeholder="contoh: sports_tennis, brush"
                        class="flex-1 px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-blue-500 text-xs text-slate-700">
                </div>
            </div>
            @error('icon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Gambar Kegiatan / Cover (Opsional)</label>
            
            <div id="image-dropzone" class="border-2 border-dashed border-slate-200 hover:border-blue-500 rounded-2xl p-6 bg-slate-50 transition cursor-pointer relative flex flex-col items-center justify-center text-center group min-h-[160px]">
                <input type="file" name="image_path" id="image_path" accept="image/*" onchange="previewImage(event)"
                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10">
                
                @php
                    $hasImage = !empty($extracurricular->image_path);
                    $imageUrl = '';
                    if ($hasImage) {
                        $imageUrl = Str::startsWith($extracurricular->image_path, 'http') 
                            ? $extracurricular->image_path 
                            : Storage::url($extracurricular->image_path);
                    }
                @endphp

                <div id="image-placeholder-wrapper" class="space-y-2 {{ $hasImage ? 'hidden' : '' }}">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto transition group-hover:scale-110">
                        <span class="material-symbols-outlined text-2xl">add_photo_alternate</span>
                    </div>
                    <div class="text-sm font-semibold text-slate-700">Pilih atau Tarik File Gambar</div>
                    <div class="text-xs text-slate-400">Rasio mendatar diutamakan. Maksimal 2MB.</div>
                </div>

                <div id="image-preview-container" class="w-full max-w-md aspect-video rounded-xl overflow-hidden relative border border-slate-200 {{ $hasImage ? '' : 'hidden' }}">
                    <img id="image-preview-el" class="w-full h-full object-cover" src="{{ $imageUrl }}">
                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 hover:opacity-100 flex items-center justify-center text-white font-semibold text-sm transition">
                        Ganti Gambar
                    </div>
                </div>
            </div>
            @error('image_path') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Kegiatan</label>
            <textarea name="description" id="description" rows="4" required placeholder="Jelaskan mengenai tujuan ekskul, kegiatan, syarat anggota, prestasi, dll."
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">{{ old('description', $extracurricular->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-50">
            <button type="submit"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition duration-150 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20">
                Pembaruan Ekstrakurikuler
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
