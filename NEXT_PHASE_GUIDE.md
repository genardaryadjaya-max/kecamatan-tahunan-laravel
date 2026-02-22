# 📋 NEXT PHASE - Admin Panel & Additional Pages

## 🎯 Overview
Membuat:
1. Halaman Profil, Potensi, Kontak
2. Admin Panel dengan authentication
3. CRUD untuk semua content  
4. Hero video support (bisa diganti dari admin)

---

## ✅ Phase 1: Database Update (COMPLETED)

### Files Created:
- ✅ Migration: `add_video_to_sliders_table.php`
- ✅ Model: `Profil.php`
- ✅ Model: `Potensi.php`

### Run Migration:
```bash
php artisan migrate
```

---

## 📝 Phase 2: Public Pages (TO DO)

### 1. Profil Pages
**Routes:**
- `/profil/sejarah` - Sejarah Kecamatan
- `/profil/geografis` - Letak Geografis
- `/profil/visi-misi` - Visi & Misi
- `/profil/struktur` - Struktur Organisasi

**Controller:** `ProfilController.php`
**Views:** `resources/views/public/profil/*.blade.php`

### 2. Potensi Page
**Route:** `/potensi`
**Controller:** `PotensiController.php`
**View:** `resources/views/public/potensi/index.blade.php`

### 3. Kontak Page
**Route:** `/kontak`
**Controller:** `KontakController.php`
**View:** `resources/views/public/kontak.blade.php`

---

## 🔐 Phase 3: Authentication & Admin Panel (TO DO)

### Install Laravel Breeze:
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build
php artisan migrate
```

### Create Admin:
```bash
php artisan tinker
>>> use App\Models\User;
>>> User::create([
    'name' => 'Super Admin',
    'email' => 'admin@kecamatantahunan.id',
    'password' => bcrypt('admin123'),
    'role' => 'admin'
]);
```

---

## 📊 Phase 4: Admin CRUD (TO DO)

### Admin Controllers:
- `Admin/DashboardController` - Dashboard
- `Admin/SliderController` - Manage Hero (Image/Video)
- `Admin/BeritaController` - CRUD Berita
- `Admin/DesaController` - CRUD Website Desa
- `Admin/ProfilController` - CRUD Profil
- `Admin/PotensiController` - CRUD Potensi
- `Admin/StatistikController` - CRUD Statistik
- `Admin/SettingController` - Settings

### Admin Routes:
```php
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('slider', SliderController::class);
    Route::resource('berita', BeritaController::class);
    Route::resource('desa', DesaController::class);
    // etc...
});
```

---

## 🎬 Phase 5: Hero Video Implementation (TO DO)

### Update Homepage View:
```blade
@if($slider->type === 'video')
    <video autoplay muted loop class="w-full h-full object-cover">
        <source src="{{ asset('uploads/slider/' . $slider->video) }}" type="video/mp4">
    </video>
@else
    <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}">
@endif
```

### Admin Form:
- Upload video (.mp4, max 50MB)
- Preview video before save
- Option: Image OR Video (radio button)

---

## 🚀 Quick Implementation Guide

### Step 1: Run Migration
```bash
php artisan migrate
```

### Step 2: Install Breeze (Authentication)
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
php artisan migrate
```

### Step 3: Create Admin User
```bash
php artisan tinker
>>> User::create(['name'=>'Admin','email'=>'admin@test.com','password'=>bcrypt('admin123'),'role'=>'admin']);
```

### Step 4: Create Controllers
```bash
php artisan make:controller Public/ProfilController
php artisan make:controller Public/PotensiController
php artisan make:controller Public/KontakController
php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/SliderController --resource
php artisan make:controller Admin/BeritaController --resource
```

### Step 5: Create Views
Manual create files in:
- `resources/views/public/profil/`
- `resources/views/public/potensi/`
- `resources/views/public/kontak.blade.php`
- `resources/views/admin/`

---

## 📁 Required Folders

Create these folders:
```bash
mkdir public\uploads\slider
mkdir public\uploads\profil
mkdir public\uploads\video
mkdir resources\views\public\profil
mkdir resources\views\public\potensi
mkdir resources\views\admin
mkdir resources\views\admin\slider
mkdir resources\views\admin\berita
mkdir resources\views\admin\desa
```

---

## ⏱️ Estimated Time

- Phase 2 (Public Pages): 30 minutes
- Phase 3 (Auth): 15 minutes
- Phase 4 (Admin CRUD): 2 hours
- Phase 5 (Video): 20 minutes

**Total: ~3 hours for complete implementation**

---

## 🎯 Priority Order

**Most Important First:**
1. ✅ Database (Done)
2. ⏳ Authentication (Breeze) - **DO THIS FIRST**
3. ⏳ Admin Dashboard Basic
4. ⏳ Slider CRUD (with video support)
5. ⏳ Public Pages (Profil, Potensi, Kontak)
6. ⏳ Other Admin CRUDs

---

## 💡 Next Action

**Mau saya lanjutkan membuat semua files sekarang?** Atau:
- Option A: Saya buat **semua sekaligus** (50+ files) ✨
- Option B: **Bertahap** - Mulai dari Authentication dulu
- Option C: Saya buat **skeleton/template** yang bisa Anda kembangkan

**Pilih mana?** 😊

---

**Note:** Karena ini banyak, saya recommend **Option B (Bertahap)** agar lebih mudah di-track dan di-test.
