<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'school_name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'address' => ['required', 'string'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'vision' => ['required', 'string'],
            'mission' => ['required', 'string'],
            'tiktok_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'about_title' => ['nullable', 'string', 'max:255'],
            'about_description' => ['nullable', 'string'],
            'about_image' => ['nullable', 'image', 'max:2048'],
            'about_year_founded' => ['nullable', 'string', 'max:10'],
            'about_accreditation' => ['nullable', 'string', 'max:50'],
            'about_card_title' => ['nullable', 'string', 'max:255'],
            'about_card_desc' => ['nullable', 'string'],
            'headmaster_name' => ['nullable', 'string', 'max:255'],
            'headmaster_title' => ['nullable', 'string', 'max:255'],
            'headmaster_photo' => ['nullable', 'image', 'max:2048'],
            'headmaster_speech_title' => ['nullable', 'string', 'max:255'],
            'headmaster_speech' => ['nullable', 'string'],
            'maps_embed' => ['nullable', 'string', 'regex:/^https:\/\/www\.google\.com\/maps\/embed/', 'max:1000'],
            'erapor_url' => ['nullable', 'url', 'max:255'],
            'ujian_url' => ['nullable', 'url', 'max:255'],
            'stat_students' => ['nullable', 'integer', 'min:0'],
            'stat_teachers' => ['nullable', 'integer', 'min:0'],
            'stat_achievements' => ['nullable', 'integer', 'min:0'],
            'stat_years' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'school_name.required' => 'Nama sekolah wajib diisi.',
            'logo.image' => 'Logo harus berupa berkas gambar.',
            'logo.max' => 'Logo tidak boleh lebih dari 2MB.',
            'address.required' => 'Alamat wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'vision.required' => 'Visi sekolah wajib diisi.',
            'mission.required' => 'Misi sekolah wajib diisi.',
            'tiktok_url.url' => 'Format tautan TikTok tidak valid.',
            'instagram_url.url' => 'Format tautan Instagram tidak valid.',
            'youtube_url.url' => 'Format tautan YouTube tidak valid.',
            'maps_embed.regex' => 'Tautan Google Maps tidak valid. Gunakan opsi "Sematkan peta" dari Google Maps.',
            'maps_embed.max' => 'Tautan Google Maps terlalu panjang.',
        ];
    }
}
