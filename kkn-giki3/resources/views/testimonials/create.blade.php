@extends('layouts.app')

@section('title', 'Kirim Testimoni - SMA GIKI 3 Surabaya')

@section('content')
<main class="pt-28 pb-section-gap min-h-screen bg-gradient-to-b from-slate-50 via-slate-100 to-slate-200">
    <div class="max-w-3xl mx-auto px-margin-mobile md:px-margin-desktop py-12">
        
        <!-- Header -->
        <div class="text-center mb-10 fade-up visible">
            <span class="text-secondary font-label-md tracking-widest uppercase mb-2 block">Ulasan Anda Sangat Berarti</span>
            <h1 class="font-display-lg-mobile md:font-display-lg text-primary text-3xl md:text-5xl font-black mb-4">
                Berikan Testimoni Anda
            </h1>
            <p class="font-body-lg text-on-surface-variant max-w-xl mx-auto text-sm md:text-base leading-relaxed">
                Bagikan pengalaman, pesan, kesan, atau ulasan positif Anda selama menjadi bagian dari keluarga besar SMA GIKI 3 Surabaya.
            </p>
        </div>

        @if(session('success'))
            <!-- Success Message Card -->
            <div class="bg-white rounded-[2rem] border border-outline-variant/20 p-8 md:p-12 text-center shadow-xl fade-up visible transition-all transform hover:scale-[1.01] duration-300">
                <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-500 mx-auto mb-6 shadow-inner animate-pulse">
                    <span class="material-symbols-outlined text-5xl">check_circle</span>
                </div>
                <h3 class="text-2xl font-bold text-primary mb-3">Terkirim!</h3>
                <p class="text-slate-600 text-sm md:text-base leading-relaxed max-w-md mx-auto mb-8">
                    {{ session('success') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/') }}" class="btn-primary bg-primary text-on-primary font-bold text-label-md px-8 py-3.5 rounded-full hover:bg-primary/95 transition duration-300">
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('testimonials.create.public') }}" class="btn-primary bg-white text-primary border border-primary/20 font-bold text-label-md px-8 py-3.5 rounded-full hover:bg-slate-50 transition duration-300">
                        Kirim Ulasan Lain
                    </a>
                </div>
            </div>
        @else
            <!-- Submission Form Card -->
            <div class="bg-white rounded-[2rem] border border-outline-variant/10 p-6 md:p-10 shadow-xl fade-up visible transition-all duration-300">
                <form action="{{ route('testimonials.store.public') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="publicTestimonialForm">
                    @csrf

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-lg text-slate-400">person</span>
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap Anda"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-secondary/10 focus:border-secondary text-slate-800 transition duration-150">
                        @error('name') 
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</p> 
                        @enderror
                    </div>

                    <!-- Relationship Field (Select/Dropdown + Custom Text Input) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="role_select" class="block text-sm font-semibold text-slate-700 mb-1.5 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-lg text-slate-400">groups</span>
                                Status / Hubungan <span class="text-red-500">*</span>
                            </label>
                            <select id="role_select" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-secondary/10 focus:border-secondary text-slate-800 transition duration-150">
                                <option value="">Pilih Status</option>
                                <option value="Siswa Aktif" {{ old('relationship') == 'Siswa Aktif' ? 'selected' : '' }}>Siswa Aktif</option>
                                <option value="Alumni" {{ str_contains(old('relationship', ''), 'Alumni') ? 'selected' : '' }}>Alumni</option>
                                <option value="Orang Tua / Wali Murid" {{ old('relationship') == 'Orang Tua / Wali Murid' ? 'selected' : '' }}>Orang Tua / Wali Murid</option>
                                <option value="Guru / Staff" {{ old('relationship') == 'Guru / Staff' ? 'selected' : '' }}>Guru / Staff</option>
                                <option value="Lainnya" {{ (old('relationship') && !in_array(old('relationship'), ['Siswa Aktif', 'Alumni', 'Orang Tua / Wali Murid', 'Guru / Staff'])) ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <input type="hidden" name="relationship" id="relationship" value="{{ old('relationship') }}">
                            @error('relationship') 
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</p> 
                            @enderror
                        </div>

                        <!-- Dynamic Relationship input for customized values -->
                        <div id="custom_relationship_container" class="hidden">
                            <label for="custom_relationship" class="block text-sm font-semibold text-slate-700 mb-1.5 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-lg text-slate-400">edit_note</span>
                                Hubungan Spesifik <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="custom_relationship" placeholder="Contoh: Alumni Angkatan 2020 / Komite Sekolah"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-secondary/10 focus:border-secondary text-slate-800 transition duration-150">
                        </div>
                    </div>

                    <!-- Interactive Star Rating -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-lg text-slate-400">star</span>
                            Rating Ulasan (Opsional)
                        </label>
                        <div class="flex items-center gap-2" id="star-rating-container">
                            <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', '') }}">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" data-rating="{{ $i }}" class="star-btn text-slate-300 hover:scale-110 transition duration-150 focus:outline-none">
                                    <svg class="w-9 h-9 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                </button>
                            @endfor
                            <span class="text-sm font-semibold text-slate-500 ml-2" id="rating-text">Pilih rating</span>
                        </div>
                        @error('rating') 
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</p> 
                        @enderror
                    </div>

                    <!-- Photo Upload File field with Preview -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-lg text-slate-400">image</span>
                            Foto Profil / Avatar <span class="text-slate-400 font-normal">(Opsional)</span>
                        </label>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-200">
                            <!-- Avatar Preview Box -->
                            <div class="w-20 h-20 rounded-full border-2 border-slate-200 bg-slate-100 overflow-hidden flex items-center justify-center flex-shrink-0 relative group">
                                <img id="avatar-preview" src="" class="w-full h-full object-cover hidden">
                                <span id="avatar-placeholder" class="material-symbols-outlined text-3xl text-slate-400">account_circle</span>
                            </div>
                            
                            <!-- File input -->
                            <div class="flex-grow w-full">
                                <input type="file" name="avatar" id="avatar" accept="image/*" class="hidden">
                                <button type="button" onclick="document.getElementById('avatar').click()" 
                                    class="w-full sm:w-auto px-5 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-xl text-sm font-semibold shadow-sm transition flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-lg">upload</span>
                                    Pilih Foto
                                </button>
                                <p class="text-xs text-slate-400 mt-2">Format: JPG, JPEG, PNG. Ukuran file maksimal 2MB.</p>
                            </div>
                        </div>
                        @error('avatar') 
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</p> 
                        @enderror
                    </div>

                    <!-- Content textarea -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-slate-700 mb-1.5 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-lg text-slate-400">rate_review</span>
                            Isi Testimoni <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" id="content" rows="5" required placeholder="Tuliskan pengalaman, kesan, atau ulasan positif Anda di sini..."
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-secondary/10 focus:border-secondary text-slate-800 transition duration-150">{{ old('content') }}</textarea>
                        @error('content') 
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</p> 
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 border-t border-slate-100 flex justify-end">
                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-4 bg-primary hover:bg-primary/95 text-white font-bold rounded-full transition duration-150 shadow-lg hover:shadow-xl active:scale-95 flex items-center justify-center gap-2 text-base">
                            <span>Kirim Testimoni</span>
                            <span class="material-symbols-outlined text-xl">send</span>
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const roleSelect = document.getElementById('role_select');
        const customRelContainer = document.getElementById('custom_relationship_container');
        const customRelInput = document.getElementById('custom_relationship');
        const hiddenRelInput = document.getElementById('relationship');

        // Dropdown selection handler
        function updateRelationship() {
            const selectedVal = roleSelect.value;
            if (selectedVal === 'Lainnya') {
                customRelContainer.classList.remove('hidden');
                customRelInput.setAttribute('required', 'required');
                hiddenRelInput.value = customRelInput.value;
            } else {
                customRelContainer.classList.add('hidden');
                customRelInput.removeAttribute('required');
                hiddenRelInput.value = selectedVal;
            }
        }

        if (roleSelect) {
            roleSelect.addEventListener('change', updateRelationship);
        }

        if (customRelInput) {
            customRelInput.addEventListener('input', () => {
                if (roleSelect.value === 'Lainnya') {
                    hiddenRelInput.value = customRelInput.value;
                }
            });
        }

        // Initialize relations on page load (handles old input)
        if (roleSelect) {
            const selectedVal = roleSelect.value;
            if (selectedVal === 'Lainnya') {
                customRelContainer.classList.remove('hidden');
                customRelInput.value = "{{ old('relationship') }}";
                updateRelationship();
            }
        }

        // Interactive Star Rating Handler
        const starButtons = document.querySelectorAll('.star-btn');
        const ratingInput = document.getElementById('rating-input');
        const ratingText = document.getElementById('rating-text');
        
        const ratingLabels = {
            1: "Sangat Buruk",
            2: "Buruk",
            3: "Cukup Baik",
            4: "Sangat Baik",
            5: "Sempurna"
        };

        function setStars(ratingValue) {
            starButtons.forEach(btn => {
                const val = parseInt(btn.getAttribute('data-rating'));
                if (val <= ratingValue) {
                    btn.classList.remove('text-slate-300');
                    btn.classList.add('text-amber-400');
                } else {
                    btn.classList.remove('text-amber-400');
                    btn.classList.add('text-slate-300');
                }
            });
            ratingText.innerText = ratingLabels[ratingValue] || "Pilih rating";
        }

        starButtons.forEach(btn => {
            // Click Handler
            btn.addEventListener('click', () => {
                const val = btn.getAttribute('data-rating');
                ratingInput.value = val;
                setStars(parseInt(val));
            });

            // Hover effects
            btn.addEventListener('mouseenter', () => {
                const val = parseInt(btn.getAttribute('data-rating'));
                setStars(val);
            });
        });

        const ratingContainer = document.getElementById('star-rating-container');
        if (ratingContainer) {
            ratingContainer.addEventListener('mouseleave', () => {
                const activeVal = parseInt(ratingInput.value) || 0;
                setStars(activeVal);
            });
        }

        // Initialize stars if old input exists
        if (ratingInput && ratingInput.value) {
            setStars(parseInt(ratingInput.value));
        }

        // File upload avatar preview handler
        const avatarInput = document.getElementById('avatar');
        const avatarPreview = document.getElementById('avatar-preview');
        const avatarPlaceholder = document.getElementById('avatar-placeholder');

        if (avatarInput) {
            avatarInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    // Check file size (2MB limit)
                    if (file.size > 2 * 1024 * 1024) {
                        alert("Ukuran file melebihi 2MB. Silakan pilih foto lain.");
                        avatarInput.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = (event) => {
                        avatarPreview.src = event.target.result;
                        avatarPreview.classList.remove('hidden');
                        avatarPlaceholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    avatarPreview.src = '';
                    avatarPreview.classList.add('hidden');
                    avatarPlaceholder.classList.remove('hidden');
                }
            });
        }
    });
</script>
@endsection
