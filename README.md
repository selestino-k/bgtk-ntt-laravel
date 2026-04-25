# Balai Guru dan Tenaga Kependidikan (BGTK) Provinsi NTT - Website

Website resmi Balai Guru dan Tenaga Kependidikan Provinsi Nusa Tenggara Timur yang dikembangkan dengan Laravel 13 untuk mendukung pengembangan dan pemberdayaan guru, tenaga kependidikan, dan pemangku kepentingan pendidikan.

## 🚀 Tentang Proyek

Website ini merupakan platform digital utama BGTK NTT yang menyediakan:

- **Informasi Profil Lembaga** — Visi misi, struktur organisasi, dan tugas pokok fungsi
- **Portal Publikasi** — Berita terkini, pengumuman, dan dokumen yang dapat diunduh
- **Sistem Pelayanan** — ULT (Unit Layanan Terpadu), ZI-WBK, dan SSD
- **Admin Panel** — Dashboard untuk manajemen konten website

## 📋 Teknologi yang Digunakan

### Framework & Libraries Utama

- **Laravel 13** — PHP framework untuk backend dan routing
- **PHP 8.3+** — Bahasa pemrograman server-side
- **Vite** — Frontend build tool untuk asset bundling
- **Blade** — Laravel templating engine
- **Pest PHP** — Testing framework modern untuk PHP
- **jenssegers/agent** — User agent detection untuk device-aware rendering

### Database & Cache

- **MySQL** — Relational database utama
- **Redis** (via Predis) — Cache dan session storage

---

## 📁 Struktur Direktori Penting

```
app/
├── Http/
│   └── Controllers/          # Controller untuk semua fitur
├── Models/                   # Model Eloquent
│   ├── Berita.php
│   ├── Dokumen.php
│   ├── Profile.php
│   ├── Publication.php
│   ├── Slideshow.php
│   ├── Tag.php
│   └── User.php
└── Services/
    └── ViewCounterService.php  # Layanan penghitung kunjungan
resources/
└── views/
    ├── home/                 # Template halaman publik
    └── admin/                # Template panel administrasi
routes/
└── web.php                   # Definisi semua rute aplikasi
database/
└── migrations/               # File migrasi skema database
```

---

## 🎨 Fitur Utama

### Halaman Publik

- **Beranda** — Slideshow foto, berita terkini, pengumuman, dan dokumen terbaru
- **Profil** — Halaman profil dinamis berdasarkan slug (visi-misi, struktur organisasi, dll.)
- **Publikasi Berita** — Daftar dan detail berita terkini dengan sistem tag
- **Pengumuman** — Daftar pengumuman resmi lembaga
- **Dokumen / PPID** — Dokumen publik yang dikelompokkan berdasarkan kategori
- **Sarana Prasarana** — Informasi fasilitas ULT
- **ZI-WBK** — Halaman area perubahan Zona Integritas
- **SSD** — Halaman informasi SSD

### Panel Admin (Terproteksi Login)

- **Dashboard** — Ringkasan statistik dan aktivitas
- **Manajemen Berita** — CRUD berita lengkap dengan gambar dan dokumen lampiran
- **Manajemen Pengumuman** — Pengelolaan pengumuman melalui sistem tag
- **Manajemen Dokumen** — Upload dan kategorisasi dokumen
- **Manajemen Tag** — CRUD tag untuk berita
- **Manajemen Slideshow** — Upload dan pengaturan urutan foto slideshow
- **Manajemen Profil** — CRUD halaman profil lembaga
- **Manajemen Pengguna** — Pengelolaan akun admin

---

## 🎯 Halaman Utama

| Halaman | Route | Deskripsi |
|---------|-------|-----------|
| Beranda | `/` | Halaman utama dengan slideshow dan berita |
| Profil | `/profil/{slug}` | Halaman profil dinamis lembaga |
| Berita | `/berita` | Daftar berita terkini |
| Detail Berita | `/berita/{slug}` | Halaman detail berita |
| Pengumuman | `/pengumuman` | Daftar pengumuman resmi |
| Dokumen / PPID | `/dokumen` | Dokumen publik per kategori |
| ZI-WBK | `/zi-wbk` | Informasi Zona Integritas |
| SSD | `/ssd` | Halaman informasi SSD |
| Admin Panel | `/admin` | Dashboard manajemen konten |

---

## 🛠️ Instalasi & Pengaturan

### Prasyarat

- **PHP** >= 8.3
- **Composer**
- **Node.js** & NPM
- **SQLite**
- **Redis** (opsional, untuk cache)

### Langkah Instalasi

1. **Clone repositori**

```bash
git clone https://github.com/selestino-k/bgtk-ntt-laravel.git
cd bgtk-ntt-laravel
```

2. **Setup otomatis** (menggunakan script composer)

```bash
composer run setup
```

Script ini akan menjalankan secara otomatis:
- `composer install`
- Menyalin `.env.example` ke `.env`
- Generate application key
- Menjalankan migrasi database
- `npm install` dan `npm run build`

3. **Atau setup manual**

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

4. **Konfigurasi environment**

Sesuaikan file `.env` dengan konfigurasi lokal Anda:

```env
APP_NAME="BGTK NTT"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bgtk_ntt
DB_USERNAME=root
DB_PASSWORD=

REDIS_HOST=127.0.0.1
REDIS_PORT=6379
```

5. **Buat symlink storage**

```bash
php artisan storage:link
```

---

## 📝 Scripts Tersedia

```bash
# Development server (Laravel + Queue + Vite secara bersamaan)
composer run dev

# Production server
php artisan serve

# Build frontend assets untuk production
npm run build

# Jalankan semua pengujian
php artisan test

# Atau menggunakan Pest langsung
./vendor/bin/pest

# Jalankan migrasi database
php artisan migrate

# Rollback migrasi
php artisan migrate:rollback

# Seed database
php artisan db:seed
```

---

## 🚢 Deployment

### Deploy ke Shared Hosting / cPanel

1. Upload semua file ke server (gunakan `public/` sebagai document root)
2. Jalankan `composer install --no-dev --optimize-autoloader`
3. Sesuaikan `.env` untuk environment production
4. Jalankan `php artisan migrate --force`
5. Jalankan `php artisan config:cache` dan `php artisan route:cache`

### Deploy ke VPS / Server Dedicated

```bash
# Optimasi untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Build frontend
npm run build
```

---

## 🤝 Kontribusi

Untuk berkontribusi pada proyek ini:

1. Fork repository
2. Clone fork Anda: `git clone https://github.com/username/bgtk-ntt-laravel.git`
3. Buat branch feature: `git checkout -b feature/AmazingFeature`
4. Commit changes: `git commit -m 'Add: AmazingFeature'`
5. Push ke branch: `git push origin feature/AmazingFeature`
6. Buat Pull Request ke branch `dev`

### Branching Strategy

- **master** — Production branch
- **dev** — Development branch

---

## 📞 Hubungi Kami

**BGTK Provinsi NTT**

- 📍 Alamat: Jl. Perintis Kemerdekaan I, Kayu Putih, Kec. Oebobo, Kota Kupang, NTT
- 📧 Email: bgtkntt@kemendikdasmen.go.id
- 🌐 Website: [https://bgtkntt.kemendikdasmen.go.id](https://bgtkntt.kemendikdasmen.go.id)
- 📱 Media Sosial:
  - Facebook: [@balaigurupenggerakntt](https://www.facebook.com/balaigurupenggerakntt/)
  - Twitter: [@BGTK_NTT](https://twitter.com/BGTK_NTT)
  - Instagram: [@bgtkntt](https://www.instagram.com/bgtkntt/)
  - YouTube: [@bgtkntt](https://www.youtube.com/@bgtkntt/)
  - TikTok: [@bgtkntt](https://www.tiktok.com/@bgtkntt)

---

## 📄 Lisensi

GNU General Public License v3.0

---

**Dibuat dengan ❤️ oleh Tim Pengembang BGTK NTT**

**Repository:** [github.com/selestino-k/bgtk-ntt-laravel](https://github.com/selestino-k/bgtk-ntt-laravel)

**Terakhir Diperbarui:** April 2026

