<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFacilityRequest;
use App\Http\Requests\Admin\UpdateFacilityRequest;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index(): View
    {
        $facilities = Facility::latest()->get();
        return view('admin.facilities.index', compact('facilities'));
    }

    public function create(): View
    {
        return view('admin.facilities.create');
    }

    public function store(StoreFacilityRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('facilities', 'public');
        }

        Facility::create($data);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Facility $facility): View
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(UpdateFacilityRequest $request, Facility $facility): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            if ($facility->image_path) {
                Storage::disk('public')->delete($facility->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('facilities', 'public');
        } else {
            unset($data['image_path']);
        }

        $facility->update($data);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $facility): RedirectResponse
    {
        if ($facility->image_path) {
            Storage::disk('public')->delete($facility->image_path);
        }

        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
