<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('articles.index') }}</loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('teachers.index.public') }}</loc>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('extracurriculars.index.public') }}</loc>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('testimonials.create.public') }}</loc>
        <priority>0.5</priority>
    </url>
    @foreach($articles as $article)
    <url>
        <loc>{{ route('articles.show', $article->slug) }}</loc>
        <lastmod>{{ $article->updated_at?->tz('UTC')->toW3cString() ?? $article->created_at?->tz('UTC')->toW3cString() ?? now()->tz('UTC')->toW3cString() }}</lastmod>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset>
