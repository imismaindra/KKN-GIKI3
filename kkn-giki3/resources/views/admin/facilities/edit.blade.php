@extends('layouts.admin')

@section('title', 'Edit Fasilitas')
@section('page_title', 'Edit Fasilitas')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.facilities.index') }}" class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ route('admin.facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Nama Fasilitas</label>
            <input type="text" name="name" id="name" value="{{ old('name', $facility->name) }}" required autofocus
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="icon" class="block text-sm font-semibold text-slate-700 mb-1">Nama Ikon / Kode Class SVG (Opsional)</label>
            <input type="text" name="icon" id="icon" value="{{ old('icon', $facility->icon) }}"
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            @error('icon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar Fasilitas Saat Ini</label>
            <div class="w-48 h-32 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden mb-3">
                @if($facility->image_path)
                    <img src="{{ Storage::url($facility->image_path) }}" alt="{{ $facility->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-xs text-slate-400 font-medium">Belum ada gambar</div>
                @endif
            </div>
            
            <label for="image_path" class="block text-sm font-semibold text-slate-700 mb-1">Ganti Gambar Fasilitas (Opsional)</label>
            <input type="file" name="image_path" id="image_path" accept="image/*"
                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-150 cursor-pointer">
            <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengganti gambar. Maksimal 2MB.</p>
            @error('image_path') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi Singkat</label>
            <textarea name="description" id="description" rows="4" required
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">{{ old('description', $facility->description) }}</textarea>
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
