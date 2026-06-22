<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use App\Helpers\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        $setting = Setting::first();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(UpdateSettingRequest $request): RedirectResponse
    {
        $setting = Setting::firstOrCreate([]); // Fallback jika record belum ada
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            // Simpan logo baru
            $data['logo'] = ImageOptimizer::optimize($request->file('logo'), 'settings', 300, 300, 85);
        } else {
            unset($data['logo']);
        }

        if ($request->hasFile('about_image')) {
            if ($setting->about_image) {
                Storage::disk('public')->delete($setting->about_image);
            }
            $data['about_image'] = ImageOptimizer::optimize($request->file('about_image'), 'settings', 1200, 800, 80);
        } else {
            unset($data['about_image']);
        }

        if ($request->hasFile('headmaster_photo')) {
            if ($setting->headmaster_photo) {
                Storage::disk('public')->delete($setting->headmaster_photo);
            }
            $data['headmaster_photo'] = ImageOptimizer::optimize($request->file('headmaster_photo'), 'settings', 600, 750, 80);
        } else {
            unset($data['headmaster_photo']);
        }

        $setting->update($data);

        return back()->with('success', 'Pengaturan sekolah berhasil diperbarui.');
    }
}
