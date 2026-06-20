<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'max:5120'],
            'delete_images' => ['nullable', 'array'],
            'delete_images.*' => ['string', 'exists:gallery_images,id'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul galeri wajib diisi.',
            'images.array' => 'Format berkas tidak valid.',
            'images.*.image' => 'Berkas harus berupa gambar.',
            'images.*.max' => 'Setiap gambar tidak boleh melebihi 5MB.',
        ];
    }
}
