@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('page_title', 'Kotak Masuk Pesan Pengunjung')

@section('content')
<div class="space-y-6">
    <p class="text-slate-500 text-sm">Berikut adalah daftar pesan, saran, maupun pertanyaan dari pengunjung landing page sekolah.</p>

    <!-- Messages Table -->
    @if($messages->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
            <h4 class="text-lg font-bold text-slate-700">Kotak masuk kosong</h4>
            <p class="text-slate-400 text-sm mt-1">Belum ada pesan yang dikirim oleh pengunjung.</p>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Nama Pengirim</th>
                            <th class="px-6 py-4">Subjek</th>
                            <th class="px-6 py-4">Diterima Pada</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">
                        @foreach($messages as $message)
                            <tr class="hover:bg-slate-50/50 transition {{ !$message->is_read ? 'bg-blue-50/20 font-semibold' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(!$message->is_read)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                            Baru
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-50 text-slate-500 border border-slate-150">
                                            Dibaca
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-slate-800">{{ $message->name }}</span>
                                    <span class="block text-xs font-normal text-slate-400 mt-0.5">{{ $message->email }}</span>
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate text-slate-700">
                                    {{ $message->subject }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-medium">
                                    {{ $message->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs space-x-2">
                                    <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="inline-block px-3 py-1.5 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 font-semibold rounded-lg transition duration-150">
                                        Buka Pesan
                                    </a>
                                    <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
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
