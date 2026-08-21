<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMajorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image_path' => ['nullable', 'image', 'max:2048'],
            'icon' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama jurusan wajib diisi.',
            'description.required' => 'Deskripsi jurusan wajib diisi.',
            'image_path.image' => 'Gambar harus berupa berkas citra.',
            'image_path.max' => 'Gambar tidak boleh melebihi 2MB.',
        ];
    }
}
