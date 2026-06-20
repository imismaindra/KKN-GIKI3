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
        $galleries = Gallery::with('images')->latest()->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create(): View
    {
        return view('admin.galleries.create');
    }

    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $gallery = Gallery::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $optimizedPath = \App\Helpers\ImageOptimizer::optimize($image, 'galleries', 1200, 1200, 75);
                $gallery->images()->create([
                    'image_path' => $optimizedPath,
                ]);
            }
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery): View
    {
        $gallery->load('images');
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();

        // Handle image deletions
        if ($request->has('delete_images')) {
            $deleteImageIds = $request->input('delete_images');
            
            // Validate if user is trying to delete all images without uploading any new ones
            $currentImagesCount = $gallery->images()->count();
            $newImagesCount = $request->hasFile('images') ? count($request->file('images')) : 0;
            $deletingCount = count($deleteImageIds);

            if (($currentImagesCount - $deletingCount + $newImagesCount) < 1) {
                return redirect()->back()->withErrors(['images' => 'Galeri harus memiliki setidaknya satu foto. Jika ingin menghapus seluruh galeri kegiatan, silakan gunakan tombol hapus di halaman daftar.'])->withInput();
            }

            $imagesToDelete = $gallery->images()->whereIn('id', $deleteImageIds)->get();
            foreach ($imagesToDelete as $image) {
                if ($image->image_path) {
                    Storage::disk('public')->delete($image->image_path);
                }
                $image->delete();
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $optimizedPath = \App\Helpers\ImageOptimizer::optimize($image, 'galleries', 1200, 1200, 75);
                $gallery->images()->create([
                    'image_path' => $optimizedPath,
                ]);
            }
        }

        $gallery->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        // Delete all associated physical files
        foreach ($gallery->images as $image) {
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }
        }

        $gallery->images()->delete();
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
