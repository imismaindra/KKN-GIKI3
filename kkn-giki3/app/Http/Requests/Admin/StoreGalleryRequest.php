<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['image', 'max:5120'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul galeri wajib diisi.',
            'images.required' => 'Foto galeri wajib diunggah.',
            'images.array' => 'Format berkas tidak valid.',
            'images.min' => 'Wajib mengunggah minimal satu foto.',
            'images.*.image' => 'Berkas harus berupa gambar.',
            'images.*.max' => 'Setiap gambar tidak boleh melebihi 5MB.',
        ];
    }
}
