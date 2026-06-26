<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Helpers\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PublicTestimonialController extends Controller
{
    /**
     * Show the public testimonial submission form.
     */
    public function create(): View
    {
        return view('testimonials.create');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'relationship' => ['required', 'string', 'max:255'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
            'content' => ['required', 'string'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'relationship.required' => 'Status/Hubungan wajib diisi.',
            'rating.integer' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal bernilai 1.',
            'rating.max' => 'Rating maksimal bernilai 5.',
            'content.required' => 'Isi testimoni wajib diisi.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        $data = $validated;
        $data['is_approved'] = false; // Default false for public submission

        if ($request->hasFile('avatar')) {
            $data['avatar'] = ImageOptimizer::optimize($request->file('avatar'), 'testimonials', 300, 300, 75);
        }

        Testimonial::create($data);

        return redirect()->route('testimonials.create.public')->with('success', 'Terima kasih! Testimoni Anda telah berhasil dikirimkan dan akan segera ditinjau oleh administrator sebelum ditampilkan.');
    }
}
