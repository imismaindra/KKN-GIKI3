<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'relationship' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama pemberi testimoni wajib diisi.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.max' => 'Avatar tidak boleh melebihi 2MB.',
            'relationship.required' => 'Hubungan/Status (misal: Alumni) wajib diisi.',
            'content.required' => 'Isi testimoni wajib diisi.',
            'rating.integer' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal bernilai 1.',
            'rating.max' => 'Rating maksimal bernilai 5.',
        ];
    }
}
