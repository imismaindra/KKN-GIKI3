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
            'image_path' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul galeri wajib diisi.',
            'image_path.image' => 'Berkas harus berupa gambar.',
            'image_path.max' => 'Gambar tidak boleh melebihi 2MB.',
        ];
    }
}
