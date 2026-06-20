<!DOCTYPE html>
<html lang="id" class="h-full bg-[#edf1f0]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMA GIKI 3 SURABAYA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-white rounded-[32px] shadow-2xl border border-slate-100/50 p-10 space-y-8">
        
        <div class="text-center space-y-3">
            <img src="{{ asset('smagiki3.webp') }}" alt="Logo SMA GIKI 3 SURABAYA" class="inline-flex w-16 h-16 object-contain">
            <div class="space-y-1">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Admin Login</h2>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider text-emerald-600">SMA GIKI 3 SURABAYA</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-rose-50 border border-rose-100 text-rose-800 px-4 py-3 rounded-2xl text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="admin@sekolah.sch.id"
                    class="w-full px-4.5 py-3 bg-slate-50 border border-slate-150 rounded-2xl focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 text-slate-800 text-sm transition duration-150">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Password</label>
                <input type="password" name="password" id="password" required placeholder="••••••••"
                    class="w-full px-4.5 py-3 bg-slate-50 border border-slate-150 rounded-2xl focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-900 text-slate-800 text-sm transition duration-150">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2.5 cursor-pointer group">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-slate-900 bg-slate-50 border-slate-200 rounded focus:ring-slate-900 focus:ring-2">
                    <span class="text-xs font-bold text-slate-500 group-hover:text-slate-700 transition">Ingat saya</span>
                </label>
            </div>

            <button type="submit"
                class="w-full py-3.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold rounded-2xl transition duration-150 shadow-lg shadow-slate-950/10 hover:shadow-slate-950/20">
                Masuk ke Dashboard
            </button>
        </form>
    </div>
</body>
</html>
