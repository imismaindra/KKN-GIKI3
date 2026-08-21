@extends('layouts.admin')

@section('title', 'Profil Admin')
@section('page_title', 'Pengaturan Akun')

@section('content')
<div class="max-w-2xl mx-auto space-y-8">

    <div class="bg-white rounded-[24px] border border-slate-100 p-8 shadow-sm">
        <div class="flex items-center space-x-5 mb-8">
            <div class="w-16 h-16 rounded-full bg-slate-900 flex items-center justify-center font-bold text-white text-xl">
                {{ substr(auth()->user()->name, 0, 2) }}
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-900">{{ auth()->user()->name }}</h3>
                <p class="text-sm text-slate-400">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required
                    class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:bg-white focus:ring-4 focus:ring-cyan-600/10 focus:border-cyan-600 text-slate-800 text-sm placeholder:text-slate-400 transition-all duration-200">
                @error('name')
                    <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                    class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:bg-white focus:ring-4 focus:ring-cyan-600/10 focus:border-cyan-600 text-slate-800 text-sm placeholder:text-slate-400 transition-all duration-200">
                @error('email')
                    <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <hr class="border-slate-100">

            <div>
                <h4 class="text-sm font-bold text-slate-800 mb-4">Ganti Password</h4>
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label for="current_password" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Password Saat Ini</label>
                        <input type="password" name="current_password" id="current_password"
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:bg-white focus:ring-4 focus:ring-cyan-600/10 focus:border-cyan-600 text-slate-800 text-sm placeholder:text-slate-400 transition-all duration-200">
                        @error('current_password')
                            <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="new_password" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Password Baru</label>
                        <input type="password" name="new_password" id="new_password"
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:bg-white focus:ring-4 focus:ring-cyan-600/10 focus:border-cyan-600 text-slate-800 text-sm placeholder:text-slate-400 transition-all duration-200">
                        @error('new_password')
                            <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="new_password_confirmation" class="block text-xs font-bold text-slate-500 uppercase tracking-widest">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:bg-white focus:ring-4 focus:ring-cyan-600/10 focus:border-cyan-600 text-slate-800 text-sm placeholder:text-slate-400 transition-all duration-200">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="px-8 py-3.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold rounded-full transition shadow-md shadow-slate-950/10">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
