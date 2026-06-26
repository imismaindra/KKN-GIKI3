<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use App\Helpers\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function index(): View
    {
        $banners = Banner::orderBy('order')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create(): View
    {
        return view('admin.banners.create');
    }

    public function store(StoreBannerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_path')) {
            $data['image_path'] = ImageOptimizer::optimize($request->file('image_path'), 'banners', 1920, 1080, 80);
        }

        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner): View
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_path')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $data['image_path'] = ImageOptimizer::optimize($request->file('image_path'), 'banners', 1920, 1080, 80);
        } else {
            unset($data['image_path']);
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function toggleActive(Banner $banner): RedirectResponse
    {
        if ($banner->is_default) {
            return redirect()->back()->with('error', 'Banner utama tidak dapat dinonaktifkan.');
        }

        $banner->update([
            'is_active' => !$banner->is_active
        ]);

        $statusText = $banner->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Banner \"{$banner->title}\" berhasil {$statusText}.");
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        if ($banner->is_default) {
            return redirect()->route('admin.banners.index')->with('error', 'Banner utama tidak dapat dihapus.');
        }

        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}
