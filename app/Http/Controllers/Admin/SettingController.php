<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use App\Helpers\HtmlSanitizer;
use App\Helpers\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        $setting = Setting::firstOrCreate([]);
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(UpdateSettingRequest $request): RedirectResponse
    {
        $setting = Setting::firstOrCreate([]); // Fallback jika record belum ada
        $data = $request->validated();

        // Sanitasi HTML dari field teks untuk mencegah XSS
        $data['about_title'] = isset($data['about_title']) ? strip_tags($data['about_title']) : null;
        $data['headmaster_speech_title'] = isset($data['headmaster_speech_title']) ? strip_tags($data['headmaster_speech_title']) : null;

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            // Simpan logo baru
            $result = ImageOptimizer::optimize($request->file('logo'), 'settings', 300, 300, 85);
            if ($result === false) {
                return back()->withInput()->with('error', 'Gagal mengupload logo. Silakan coba lagi.');
            }
            $data['logo'] = $result;
        } else {
            unset($data['logo']);
        }

        if ($request->hasFile('about_image')) {
            if ($setting->about_image) {
                Storage::disk('public')->delete($setting->about_image);
            }
            $result = ImageOptimizer::optimize($request->file('about_image'), 'settings', 1200, 800, 80);
            if ($result === false) {
                return back()->withInput()->with('error', 'Gagal mengupload gambar profil. Silakan coba lagi.');
            }
            $data['about_image'] = $result;
        } else {
            unset($data['about_image']);
        }

        if ($request->hasFile('headmaster_photo')) {
            if ($setting->headmaster_photo) {
                Storage::disk('public')->delete($setting->headmaster_photo);
            }
            $result = ImageOptimizer::optimize($request->file('headmaster_photo'), 'settings', 600, 750, 80);
            if ($result === false) {
                return back()->withInput()->with('error', 'Gagal mengupload foto kepala sekolah. Silakan coba lagi.');
            }
            $data['headmaster_photo'] = $result;
        } else {
            unset($data['headmaster_photo']);
        }

        $setting->update($data);

        return back()->with('success', 'Pengaturan sekolah berhasil diperbarui.');
    }
}
