<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'image_path' => ['required', 'image', 'max:2048'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'url', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul banner wajib diisi.',
            'image_path.required' => 'Gambar banner wajib diunggah.',
            'image_path.image' => 'Gambar harus berupa berkas citra (PNG, JPG, dll).',
            'image_path.max' => 'Gambar tidak boleh melebihi 2MB.',
            'button_url.url' => 'Tautan tombol harus berupa URL yang valid.',
            'order.integer' => 'Urutan harus berupa angka.',
            'order.min' => 'Urutan minimal bernilai 0.',
        ];
    }
}
