@extends('layouts.admin')

@section('title', 'Edit Guru/Staf')
@section('page_title', 'Edit Guru/Staf')

@section('content')
<div class="max-w-2xl">
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
            <label for="position" class="block text-sm font-semibold text-slate-700 mb-1">Jabatan / Guru Bidang Studi</label>
            <input type="text" name="position" id="position" value="{{ old('position', $teacher->position) }}" required placeholder="Contoh: Guru Matematika / Kepala Sekolah" list="positions-list"
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            <datalist id="positions-list">
                <option value="Kepala Sekolah">
                <option value="Wakil Kepala Sekolah Bidang Kurikulum">
                <option value="Wakil Kepala Sekolah Bidang Kesiswaan">
                <option value="Wakil Kepala Sekolah Bidang Humas">
                <option value="Wakil Kepala Sekolah Bidang Sarana & Prasarana">
                <option value="Guru Bimbingan Konseling (BK)">
                <option value="Guru Bahasa Indonesia">
                <option value="Guru Bahasa Inggris">
                <option value="Guru Matematika">
                <option value="Guru Pendidikan Jasmani (PJOK)">
                <option value="Guru Seni Budaya">
                <option value="Guru IPA (Fisika/Kimia/Biologi)">
                <option value="Guru IPS (Sejarah/Sosiologi/Ekonomi)">
                <option value="Guru Pendidikan Agama & Budi Pekerti">
                <option value="Staf Tata Usaha">
                <option value="Pustakawan">
            </datalist>
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

        <div>
            <label for="order" class="block text-sm font-semibold text-slate-700 mb-1">Nomor Urutan Tampil</label>
            <div class="flex items-center space-x-2">
                <input type="number" name="order" id="order" value="{{ old('order', $teacher->order) }}" min="0" required
                    class="w-32 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                <span class="text-xs text-slate-400">Mengatur posisi urutan tampil di web utama.</span>
            </div>
            <p class="text-xs text-slate-400 mt-2 bg-slate-50 border border-slate-100 p-3 rounded-xl leading-relaxed">
                <strong>💡 Info Urutan:</strong> Urutan tampil dimulai dari angka terkecil ke terbesar.
                <br>Contoh: <strong>1</strong> (Kepala Sekolah), <strong>2</strong> (Wakil Kepala Sekolah), <strong>3</strong> (Guru Mata Pelajaran), dst.
            </p>
            @error('order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
</script>
@endpush
