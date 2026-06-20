@extends('layouts.admin')

@section('title', 'Tulis Artikel')
@section('page_title', 'Tulis Artikel Baru')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
        @csrf
        
        <div>
            <label for="title" class="block text-sm font-semibold text-slate-700 mb-1">Judul Artikel</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus placeholder="Contoh: Kegiatan Pondok Ramadhan 1447H di Sekolah"
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="status" class="block text-sm font-semibold text-slate-700 mb-1">Status Publikasi</label>
                <select name="status" id="status" required
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="published_at" class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Rilis Publikasi (Opsional)</label>
                <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at') }}"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika ingin otomatis dirilis langsung (saat ini) ketika dipublikasi.</p>
                @error('published_at') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="thumbnail" class="block text-sm font-semibold text-slate-700 mb-1">Pilih Gambar Cover / Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-150 cursor-pointer">
            <p class="text-xs text-slate-400 mt-1">Maksimal 2MB.</p>
            @error('thumbnail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-semibold text-slate-700 mb-1">Konten / Isi Lengkap Artikel</label>
            <textarea name="content" id="content" rows="12" required placeholder="Tulis isi berita atau pengumuman sekolah secara lengkap di sini..."
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">{{ old('content') }}</textarea>
            @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end pt-4 border-t border-slate-50">
            <button type="submit"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition duration-150 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20">
                Simpan & Publikasikan
            </button>
        </div>
    </form>
</div>
@endsection
