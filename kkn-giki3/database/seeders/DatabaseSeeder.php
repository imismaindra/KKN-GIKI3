<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin default
        User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@sekolah.sch.id',
            'password' => Hash::make('password'),
        ]);

        // Setting default
        Setting::create([
            'school_name' => 'SD Negeri Impian',
            'logo' => null,
            'address' => 'Jl. Pendidikan No. 123, Surabaya',
            'email' => 'info@sdnegriimpian.sch.id',
            'phone' => '031-5551234',
            'vision' => 'Terwujudnya peserta didik yang bertaqwa, cerdas, kreatif, mandiri, dan berwawasan lingkungan.',
            'mission' => "1. Menanamkan keimanan dan ketaqwaan terhadap Tuhan Yang Maha Esa.\n2. Melaksanakan pembelajaran yang aktif, inovatif, dan menyenangkan.\n3. Mengembangkan bakat, minat, dan potensi peserta didik secara optimal.\n4. Menerapkan pembiasaan hidup bersih, sehat, dan peduli lingkungan sekitar.",
            'facebook_url' => 'https://facebook.com/sdnimpian',
            'instagram_url' => 'https://instagram.com/sdnimpian',
            'youtube_url' => 'https://youtube.com/sdnimpian',
        ]);
    }
}
