<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExtracurricularRequest;
use App\Http\Requests\Admin\UpdateExtracurricularRequest;
use App\Models\Extracurricular;
use App\Helpers\ImageOptimizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ExtracurricularController extends Controller
{
    public function index(): View
    {
        $extracurriculars = Extracurricular::latest()->get();
        return view('admin.extracurriculars.index', compact('extracurriculars'));
    }

    public function create(): View
    {
        return view('admin.extracurriculars.create');
    }

    public function store(StoreExtracurricularRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = ImageOptimizer::optimize($request->file('image_path'), 'extracurriculars', 1000, 1000, 75);
        }

        Extracurricular::create($data);

        return redirect()->route('admin.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit(Extracurricular $extracurricular): View
    {
        return view('admin.extracurriculars.edit', compact('extracurricular'));
    }

    public function update(UpdateExtracurricularRequest $request, Extracurricular $extracurricular): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('image_path')) {
            if ($extracurricular->image_path) {
                Storage::disk('public')->delete($extracurricular->image_path);
            }
            $data['image_path'] = ImageOptimizer::optimize($request->file('image_path'), 'extracurriculars', 1000, 1000, 75);
        } else {
            unset($data['image_path']);
        }

        $extracurricular->update($data);

        return redirect()->route('admin.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Extracurricular $extracurricular): RedirectResponse
    {
        if ($extracurricular->image_path) {
            Storage::disk('public')->delete($extracurricular->image_path);
        }

        $extracurricular->delete();

        return redirect()->route('admin.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
