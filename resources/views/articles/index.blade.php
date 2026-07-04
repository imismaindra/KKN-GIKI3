@extends('layouts.app')

@section('title', 'Berita & Artikel - SMA GIKI 3 Surabaya')

@section('meta')
    <meta name="description" content="Informasi terbaru, berita kegiatan, pengumuman resmi, dan artikel pendidikan terupdate dari SMA GIKI 3 Surabaya." />
    <meta name="keywords" content="berita sekolah, artikel sma giki 3, pengumuman giki 3, surabaya" />
    <meta property="og:title" content="Berita & Artikel - SMA GIKI 3 Surabaya" />
    <meta property="og:description" content="Informasi terbaru, berita kegiatan, pengumuman resmi, dan artikel pendidikan terupdate dari SMA GIKI 3 Surabaya." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('articles.index') }}" />
    <meta name="twitter:card" content="summary" />
@endsection

@section('content')
<main class="pt-32 pb-24 bg-[#FAF9F6] min-h-screen">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <!-- Page Header -->
        <div class="mb-16 text-center max-w-3xl mx-auto">
            <span class="text-secondary font-label-md tracking-widest uppercase mb-4 block">Pusat Informasi</span>
            <h1 class="font-display-lg text-4xl md:text-5xl text-primary font-bold mb-6">Berita &amp; Artikel</h1>
            <p class="font-body-lg text-slate-500 text-base leading-relaxed">
                Ikuti terus informasi seputar kegiatan sekolah, artikel edukasi, prestasi siswa, dan pengumuman resmi dari kami.
            </p>
        </div>

        @if($articles->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-3xl p-16 text-center border border-slate-100 shadow-sm max-w-lg mx-auto">
                <span class="material-symbols-outlined text-6xl text-slate-300 mb-4">newspaper</span>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Artikel</h3>
                <p class="text-slate-500 text-sm mb-6 leading-relaxed">
                    Maaf, saat ini belum ada berita atau artikel yang diterbitkan. Silakan kembali lagi nanti.
                </p>
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-full text-sm font-semibold hover:bg-primary/95 transition duration-150">
                    <span class="material-symbols-outlined text-lg">home</span>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        @else
            <!-- Bento-style Grid of Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                    <div class="bento-card bg-white flex flex-col h-full border border-slate-100/50 hover:shadow-xl transition-all duration-300">
                        <!-- Image wrapper -->
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100 flex-shrink-0">
                            @if($article->thumbnail)
                                <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover img-zoom" loading="lazy" />
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-350">
                                    <span class="material-symbols-outlined text-5xl">image</span>
                                </div>
                            @endif
                            <div class="absolute bottom-4 left-4">
                                <span class="px-3 py-1 bg-primary/95 text-on-primary rounded-full text-[10px] font-bold tracking-wider uppercase">
                                    Info
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex flex-col flex-grow">
                            <!-- Meta date -->
                            <div class="flex items-center gap-2 text-xs text-slate-400 font-medium mb-3">
                                <span class="material-symbols-outlined text-sm text-secondary">calendar_today</span>
                                <span>{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                                <span>•</span>
                                <span>Oleh Admin</span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-primary mb-3 hover:text-secondary transition-colors line-clamp-2 leading-snug">
                                <a href="{{ route('articles.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <!-- Snippet description -->
                            <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3">
                                {{ $article->meta_description ?: strip_tags($article->content) }}
                            </p>

                            <!-- Call to action button at the bottom -->
                            <div class="mt-auto pt-4 border-t border-slate-50 flex items-center">
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-xs font-bold text-secondary hover:text-primary transition-colors flex items-center gap-1.5 group">
                                    <span>Baca Selengkapnya</span>
                                    <span class="material-symbols-outlined text-sm transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Custom Styled Laravel Pagination -->
            <div class="mt-16 border-t border-slate-200/50 pt-8 flex justify-center">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</main>
@endsection
