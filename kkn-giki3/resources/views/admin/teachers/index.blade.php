@extends('layouts.admin')

@section('title', 'Kelola Guru & Staf')
@section('page_title', 'Kelola Daftar Guru & Staf')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <p class="text-slate-500 text-sm">Kelola daftar kepala sekolah, guru, dan tenaga kependidikan aktif di sekolah Anda.</p>
        <a href="{{ route('admin.teachers.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm transition duration-150 shadow-lg shadow-blue-500/10 flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Tambah Guru/Staf</span>
        </a>
    </div>

    <!-- Teachers Table -->
    @if($teachers->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <h4 class="text-lg font-bold text-slate-700">Belum ada guru/staf</h4>
            <p class="text-slate-400 text-sm mt-1">Tambahkan profil guru atau staf untuk dimunculkan di landing page.</p>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Foto</th>
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Jabatan / Mapel</th>
                            <th class="px-6 py-4">Urutan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">
                        @foreach($teachers as $teacher)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden">
                                        @if($teacher->photo)
                                            <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-xs font-semibold text-slate-400 bg-slate-100">
                                                {{ substr($teacher->name, 0, 2) }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-800">
                                    {{ $teacher->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-600">
                                    {{ $teacher->position }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-mono">
                                    {{ $teacher->order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs space-x-2">
                                    <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="inline-block px-3 py-1.5 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 font-semibold rounded-lg transition duration-150">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil guru ini?')">
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
