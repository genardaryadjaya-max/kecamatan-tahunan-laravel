# 📦 Checklist Instalasi - Kecamatan Tahunan Laravel 11

## ✅ Status Instalasi

### 1. **Laptop/System Requirements**

#### PHP ✅ (Sudah Ada - via XAMPP)
```bash
php -v
# Expected: PHP 8.1+ 
```

#### Composer ✅ (Sudah Ada)
```bash
composer -v
# Expected: Composer 2.x
```

#### Node.js & NPM ✅ (Sudah Ada)
```bash
node -v
npm -v
# Expected: Node 18+ & NPM 9+
```

#### MySQL ✅ (Sudah Ada - via XAMPP)
- Database sudah dibuat: `kecamatan_tahunan_laravel` ✅
- Data sudah diimport dari `kecamatan_tahunan_FULL.sql` ✅

---

### 2. **Project Dependencies**

#### ❌ **Composer Packages (BELUM TERINSTALL)**

**Yang perlu diinstall:**
- ❌ `livewire/livewire` - Untuk dynamic content
- ❌ `intervention/image` - Untuk image optimization
- ❌ `spatie/laravel-permission` - Untuk role & permissions
- ❌ `laravel/breeze` (dev) - Untuk authentication

**Cara Install:**
```bash
cd c:\xampp\htdocs\kecamatan_tahunan_laravel
composer install
```

---

#### ❌ **NPM Packages (BELUM TERINSTALL)**

**Yang perlu diinstall:**
- ❌ `tailwindcss` - Utility-first CSS framework
- ❌ `@tailwindcss/forms` - Form styling
- ❌ `@tailwindcss/typography` - Typography plugin
- ❌ `autoprefixer` - CSS vendor prefixes
- ❌ `postcss` - CSS processor
- ❌ `alpinejs` - Lightweight JS framework
- ❌ `swiper` - Modern carousel library
- ❌ `aos` - Animate on scroll library
- ❌ `leaflet` - Interactive maps library
- ❌ `gsap` - Animation library

**Cara Install:**
```bash
cd c:\xampp\htdocs\kecamatan_tahunan_laravel
npm install
```

---

### 3. **Konfigurasi Files**

#### ✅ **Yang Sudah Dibuat:**
- ✅ `tailwind.config.js` - Tailwind configuration
- ✅ `vite.config.js` - Vite configuration
- ✅ `postcss.config.js` - PostCSS configuration
- ✅ `resources/css/app.css` - Tailwind CSS with custom styles
- ✅ `resources/js/app.js` - JS with Alpine, Swiper, AOS, Leaflet
- ✅ `package.json` - Updated with all dependencies
- ✅ `composer.json` - Updated with all packages

#### ❌ **Yang Belum Dijalankan:**
- ❌ `composer install` - Install PHP packages
- ❌ `npm install` - Install Node packages
- ❌ `php artisan storage:link` - Link storage folder
- ❌ `php artisan key:generate` - Generate application key (jika belum)

---

## 🚀 **Langkah Instalasi Lengkap (Copy Paste Aja!)**

### **Step 1: Install Composer Dependencies**
```bash
cd c:\xampp\htdocs\kecamatan_tahunan_laravel
composer install
```

**Output yang diharapkan:**
```
Installing dependencies from lock file
...
Package operations: X installs, 0 updates, 0 removals
...
Generating optimized autoload files
```

---

### **Step 2: Install NPM Dependencies**
```bash
npm install
```

**Output yang diharapkan:**
```
added XXX packages in Xs
```

---

### **Step 3: Setup Laravel**
```bash
# Generate application key (jika belum ada)
php artisan key:generate

# Link storage folder untuk uploads
php artisan storage:link

# Clear all cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

---

### **Step 4: Buat Folder untuk Uploads**
```bash
# Via File Explorer, buat folder-folder ini di public/:
# public/uploads/berita/
# public/uploads/desa/
# public/uploads/slider/
# public/uploads/potensi/
# public/images/

# Atau via Command Prompt:
mkdir public\uploads
mkdir public\uploads\berita
mkdir public\uploads\desa
mkdir public\uploads\slider
mkdir public\uploads\potensi
mkdir public\images
```

---

### **Step 5: Jalankan Development Server**

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite Dev Server:**
```bash
npm run dev
```

**Buka Browser:**
```
http://localhost:8000
```

---

## 📊 **Verifikasi Instalasi**

### **Cek Composer Packages:**
```bash
composer show | findstr "livewire intervention spatie breeze"
```

**Harusnya muncul:**
```
intervention/image
livewire/livewire
spatie/laravel-permission
laravel/breeze
```

---

### **Cek NPM Packages:**
```bash
npm list --depth=0
```

**Harusnya muncul:**
```
├── alpinejs@3.x.x
├── aos@2.x.x
├── gsap@3.x.x
├── leaflet@1.x.x
├── swiper@11.x.x
├── tailwindcss@3.x.x
└── ...
```

---

### **Cek Laravel Installation:**
```bash
php artisan about
```

**Harusnya muncul info tentang:**
- Environment: local
- Debug: true
- URL: http://localhost
- Database: kecamatan_tahunan_laravel
- etc.

---

## ⚠️ **Troubleshooting**

### **Error: "composer not found"**
```bash
# Install Composer dari https://getcomposer.org/download/
# Atau pastikan Composer sudah ada di PATH
```

### **Error: "npm not found"**
```bash
# Install Node.js dari https://nodejs.org/
# Download versi LTS (Long Term Support)
```

### **Error: "Class 'Livewire\...' not found"**
```bash
# Run composer install lagi
composer install
php artisan clear-compiled
composer dump-autoload
```

### **Error: Vite manifest not found**
```bash
# Pastikan npm run dev sedang berjalan
npm run dev

# Atau build untuk production
npm run build
```

### **Error: Database connection refused**
```bash
# Pastikan XAMPP MySQL sudah jalan
# Cek .env file:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kecamatan_tahunan_laravel
DB_USERNAME=root
DB_PASSWORD=
```

---

## 🎯 **Status Summary**

| Item | Status | Action |
|------|--------|--------|
| PHP | ✅ Installed | - |
| Composer | ✅ Installed | - |
| Node.js & NPM | ✅ Installed | - |
| MySQL | ✅ Installed | - |
| Database Created | ✅ Done | - |
| Database Imported | ✅ Done | - |
| Config Files | ✅ Created | - |
| **Composer Packages** | ❌ **Not Installed** | **Run: `composer install`** |
| **NPM Packages** | ❌ **Not Installed** | **Run: `npm install`** |
| Storage Link | ❌ Not Created | Run: `php artisan storage:link` |
| Upload Folders | ❌ Not Created | Create manually |

---

## 🚀 **Quick Install (All in One)**

**Copy paste command ini satu per satu:**

```bash
cd c:\xampp\htdocs\kecamatan_tahunan_laravel

composer install

npm install

php artisan key:generate

php artisan storage:link

mkdir public\uploads\berita
mkdir public\uploads\desa
mkdir public\uploads\slider
mkdir public\uploads\potensi
mkdir public\images

php artisan cache:clear

echo "Installation Complete!"
```

**Lalu jalankan server (2 terminal):**

**Terminal 1:**
```bash
php artisan serve
```

**Terminal 2:**
```bash
npm run dev
```

**Buka:** `http://localhost:8000`

---

## ✅ **Setelah Install Berhasil**

Website sudah siap dengan:
- ✅ Modern Tailwind CSS UI
- ✅ Alpine.js interactivity
- ✅ Swiper carousel
- ✅ AOS animations
- ✅ Leaflet maps
- ✅ Responsive design
- ✅ Fast performance

**Enjoy!** 🎉

---

**Last Updated:** 2026-02-10
