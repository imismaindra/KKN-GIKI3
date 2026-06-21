<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setting;
use App\Models\Extracurricular;
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
        User::firstOrCreate(
            ['email' => 'admin@sekolah.sch.id'],
            [
                'name' => 'Admin Sekolah',
                'password' => Hash::make('password'),
            ]
        );

        // Setting default
        Setting::updateOrCreate(
            [],
            [
                'school_name' => 'SMA GIKI 3 SURABAYA',
                'logo' => null,
                'address' => 'Jl. Klampis Jaya No. 11, Klampis Ngasem, Kec. Sukolilo, Surabaya, Jawa Timur 60117',
                'email' => 'info@smagiki3surabaya.sch.id',
                'phone' => '031-5996405',
                'vision' => 'Beriman dan bertaqwa, berilmu pengetahuan dan teknologi, berprestasi unggul, berkepribadian, berbudaya, berwawasan kebangsaan dan lingkungan demi terwujudnya kedamaian dan kesejahteraan.',
                'mission' => "1. Meningkatkan keimanan dan ketaqwaan terhadap Tuhan Yang Maha Esa.\n2. Tanggap dan terampil terhadap perkembangan ilmu pengetahuan dan teknologi.\n3. Meningkatkan kualitas sumber daya manusia dan berprestasi unggul.\n4. Menanamkan disiplin dan loyalitas kebangsaan kepada almamater dan profesionalisme.\n5. Berkepribadian, berbudaya, dan berwawasan kebangsaan dan lingkungan.\n6. Membangun kekeluargaan dan kebersamaan.\n7. Mewujudkan kedamaian dan kesejahteraan.",
                'tiktok_url' => 'https://www.tiktok.com/@smagiga_media',
                'instagram_url' => 'https://instagram.com/smagiga',
                'youtube_url' => 'https://youtube.com/@smagiki3surabaya730',
            ]
        );

        // Extracurriculars default
        $extracurriculars = [
            [
                'name' => 'Tari Tradisional',
                'slug' => 'tari-tradisional',
                'category' => 'Seni & Budaya',
                'description' => 'Melestarikan warisan budaya nusantara melalui gerak dan harmoni, tampil di berbagai festival nasional.',
                'pembina' => 'Dra. Endang Purwanti',
                'schedule' => 'Jumat, 14.30 - 16.30 WIB',
                'icon' => 'palette',
                'image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCO38iPlrza6vYZYAyX7PQAxDVL--q0_tE-V_UCbUGC-pyQolX8VgYMyo6iv_N-B6rc6XSyZRvI-NVKEhJsCU0038zo9-pIL4hcuBmOlUMAt_sjOCELOOTLqqJ01m1mjAqLnLUFZm6ovBKVj0Rf2dFR-TCG6_Joxy3aHzWCp7rQPkq8iazwqK9H-YdIFRWPeFrm7rsDCdyewWEzqCmZWrjfzYsE75wM8OzERM7JgOZbjm05LBnyVqE2G3HdyEpDYrdLah_a6LIItnQH',
            ],
            [
                'name' => 'Tim Basket',
                'slug' => 'tim-basket',
                'category' => 'Olahraga',
                'description' => 'Membangun sportivitas, disiplin, dan kerjasama tim di lapangan kompetisi basket antar sekolah.',
                'pembina' => 'Aris Setiawan, S.Pd.',
                'schedule' => 'Sabtu, 08.00 - 10.00 WIB',
                'icon' => 'sports_basketball',
                'image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDLT7MEGmBhEANV3w7U9898OXQr0DfDB-zyie1rzCazRqQCp2WDP5C__pIeFuFKDctbpiWNHws6BEY6szXryhToLKbq90tfdE6Y1O6Tn2VuaikLd557R3t7CYRg5y2Zn8RDHsWAysfVM_VGptUagChzGLzg0qNdYxTOerHcCq-UGFxfeKJvymE5ihuagw8igMUdFNuCiTwIonQkf1AcW_gusX6kYXgPFegt2B0KL6lHFNt_mbOpPhOtQNdrgWud58p_QmLn08xv1fi-',
            ],
            [
                'name' => 'Klub Robotika',
                'slug' => 'klub-robotika',
                'category' => 'Sains & Teknologi',
                'description' => 'Inovasi teknologi masa depan dirancang hari ini melalui pemecahan masalah praktis dan pemrograman perangkat keras.',
                'pembina' => 'Budi Hartono, M.T.',
                'schedule' => 'Kamis, 15.00 - 17.00 WIB',
                'icon' => 'precision_manufacturing',
                'image_path' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuATkTVQBv3VR4_U_-0KyWt1VrqYlg0Oo46X8_esHSTLqZZwhJ5HjQJxpS5TSZtnrVJl0Q84yo_P66zUvitxlE7LEylw4kMDwPPXETHL878Q6NZTYouQSvswKvvHXMQ2qtIOMui0RTxV7pAxX0iuO5kNG3a0VFxo69QUbMTw087TaDgrdgnpLSQPmjIfyoYqAgVDv7UQMQ1bqbXvzFwulLmxV-bpJkcQaWV1G7QblZZiWCuqa0GpXIMS-6mBtMMG5lVz6S0cQwpf50K2',
            ],
            [
                'name' => 'Pramuka',
                'slug' => 'pramuka',
                'category' => 'Kepanduan',
                'description' => 'Melatih kepemimpinan, kemandirian, kedisiplinan, dan rasa cinta tanah air melalui berbagai kegiatan kepanduan yang seru.',
                'pembina' => 'Kak Hariyono, S.Sos.',
                'schedule' => 'Jumat, 13.00 - 15.00 WIB',
                'icon' => 'forest',
                'image_path' => null,
            ],
            [
                'name' => 'PMR (Palang Merah Remaja)',
                'slug' => 'pmr-palang-merah-remaja',
                'category' => 'Sosial & Kesehatan',
                'description' => 'Mempelajari pertolongan pertama, donor darah, hidup sehat, serta kepedulian sosial terhadap sesama.',
                'pembina' => 'dr. Siska Amelia',
                'schedule' => 'Rabu, 14.30 - 16.30 WIB',
                'icon' => 'medical_services',
                'image_path' => null,
            ],
        ];

        foreach ($extracurriculars as $ekskul) {
            Extracurricular::updateOrCreate(
                ['slug' => $ekskul['slug']],
                $ekskul
            );
        }
    }
}
