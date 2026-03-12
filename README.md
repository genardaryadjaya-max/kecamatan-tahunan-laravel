SISTEM INFORMASI KECAMATAN TAHUNAN
Website Resmi Kecamatan Tahunan, Kabupaten Jepara, Jawa Tengah

Platform digital modern untuk pelayanan, informasi, dan transparansi pemerintahan Kecamatan Tahunan.
Dibangun dengan Laravel 10, PHP 8.1, MySQL, dan Tailwind CSS.

============================================================
FITUR UNGGULAN
============================================================

Halaman Publik:
- Video atau gambar background yang bisa diganti dari admin
- Berita dan pengumuman dengan kategori, pencarian, dan filter
- Showcase potensi daerah (pertanian, wisata, ekonomi, peternakan)
- Data statistik kependudukan, pendidikan, kesehatan, dan ekonomi
- Daftar desa beserta link website resminya
- Halaman unduhan dokumen dan formulir
- Halaman FAQ seputar pelayanan kecamatan
- Peta interaktif wilayah kecamatan
- Formulir SIREMA untuk laporan dan keluhan masyarakat

Panel Admin:
- Upload dan kelola video atau gambar background beranda
- Manajemen berita dan pengumuman
- Manajemen potensi daerah beserta galeri foto
- Data desa dengan kontak dan media sosial
- Update data statistik kependudukan
- Kelola struktur organisasi dan foto pegawai
- Konfigurasi layanan publik di beranda
- Jadwal agenda kegiatan kecamatan
- Pengaturan nama situs, kontak, media sosial, dan peta

Desain:
- Light mode dan dark mode yang bisa ditoggle
- Tampilan responsif untuk desktop, tablet, dan ponsel
- Efek glassmorphism pada card dan navbar
- Animasi parallax scrolling dan scroll animations
- Peta dengan tile yang menyesuaikan tema aktif

============================================================
KEBUTUHAN SISTEM
============================================================

- PHP versi 8.1 atau lebih baru
- Composer versi 2.x
- MySQL versi 8.0 atau MariaDB
- Node.js versi 18 (opsional, untuk build assets)
- Web server Apache atau Nginx, bisa juga menggunakan Laragon di Windows

============================================================
CARA INSTALASI
============================================================

Langkah 1 - Clone repositori

    git clone https://github.com/genardaryadjaya-max/kecamatan-tahunan-laravel.git
    cd kecamatan-tahunan-laravel

Langkah 2 - Install dependensi PHP

    composer install

Proses ini membutuhkan koneksi internet dan bisa memakan waktu beberapa menit.

Langkah 3 - Konfigurasi environment

    cp .env.example .env
    php artisan key:generate

Buka file .env dan sesuaikan konfigurasi berikut:

    APP_NAME="Kecamatan Tahunan"
    APP_URL=http://kecamatan-tahunan-laravel.test

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=kecamatan_tahunan_laravel
    DB_USERNAME=root
    DB_PASSWORD=

Langkah 4 - Import database

Cara pertama (via phpMyAdmin atau HeidiSQL, disarankan):
  1. Buat database baru bernama kecamatan_tahunan_laravel
  2. Import file: database/kecamatan_tahunan_FULL.sql
  3. Jalankan migration: php artisan migrate

Cara kedua (via terminal):
    mysql -u root < database/kecamatan_tahunan_FULL.sql
    php artisan migrate

Langkah 5 - Storage link

    php artisan storage:link

Perintah ini diperlukan agar file yang diupload bisa diakses dari browser.

Langkah 6 - Jalankan server

    php artisan serve

Buka browser dan kunjungi: http://127.0.0.1:8000

============================================================
LOGIN ADMIN
============================================================

Setelah database diimport, gunakan akun berikut:

    Super Admin : admin@kecamatantahunan.id  /  password
    Admin       : admin@tahunan.id           /  password

Segera ganti password setelah login pertama!
Panel admin tersedia di: http://127.0.0.1:8000/admin/dashboard

============================================================
STRUKTUR PROYEK
============================================================

    app/Http/Controllers/Admin/     Controller panel admin
    app/Http/Controllers/Auth/      Login dan logout
    app/Http/Controllers/Public/    Controller halaman publik
    app/Models/                     Model Eloquent

    database/migrations/            Skema database
    database/seeders/               Data awal
    database/kecamatan_tahunan_FULL.sql     Export database lengkap

    public/images/                  Gambar statis
    public/uploads/                 File upload (video, dll)

    resources/views/admin/          Tampilan panel admin
    resources/views/layouts/        Template utama
    resources/views/components/     Navbar, footer, dll
    resources/views/public/         Halaman publik

    routes/web.php                  Definisi semua route

============================================================
SKEMA DATABASE
============================================================

    users           Akun admin
    sliders         Video atau gambar background beranda
    beritas         Artikel berita dan pengumuman
    potensis        Data potensi daerah
    desas           Informasi desa dalam kecamatan
    statistiks      Data statistik kependudukan
    strukturs       Struktur organisasi
    layanans        Layanan publik cepat di beranda
    agendas         Jadwal kegiatan
    unduhans        Dokumen yang bisa diunduh
    faqs            Pertanyaan yang sering diajukan
    profils         Profil kecamatan
    settings        Pengaturan website

============================================================
TECH STACK
============================================================

    Backend         Laravel 10, PHP 8.1
    Frontend        Blade Templates, Tailwind CSS (CDN), Alpine.js
    Database        MySQL 8.0
    Peta            Leaflet.js
    Animasi         AOS (Animate On Scroll)
    Icons           Font Awesome 6
    Font            Google Fonts (Inter, Playfair Display)

============================================================
TROUBLESHOOTING
============================================================

Error "Table not found"
  Jalankan: php artisan migrate

Gambar atau video tidak muncul
  Jalankan: php artisan storage:link
  Pastikan folder storage/app/public memiliki izin tulis.

Lupa password admin
  php artisan tinker
  \App\Models\User::find(1)->update(['password' => bcrypt('passwordbaru')]);

Tema tidak berubah ke light mode
  Hapus item "site-theme" di localStorage browser.
  Caranya: F12 > Application > Local Storage > hapus data > refresh halaman.

============================================================

Dibuat untuk Kecamatan Tahunan, Kabupaten Jepara, Jawa Tengah.
Melayani dengan Sepenuh Hati untuk Masyarakat.
