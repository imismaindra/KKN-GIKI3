<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTestimonialRequest;
use App\Http\Requests\Admin\UpdateTestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use App\Helpers\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        // Display latest testimonials
        $testimonials = Testimonial::latest()->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(StoreTestimonialRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_approved'] = $request->boolean('is_approved');

        if ($request->hasFile('avatar')) {
            $result = ImageOptimizer::optimize($request->file('avatar'), 'testimonials', 300, 300, 75);
            if ($result === false) {
                return back()->withInput()->with('error', 'Gagal mengupload avatar. Silakan coba lagi.');
            }
            $data['avatar'] = $result;
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->validated();
        $data['is_approved'] = $request->boolean('is_approved'); // will be false if unchecked

        if ($request->hasFile('avatar')) {
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $result = ImageOptimizer::optimize($request->file('avatar'), 'testimonials', 300, 300, 75);
            if ($result === false) {
                return back()->withInput()->with('error', 'Gagal mengupload avatar. Silakan coba lagi.');
            }
            $data['avatar'] = $result;
        } else {
            unset($data['avatar']);
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function toggleApproval(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update([
            'is_approved' => !$testimonial->is_approved
        ]);

        $statusText = $testimonial->is_approved ? 'Disetujui' : 'Batal Disetujui';
        return redirect()->back()->with('success', "Status persetujuan testimoni \"{$testimonial->name}\" berhasil diubah menjadi: {$statusText}.");
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
