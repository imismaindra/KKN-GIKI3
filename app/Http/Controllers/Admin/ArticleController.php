<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArticleRequest;
use App\Http\Requests\Admin\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use App\Helpers\HtmlSanitizer;
use App\Helpers\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        return view('admin.articles.create');
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['content'] = HtmlSanitizer::sanitize($data['content']);
        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $data['slug'] = $slug;

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $result = ImageOptimizer::optimize($request->file('thumbnail'), 'articles', 1000, 1000, 75);
            if ($result === false) {
                return back()->withInput()->with('error', 'Gagal mengupload thumbnail. Silakan coba lagi.');
            }
            $data['thumbnail'] = $result;
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $request->validated();
        $data['content'] = HtmlSanitizer::sanitize($data['content']);
        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $data['slug'] = $slug;

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = $article->published_at ?? now();
        } elseif ($data['status'] === 'draft') {
            $data['published_at'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $result = ImageOptimizer::optimize($request->file('thumbnail'), 'articles', 1000, 1000, 75);
            if ($result === false) {
                return back()->withInput()->with('error', 'Gagal mengupload thumbnail. Silakan coba lagi.');
            }
            $data['thumbnail'] = $result;
        } else {
            unset($data['thumbnail']);
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
