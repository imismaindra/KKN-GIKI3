@extends('layouts.admin')

@section('title', 'Galeri Kegiatan')
@section('page_title', 'Kelola Galeri Foto Sekolah')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <p class="text-slate-500 text-sm">Unggah dan kelola dokumentasi foto kegiatan sekolah yang akan ditampilkan di landing page.</p>
        <a href="{{ route('admin.galleries.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm transition duration-150 shadow-lg shadow-blue-500/10 flex items-center space-x-2 flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Unggah Foto</span>
        </a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('admin.galleries.index') }}" class="relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari galeri berdasarkan judul..."
               class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition duration-150">
    </form>

    <!-- Gallery Grid -->
    @if($galleries->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <h4 class="text-lg font-bold text-slate-700">{{ request('search') ? 'Tidak ditemukan galeri' : 'Belum ada foto galeri' }}</h4>
            <p class="text-slate-400 text-sm mt-1">{{ request('search') ? 'Coba kata kunci pencarian lain.' : 'Unggah dokumentasi foto kegiatan pertama sekolah Anda.' }}</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galleries as $gallery)
                <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition duration-200 flex flex-col justify-between">
                    <div class="relative aspect-square bg-slate-100">
                        @php
                            $firstImage = $gallery->images->first();
                        @endphp
                        @if($firstImage)
                            <img src="{{ Storage::url($firstImage->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-400">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3 bg-slate-900/60 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full flex items-center space-x-1 shadow-sm">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>{{ $gallery->images->count() }} Foto</span>
                        </div>
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div class="space-y-1 mb-4">
                            <h4 class="font-bold text-slate-800 line-clamp-1 text-sm">{{ $gallery->title }}</h4>
                            <p class="text-slate-500 text-xs line-clamp-2">{{ $gallery->description ?? 'Tidak ada deskripsi' }}</p>
                        </div>
                        <div class="flex items-center space-x-2 pt-3 border-t border-slate-50">
                            <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="flex-1 text-center py-2 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 font-semibold rounded-lg text-xs transition duration-150">
                                Edit
                            </a>
                            <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto galeri ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center py-2 bg-slate-50 hover:bg-red-50 text-slate-600 hover:text-red-600 font-semibold rounded-lg text-xs transition duration-150">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($galleries->hasPages())
            <div class="mt-8">
                {{ $galleries->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
