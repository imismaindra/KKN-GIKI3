<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::latest()->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create(): View
    {
        return view('admin.galleries.create');
    }

    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('galleries', 'public');
        }

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('galleries', 'public');
        } else {
            unset($data['image_path']);
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
