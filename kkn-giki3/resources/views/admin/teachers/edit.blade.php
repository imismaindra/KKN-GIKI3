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
            <input type="text" name="position" id="position" value="{{ old('position', $teacher->position) }}" required
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            @error('position') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Saat Ini</label>
            <div class="w-32 h-40 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden mb-3">
                @if($teacher->photo)
                    <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-xs text-slate-400 font-medium">Belum ada foto</div>
                @endif
            </div>
            
            <label for="photo" class="block text-sm font-semibold text-slate-700 mb-1">Ganti Foto Profil (Opsional)</label>
            <input type="file" name="photo" id="photo" accept="image/*"
                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-150 cursor-pointer">
            <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengganti foto. Maksimal 2MB.</p>
            @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="order" class="block text-sm font-semibold text-slate-700 mb-1">Nomor Urutan Tampil</label>
            <input type="number" name="order" id="order" value="{{ old('order', $teacher->order) }}" min="0" required
                class="w-48 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            <p class="text-xs text-slate-400 mt-1">Urutan tampil.</p>
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
