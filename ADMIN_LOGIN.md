# 🔐 Login Admin - Panduan Lengkap

## Credentials Default

Gunakan salah satu akun berikut untuk login ke Admin Panel:

### Akun Admin
```
Email    : admin@tahunan.id
Password : admin123
URL Login: http://localhost:8000/login
```

---

## Cara Login

1. Buka browser dan akses: **`http://localhost:8000/login`**
2. Masukkan email: **`admin@tahunan.id`**
3. Masukkan password: **`admin123`**
4. Klik tombol **Login**
5. Anda akan diarahkan ke Dashboard Admin: **`http://localhost:8000/admin/dashboard`**

---

## Troubleshooting

### ❌ Error: "The provided credentials do not match our records"

**Penyebab:**
- User admin belum dibuat di database
- Password salah
- Email salah

**Solusi:**

#### Opsi 1: Buat/Reset Admin via Artisan Command (RECOMMENDED)

Jalankan command berikut di terminal:

```bash
php artisan admin:create
```

Command ini akan:
- Cek apakah user `admin@tahunan.id` sudah ada
- Jika sudah ada, akan tanya apakah mau reset password
- Jika belum ada, akan create user baru

**Custom Credentials:**

Jika ingin email/password berbeda:

```bash
php artisan admin:create --email=admin@example.com --password=rahasia123 --name="Admin Baru"
```

#### Opsi 2: Buat Manual via Tinker

```bash
php artisan tinker
```

Lalu jalankan:

```php
App\Models\User::updateOrCreate(
    ['email' => 'admin@tahunan.id'],
    [
        'name' => 'Administrator',
        'role' => 'admin',
        'password' => bcrypt('admin123'),
        'is_active' => true
    ]
);
```

Tekan `Ctrl+C` untuk keluar dari tinker.

#### Opsi 3: Re-run Database Seeder

⚠️ **WARNING**: Ini akan RESET semua data!

```bash
php artisan migrate:fresh --seed
```

---

## Ubah Password Setelah Login

Setelah login pertama kali, sebaiknya ganti password default:

1. Masuk ke Dashboard Admin
2. Klik profil/nama user di pojok kanan atas
3. Pilih "Ubah Password"
4. Masukkan password baru
5. Simpan perubahan

---

## Role Administrator

Sistem mendukung 2 jenis role:

| Role | Akses | Keterangan |
|------|-------|------------|
| `admin` | Full access | Admin biasa |
| `super_admin` | Full access | Super administrator |

Kedua role memiliki akses yang sama ke Admin Panel.

Middleware akan menerima kedua role:
```php
// app/Http/Middleware/AdminMiddleware.php
if (!in_array(auth()->user()->role, ['admin', 'super_admin'])) {
    return redirect()->route('home');
}
```

---

## Keamanan

### ⚡ PENTING - Sebelum Deploy ke Production:

1. **Ganti password default** `admin123` dengan password yang kuat
2. **Ubah email admin** dari `admin@tahunan.id` ke email resmi
3. **Aktifkan 2FA** (Two-Factor Authentication)
4. **Backup database** secara berkala
5. **Set `APP_DEBUG=false`** di file `.env`

### Password Yang Kuat:

- Minimal 12 karakter
- Kombinasi huruf besar, huruf kecil, angka, dan simbol
- Tidak menggunakan kata yang mudah ditebak
- Contoh: `T@hun4n!2026#Kec`

---

## FAQ

**Q: Apakah bisa punya banyak admin?**  
A: Ya! Gunakan command `php artisan admin:create --email=admin2@tahunan.id --password=xxx`

**Q: Bagaimana cara hapus admin?**  
A: Via tinker: `User::where('email', 'admin@xxx.id')->delete();`

**Q: Lupa password, bagaimana?**  
A: Gunakan command `php artisan admin:create` dan pilih reset password

**Q: Kenapa setelah login redirect ke home bukan dashboard?**  
A: Role user bukan 'admin' atau 'super_admin'. Cek dengan: `User::find(1)->role`

---

## Kontak Developer

Jika masih ada masalah, hubungi developer atau cek log error di:
- `storage/logs/laravel.log`
- Browser Console (F12)
- Network tab untuk cek request/response

---

**Last Updated:** 2026-02-15  
**Version:** 1.0
