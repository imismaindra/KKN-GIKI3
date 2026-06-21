@extends('layouts.app')

@section('title', ($article->meta_title ?: $article->title) . ' - SMA GIKI 3 Surabaya')

@section('meta')
    <meta name="description" content="{{ $article->meta_description ?: strip_tags(Str::limit($article->content, 155)) }}" />
    @if($article->meta_keywords)
        <meta name="keywords" content="{{ $article->meta_keywords }}" />
    @endif
    
    <!-- Open Graph (Facebook / LinkedIn) Meta Tags -->
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $article->meta_title ?: $article->title }}" />
    <meta property="og:description" content="{{ $article->meta_description ?: strip_tags(Str::limit($article->content, 155)) }}" />
    <meta property="og:url" content="{{ route('articles.show', $article->slug) }}" />
    @if($article->thumbnail)
        <meta property="og:image" content="{{ url(Storage::url($article->thumbnail)) }}" />
    @endif
    <meta property="article:published_time" content="{{ $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String() }}" />
    <meta property="article:author" content="SMA GIKI 3 Surabaya Admin" />

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $article->meta_title ?: $article->title }}" />
    <meta name="twitter:description" content="{{ $article->meta_description ?: strip_tags(Str::limit($article->content, 155)) }}" />
    @if($article->thumbnail)
        <meta name="twitter:image" content="{{ url(Storage::url($article->thumbnail)) }}" />
    @endif
@endsection

@section('content')
<main class="pt-32 pb-24 bg-[#FAF9F6] min-h-screen">
    <div class="max-w-4xl mx-auto px-margin-mobile md:px-margin-desktop">
        <!-- Breadcrumb link -->
        <nav class="mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 text-xs font-semibold text-slate-500">
                <li><a href="{{ url('/') }}" class="hover:text-secondary">Beranda</a></li>
                <li class="flex items-center">
                    <span class="material-symbols-outlined text-[14px] mx-1">chevron_right</span>
                    <a href="{{ route('articles.index') }}" class="hover:text-secondary">Berita &amp; Artikel</a>
                </li>
                <li class="flex items-center text-slate-400 font-medium truncate max-w-[200px]" aria-current="page">
                    <span class="material-symbols-outlined text-[14px] mx-1">chevron_right</span>
                    <span>{{ $article->title }}</span>
                </li>
            </ol>
        </nav>

        <article class="bg-white rounded-3xl border border-slate-100 p-6 md:p-10 shadow-sm space-y-8">
            <!-- Article Header Metadata -->
            <div class="space-y-4">
                <span class="px-3 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-full text-xs font-bold uppercase tracking-wider">
                    Pengumuman & Berita
                </span>
                
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-primary leading-tight tracking-tight">
                    {{ $article->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-4 text-xs text-slate-400 font-semibold border-t border-b border-slate-100/80 py-3.5">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm text-secondary">calendar_today</span>
                        <span>Diterbitkan: {{ $article->published_at ? $article->published_at->format('d M Y, H:i') : $article->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <span class="hidden sm:inline text-slate-200">|</span>
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm text-secondary">person</span>
                        <span>Oleh: Admin SMA GIKI 3</span>
                    </div>
                </div>
            </div>

            <!-- Featured Thumbnail -->
            @if($article->thumbnail)
                <div class="w-full aspect-video rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shadow-inner">
                    <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover" />
                </div>
            @endif

            <!-- Article HTML Content (WYSIWYG Quill Render) -->
            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-base break-words space-y-6" id="articleBody">
                {!! $article->content !!}
            </div>

            <!-- Share Buttons & Keywords -->
            <div class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <!-- Meta keywords tags -->
                @if($article->meta_keywords)
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-xs font-bold text-slate-450 uppercase">Tag:</span>
                        @foreach(explode(',', $article->meta_keywords) as $keyword)
                            <span class="px-2.5 py-1 bg-slate-50 border border-slate-200/50 rounded-lg text-xs text-slate-500 font-semibold">
                                #{{ trim($keyword) }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <!-- Simple Share trigger -->
                <div class="flex items-center space-x-3">
                    <span class="text-xs font-bold text-slate-450 uppercase">Bagikan:</span>
                    <button onclick="window.navigator.clipboard.writeText(window.location.href); alert('Tautan berhasil disalin!');" 
                            class="p-2 bg-slate-50 border border-slate-200 rounded-xl hover:bg-secondary hover:text-white transition duration-150 flex items-center justify-center text-slate-500" 
                            title="Salin Tautan">
                        <span class="material-symbols-outlined text-lg">content_copy</span>
                    </button>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . request()->url()) }}" target="_blank" 
                       class="p-2 bg-slate-50 border border-slate-200 rounded-xl hover:bg-emerald-500 hover:text-white transition duration-150 flex items-center justify-center text-slate-500" 
                       title="Bagikan ke WhatsApp">
                        <svg class="w-4.5 h-4.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.262 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.5-5.739-1.45L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.963C16.59 2.025 14.121.999 11.503.999c-5.437 0-9.862 4.371-9.866 9.802-.001 1.777.478 3.512 1.39 5.065l-.946 3.46 3.565-.936zM17.65 14.6c-.299-.15-1.768-.871-2.043-.971-.274-.1-.474-.15-.674.15-.2.3-.773.971-.948 1.171-.175.2-.349.224-.648.075-1.121-.561-2.203-1.393-3.08-2.161-.685-.6-1.147-1.341-1.28-1.566-.135-.224-.015-.347.134-.496.136-.135.299-.349.45-.523.149-.174.2-.299.299-.499.1-.2.05-.374-.025-.524-.075-.15-.674-1.62-.924-2.22-.243-.585-.49-.506-.674-.515-.175-.008-.374-.01-.574-.01-.2 0-.524.075-.798.374-.275.3-.924.903-.924 2.196 0 1.293.948 2.54 1.073 2.71.125.174 1.866 2.85 4.521 3.992.633.272 1.127.435 1.514.557.636.202 1.213.174 1.67.106.509-.076 1.768-.722 2.018-1.42.25-.698.25-1.296.175-1.42-.075-.125-.275-.2-.574-.35z"/></svg>
                    </a>
                </div>
            </div>
        </article>

        <!-- Related Articles -->
        @if(!$relatedArticles->isEmpty())
            <div class="mt-20 space-y-8">
                <div class="flex items-center justify-between border-b border-slate-200/50 pb-4">
                    <h3 class="text-2xl font-bold text-primary">Artikel Terkait</h3>
                    <a href="{{ route('articles.index') }}" class="text-sm font-semibold text-secondary hover:text-primary transition-colors flex items-center gap-1.5 group">
                        <span>Lihat Semua</span>
                        <span class="material-symbols-outlined text-sm transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                        <div class="bento-card bg-white border border-slate-100 flex flex-col h-full hover:shadow-lg transition duration-200 p-4">
                            <div class="relative w-full aspect-video rounded-xl overflow-hidden bg-slate-100 mb-4">
                                @if($related->thumbnail)
                                    <img src="{{ Storage::url($related->thumbnail) }}" alt="{{ $related->title }}" class="w-full h-full object-cover" loading="lazy" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-350">
                                        <span class="material-symbols-outlined text-4xl">image</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow flex flex-col">
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1.5">
                                    {{ $related->published_at ? $related->published_at->format('d M Y') : $related->created_at->format('d M Y') }}
                                </span>
                                <h4 class="font-bold text-slate-800 text-sm hover:text-secondary line-clamp-2 leading-snug mb-2">
                                    <a href="{{ route('articles.show', $related->slug) }}">
                                        {{ $related->title }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</main>
@endsection

@push('styles')
<style>
    /* Premium Typography style variables for rich text content output */
    #articleBody h1 {
        font-family: 'Poppins', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        color: #112240;
        margin-top: 2rem;
        margin-bottom: 1rem;
        line-height: 1.25;
    }
    #articleBody h2 {
        font-family: 'Poppins', sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: #112240;
        margin-top: 1.8rem;
        margin-bottom: 0.8rem;
        line-height: 1.3;
    }
    #articleBody h3 {
        font-family: 'Poppins', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #112240;
        margin-top: 1.5rem;
        margin-bottom: 0.7rem;
    }
    #articleBody p {
        font-family: 'Open Sans', sans-serif;
        font-size: 1rem;
        color: #334155;
        margin-bottom: 1.2rem;
        line-height: 1.8;
    }
    #articleBody ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1.2rem;
    }
    #articleBody ol {
        list-style-type: decimal;
        padding-left: 1.5rem;
        margin-bottom: 1.2rem;
    }
    #articleBody li {
        margin-bottom: 0.4rem;
        line-height: 1.7;
        color: #334155;
    }
    #articleBody blockquote {
        border-left: 4px solid #E5A93C;
        padding-left: 1.25rem;
        color: #475569;
        font-style: italic;
        margin-top: 1.5rem;
        margin-bottom: 1.5rem;
        background-color: #FAF9F6;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        border-top-right-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }
    #articleBody a {
        color: #E5A93C;
        text-decoration: underline;
        font-weight: 600;
    }
    #articleBody a:hover {
        color: #112240;
    }
    #articleBody img {
        border-radius: 1rem;
        margin: 1.5rem auto;
        max-width: 100%;
        height: auto;
        box-shadow: 0 4px 12px rgba(17,34,64,0.04);
    }
</style>
@endpush
