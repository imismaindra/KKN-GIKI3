@extends('layouts.admin')

@section('title', 'Kelola Testimoni')
@section('page_title', 'Kelola Testimoni Alumni & Wali Murid')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <p class="text-slate-500 text-sm">Kelola testimoni atau ulasan positif dari alumni, siswa, maupun orang tua/wali murid.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm transition duration-150 shadow-lg shadow-blue-500/10 flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Tambah Testimoni</span>
        </a>
    </div>

    <!-- Testimonials Table -->
    @if($testimonials->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            <h4 class="text-lg font-bold text-slate-700">Belum ada testimoni</h4>
            <p class="text-slate-400 text-sm mt-1">Tambahkan testimoni baru untuk meningkatkan kredibilitas sekolah di landing page.</p>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Pemberi Ulasan</th>
                            <th class="px-6 py-4">Hubungan / Status</th>
                            <th class="px-6 py-4">Rating</th>
                            <th class="px-6 py-4">Ulasan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">
                        @foreach($testimonials as $testimonial)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0">
                                            @if($testimonial->avatar)
                                                <img src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-xs font-semibold text-slate-400 bg-slate-100">
                                                    {{ substr($testimonial->name, 0, 2) }}
                                                </div>
                                            @endif
                                        </div>
                                        <span class="font-semibold text-slate-800">{{ $testimonial->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-600">
                                    {{ $testimonial->relationship }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-amber-400 font-bold">
                                    @if($testimonial->rating)
                                        <div class="flex items-center space-x-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $testimonial->rating ? 'fill-current text-amber-400' : 'text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.907c.961 0 1.36 1.238.588 1.81l-3.97 2.883a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.971-2.883a1 1 0 00-1.18 0l-3.97 2.883c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118L2.98 9.42c-.771-.572-.372-1.81.588-1.81h4.906a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                            @endfor
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate text-slate-600">
                                    "{{ $testimonial->content }}"
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs space-x-2">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="inline-block px-3 py-1.5 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 font-semibold rounded-lg transition duration-150">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
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
