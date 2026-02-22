# 🔄 Update Kategori Potensi - Panduan Lengkap

## 📋 Yang Sudah Dilakukan

### 1. ✅ Navbar Dropdown Sekarang DINAMIS
Dropdown menu "Potensi" sekarang otomatis mengambil kategori dari database, bukan hardcoded lagi!

**Lokasi perubahan:**
- `app/Providers/AppServiceProvider.php` - View Composer untuk share data ke navbar
- `resources/views/components/navbar.blade.php` - Loop dinamis untuk kategori

**Cara kerja:**
```php
// AppServiceProvider.php
view()->composer('components.navbar', function ($view) {
    // Ambil kategori dari database
    $dbCategories = Potensi::active()->select('category')->distinct()->get();
    
    // Mapping ke label yang user-friendly
    $categoryLabels = [
        'pertanian' => 'Pertanian',
        'industri' => 'Industri & Kerajinan',  // ✅ Ganti dari ekonomi
        'wisata' => 'Wisata',
        'peternakan' => 'Peternakan',
    ];
    
    // Share ke navbar
    $view->with('potensiCategories', $categories);
});
```

### 2. ✅ Kategori Database Labels
Sekarang kategori menggunakan nama yang konsisten:

| Old (❌) | New (✅) | Tampilan di Website |
|----------|---------|---------------------|
| `Pertanian` | `pertanian` | Pertanian |
| `Ekonomi` | `industri` | Industri & Kerajinan |
| `Wisata` | `wisata` | Wisata |
| `Pariwisata` | `wisata` | Wisata |
| `Peternakan` | `peternakan` | Peternakan |

---

## 🛠️ CARA UPDATE DATABASE

**PENTING:** Anda perlu update kategori di database agar "Ekonomi" berubah jadi "Industri & Kerajinan"

### Opsi 1: Via phpMyAdmin (TERMUDAH) ⭐

1. **Buka** phpMyAdmin: `http://localhost/phpmyadmin`
2. **Pilih** database: `kecamatan_tahunan`
3. **Klik** tab **SQL** di atas
4. **Copy-paste** query ini:

```sql
UPDATE potensis SET category = 'pertanian' WHERE category = 'Pertanian';
UPDATE potensis SET category = 'industri' WHERE category = 'Ekonomi' OR category = 'ekonomi';
UPDATE potensis SET category = 'wisata' WHERE category = 'Wisata' OR category = 'Pariwisata';
UPDATE potensis SET category = 'peternakan' WHERE category = 'Peternakan';
```

5. **Klik** tombol **Go / Kirim**
6. **Refresh** halaman website: `http://localhost:8000/potensi`

### Opsi 2: Via Command Line

Buka terminal/cmd di folder project, lalu:

```bash
# Versi 1: Pakai file SQL yang sudah dibuat
mysql -u root -p kecamatan_tahunan < database/quick-update-categories.sql

# Versi 2: Langsung jalankan query
mysql -u root -p -e "USE kecamatan_tahunan; UPDATE potensis SET category = 'industri' WHERE category = 'Ekonomi';"
```

### Opsi 3: Via PHP Script

Jalankan script yang sudah dibuat:

```bash
php update-potensi-category.php
```

Script ini akan:
- Update semua kategori ke lowercase
- Ganti "Ekonomi" → "industri"
- Ganti "Pariwisata" → "wisata"
- Tampilkan summary hasil update

---

## ✨ Hasil Setelah Update

### Before ❌
**Dropdown Navbar:**
- Semua Potensi
- Pertanian
- Industri & Kerajinan
- Wisata

**Halaman Potensi Filter:**
- Semua
- **Pertanian** (dari DB: `Pertanian`)
- **Ekonomi** ❌ (dari DB: `Ekonomi`)
- **Wisata** (dari DB: `Wisata`)
- **Peternakan** (dari DB: `Peternakan`)

**MASALAH:** Dropdown navbar hardcode, tidak sinkron dengan data di database!

### After ✅
**Dropdown Navbar (DINAMIS):**
- Semua Potensi
- Pertanian
- **Industri & Kerajinan** ✅ (dari DB: `industri`)
- Wisata
- Peternakan (jika ada di DB)

**Halaman Potensi Filter (DINAMIS):**
- Semua
- **Pertanian** (dari DB: `pertanian`)
- **Industri & Kerajinan** ✅ (dari DB: `industri`)
- **Wisata** (dari DB: `wisata`)
- **Peternakan** (dari DB: `peternakan`)

**KEUNTUNGAN:**
✅ Dropdown navbar otomatis update jika ada kategori baru di database
✅ "Ekonomi" berubah jadi "Industri & Kerajinan"
✅ Konsisten antara navbar dan halaman potensi
✅ Fallback ke default jika database kosong

---

## 🧪 Cara Test

1. **Update database** (pilih salah satu opsi di atas)
2. **Clear cache** (opsional):
   ```bash
   php artisan view:clear
   php artisan cache:clear
   ```
3. **Refresh halaman**:
   - Homepage: `http://localhost:8000`
   - Halaman Potensi: `http://localhost:8000/potensi`
4. **Hover menu "Potensi"** di navbar
5. **Cek dropdown** - Harusnya muncul sesuai data DB:
   - Pertanian ✅
   - **Industri & Kerajinan** ✅ (bukan "Ekonomi")
   - Wisata ✅
   - (Peternakan jika ada) ✅

---

## 📝 Tambah Kategori Baru

Sekarang karena dropdown dinamis, Anda bisa tambah kategori baru dengan mudah:

1. **Tambah data potensi** dengan kategori baru (misalnya: `perikanan`)
2. **Update label mapping** di `AppServiceProvider.php`:
   ```php
   $categoryLabels = [
       'pertanian' => 'Pertanian',
       'industri' => 'Industri & Kerajinan',
       'wisata' => 'Wisata',
       'peternakan' => 'Peternakan',
       'perikanan' => 'Perikanan', // ✅ Tambah ini
   ];
   ```
3. **Refresh halaman** - Navbar otomatis update! 🎉

---

## ❓ FAQ

**Q: Dropdown navbar tidak muncul kategorinya?**  
A: Pastikan ada data potensi di database dengan `is_active = 1`

**Q: Kategori masih tampil "Ekonomi"?**  
A: Database belum di-update. Jalankan SQL update di atas.

**Q: Bisa tambah kategori "Perdagangan"?**  
A: Ya! Tambah data potensi dengan `category = 'perdagangan'`, lalu tambah label di `AppServiceProvider.php`

**Q: Dropdown navbar kosong?**  
A: Ada fallback otomatis ke 3 kategori default (Pertanian, Industri & Kerajinan, Wisata)

---

**Last Updated:** 2026-02-15  
**Version:** 2.0 - Dynamic Categories
