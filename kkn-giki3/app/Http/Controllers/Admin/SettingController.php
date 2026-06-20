<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
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
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        } else {
            unset($data['logo']);
        }

        $setting->update($data);

        return back()->with('success', 'Pengaturan sekolah berhasil diperbarui.');
    }
}
