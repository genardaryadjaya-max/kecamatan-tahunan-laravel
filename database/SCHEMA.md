# 📊 Database Schema - Kecamatan Tahunan Laravel

## Ringkasan Tabel Database

| No | Tabel | Jumlah Kolom | Deskripsi |
|----|-------|--------------|-----------|
| 1 | `users` | 13 | Data administrator website |
| 2 | `sliders` | 9 | Hero banner/slider homepage |
| 3 | `beritas` | 13 | Berita & pengumuman |
| 4 | `profils` | 8 | Profil kecamatan (sejarah, geografis, visi misi) |
| 5 | `potensis` | 11 | Potensi daerah |
| 6 | `statistiks` | 10 | Statistik kecamatan |
| 7 | `desas` | 11 | Data desa/kelurahan |
| 8 | `strukturs` | 12 | Struktur organisasi pemerintahan |
| 9 | `unduhans` | 12 | File download/unduhan |
| 10 | `faqs` | 8 | Frequently Asked Questions |
| 11 | `settings` | 8 | Pengaturan website |

**Total: 11 Tabel Utama** + 4 Tabel Laravel Default (password_reset_tokens, failed_jobs, personal_access_tokens, migrations)

## 🔗 Relasi Antar Tabel

```
┌─────────────┐
│   users     │
│ (Admin)     │
└──────┬──────┘
       │
       │ 1:N (created_by)
       │
       ▼
┌─────────────┐
│   beritas   │
│ (Berita)    │
└─────────────┘


┌──────────────┐
│  strukturs   │
│ (Organisasi) │
└───────┬──────┘
        │
        │ Self-Referencing (parent_id)
        │ 1:N Hierarchical
        │
        └─────► strukturs (child)


Tabel Independent (No Relations):
├── sliders (Hero Banner)
├── profils (Profil Kecamatan)
├── potensis (Potensi)
├── statistiks (Statistik)
├── desas (Desa)
├── unduhans (Downloads)
├── faqs (FAQ)
└── settings (Config)
```

## 📋 Detail Field Setiap Tabel

### 1️⃣ users (Administrators)
```
id             → PK, Auto Increment
name           → VARCHAR(255) NOT NULL
email          → VARCHAR(255) UNIQUE NOT NULL
role           → VARCHAR(50) DEFAULT 'admin'
phone          → VARCHAR(20) NULL
photo          → VARCHAR(255) NULL
is_active      → BOOLEAN DEFAULT true
last_login_at  → TIMESTAMP NULL
password       → VARCHAR(255) NOT NULL
created_at     → TIMESTAMP
updated_at     → TIMESTAMP
```

### 2️⃣ sliders (Hero Banner)
```
id          → PK, Auto Increment
title       → VARCHAR(255) NOT NULL
description → TEXT NULL
image       → VARCHAR(255) NOT NULL
link        → VARCHAR(255) NULL
order       → INT DEFAULT 0
is_active   → BOOLEAN DEFAULT true
created_at  → TIMESTAMP
updated_at  → TIMESTAMP
```

### 3️⃣ beritas (News & Announcements)
```
id           → PK, Auto Increment
title        → VARCHAR(255) NOT NULL
slug         → VARCHAR(255) UNIQUE NOT NULL
excerpt      → TEXT NULL
content      → LONGTEXT NOT NULL
image        → VARCHAR(255) NULL
category     → VARCHAR(100) DEFAULT 'Berita'
views        → INT DEFAULT 0
is_published → BOOLEAN DEFAULT true
published_at → TIMESTAMP NULL
created_by   → FK → users.id (ON DELETE SET NULL)
created_at   → TIMESTAMP
updated_at   → TIMESTAMP
```

### 4️⃣ profils (District Profile)
```
id              → PK, Auto Increment
type            → VARCHAR(100) NOT NULL (sejarah, geografis, visi_misi)
title           → VARCHAR(255) NOT NULL
content         → LONGTEXT NOT NULL
image           → VARCHAR(255) NULL
additional_data → JSON NULL (koordinat, luas_wilayah, dll)
created_at      → TIMESTAMP
updated_at      → TIMESTAMP
```

### 5️⃣ potensis (District Potential)
```
id          → PK, Auto Increment
name        → VARCHAR(255) NOT NULL
slug        → VARCHAR(255) UNIQUE NOT NULL
category    → VARCHAR(100) NOT NULL
description → TEXT NOT NULL
image       → VARCHAR(255) NULL
location    → VARCHAR(255) NULL
gallery     → JSON NULL (array images)
is_active   → BOOLEAN DEFAULT true
created_at  → TIMESTAMP
updated_at  → TIMESTAMP
```

### 6️⃣ statistiks (Statistics)
```
id         → PK, Auto Increment
category   → VARCHAR(100) NOT NULL
name       → VARCHAR(255) NOT NULL
value      → VARCHAR(100) NOT NULL
unit       → VARCHAR(50) NULL
icon       → VARCHAR(50) NULL
year       → INT DEFAULT 2024
order      → INT DEFAULT 0
created_at → TIMESTAMP
updated_at → TIMESTAMP
```

### 7️⃣ desas (Villages)
```
id           → PK, Auto Increment
name         → VARCHAR(255) NOT NULL
slug         → VARCHAR(255) UNIQUE NOT NULL
description  → TEXT NULL
website_url  → VARCHAR(255) NULL
logo         → VARCHAR(255) NULL
contact      → JSON NULL (phone, email, address)
social_media → JSON NULL (facebook, instagram, dll)
is_active    → BOOLEAN DEFAULT true
created_at   → TIMESTAMP
updated_at   → TIMESTAMP
```

### 8️⃣ strukturs (Organization Structure)
```
id          → PK, Auto Increment
name        → VARCHAR(255) NOT NULL
position    → VARCHAR(255) NOT NULL
nip         → VARCHAR(50) NULL
photo       → VARCHAR(255) NULL
description → TEXT NULL
order       → INT DEFAULT 0
parent_id   → FK → strukturs.id (ON DELETE CASCADE) [Self-Referencing]
is_active   → BOOLEAN DEFAULT true
created_at  → TIMESTAMP
updated_at  → TIMESTAMP
```

### 9️⃣ unduhans (Downloads)
```
id          → PK, Auto Increment
title       → VARCHAR(255) NOT NULL
description → TEXT NULL
file_name   → VARCHAR(255) NOT NULL
file_path   → VARCHAR(255) NOT NULL
file_type   → VARCHAR(50) NOT NULL
file_size   → INT NOT NULL (bytes)
category    → VARCHAR(100) DEFAULT 'Dokumen'
downloads   → INT DEFAULT 0
is_active   → BOOLEAN DEFAULT true
created_at  → TIMESTAMP
updated_at  → TIMESTAMP
```

### 🔟 faqs (FAQ)
```
id         → PK, Auto Increment
question   → VARCHAR(255) NOT NULL
answer     → TEXT NOT NULL
category   → VARCHAR(100) DEFAULT 'Umum'
order      → INT DEFAULT 0
is_active  → BOOLEAN DEFAULT true
created_at → TIMESTAMP
updated_at → TIMESTAMP
```

### 1️⃣1️⃣ settings (Website Settings)
```
id          → PK, Auto Increment
key         → VARCHAR(255) UNIQUE NOT NULL
value       → TEXT NULL
type        → VARCHAR(50) DEFAULT 'text'
group       → VARCHAR(100) DEFAULT 'general'
description → TEXT NULL
created_at  → TIMESTAMP
updated_at  → TIMESTAMP
```

## 🎯 Kategori Data Sample

### Kategori Berita (`beritas.category`)
- `Berita` - Berita umum kecamatan
- `Pengumuman` - Pengumuman resmi

### Tipe Profil (`profils.type`)
- `sejarah` - Sejarah kecamatan
- `geografis` - Letak geografis
- `visi_misi` - Visi dan Misi

### Kategori Potensi (`potensis.category`)
- `Pertanian`
- `Wisata`
- `Ekonomi`
- `Peternakan`

### Kategori Statistik (`statistiks.category`)
- `penduduk` - Data kependudukan
- `pendidikan` - Fasilitas pendidikan
- `kesehatan` - Fasilitas kesehatan
- `ekonomi` - Data ekonomi

### Group Settings (`settings.group`)
- `general` - Pengaturan umum (nama situs, logo, dll)
- `contact` - Info kontak
- `social` - Social media links
- `map` - Konfigurasi peta

## 🔐 Security Features

1. **Password Hashing**: Menggunakan bcrypt untuk password users
2. **Foreign Key Constraints**: Menjaga integritas data
3. **JSON Data Type**: Untuk fleksibilitas data terstruktur
4. **Unique Constraints**: Mencegah duplikasi (email, slug)

## 📦 Storage Requirements

**Estimasi Size Database:**
- Empty Database: ~2 MB
- With Sample Data: ~5 MB
- Production (1 tahun): ~50-100 MB (tergantung jumlah berita & file)

**Files Storage (public/storage):**
- Images (sliders, news, profiles): ~500MB - 2GB/tahun
- Downloads (documents): ~100MB - 500MB/tahun

---

Last Updated: 2026-02-10
