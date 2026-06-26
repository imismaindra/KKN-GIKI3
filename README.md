# 🏫 Website Resmi SMA GIKI 3 Surabaya (KKN GIKI 3)

Website profil resmi **SMA GIKI 3 Surabaya** yang dibangun sebagai bagian dari program Kuliah Kerja Nyata (KKN) mahasiswa Universitas. Website ini dirancang untuk mempublikasikan profil sekolah, sarana prasarana, kegiatan, berita, serta menyediakan Panel Admin (CMS) yang interaktif untuk memudahkan pihak sekolah dalam mengelola konten secara mandiri dan real-time.

---

## 🚀 Fitur Utama

### 👥 Halaman Pengunjung (Public Frontend)
- **Beranda Dinamis:** Slider banner interaktif dengan headline promosi sekolah.
- **Profil Sekolah:** Detail tentang sekolah, Visi & Misi, serta Sambutan Kepala Sekolah.
- **Direktori Jurusan & Fasilitas:** Menampilkan daftar jurusan (IPA/IPS) serta sarana prasarana sekolah yang representatif.
- **Direktori Guru & Staf:** Daftar pendidik terurut berdasarkan posisi formal (Kepala Sekolah, Guru, Staf).
- **Galeri Kegiatan:** Dokumentasi foto-foto kegiatan sekolah yang diunggah secara dinamis.
- **Berita & Artikel:** Publikasi berita terupdate sekolah dengan sistem halaman detail dan SEO Meta Tag Generator.
- **Testimoni Publik:** Halaman menulis testimoni langsung oleh siswa/alumni yang akan masuk ke antrean moderasi admin.
- **Formulir Kontak:** Formulir hubungi kami untuk mengirimkan pesan langsung ke kotak masuk admin.
- **Akses Portal Sekolah:** Tautan langsung menuju e-Rapor dan sistem Ujian Online sekolah.

### 🛡️ Panel Admin (CMS - Content Management System)
- **Dashboard Statistik:** Ringkasan jumlah artikel, guru, pesan masuk, dan statistik testimoni.
- **Manajemen Banner:** Mengelola slider halaman beranda (tambah, urutan tampil, status aktif/nonaktif).
- **Manajemen Jurusan & Fasilitas:** CRUD data jurusan dan sarana prasarana sekolah.
- **Manajemen Guru & Staf:** CRUD direktori pendidik dengan urutan penampilan yang fleksibel.
- **Manajemen Ekstrakurikuler:** Mengelola daftar ekskul sekolah berserta deskripsi dan kategori.
- **Manajemen Artikel:** Editor berita dilengkapi pengisian SEO Meta (Title, Keywords, Description) dengan live preview tampilan pencarian Google.
- **Manajemen Galeri:** Unggah dokumentasi foto kegiatan sekolah secara massal.
- **Moderasi Testimoni:** Sistem persetujuan (approval) satu tombol untuk testimoni pengunjung sebelum tampil di halaman depan.
- **Inbox Pesan Masuk:** Melihat, membaca, dan menghapus pesan yang dikirim oleh pengunjung melalui formulir kontak.
- **Pengaturan Website Instan:** Konfigurasi dinamis untuk logo sekolah, nama, kontak (alamat, telepon, email, media sosial), koordinat Google Maps, serta tautan portal eksternal (e-Rapor & Ujian).

---

## 🛠️ Teknologi yang Digunakan

- **Backend Framework:** [Laravel 13](https://laravel.com) (PHP ^8.3)
- **Frontend Styling:** [Tailwind CSS](https://tailwindcss.com) (dengan kustomisasi tema) & Vanilla CSS
- **Build Tool:** [Vite](https://vitejs.dev)
- **Testing Suite:** [Pest PHP](https://pestphp.com)
- **Utilities:** `npx concurrently` untuk menjalankan server, antrean queue, dan Vite secara bersamaan.

---

## 🏁 Panduan Instalasi & Menjalankan Project

### Prasyarat
Pastikan komputer Anda sudah terinstal:
- PHP >= 8.3
- Composer
- Node.js & NPM
- Database Server (SQLite, MySQL, atau PostgreSQL)

### Langkah-langkah
1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd KKN
   ```

2. **Jalankan Setup Otomatis**
   Project ini telah dilengkapi dengan script instalasi otomatis untuk mempermudah pemasangan:
   ```bash
   composer run setup
   ```
   *Script di atas secara otomatis akan melakukan: `composer install`, menyalin berkas `.env`, membuat application key, menjalankan migrasi database, menginstal NPM package, dan mem-build asset production.*

3. **Konfigurasi Database (.env)**
   Sesuaikan konfigurasi database Anda di berkas `.env` jika menggunakan MySQL. Jika Anda ingin menggunakan SQLite bawaan, Anda dapat melewati langkah ini karena database awal akan dikonfigurasi otomatis.

4. **Jalankan Database Seeder (Opsional jika ingin mereset data default)**
   Untuk mengisi database dengan data awal sekolah, data guru bawaan, daftar fasilitas, jurusan, dan akun admin default:
   ```bash
   php artisan db:seed
   ```

5. **Jalankan Server Development**
   Jalankan perintah berikut untuk mengaktifkan server web Laravel, queue worker, dan Vite build dev server sekaligus:
   ```bash
   composer run dev
   ```
   *Aplikasi dapat diakses melalui browser di alamat: `http://127.0.0.1:8000`*

---

## 🔑 Kredensial Admin Default

Untuk masuk ke Panel Admin (`http://127.0.0.1:8000/admin/login`), gunakan akun berikut:
- **Email:** `admin@sekolah.sch.id`
- **Password:** `password`

---

## 🧪 Menjalankan Pengujian (Testing)

Untuk menjalankan test suite menggunakan Pest PHP:
```bash
composer run test
```

---

*Project ini dikembangkan dengan penuh dedikasi oleh Tim Mahasiswa KKN untuk mendukung digitalisasi administrasi dan publikasi informasi SMA GIKI 3 Surabaya.*
