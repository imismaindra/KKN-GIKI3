@extends('layouts.admin')

@section('title', 'Kelola Fasilitas')
@section('page_title', 'Kelola Fasilitas Sekolah')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <p class="text-slate-500 text-sm">Kelola daftar sarana dan prasarana penunjang kegiatan belajar mengajar di sekolah.</p>
        <a href="{{ route('admin.facilities.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm transition duration-150 shadow-lg shadow-blue-500/10 flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Tambah Fasilitas</span>
        </a>
    </div>

    <!-- Facilities Table -->
    @if($facilities->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <h4 class="text-lg font-bold text-slate-700">Belum ada fasilitas</h4>
            <p class="text-slate-400 text-sm mt-1">Tambahkan fasilitas sekolah baru untuk dimunculkan di landing page.</p>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Gambar</th>
                            <th class="px-6 py-4">Nama Fasilitas</th>
                            <th class="px-6 py-4">Ikon</th>
                            <th class="px-6 py-4">Deskripsi</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">
                        @foreach($facilities as $facility)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-16 h-12 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden">
                                        @if($facility->image_path)
                                            <img src="{{ Storage::url($facility->image_path) }}" alt="{{ $facility->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-xs text-slate-400 font-medium">No Image</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-800">
                                    {{ $facility->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($facility->icon)
                                        <div class="flex items-center space-x-2">
                                            <span class="material-symbols-outlined text-xl text-slate-700 bg-slate-50 p-2 rounded-xl border border-slate-100">{{ $facility->icon }}</span>
                                            <span class="text-xs text-slate-400 font-mono">{{ $facility->icon }}</span>
                                        </div>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate">
                                    {{ $facility->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs space-x-2">
                                    <a href="{{ route('admin.facilities.edit', $facility->id) }}" class="inline-block px-3 py-1.5 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 font-semibold rounded-lg transition duration-150">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 font-semibold rounded-lg transition duration-150">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
