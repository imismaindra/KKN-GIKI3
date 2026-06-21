@extends('layouts.admin')

@section('title', 'Kelola Ekstrakurikuler')
@section('page_title', 'Kelola Ekstrakurikuler Sekolah')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <p class="text-slate-500 text-sm">Kelola daftar kegiatan ekstrakurikuler pembentuk minat bakat siswa di sekolah.</p>
        <a href="{{ route('admin.extracurriculars.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm transition duration-150 shadow-lg shadow-blue-500/10 flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Tambah Ekstrakurikuler</span>
        </a>
    </div>

    <!-- Extracurriculars Table -->
    @if($extracurriculars->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <h4 class="text-lg font-bold text-slate-700">Belum ada ekstrakurikuler</h4>
            <p class="text-slate-400 text-sm mt-1">Tambahkan ekstrakurikuler baru untuk dimunculkan di halaman publik.</p>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Foto</th>
                            <th class="px-6 py-4">Nama Ekskul</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Ikon</th>
                            <th class="px-6 py-4">Pembina / Pelatih</th>
                            <th class="px-6 py-4">Jadwal Latihan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">
                        @foreach($extracurriculars as $ekskul)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-16 h-12 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden">
                                        @if($ekskul->image_path)
                                            @if(Str::startsWith($ekskul->image_path, 'http'))
                                                <img src="{{ $ekskul->image_path }}" alt="{{ $ekskul->name }}" class="w-full h-full object-cover">
                                            @else
                                                <img src="{{ Storage::url($ekskul->image_path) }}" alt="{{ $ekskul->name }}" class="w-full h-full object-cover">
                                            @endif
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] text-slate-400 font-medium bg-slate-50">No Image</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-slate-800">
                                    {{ $ekskul->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($ekskul->category)
                                        <span class="px-3 py-1 bg-slate-100 text-slate-700 font-semibold text-xs rounded-full border border-slate-200/50">{{ $ekskul->category }}</span>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($ekskul->icon)
                                        <div class="flex items-center space-x-2">
                                            <span class="material-symbols-outlined text-xl text-slate-700 bg-slate-50 p-2 rounded-xl border border-slate-100">{{ $ekskul->icon }}</span>
                                            <span class="text-xs text-slate-400 font-mono">{{ $ekskul->icon }}</span>
                                        </div>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $ekskul->pembina ?: '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $ekskul->schedule ?: '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs space-x-2">
                                    <a href="{{ route('admin.extracurriculars.edit', $ekskul->id) }}" class="inline-block px-3 py-1.5 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 font-semibold rounded-lg transition duration-150">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.extracurriculars.destroy', $ekskul->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler ini?')">
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
