@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('page_title', 'Detail Pesan Masuk')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <a href="{{ route('admin.contact-messages.index') }}" class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Kotak Masuk</span>
        </a>

        <form action="{{ route('admin.contact-messages.destroy', $contactMessage->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 font-semibold rounded-xl text-sm transition duration-150 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                <span>Hapus Pesan</span>
            </button>
        </form>
    </div>

    <!-- Message Detail Card -->
    <div class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
        <div class="border-b border-slate-100 pb-6 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                <div>
                    <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pengirim</h3>
                    <p class="text-lg font-bold text-slate-800 mt-1">{{ $contactMessage->name }}</p>
                    <a href="mailto:{{ $contactMessage->email }}" class="text-sm text-blue-600 hover:underline mt-0.5 block">{{ $contactMessage->email }}</a>
                </div>
                <div class="text-left sm:text-right">
                    <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Diterima</h3>
                    <p class="text-sm font-medium text-slate-600 mt-1">{{ $contactMessage->created_at->format('d F Y, H:i') }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">({{ $contactMessage->created_at->diffForHumans() }})</p>
                </div>
            </div>
            
            <div>
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Subjek</h3>
                <p class="text-base font-semibold text-slate-800 mt-1">{{ $contactMessage->subject }}</p>
            </div>
        </div>

        <div>
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Isi Pesan</h3>
            <div class="bg-slate-50 rounded-2xl p-6 text-slate-700 text-sm leading-relaxed whitespace-pre-line border border-slate-100">
                {{ $contactMessage->message }}
            </div>
        </div>
    </div>
</div>
@endsection
