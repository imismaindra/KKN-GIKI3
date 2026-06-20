<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
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

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('banners', 'public');
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

        if ($request->hasFile('image_path')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('banners', 'public');
        } else {
            unset($data['image_path']);
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}
