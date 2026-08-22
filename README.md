<div align="center">

# 🏫 SMA GIKI 3 Surabaya — Website Profil Resmi

### Website Profil & Content Management System (CMS) Sekolah

[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![Vite](https://img.shields.io/badge/Vite-8-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![Pest PHP](https://img.shields.io/badge/Pest_PHP-4-5A29E4?style=for-the-badge&logo=pestphp&logoColor=white)](https://pestphp.com)

---

**Website profil resmi SMA GIKI 3 Surabaya** yang dibangun sebagai bagian dari program **Kuliah Kerja Nyata (KKN)** mahasiswa Universitas.

Website ini dirancang untuk mempublikasikan profil sekolah, sarana prasarana, kegiatan, berita, serta menyediakan **Panel Admin (CMS) interaktif** yang memudahkan pihak sekolah dalam mengelola konten secara mandiri dan real-time.

</div>

---

## 📑 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Arsitektur Proyek](#-arsitektur-proyek)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Panduan Instalasi](#-panduan-instalasi--menjalankan-project)
- [Konfigurasi Database](#-konfigurasi-database)
- [Kredensial Admin Default](#-kredensial-admin-default)
- [Jalur Akses (Route)](#-jalur-akses-route)
- [Menjalankan Pengujian](#-menjalankan-pengujian-testing)
- [Struktur Database](#-struktur-database)
- [Lisensi](#-lisensi)

---

## 🚀 Fitur Utama

### 👥 Halaman Pengunjung (Public Frontend)

| Fitur | Deskripsi |
|-------|-----------|
| **Beranda Dinamis** | Slider banner interaktif dengan headline promosi sekolah |
| **Profil Sekolah** | Detail tentang sekolah, Visi & Misi, serta Sambutan Kepala Sekolah |
| **Direktori Jurusan & Fasilitas** | Menampilkan daftar jurusan (IPA/IPS) serta sarana prasarana sekolah |
| **Direktori Guru & Staf** | Daftar pendidik terurut berdasarkan posisi formal (Kepala Sekolah, Guru, Staf) |
| **Galeri Kegiatan** | Dokumentasi foto-foto kegiatan sekolah yang diunggah secara dinamis |
| **Berita & Artikel** | Publikasi berita terupdate dengan sistem halaman detail dan SEO Meta Tag Generator |
| **Testimoni Publik** | Halaman menulis testimoni langsung oleh siswa/alumni (masuk antrean moderasi admin) |
| **Formulir Kontak** | Formulir hubungi kami untuk mengirimkan pesan langsung ke kotak masuk admin |
| **Ekstrakurikuler** | Daftar kegiatan ekstrakurikuler sekolah beserta deskripsi dan kategori |
| **Akses Portal Sekolah** | Tautan langsung menuju e-Rapor dan sistem Ujian Online sekolah |

### 🛡️ Panel Admin (CMS — Content Management System)

| Modul | Deskripsi |
|-------|-----------|
| **Dashboard Statistik** | Ringkasan jumlah artikel, guru, pesan masuk, dan statistik testimoni |
| **Manajemen Banner** | Mengelola slider halaman beranda (tambah, urutan tampil, status aktif/nonaktif) |
| **Manajemen Jurusan & Fasilitas** | CRUD data jurusan dan sarana prasarana sekolah |
| **Manajemen Guru & Staf** | CRUD direktori pendidik dengan urutan penampilan yang fleksibel |
| **Manajemen Ekstrakurikuler** | Mengelola daftar ekskul sekolah beserta deskripsi dan kategori |
| **Manajemen Artikel** | Editor berita dilengkapi SEO Meta (Title, Keywords, Description) dengan live preview Google |
| **Manajemen Galeri** | Unggah dokumentasi foto kegiatan sekolah secara massal |
| **Moderasi Testimoni** | Persetujuan (approval) satu tombol untuk testimoni pengunjung |
| **Inbox Pesan Masuk** | Melihat, membaca, dan menghapus pesan dari pengunjung |
| **Pengaturan Website** | Konfigurasi logo, nama, kontak, koordinat Maps, tautan portal eksternal |
| **Manajemen Profil Admin** | Ubah password dan email akun administrator |

---

## 🏗️ Arsitektur Proyek

```
KKN/
├── app/
│   ├── Helpers/              # Fungsi bantuan (HtmlSanitizer, ImageOptimizer)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/        # Controller panel admin (CRUD semua modul)
│   │   │   └── Public/       # Controller halaman publik
│   │   ├── Middleware/       # Auth, Admin, Security Headers
│   │   └── Requests/        # Form Request validation
│   ├── Mail/                 # Email templates
│   ├── Models/               # Eloquent models (12 model)
│   ├── Notifications/        # Notifikasi aplikasi
│   └── Providers/            # Service providers
├── config/                   # Konfigurasi aplikasi Laravel
├── database/
│   ├── factories/            # Model factories untuk testing
│   ├── migrations/           # 25 migrasi database
│   └── seeders/              # Seeder data awal sekolah
├── public/                   # Public assets (CSS, JS, images)
├── resources/
│   └── views/
│       ├── admin/            # Blade templates panel admin
│       ├── articles/         # Template halaman artikel
│       ├── galleries/        # Template halaman galeri
│       ├── layouts/          # Layout utama (app, admin)
│       └── ...               # Template halaman lainnya
├── routes/
│   └── web.php               # Definisi route publik & admin
├── tests/                    # Suite pengujian Pest PHP
└── vite.config.js            # Konfigurasi build Vite
```

---

## 🛠️ Teknologi yang Digunakan

### Backend

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| [Laravel](https://laravel.com) | 13.x | Framework PHP untuk backend & routing |
| [PHP](https://www.php.net) | ^8.3 | Bahasa pemrograman server-side |
| [SQLite](https://www.sqlite.org) / MySQL | — | Database (SQLite bawaan, MySQL untuk produksi) |

### Frontend

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| [Tailwind CSS](https://tailwindcss.com) | 4.x | Utility-first CSS framework |
| [Vite](https://vitejs.dev) | 8.x | Build tool & development server |
| Blade Templates | — | Template engine Laravel |
| Vanilla JavaScript | — | Interaktivitas client-side |

### Development & Testing

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| [Pest PHP](https://pestphp.com) | 4.x | Testing framework |
| [Laravel Pint](https://laravel.com/docs/pint) | 1.x | Code style fixer (PSR-12) |
| [Faker PHP](https://fakerphp.github.io) | 1.x | Data dummy untuk testing |
| [Concurrently](https://www.npmjs.com/package/concurrently) | 9.x | Menjalankan beberapa server sekaligus |

---

## 🏁 Panduan Instalasi & Menjalankan Project

### Prasyarat

Pastikan komputer Anda sudah terinstal:

- [ ] **PHP** >= 8.3 (dengan ekstensi: mbstring, xml, ctype, json, bcmath, gd, zip)
- [ ] **Composer** (latest)
- [ ] **Node.js** >= 18 & NPM
- [ ] **Database Server** — SQLite (bawaan) atau MySQL 8+

### Instalasi Cepat

```bash
# 1. Clone repository
git clone <repository-url>
cd KKN

# 2. Jalankan setup otomatis
composer run setup

# 3. Jalankan server development
composer run dev
```

Aplikasi dapat diakses melalui: **http://127.0.0.1:8000**

### Instalasi Manual (Langkah demi Langkah)

<details>
<summary>Klik untuk melihat langkah-langkah manual</summary>

#### 1. Clone Repository

```bash
git clone <repository-url>
cd KKN
```

#### 2. Install Dependencies PHP & Node

```bash
composer install
npm install
```

#### 3. Konfigurasi Environment

```bash
# Salin file .env.example ke .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### 4. Konfigurasi Database

Buka file `.env` dan sesuaikan konfigurasi database:

```env
# Untuk SQLite (default — tidak perlu pengaturan tambahan)
DB_CONNECTION=sqlite

# Untuk MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kkn_giki3
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Jalankan Migrasi Database

```bash
php artisan migrate --force
```

#### 6. Isi Data Awal (Seeders)

```bash
php artisan db:seed
```

> Perintah ini akan mengisi database dengan data default: akun admin, data guru, daftar fasilitas, jurusan, dan pengaturan awal sekolah.

#### 7. Build Asset Frontend

```bash
npm run build
```

#### 8. Jalankan Server

```bash
# Option A: Menggunakan script bawaan (recommended)
composer run dev

# Option B: Manual (per terminal terpisah)
php artisan serve
php artisan queue:listen --tries=1
npm run dev
```

</details>

---

## ⚙️ Konfigurasi Database

### Menggunakan SQLite (Default — Direkomendasikan untuk Development)

SQLite sudah dikonfigurasi secara otomatis. Database akan dibuat di `database/database.sqlite` saat pertama kali menjalankan `php artisan migrate`.

### Menggunakan MySQL

1. Buat database baru di MySQL:
   ```sql
   CREATE DATABASE kkn_giki3 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Update konfigurasi di `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kkn_giki3
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

3. Jalankan migrasi:
   ```bash
   php artisan migrate --force
   ```

---

## 🔑 Kredensial Admin Default

Untuk masuk ke **Panel Admin** (`http://127.0.0.1:8000/admin/login`):

| Field | Nilai |
|-------|-------|
| **Email** | `admin@sekolah.sch.id` |
| **Password** | `password` |

> ⚠️ **Penting:** Segera ubah password default setelah pertama kali login untuk keamanan.

---

## 🗺️ Jalur Akses (Route)

### Halaman Publik

| Route | Method | Deskripsi |
|-------|--------|-----------|
| `/` | GET | Beranda utama |
| `/berita-artikel` | GET | Daftar berita & artikel |
| `/berita-artikel/{slug}` | GET | Detail artikel |
| `/guru-staff` | GET | Direktori guru & staf |
| `/galeri` | GET | Galeri kegiatan sekolah |
| `/galeri/{id}` | GET | Detail galeri |
| `/ekstrakurikuler` | GET | Daftar ekstrakurikuler |
| `/testimoni/tulis` | GET/POST | Formulir tulis testimoni |
| `/kontak` | POST | Kirim pesan (throttle: 5/menit) |
| `/sitemap.xml` | GET | Sitemap XML untuk SEO |

### Panel Admin (Memerlukan Autentikasi)

| Route | Method | Deskripsi |
|-------|--------|-----------|
| `/admin/login` | GET/POST | Halaman login admin |
| `/admin/dashboard` | GET | Dashboard statistik |
| `/admin/banners` | CRUD | Manajemen banner |
| `/admin/majors` | CRUD | Manajemen jurusan |
| `/admin/facilities` | CRUD | Manajemen fasilitas |
| `/admin/teachers` | CRUD | Manajemen guru & staf |
| `/admin/extracurriculars` | CRUD | Manajemen ekstrakurikuler |
| `/admin/articles` | CRUD | Manajemen artikel |
| `/admin/galleries` | CRUD | Manajemen galeri |
| `/admin/testimonials` | CRUD | Moderasi testimoni |
| `/admin/contact-messages` | R/D | Inbox pesan masuk |
| `/admin/settings` | GET/PUT | Pengaturan website |
| `/admin/profile` | GET/PUT | Profil admin |

---

## 🧪 Menjalankan Pengujian (Testing)

```bash
# Jalankan semua test
composer run test

# Jalankan test tertentu
php artisan test --filter=ArticleTest

# Jalankan dengan output verbose
php artisan test --verbose
```

Framework testing: **Pest PHP** dengan fitur dataset, mocking, dan browser testing.

---

## 📊 Struktur Database

Database terdiri dari **12 tabel** utama:

| Tabel | Fungsi |
|-------|--------|
| `users` | Akun administrator |
| `settings` | Pengaturan dinamis website (logo, kontak, dll) |
| `banners` | Slider banner beranda |
| `majors` | Data jurusan (IPA/IPS) |
| `facilities` | Data sarana prasarana |
| `teachers` | Data guru & staf |
| `articles` | Berita & artikel |
| `galleries` | Album galeri kegiatan |
| `gallery_images` | Foto-foto dalam galeri |
| `testimonials` | Testimoni pengunjung |
| `contact_messages` | Pesan dari formulir kontak |
| `extracurriculars` | Kegiatan ekstrakurikuler |

---

## 🔒 Keamanan

Proyek ini telah dilengkapi dengan berbagai lapisan keamanan:

- **Autentikasi & Otorisasi** — Middleware `auth` + `admin` untuk proteksi route admin
- **Brute-Force Protection** — Rate limiting pada login (5 percobaan/menit)
- **Input Sanitization** — HTML sanitizer untuk konten artikel & pengaturan
- **XSS Prevention** — Escape output menggunakan `@json()` dan `{{ }}`
- **CSRF Protection** — Token CSRF pada semua form
- **Security Headers** — X-Frame-Options, X-Content-Type-Options, Referrer-Policy, X-XSS-Protection
- **SQL Injection Prevention** — Eloquent ORM dengan parameter binding
- **File Upload Validation** — Validasi tipe file dan ukuran maksimal

---

## 📝 Changelog

Lihat [BUG_REPORT.md](BUG_REPORT.md) untuk detail perbaikan bug dan perubahan yang telah dilakukan.

---

## 👥 Tim Pengembang

Proyek ini dikembangkan oleh **Tim Mahasiswa KKN** untuk mendukung digitalisasi administrasi dan publikasi informasi SMA GIKI 3 Surabaya.

---

## 📄 Lisensi

Proyek ini menggunakan lisensi **MIT**. Silakan lihat file [LICENSE](LICENSE) untuk informasi lebih lanjut.

---

<div align="center">

**Dibuat dengan ❤️ untuk SMA GIKI 3 Surabaya**

</div>
