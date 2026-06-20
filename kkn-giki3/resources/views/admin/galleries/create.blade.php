@extends('layouts.admin')

@section('title', 'Unggah Galeri')
@section('page_title', 'Unggah Foto Galeri Baru')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.galleries.index') }}" class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
        @csrf
        
        <div>
            <label for="title" class="block text-sm font-semibold text-slate-700 mb-1">Judul / Nama Kegiatan</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus placeholder="Contoh: Upacara Hari Kemerdekaan RI"
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="images" class="block text-sm font-semibold text-slate-700 mb-1">Pilih File Foto (Bisa lebih dari 1)</label>
            <input type="file" name="images[]" id="images" accept="image/*" multiple required
                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-150 cursor-pointer">
            <p class="text-xs text-slate-400 mt-1">Dapat memilih beberapa foto sekaligus. Maksimal 5MB per file.</p>
            @error('images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-1">Keterangan Singkat (Opsional)</label>
            <textarea name="description" id="description" rows="3" placeholder="Tulis keterangan atau penjelasan singkat tentang foto kegiatan ini..."
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-50">
            <button type="submit"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition duration-150 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20">
                Simpan Foto
            </button>
        </div>
    </form>
</div>
@endsection
