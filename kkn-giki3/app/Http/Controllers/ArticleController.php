<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of published articles.
     */
    public function index(): View
    {
        $articles = Article::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('articles.index', compact('articles'));
    }

    /**
     * Display the specified article.
     */
    public function show(string $slug): View
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Retrieve latest 3 other published articles as related articles
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
