@extends('layouts.admin')

@section('title', 'Kelola Jurusan')
@section('page_title', 'Kelola Program Keahlian / Jurusan')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <p class="text-slate-500 text-sm">Kelola program keahlian atau jurusan yang ditawarkan sekolah kepada siswa.</p>
        <a href="{{ route('admin.majors.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm transition duration-150 shadow-lg shadow-blue-500/10 flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Tambah Jurusan</span>
        </a>
    </div>

    <!-- Majors Table -->
    @if($majors->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            <h4 class="text-lg font-bold text-slate-700">Belum ada jurusan</h4>
            <p class="text-slate-400 text-sm mt-1">Tambahkan jurusan baru untuk dimunculkan di landing page.</p>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Gambar</th>
                            <th class="px-6 py-4">Nama Jurusan</th>
                            <th class="px-6 py-4">Ikon</th>
                            <th class="px-6 py-4">Deskripsi</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">
                        @foreach($majors as $major)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-16 h-12 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden">
                                        @if($major->image_path)
                                            <img src="{{ Storage::url($major->image_path) }}" alt="{{ $major->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-xs text-slate-400 font-medium">No Image</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-800">
                                    {{ $major->name }}
                                    <span class="block text-xs font-normal text-slate-400 mt-0.5">{{ $major->slug }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs font-mono">{{ $major->icon ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate">
                                    {{ $major->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs space-x-2">
                                    <a href="{{ route('admin.majors.edit', $major->id) }}" class="inline-block px-3 py-1.5 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 font-semibold rounded-lg transition duration-150">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.majors.destroy', $major->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
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
