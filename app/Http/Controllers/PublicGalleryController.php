<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class PublicGalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::with('images')->latest()->paginate(9);

        return view('galleries.index', compact('galleries'));
    }

    public function show(string $id): View
    {
        $gallery = Gallery::with('images')->findOrFail($id);

        $relatedGalleries = Gallery::with('images')
            ->where('id', '!=', $gallery->id)
            ->latest()
            ->take(4)
            ->get();

        return view('galleries.show', compact('gallery', 'relatedGalleries'));
    }
}
