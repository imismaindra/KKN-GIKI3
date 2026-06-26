<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setting;
use App\Models\Extracurricular;
use App\Models\Major;
use App\Models\Facility;
use App\Models\Teacher;
use App\Models\Banner;
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
                'about_description' => 'SMA GIKI 3 Surabaya didirikan dengan visi menjadi sekolah unggulan yang menghasilkan lulusan berkualitas tinggi. Dengan motto "GESIT", kami berkomitmen untuk membentuk generasi yang cerdas, berkarakter, dan siap menghadapi tantangan masa depan.',
                'headmaster_name' => 'Dyah Puspita Tri Wulandari, M.Pd',
                'headmaster_speech' => "Selamat datang di SMA GIKI 3 Surabaya. Kami berkomitmen untuk memberikan pendidikan terbaik bagi putra-putri bangsa. Dengan motto 'GESIT', kami mengajak seluruh siswa untuk menjadi generasi yang cerdas, berkarakter, dan siap menghadapi tantangan masa depan. Mari bersama-sama membangun masa depan yang gemilang melalui pendidikan berkualitas.",
                'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5902137818302!2d112.773000574839!3d-7.287376992720005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa47d22c3291%3A0x92b8e0d77b387367!2sSMP%20%26%20SMA%20Giki%203!5e0!3m2!1sid!2sid!4v1782139832214!5m2!1sid!2sid',
                'erapor_url' => 'http://36.66.203.29:8239/',
                'ujian_url' => 'http://36.66.203.29:4610/login/index.php',
            ]
        );

        // Extracurriculars default
        $extracurriculars = [
            [
                'name' => 'KIR',
                'slug' => 'kir',
                'category' => 'Akademik',
                'description' => 'Karya Ilmiah Remaja — wadah bagi siswa yang ingin mengeksplorasi dunia sains dan penelitian melalui karya ilmiah yang inovatif.',
                'pembina' => null,
                'schedule' => null,
                'icon' => 'science',
                'image_path' => null,
            ],
            [
                'name' => 'Paskibra',
                'slug' => 'paskibra',
                'category' => 'Bela Negara',
                'description' => 'Pasukan Pengibar Bendera — melatih kedisiplinan, nasionalisme, dan kebanggaan sebagai generasi penerus bangsa.',
                'pembina' => null,
                'schedule' => null,
                'icon' => 'flag',
                'image_path' => null,
            ],
            [
                'name' => 'Modern Dance',
                'slug' => 'modern-dance',
                'category' => 'Seni & Budaya',
                'description' => 'Mengekspresikan kreativitas dan semangat muda melalui gerakan tari modern yang dinamis dan penuh energi.',
                'pembina' => null,
                'schedule' => null,
                'icon' => 'music_note',
                'image_path' => null,
            ],
            [
                'name' => 'Cheerleaders',
                'slug' => 'cheerleaders',
                'category' => 'Seni & Budaya',
                'description' => 'Membangun kebersamaan, kepercayaan diri, dan semangat juang melalui atraksi sorak dan akrobatik yang memukau.',
                'pembina' => null,
                'schedule' => null,
                'icon' => 'stars',
                'image_path' => null,
            ],
            [
                'name' => 'Paduan Suara',
                'slug' => 'paduan-suara',
                'category' => 'Seni & Budaya',
                'description' => 'Menyatukan suara dan harmoni dalam paduan yang indah, aktif tampil di berbagai acara sekolah dan kompetisi paduan suara.',
                'pembina' => null,
                'schedule' => null,
                'icon' => 'queue_music',
                'image_path' => null,
            ],
            [
                'name' => 'Basket',
                'slug' => 'basket',
                'category' => 'Olahraga',
                'description' => 'Membangun sportivitas, disiplin, dan kerjasama tim di lapangan kompetisi basket antar sekolah.',
                'pembina' => null,
                'schedule' => null,
                'icon' => 'sports_basketball',
                'image_path' => null,
            ],
            [
                'name' => 'Volley',
                'slug' => 'volley',
                'category' => 'Olahraga',
                'description' => 'Meningkatkan kemampuan teknik dan mental bertanding melalui latihan bola voli yang terstruktur dan kompetitif.',
                'pembina' => null,
                'schedule' => null,
                'icon' => 'sports_volleyball',
                'image_path' => null,
            ],
            [
                'name' => 'Futsal',
                'slug' => 'futsal',
                'category' => 'Olahraga',
                'description' => 'Mengasah teknik, strategi, dan kekompakan tim di lapangan futsal dalam berbagai turnamen antar pelajar.',
                'pembina' => null,
                'schedule' => null,
                'icon' => 'sports_soccer',
                'image_path' => null,
            ],
            [
                'name' => 'Band',
                'slug' => 'band',
                'category' => 'Seni & Budaya',
                'description' => 'Menyalurkan bakat musik dan kreativitas siswa melalui latihan band dan penampilan di berbagai panggung sekolah.',
                'pembina' => null,
                'schedule' => null,
                'icon' => 'piano',
                'image_path' => null,
            ],
        ];

        foreach ($extracurriculars as $ekskul) {
            Extracurricular::updateOrCreate(
                ['slug' => $ekskul['slug']],
                $ekskul
            );
        }

        // Majors default
        $majors = [
            [
                'name' => 'Jurusan IPA',
                'slug' => 'ipa',
                'description' => 'Ilmu Pengetahuan Alam — program jurusan yang berfokus pada mata pelajaran sains seperti Fisika, Kimia, dan Biologi untuk mempersiapkan siswa menuju perguruan tinggi sains dan teknologi.',
                'icon' => 'biotech',
                'image_path' => null,
            ],
            [
                'name' => 'Jurusan IPS',
                'slug' => 'ips',
                'description' => 'Ilmu Pengetahuan Sosial — program jurusan yang berfokus pada mata pelajaran sosial seperti Ekonomi, Sosiologi, dan Geografi untuk mempersiapkan siswa menuju perguruan tinggi ilmu sosial dan humaniora.',
                'icon' => 'groups',
                'image_path' => null,
            ],
        ];

        foreach ($majors as $major) {
            Major::updateOrCreate(
                ['slug' => $major['slug']],
                $major
            );
        }

        // Facilities default
        $facilities = [
            [
                'name' => 'Ruang Kelas',
                'description' => 'Tersedia 10 ruang kelas yang nyaman dan representatif, dilengkapi dengan fasilitas belajar modern untuk mendukung proses pembelajaran yang efektif.',
                'icon' => 'meeting_room',
                'image_path' => null,
            ],
            [
                'name' => 'Laboratorium Fisika',
                'description' => 'Laboratorium fisika lengkap dengan peralatan eksperimen modern untuk menunjang praktikum dan penelitian siswa dalam memahami konsep fisika secara langsung.',
                'icon' => 'science',
                'image_path' => null,
            ],
            [
                'name' => 'Laboratorium Kimia',
                'description' => 'Laboratorium kimia yang dilengkapi dengan peralatan dan bahan praktikum standar untuk mendukung kegiatan eksperimen dan pembelajaran kimia secara langsung.',
                'icon' => 'biotech',
                'image_path' => null,
            ],
            [
                'name' => 'Laboratorium Bahasa',
                'description' => 'Laboratorium bahasa modern dengan perangkat audio-visual yang memadai untuk mendukung pembelajaran bahasa secara intensif dan interaktif.',
                'icon' => 'headset_mic',
                'image_path' => null,
            ],
            [
                'name' => 'Laboratorium Komputer',
                'description' => 'Laboratorium komputer dengan unit komputer lengkap dan koneksi internet yang mendukung pembelajaran teknologi informasi dan komunikasi.',
                'icon' => 'computer',
                'image_path' => null,
            ],
            [
                'name' => 'Perpustakaan',
                'description' => 'Perpustakaan sekolah dengan koleksi buku yang lengkap dan beragam, menyediakan ruang baca yang nyaman untuk mendukung minat literasi siswa.',
                'icon' => 'local_library',
                'image_path' => null,
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::updateOrCreate(
                ['name' => $facility['name']],
                $facility
            );
        }

        // Teachers default
        $teachers = [
            ['name' => 'Aminatus Zuhriyah, S.Pd',        'position' => 'Guru', 'photo' => null, 'order' => 1],
            ['name' => 'Desy Trie Suciarsie, S.Pd',      'position' => 'Guru', 'photo' => null, 'order' => 2],
            ['name' => 'Dita Hardian Pratama, S.Pd',     'position' => 'Guru', 'photo' => null, 'order' => 3],
            ['name' => 'Dra. Lilik Soebarijati',         'position' => 'Guru', 'photo' => null, 'order' => 4],
            ['name' => 'Dyah Puspita Tri W., M.Pd',      'position' => 'Kepala Sekolah', 'photo' => null, 'order' => 0],
            ['name' => 'Fahmiyah Wirayanti, S.Pd',       'position' => 'Guru', 'photo' => null, 'order' => 5],
            ['name' => 'M. Suadi, S.Ag, M.Pdi',          'position' => 'Guru', 'photo' => null, 'order' => 6],
            ['name' => 'Mey Indah Wati, S.Pd',           'position' => 'Guru', 'photo' => null, 'order' => 7],
            ['name' => 'Pdt. Suherno',                   'position' => 'Guru', 'photo' => null, 'order' => 8],
            ['name' => 'Rendra Mei Herdyanto, S.Pd',     'position' => 'Guru', 'photo' => null, 'order' => 9],
            ['name' => 'Romadhona, S.Pd',                'position' => 'Guru', 'photo' => null, 'order' => 10],
            ['name' => 'Shela Sonia, S.Pd',              'position' => 'Guru', 'photo' => null, 'order' => 11],
        ];

        foreach ($teachers as $teacher) {
            Teacher::updateOrCreate(
                ['name' => $teacher['name']],
                $teacher
            );
        }

        // Default banner (permanent, tidak bisa dihapus)
        Banner::updateOrCreate(
            ['is_default' => true],
            [
                'title'           => 'Membentuk Karakter, Mengukir Prestasi',
                'subtitle'        => 'Berkomitmen pada keunggulan akademis dan pembentukan karakter mulia melalui semangat Merdeka Belajar, mencetak pemimpin masa depan yang berwawasan global.',
                'image_path'      => null,
                'button_text'     => 'Jelajahi Profil',
                'button_url'      => '#profil',
                'order'           => 0,
                'is_active'       => true,
                'is_default'      => true,
                'alignment'       => 'left',
                'cta_color'       => 'amber',
                'overlay_opacity' => 60,
                'text_color'      => 'light',
            ]
        );
    }
}
