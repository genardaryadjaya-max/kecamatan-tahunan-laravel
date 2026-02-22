# 🚀 FULL IMPLEMENTATION SCRIPT
# Kecamatan Tahunan - Complete Admin & Public Pages

## ⚡ QUICK COMMANDS - Copy Paste Ini Saja!

### Step 1: Run Migration
php artisan migrate

### Step 2: Create All Controllers
php artisan make:controller Public/ProfilController
php artisan make:controller Public/PotensiController
php artisan make:controller Public/KontakController
php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/SliderController --resource
php artisan make:controller Admin/BeritaController --resource
php artisan make:controller Admin/DesaController --resource
php artisan make:controller Admin/ProfilController --resource
php artisan make:controller Admin/PotensiController --resource
php artisan make:controller Admin/StatistikController --resource

### Step 3: Create Middleware
php artisan make:middleware AdminMiddleware

### Step 4: Create Folders
mkdir public\uploads\slider
mkdir public\uploads\video
mkdir public\uploads\profil
mkdir resources\views\public\profil
mkdir resources\views\public\potensi
mkdir resources\views\admin
mkdir resources\views\admin\layouts
mkdir resources\views\admin\slider
mkdir resources\views\admin\berita
mkdir resources\views\admin\desa
mkdir resources\views\admin\profil

### Step 5: Install Breeze (Optional - for better auth)
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build

### Step 6: Create Admin User
php artisan tinker
User::create(['name'=>'Super Admin','email'=>'admin@kecamatantahunan.id','password'=>bcrypt('admin123'),'role'=>'admin','is_active'=>1]);
exit

---

## 📁 FILES YANG SUDAH DIBUAT:

✅ Models:
- Berita.php
- Desa.php
- Slider.php (updated with video)
- Statistik.php
- Setting.php
- Profil.php
- Potensi.php

✅ Controllers:
- PublicController.php

✅ Views:
- layouts/app.blade.php
- components/navbar.blade.php
- components/footer.blade.php
- public/index.blade.php (Homepage)
- public/berita/index.blade.php
- public/berita/show.blade.php
- public/desa/index.blade.php

✅ Config:
- tailwind.config.js
- vite.config.js
- postcss.config.js

---

## 📋 FILES YANG PERLU DIBUAT MANUAL:

Karena keterbatasan, beberapa files ini perlu dibuat manual atau saya akan berikan template-nya:

### 1. AdminMiddleware (app/Http/Middleware/AdminMiddleware.php)
```php
<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }
        return $next($request);
    }
}
```

Daftarkan di `app/Http/Kernel.php`:
```php
protected $middlewareAliases = [
    // ...
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
];
```

### 2. Update routes/web.php
```php
<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\Public\ProfilController;
use App\Http\Controllers\Public\PotensiController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DesaController as AdminDesaController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('home');

// Berita
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [PublicController::class, 'berita'])->name('index');
    Route::get('/{slug}', [PublicController::class, 'beritaShow'])->name('show');
});

// Desa
Route::prefix('desa')->name('desa.')->group(function () {
    Route::get('/', [PublicController::class, 'desa'])->name('index');
    Route::get('/{slug}', [PublicController::class, 'desaShow'])->name('show');
});

// Profil
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('sejarah');
    Route::get('/geografis', [ProfilController::class, 'geografis'])->name('geografis');
    Route::get('/visi-misi', [ProfilController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/struktur', [ProfilController::class, 'struktur'])->name('struktur');
});

// Potensi
Route::get('/potensi', [PotensiController::class, 'index'])->name('potensi.index');
Route::get('/potensi/{slug}', [PotensiController::class, 'show'])->name('potensi.show');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('slider', AdminSliderController::class);
    Route::resource('berita', AdminBeritaController::class);
    Route::resource('desa', AdminDesaController::class);
    Route::resource('profil', AdminProfilController::class);
    Route::resource('potensi', AdminPotensiController::class);
    Route::resource('statistik', AdminStatistikController::class);
});

// Breeze auth routes (if installed)
require __DIR__.'/auth.php';
```

---

## 🎯 IMPLEMENTATION PRIORITY:

### HIGH PRIORITY (Do First):
1. ✅ Run migration (`php artisan migrate`)
2. ✅ Create AdminMiddleware
3. ✅ Update routes/web.php
4. ✅ Create admin user
5. ✅ Test login

### MEDIUM PRIORITY:
6. Create Public Controllers (Profil, Potensi, Kontak)
7. Create Public Views
8. Update Homepage hero to support video

### LOW PRIORITY (Can do later):
9. Create Admin Dashboard
10. Create Admin CRUD views
11. Implement file upload
12. Add validation

---

## 💾 DATABASE STATUS:

### Tables:
✅ users (with role column)
✅ sliders (with video & type columns - after migration)
✅ beritas
✅ desas
✅ profils
✅ potensis
✅ statistiks
✅ settings
✅ strukturs
✅ unduhans
✅ faqs

### Sample Data:
✅ 2 Admin users
✅ Settings
✅ Sample berita, desa, statistik, etc.

---

## ⚠️ IMPORTANT NOTES:

1. **Admin Access:**
   - Email: `admin@kecamatantahunan.id`
   - Password: `admin123` (change this!)
   - URL: `http://localhost:8000/admin/dashboard`

2. **File Uploads:**
   - Max size: 10MB (can change in php.ini)
   - Video: max 50MB
   - Allowed: jpg, png, mp4, mov

3. **Permissions:**
   - Make sure `public/uploads` is writable
   - `chmod -R 775 public/uploads` (Linux/Mac)

4. **Cache:**
   - Clear cache after changes: `php artisan cache:clear`
   - Clear views: `php artisan view:clear`

---

## 🔥 NEXT STEPS:

**Sekarang jalankan command-command di atas satu per satu!**

Saya sudah siapkan structure-nya. Untuk **full implementation**, saya akan:

1. Buat Public Controllers & Views (10+ files)
2. Buat Admin Controllers & Views (30+ files)
3. Update Homepage untuk video support

**Mau saya lanjutkan membuat semua files sekarang?** Atau cukup dengan script ini dulu?

**Note:** Karena banyak files (50+), saya recommend Anda jalankan setup di atas dulu, lalu saya lanjutkan dengan views & controllers-nya.

**Ready?** 🚀
