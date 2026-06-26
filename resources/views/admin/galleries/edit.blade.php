@extends('layouts.admin')

@section('title', 'Edit Galeri')
@section('page_title', 'Edit Foto Galeri')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.galleries.index') }}" class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="title" class="block text-sm font-semibold text-slate-700 mb-1">Judul / Nama Kegiatan</label>
            <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}" required autofocus
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="space-y-4">
            <label class="block text-sm font-semibold text-slate-700">Foto Saat Ini (Centang foto yang ingin dihapus)</label>
            @error('images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach($gallery->images as $image)
                    <div class="relative aspect-square rounded-xl bg-slate-100 border border-slate-200 overflow-hidden group">
                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_img_{{ $image->id }}" class="hidden delete-checkbox">
                        
                        <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover transition duration-150">
                        
                        <!-- Overlay border and background when checked -->
                        <div class="absolute inset-0 bg-red-950/20 opacity-0 transition duration-150 border-2 border-red-500 rounded-xl pointer-events-none delete-overlay"></div>
                        
                        <label for="delete_img_{{ $image->id }}" class="absolute inset-0 flex flex-col justify-between p-3 cursor-pointer select-none">
                            <div class="flex justify-end">
                                <!-- Styled custom checkbox circle -->
                                <div class="w-6 h-6 rounded-full bg-white/90 border border-slate-200 flex items-center justify-center transition duration-150 check-circle shadow-sm">
                                    <svg class="w-3.5 h-3.5 opacity-0 transition duration-150 text-white check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>
                            <div class="opacity-0 scale-95 bg-red-600 text-white text-[9px] font-bold py-1 px-2.5 rounded-lg text-center uppercase tracking-wider transition duration-150 self-center shadow-md delete-badge">
                                Akan Dihapus
                            </div>
                        </label>
                    </div>
                @endforeach
            </div>
            
            <div class="pt-2">
                <label for="images" class="block text-sm font-semibold text-slate-700 mb-1">Tambah Foto Baru (Opsional)</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple
                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-150 cursor-pointer">
                <p class="text-xs text-slate-400 mt-1">Dapat memilih beberapa foto sekaligus. Maksimal 5MB per file.</p>
                @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-1">Keterangan Singkat (Opsional)</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">{{ old('description', $gallery->description) }}</textarea>
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

@push('styles')
<style>
    .delete-checkbox:checked ~ img {
        opacity: 0.3;
        filter: grayscale(100%);
    }
    .delete-checkbox:checked ~ .delete-overlay {
        opacity: 1;
    }
    .delete-checkbox:checked ~ label .check-circle {
        background-color: #ef4444 !important;
        border-color: #ef4444 !important;
        color: #ffffff !important;
    }
    .delete-checkbox:checked ~ label .check-icon {
        opacity: 1 !important;
    }
    .delete-checkbox:checked ~ label .delete-badge {
        opacity: 1 !important;
        transform: scale(1) !important;
    }
</style>
@endpush
