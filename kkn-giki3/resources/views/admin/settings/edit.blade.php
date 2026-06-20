@extends('layouts.admin')

@section('title', 'Pengaturan Sekolah')
@section('page_title', 'Pengaturan Profil Sekolah')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Card: Utama -->
        <div class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Informasi Utama Sekolah</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="school_name" class="block text-sm font-semibold text-slate-700 mb-1">Nama Sekolah</label>
                    <input type="text" name="school_name" id="school_name" value="{{ old('school_name', $setting->school_name ?? '') }}" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    @error('school_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Email Sekolah</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $setting->email ?? '') }}" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1">Telepon/Kontak</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone ?? '') }}" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-semibold text-slate-700 mb-1">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="3" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">{{ old('address', $setting->address ?? '') }}</textarea>
                    @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Card: Logo -->
        <div class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Logo Sekolah</h3>
            
            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <div class="w-24 h-24 rounded-2xl border border-slate-200 bg-slate-50 overflow-hidden flex items-center justify-center p-2 flex-shrink-0">
                    @if ($setting && $setting->logo)
                        <img src="{{ Storage::url($setting->logo) }}" alt="Logo Sekolah" class="max-w-full max-h-full object-contain">
                    @else
                        <span class="text-slate-400 text-xs text-center font-medium">Belum ada logo</span>
                    @endif
                </div>
                <div class="space-y-2">
                    <label for="logo" class="block text-sm font-semibold text-slate-700">Pilih File Logo Baru</label>
                    <input type="file" name="logo" id="logo" accept="image/*"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-150 cursor-pointer">
                    <p class="text-xs text-slate-400">Format gambar (PNG, JPG). Maksimal 2MB.</p>
                    @error('logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Card: Visi & Misi -->
        <div class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Visi & Misi Sekolah</h3>
            
            <div class="space-y-6">
                <div>
                    <label for="vision" class="block text-sm font-semibold text-slate-700 mb-1">Visi Sekolah</label>
                    <textarea name="vision" id="vision" rows="3" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">{{ old('vision', $setting->vision ?? '') }}</textarea>
                    @error('vision') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="mission" class="block text-sm font-semibold text-slate-700 mb-1">Misi Sekolah</label>
                    <textarea name="mission" id="mission" rows="5" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">{{ old('mission', $setting->mission ?? '') }}</textarea>
                    <p class="text-xs text-slate-400 mt-1">Gunakan baris baru (Enter) untuk menulis poin-poin misi.</p>
                    @error('mission') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Card: Sosmed -->
        <div class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Media Sosial Resmi</h3>
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="facebook_url" class="block text-sm font-semibold text-slate-700 mb-1">Tautan Facebook</label>
                    <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $setting->facebook_url ?? '') }}" placeholder="https://facebook.com/..."
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    @error('facebook_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="instagram_url" class="block text-sm font-semibold text-slate-700 mb-1">Tautan Instagram</label>
                    <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $setting->instagram_url ?? '') }}" placeholder="https://instagram.com/..."
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    @error('instagram_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="youtube_url" class="block text-sm font-semibold text-slate-700 mb-1">Tautan YouTube</label>
                    <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $setting->youtube_url ?? '') }}" placeholder="https://youtube.com/..."
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    @error('youtube_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition duration-150 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
