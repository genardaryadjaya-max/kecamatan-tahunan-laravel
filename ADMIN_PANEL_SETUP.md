# 🔥 ADMIN PANEL SETUP GUIDE

## Step 1: Install Laravel Breeze
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan migrate
npm install
npm run build
```

## Step 2: Update User Migration (add role field)
Check file: `database/migrations/xxxx_create_users_table.php`

Add this line:
```php
$table->string('role')->default('user'); // admin or user
```

Then run:
```bash
php artisan migrate:fresh --seed
```

## Step 3: Create Admin User
```bash
php artisan tinker
```

Then:
```php
\App\Models\User::create([
    'name' => 'Super Admin',
    'email' => 'admin@kecamatantahunan.id',
    'password' => bcrypt('admin123'),
    'role' => 'admin',
]);
exit
```

## Step 4: Create Admin Middleware
File already created: `app/Http/Middleware/AdminMiddleware.php`

Register in `bootstrap/app.php`:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
})
```

## Step 5: Admin Routes Already Created
Check: `routes/web.php` - Admin routes section

## Step 6: Test Admin Login
```
http://localhost:8000/login
Email: admin@kecamatantahunan.id
Password: admin123
```

After login, access:
```
http://localhost:8000/admin/dashboard
```

---

## ✅ FILES YANG SUDAH DISIAPKAN:

1. AdminMiddleware.php
2. Admin Controllers (will create next)
3. Admin Routes (ready to uncomment)
4. Admin Views (will create next)

---

## 🎬 VIDEO UPLOAD FLOW:

1. Admin login
2. Go to **Admin > Slider**
3. Click **"Tambah Slider"**
4. Form:
   - Title: "Hero Video Kecamatan Tahunan"
   - Type: [x] Video (radio button)
   - Upload Video: Select from assets folder
   - Upload Image: Fallback jika video error
5. Save
6. Homepage auto update dengan video looping! ✅

---

**Siap lanjut buat Admin Panel full?** 🚀
