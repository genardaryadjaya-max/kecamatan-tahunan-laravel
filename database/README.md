# Database Kecamatan Tahunan Laravel

## 📋 Deskripsi
Database untuk website Kecamatan Tahunan yang dibangun menggunakan Laravel Framework. Database ini mengelola berbagai informasi terkait pemerintahan kecamatan, berita, profil, potensi wilayah, dan layanan masyarakat.

## 🗂️ Struktur Database

### 1. **users** - Tabel Administrator
Menyimpan data admin yang mengelola website.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| name | varchar(255) | Nama lengkap admin |
| email | varchar(255) | Email (unique) |
| role | varchar(50) | Role: 'admin' atau 'super_admin' |
| phone | varchar(20) | Nomor telepon |
| photo | varchar(255) | Path foto profil |
| is_active | tinyint(1) | Status aktif |
| password | varchar(255) | Password (hashed) |

**Default Accounts:**
- Email: `admin@kecamatantahunan.id` | Password: `password123` (Super Admin)
- Email: `admin@tahunan.id` | Password: `password123` (Admin)

---

### 2. **sliders** - Tabel Hero Banner/Slider
Menyimpan gambar slider yang ditampilkan di homepage.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| title | varchar(255) | Judul slider |
| description | text | Deskripsi/subtitle |
| image | varchar(255) | Path gambar |
| link | varchar(255) | Link tujuan (optional) |
| order | int | Urutan tampil |
| is_active | tinyint(1) | Status aktif |

---

### 3. **beritas** - Tabel Berita & Pengumuman
Menyimpan artikel berita dan pengumuman kecamatan.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| title | varchar(255) | Judul berita |
| slug | varchar(255) | URL-friendly title (unique) |
| excerpt | text | Ringkasan berita |
| content | longtext | Isi berita (HTML) |
| image | varchar(255) | Gambar featured |
| category | varchar(100) | Kategori: 'Berita', 'Pengumuman' |
| views | int | Jumlah dilihat |
| is_published | tinyint(1) | Status publish |
| published_at | timestamp | Tanggal publikasi |
| created_by | bigint | Foreign key ke users |

---

### 4. **profils** - Tabel Profil Kecamatan
Menyimpan berbagai informasi profil kecamatan.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| type | varchar(100) | Tipe: 'sejarah', 'geografis', 'struktur', 'visi_misi' |
| title | varchar(255) | Judul |
| content | longtext | Konten (HTML) |
| image | varchar(255) | Gambar pendukung |
| additional_data | json | Data tambahan (koordinat, dll) |

---

### 5. **potensis** - Tabel Potensi Daerah
Menyimpan informasi potensi kecamatan (ekonomi, wisata, dll).

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| name | varchar(255) | Nama potensi |
| slug | varchar(255) | URL-friendly name (unique) |
| category | varchar(100) | Kategori: 'Pertanian', 'Wisata', 'Ekonomi', dll |
| description | text | Deskripsi potensi |
| image | varchar(255) | Gambar utama |
| location | varchar(255) | Lokasi |
| gallery | json | Array gambar gallery |
| is_active | tinyint(1) | Status aktif |

---

### 6. **statistiks** - Tabel Statistik Kecamatan
Menyimpan data statistik wilayah.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| category | varchar(100) | Kategori: 'penduduk', 'pendidikan', 'ekonomi', dll |
| name | varchar(255) | Nama statistik |
| value | varchar(100) | Nilai/angka |
| unit | varchar(50) | Satuan (jiwa, unit, dll) |
| icon | varchar(50) | Nama icon |
| year | int | Tahun data |
| order | int | Urutan tampil |

---

### 7. **desas** - Tabel Desa/Kelurahan
Menyimpan informasi desa-desa di kecamatan.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| name | varchar(255) | Nama desa |
| slug | varchar(255) | URL-friendly name (unique) |
| description | text | Deskripsi desa |
| website_url | varchar(255) | Website desa |
| logo | varchar(255) | Logo desa |
| contact | json | Info kontak (phone, email, address) |
| social_media | json | Social media links |
| is_active | tinyint(1) | Status aktif |

---

### 8. **strukturs** - Tabel Struktur Organisasi
Menyimpan struktur pemerintahan kecamatan (hierarchical).

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| name | varchar(255) | Nama pejabat |
| position | varchar(255) | Jabatan |
| nip | varchar(50) | NIP |
| photo | varchar(255) | Foto |
| description | text | Deskripsi |
| order | int | Urutan tampil |
| parent_id | bigint | Foreign key ke strukturs (self-referencing) |
| is_active | tinyint(1) | Status aktif |

---

### 9. **unduhans** - Tabel Download/Unduhan
Menyimpan file-file yang bisa diunduh masyarakat.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| title | varchar(255) | Judul dokumen |
| description | text | Deskripsi |
| file_name | varchar(255) | Nama file asli |
| file_path | varchar(255) | Path file |
| file_type | varchar(50) | Tipe file (pdf, doc, dll) |
| file_size | int | Ukuran file (bytes) |
| category | varchar(100) | Kategori dokumen |
| downloads | int | Jumlah diunduh |
| is_active | tinyint(1) | Status aktif |

---

### 10. **faqs** - Tabel FAQ
Menyimpan pertanyaan dan jawaban yang sering ditanyakan.

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| question | varchar(255) | Pertanyaan |
| answer | text | Jawaban |
| category | varchar(100) | Kategori FAQ |
| order | int | Urutan tampil |
| is_active | tinyint(1) | Status aktif |

---

### 11. **settings** - Tabel Pengaturan Website
Menyimpan konfigurasi website (key-value).

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| key | varchar(255) | Key setting (unique) |
| value | text | Value setting |
| type | varchar(50) | Type: 'text', 'textarea', 'image', 'json' |
| group | varchar(100) | Group: 'general', 'contact', 'social', 'map' |
| description | text | Deskripsi |

---

## 🚀 Cara Instalasi Database

### Opsi 1: Menggunakan Laravel Migration (Recommended)
```bash
# Pastikan XAMPP MySQL sudah running
# Pastikan database 'kecamatan_tahunan_laravel' sudah dibuat

# Jalankan migration
php artisan migrate:fresh

# Jalankan seeder untuk data awal
php artisan db:seed
```

### Opsi 2: Menggunakan File SQL
```bash
# Import melalui phpMyAdmin:
1. Buka http://localhost/phpmyadmin
2. Import file: database/kecamatan_tahunan_database.sql
3. Import file: database/kecamatan_tahunan_seeders.sql

# Atau via command line:
mysql -u root -p < database/kecamatan_tahunan_database.sql
mysql -u root -p < database/kecamatan_tahunan_seeders.sql
```

## 📊 Entity Relationship Diagram (ERD)

```
users (1) -----> (N) beritas
strukturs (1) --> (N) strukturs (self-referencing hierarchy)
```

## 🔐 Default Login Credentials

| Role | Email | Password |
|------|-------|----------|
| Super Admin | admin@kecamatantahunan.id | password123 |
| Admin | admin@tahunan.id | password123 |

**⚠️ PENTING:** Segera ganti password default setelah instalasi!

## 📝 Sample Data yang Sudah Tersedia

- ✅ 2 Admin users
- ✅ 3 Slider/Hero banners
- ✅ 3 Profil kecamatan (Sejarah, Geografis, Visi Misi)
- ✅ 5 Berita/Pengumuman
- ✅ 3 Data desa
- ✅ 11 Statistik
- ✅ 4 Potensi daerah
- ✅ 6 Struktur organisasi
- ✅ 5 FAQ
- ✅ 15 Settings

## 🛠️ Update .env File

Pastikan file `.env` Anda sudah dikonfigurasi dengan benar:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kecamatan_tahunan_laravel
DB_USERNAME=root
DB_PASSWORD=
```

## 📚 Catatan Penting

1. **Backup Database**: Selalu backup database sebelum melakukan migration:fresh
2. **Foreign Keys**: Beberapa tabel memiliki foreign key constraints, perhatikan urutan delete
3. **JSON Fields**: Tabel `desas`, `profils`, `potensis`, dan `settings` menggunakan JSON untuk data flexibility
4. **Soft Deletes**: Tidak menggunakan soft deletes, data yang dihapus akan hilang permanent
5. **Image Paths**: Simpan path relatif image, bukan absolute path

## 🔧 Maintenance Commands

```bash
# Reset database dan seed ulang
php artisan migrate:fresh --seed

# Hanya jalankan seeder
php artisan db:seed

# Jalankan seeder spesifik
php artisan db:seed --class=BeritaSeeder

# Cek status migration
php artisan migrate:status

# Rollback migration terakhir
php artisan migrate:rollback
```

## 📞 Support

Jika ada pertanyaan atau issue terkait database, silakan hubungi tim developer.

---

**Created with ❤️ for Kecamatan Tahunan**
