@extends('layouts.admin')

@section('title', 'Edit Guru/Staf')
@section('page_title', 'Edit Guru/Staf')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.teachers.index') }}" class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap beserta Gelar</label>
            <input type="text" name="name" id="name" value="{{ old('name', $teacher->name) }}" required autofocus
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <!-- Hidden input to store comma-separated values -->
            <input type="hidden" name="position" id="position" value="{{ old('position', $teacher->position) }}">
            
            <div class="relative" id="multiselect-container">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Jabatan / Guru Bidang Studi</label>
                
                <!-- Custom Multi-Select Input Box -->
                <div id="multiselect-trigger" class="min-h-[46px] w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus-within:ring-2 focus-within:ring-blue-500/20 focus-within:border-blue-500 text-slate-800 transition duration-150 flex flex-wrap gap-2 items-center cursor-pointer">
                    <!-- Selected items will be inserted here by JS -->
                    <span id="multiselect-placeholder" class="text-slate-400 text-sm select-none">Pilih satu atau lebih jabatan...</span>
                    
                    <!-- Input field for filtering/adding custom values -->
                    <input type="text" id="multiselect-search" class="flex-grow min-w-[120px] bg-transparent border-none outline-none p-0 text-sm focus:ring-0 text-slate-800">
                    
                    <!-- Dropdown arrow -->
                    <div class="ml-auto flex items-center pl-2">
                        <span class="material-symbols-outlined text-slate-400 text-xl transition-transform duration-200" id="multiselect-arrow">expand_more</span>
                    </div>
                </div>
                
                <!-- Dropdown Options List -->
                <div id="multiselect-dropdown" class="hidden absolute left-0 right-0 mt-1 bg-white border border-slate-200 rounded-xl shadow-xl max-h-60 overflow-y-auto z-50 py-1 divide-y divide-slate-50">
                    <!-- Predefined options populated by JS -->
                </div>
            </div>
            <p class="text-xs text-slate-400 mt-1.5">Anda dapat memilih lebih dari satu jabatan. Tekan <strong>Enter</strong> setelah mengetik untuk menambahkan jabatan baru.</p>
            @error('position') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Foto Profil / Pasfoto (Opsional)</label>
            
            <div id="image-dropzone" class="border-2 border-dashed border-slate-200 hover:border-blue-500 rounded-2xl p-6 bg-slate-50 transition cursor-pointer relative flex flex-col items-center justify-center text-center group min-h-[220px]">
                <input type="file" name="photo" id="photo" accept="image/*" onchange="previewImage(event)"
                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10">
                
                <div id="image-placeholder-wrapper" class="{{ $teacher->photo ? 'hidden' : '' }} space-y-2">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto transition group-hover:scale-110">
                        <span class="material-symbols-outlined text-2xl">account_box</span>
                    </div>
                    <div class="text-sm font-semibold text-slate-700">Pilih atau Tarik Pasfoto Guru Baru</div>
                    <div class="text-xs text-slate-400">Rasio pasfoto formal 3x4 diutamakan. Maksimal 2MB.</div>
                </div>

                <div id="image-preview-container" class="{{ $teacher->photo ? '' : 'hidden' }} w-36 h-48 rounded-xl overflow-hidden relative border border-slate-200 bg-white shadow-sm">
                    <img id="image-preview-el" src="{{ $teacher->photo ? Storage::url($teacher->photo) : '' }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 hover:opacity-100 flex items-center justify-center text-white font-semibold text-xs transition">
                        Ganti Foto
                    </div>
                </div>
            </div>
            <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengganti foto.</p>
            @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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

    document.addEventListener("DOMContentLoaded", () => {
        const predefinedOptions = @json(\App\Models\Teacher::getPredefinedPositions());
        let selectedOptions = [];

        const container = document.getElementById('multiselect-container');
        const trigger = document.getElementById('multiselect-trigger');
        const searchInput = document.getElementById('multiselect-search');
        const dropdown = document.getElementById('multiselect-dropdown');
        const arrow = document.getElementById('multiselect-arrow');
        const hiddenInput = document.getElementById('position');
        const placeholder = document.getElementById('multiselect-placeholder');

        // Initialize selected options from existing value
        const rawPositionVal = hiddenInput.value;
        if (rawPositionVal) {
            selectedOptions = rawPositionVal.split(',').map(s => s.trim()).filter(Boolean);
        }

        function renderBadges() {
            // Remove existing badges
            const existingBadges = trigger.querySelectorAll('.selected-badge');
            existingBadges.forEach(b => b.remove());
            
            if (selectedOptions.length > 0) {
                placeholder.classList.add('hidden');
                // Insert badges before the search input
                selectedOptions.forEach(opt => {
                    const badge = document.createElement('span');
                    badge.className = 'selected-badge inline-flex items-center gap-1 px-2.5 py-0.5 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg border border-blue-100/50';
                    badge.innerHTML = `
                        <span>${opt}</span>
                        <button type="button" class="ml-1.5 inline-flex items-center justify-center w-3.5 h-3.5 rounded-full text-blue-400 hover:text-blue-600 hover:bg-blue-100/50 transition duration-150 focus:outline-none" data-option="${opt}">
                            <span class="material-symbols-outlined text-[10px] font-black pointer-events-none">close</span>
                        </button>
                    `;
                    trigger.insertBefore(badge, searchInput);
                });
                
                // Add event listeners to delete buttons
                trigger.querySelectorAll('button[data-option]').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const opt = btn.getAttribute('data-option');
                        removeOption(opt);
                    });
                });
            } else {
                placeholder.classList.remove('hidden');
            }
            
            // Update hidden input value
            hiddenInput.value = selectedOptions.join(', ');
        }

        function removeOption(option) {
            selectedOptions = selectedOptions.filter(o => o !== option);
            renderBadges();
            renderDropdownOptions();
        }

        function addOption(option) {
            option = option.trim();
            if (option && !selectedOptions.includes(option)) {
                selectedOptions.push(option);
                renderBadges();
            }
            searchInput.value = '';
            renderDropdownOptions();
        }

        function renderDropdownOptions() {
            dropdown.innerHTML = '';
            const query = searchInput.value.toLowerCase().trim();
            
            // Filter predefined options that are not already selected and match query
            let filtered = predefinedOptions.filter(opt => !selectedOptions.includes(opt));
            if (query) {
                filtered = filtered.filter(opt => opt.toLowerCase().includes(query));
            }
            
            if (filtered.length > 0) {
                filtered.forEach(opt => {
                    const item = document.createElement('div');
                    item.className = 'px-4 py-2.5 hover:bg-slate-50 cursor-pointer text-slate-700 text-sm transition';
                    item.innerText = opt;
                    item.addEventListener('click', (e) => {
                        e.stopPropagation();
                        addOption(opt);
                    });
                    dropdown.appendChild(item);
                });
            }
            
            // Add custom typed option if it's not already in predefined/selected list
            if (query && !predefinedOptions.includes(searchInput.value) && !selectedOptions.includes(searchInput.value)) {
                const customItem = document.createElement('div');
                customItem.className = 'px-4 py-2.5 hover:bg-slate-50 cursor-pointer text-blue-600 font-semibold text-sm transition border-t border-slate-50';
                customItem.innerHTML = `Tambah "<strong>${searchInput.value}</strong>"...`;
                customItem.addEventListener('click', (e) => {
                    e.stopPropagation();
                    addOption(searchInput.value);
                });
                dropdown.appendChild(customItem);
            }
            
            if (dropdown.children.length === 0) {
                const noItem = document.createElement('div');
                noItem.className = 'px-4 py-2.5 text-slate-400 text-xs italic';
                noItem.innerText = 'Tidak ada pilihan';
                dropdown.appendChild(noItem);
            }
        }

        // Show/Hide dropdown
        function showDropdown() {
            dropdown.classList.remove('hidden');
            arrow.classList.add('rotate-180');
            renderDropdownOptions();
        }

        function hideDropdown() {
            dropdown.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }

        // Events
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            searchInput.focus();
            showDropdown();
        });

        searchInput.addEventListener('focus', showDropdown);
        searchInput.addEventListener('input', showDropdown);

        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                const val = searchInput.value.trim();
                if (val) {
                    addOption(val);
                }
            } else if (e.key === 'Backspace' && !searchInput.value && selectedOptions.length > 0) {
                // Remove last item on backspace if input is empty
                selectedOptions.pop();
                renderBadges();
                renderDropdownOptions();
            }
        });

        // Close dropdown on click outside
        document.addEventListener('click', (e) => {
            if (!container.contains(e.target)) {
                hideDropdown();
            }
        });

        // Initial render
        renderBadges();

        // Sync and validate on submit
        const form = trigger.closest('form');
        form.addEventListener('submit', (e) => {
            if (selectedOptions.length === 0) {
                e.preventDefault();
                alert('Silakan pilih atau ketik minimal satu jabatan terlebih dahulu.');
            }
        });
    });
</script>
@endpush
