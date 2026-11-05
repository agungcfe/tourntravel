# Nusantara Trip — Website Tour & Travel Indonesia

Website tour & travel dengan **CMS Dashboard** berbasis **Laravel 12**.
UI responsive (desktop, tablet, mobile) dengan animasi halus, tanpa build step frontend (CSS & JS murni di `public/`).

## Fitur

**Website publik**
- Beranda: hero + pencarian paket, destinasi populer, paket unggulan, testimoni (slider), artikel terbaru
- Destinasi (list & detail), Paket Tour (filter, sort, detail dengan tab itinerary & form booking)
- Blog (kategori & detail), Tentang Kami, Kontak, tombol WhatsApp melayang

**CMS Dashboard (`/admin`)**
- Login (rate limit 5x/menit, ingat saya), logout, profil & ganti password
- Dashboard statistik + grafik booking 6 bulan
- Content management: Destinasi, Paket Tour, Artikel Blog, Kategori, Testimoni (upload gambar + preview)
- Booking masuk: lihat detail, ubah status, balas via WhatsApp
- **User management** (khusus admin): tambah/edit/hapus user, role, aktif/nonaktif
- Pengaturan website (khusus admin): nama situs, hero, kontak, sosial media

**Role**
| Role | Akses |
|------|-------|
| `admin`  | Semua fitur, termasuk User Management & Pengaturan |
| `editor` | Kelola konten & booking |

## Instalasi

Kebutuhan: PHP 8.2+, Composer, SQLite atau MySQL.

```bash
git clone https://github.com/agungcfe/tourntravel.git
cd tourntravel
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite      # jika memakai SQLite (default)
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Buka http://localhost:8000 — CMS di http://localhost:8000/login

| Email | Password | Role |
|-------|----------|------|
| admin@tourntravel.test  | password | Admin  |
| editor@tourntravel.test | password | Editor |

> Segera ganti password akun demo sebelum online.

**Memakai MySQL:** ubah di `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tourntravel
DB_USERNAME=root
DB_PASSWORD=
```

## Struktur MVC

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Frontend/        # Controller website publik
│   │   │   ├── HomeController.php
│   │   │   ├── DestinationController.php
│   │   │   ├── PackageController.php
│   │   │   ├── BlogController.php
│   │   │   └── InquiryController.php   # form kontak & booking
│   │   ├── Admin/           # Controller CMS dashboard
│   │   │   ├── DashboardController.php
│   │   │   ├── DestinationController.php, PackageController.php
│   │   │   ├── PostController.php, CategoryController.php
│   │   │   ├── TestimonialController.php, InquiryController.php
│   │   │   ├── UserController.php      # user management
│   │   │   ├── SettingController.php, ProfileController.php
│   │   └── Auth/LoginController.php
│   ├── Middleware/
│   │   ├── EnsureUserHasRole.php       # alias "role"  -> ->middleware('role:admin')
│   │   └── EnsureUserIsActive.php      # alias "active"
│   └── Requests/Admin/                 # Validasi form (FormRequest)
├── Models/                             # Model Eloquent
│   ├── User, Destination, Package, Category, Post, Testimonial, Inquiry, Setting
│   └── Concerns/HasSlug.php, HasImage.php   # trait: slug otomatis & URL gambar
├── Services/ImageUploadService.php     # simpan/hapus file upload
└── Support/helpers.php                 # rupiah(), setting(), media_url()

resources/views/
├── layouts/frontend.blade.php, admin.blade.php
├── frontend/   # halaman publik + partials (navbar, footer, card)
├── admin/      # halaman CMS + partials (alert, toggle, image-input, delete-button)
├── auth/login.blade.php
└── components/icon.blade.php, pagination.blade.php

public/css/app.css, admin.css           # stylesheet
public/js/app.js, admin.js              # interaksi (vanilla JS)
routes/web.php                          # semua route, dikelompokkan per area
database/migrations, database/seeders   # skema & data contoh
tests/Feature/                          # WebsiteTest, AdminTest
```

**Alur request:** `routes/web.php` → Middleware → Controller → (FormRequest validasi) → Model → View Blade.

## Testing

```bash
php artisan test
```

## Catatan
- Gambar contoh memakai `picsum.photos`; ganti lewat CMS dengan upload gambar asli.
- Isi artikel mendukung HTML dan ditampilkan apa adanya — hanya berikan akses CMS ke user tepercaya.
