<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama guru wajib diisi.',
            'position.required' => 'Jabatan/Mata Pelajaran wajib diisi.',
            'photo.image' => 'Foto harus berupa berkas citra.',
            'photo.max' => 'Foto tidak boleh melebihi 2MB.',
            'order.integer' => 'Urutan harus berupa angka.',
            'order.min' => 'Urutan minimal bernilai 0.',
        ];
    }
}
