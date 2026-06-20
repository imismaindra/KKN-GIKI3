@extends('layouts.admin')

@section('title', 'Edit Testimoni')
@section('page_title', 'Edit Testimoni')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Nama Pemberi Testimoni</label>
            <input type="text" name="name" id="name" value="{{ old('name', $testimonial->name) }}" required autofocus
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="relationship" class="block text-sm font-semibold text-slate-700 mb-1">Hubungan / Status</label>
                <input type="text" name="relationship" id="relationship" value="{{ old('relationship', $testimonial->relationship) }}" required
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                @error('relationship') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="rating" class="block text-sm font-semibold text-slate-700 mb-1">Rating Bintang (Opsional)</label>
                <select name="rating" id="rating"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    <option value="">Pilih Rating</option>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                    @endfor
                </select>
                @error('rating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Avatar Saat Ini</label>
            <div class="w-20 h-20 rounded-full bg-slate-100 border border-slate-200 overflow-hidden mb-3">
                @if($testimonial->avatar)
                    <img src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-xs font-semibold text-slate-400">No Image</div>
                @endif
            </div>
            
            <label for="avatar" class="block text-sm font-semibold text-slate-700 mb-1">Ganti Foto Avatar (Opsional)</label>
            <input type="file" name="avatar" id="avatar" accept="image/*"
                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-150 cursor-pointer">
            <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengganti. Maksimal 2MB.</p>
            @error('avatar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-semibold text-slate-700 mb-1">Isi Testimoni / Ulasan</label>
            <textarea name="content" id="content" rows="4" required
                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">{{ old('content', $testimonial->content) }}</textarea>
            @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_approved" id="is_approved" value="1" {{ old('is_approved', $testimonial->is_approved) ? 'checked' : '' }}
                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded transition duration-150">
            <label for="is_approved" class="ml-2 block text-sm text-slate-700 font-semibold">
                Setujui testimoni ini (Tampilkan langsung di halaman utama)
            </label>
            @error('is_approved') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
