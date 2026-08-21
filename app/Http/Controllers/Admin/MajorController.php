<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMajorRequest;
use App\Http\Requests\Admin\UpdateMajorRequest;
use App\Models\Major;
use Illuminate\Http\RedirectResponse;
use App\Helpers\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MajorController extends Controller
{
    public function index(): View
    {
        $majors = Major::latest()->paginate(15);
        return view('admin.majors.index', compact('majors'));
    }

    public function create(): View
    {
        return view('admin.majors.create');
    }

    public function store(StoreMajorRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Major::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('image_path')) {
            $result = ImageOptimizer::optimize($request->file('image_path'), 'majors', 1000, 1000, 75);
            if ($result === false) {
                return back()->withInput()->with('error', 'Gagal mengupload gambar. Silakan coba lagi.');
            }
            $data['image_path'] = $result;
        }

        Major::create($data);

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(Major $major): View
    {
        return view('admin.majors.edit', compact('major'));
    }

    public function update(UpdateMajorRequest $request, Major $major): RedirectResponse
    {
        $data = $request->validated();
        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Major::where('slug', $slug)->where('id', '!=', $major->id)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('image_path')) {
            if ($major->image_path) {
                Storage::disk('public')->delete($major->image_path);
            }
            $result = ImageOptimizer::optimize($request->file('image_path'), 'majors', 1000, 1000, 75);
            if ($result === false) {
                return back()->withInput()->with('error', 'Gagal mengupload gambar. Silakan coba lagi.');
            }
            $data['image_path'] = $result;
        } else {
            unset($data['image_path']);
        }

        $major->update($data);

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Major $major): RedirectResponse
    {
        if ($major->image_path) {
            Storage::disk('public')->delete($major->image_path);
        }

        $major->delete();

        return redirect()->route('admin.majors.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}
