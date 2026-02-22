# 🚀 Quick Start Guide - Kecamatan Tahunan Laravel 11

## ⚡ Instalasi Cepat

### 1. Install Dependencies

```bash
# Composer Dependencies
composer require livewire/livewire
composer require laravel/sanctum
composer require intervention/image
composer require spatie/laravel-permission
composer require laravel/breeze --dev

# NPM Dependencies
npm install -D tailwindcss postcss autoprefixer
npm install -D alpinejs @tailwindcss/forms @tailwindcss/typography
npm install gsap swiper leaflet aos
```

### 2. Setup Laravel Breeze (Authentication)

```bash
php artisan breeze:install blade
npm install
npm run dev
php artisan migrate
```

### 3. Setup Tailwind CSS

File: `tailwind.config.js`
```javascript
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
```

### 4. Import Database

```bash
# Via phpMyAdmin
Import: database/kecamatan_tahunan_FULL.sql

# Atau via command line
mysql -u root -p < database/kecamatan_tahunan_FULL.sql
```

### 5. Configure Environment

File: `.env`
```env
APP_NAME="Kecamatan Tahunan"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kecamatan_tahunan_laravel
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 6. Setup Storage Link

```bash
php artisan storage:link
```

### 7. Run Development Server

```bash
# Terminal 1: Laravel Server
php artisan serve

# Terminal 2: Vite Dev Server
npm run dev

# Terminal 3: Queue Worker (optional)
php artisan queue:work
```

## 📁 Folder Structure yang Perlu Dibuat

```bash
mkdir -p app/Services
mkdir -p app/Http/Livewire
mkdir -p app/Jobs
mkdir -p app/View/Components
mkdir -p resources/views/components
mkdir -p resources/views/livewire
mkdir -p resources/views/public
mkdir -p resources/views/admin
mkdir -p public/uploads/berita
mkdir -p public/uploads/desa
mkdir -p public/uploads/slider
mkdir -p public/uploads/potensi
```

## 🎯 Development Workflow

### Tahap 1: Setup Models & Relationships (Hari 1)

1. Create Models:
```bash
php artisan make:model Berita
php artisan make:model Desa
php artisan make:model Slider
php artisan make:model Profil
php artisan make:model Potensi
php artisan make:model Statistik
php artisan make:model Struktur
php artisan make:model Unduhan
php artisan make:model Faq
php artisan make:model Setting
php artisan make:model Sikema
```

2. Define relationships di masing-masing model

### Tahap 2: Create Controllers (Hari 1-2)

```bash
# Public Controllers
php artisan make:controller PublicController
php artisan make:controller BeritaController
php artisan make:controller DesaController

# Admin Controllers
php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/BeritaController --resource
php artisan make:controller Admin/DesaController --resource
php artisan make:controller Admin/SliderController --resource
php artisan make:controller Admin/SikemaController --resource

# API Controllers
php artisan make:controller Api/BeritaController --api
php artisan make:controller Api/DesaController --api
```

### Tahap 3: Create Livewire Components (Hari 2-3)

```bash
php artisan make:livewire BeritaList
php artisan make:livewire DesaCarousel
php artisan make:livewire SikemaForm
php artisan make:livewire StatistikCounter
php artisan make:livewire SearchComponent
```

### Tahap 4: Create Blade Components (Hari 3)

```bash
php artisan make:component Navbar
php artisan make:component Footer
php artisan make:component BeritaCard
php artisan make:component DesaCard
php artisan make:component HeroVideo
php artisan make:component StatCard
```

### Tahap 5: Create Services (Hari 3-4)

```bash
php artisan make:class Services/BeritaService
php artisan make:class Services/DesaService
php artisan make:class Services/SikemaService
php artisan make:class Services/FileUploadService
```

### Tahap 6: Create Jobs (Hari 4)

```bash
php artisan make:job OptimizeImage
php artisan make:job GenerateVideoThumbnail
php artisan make:job SendSikemaNotification
```

### Tahap 7: Create Form Requests (Hari 4)

```bash
php artisan make:request StoreBeritaRequest
php artisan make:request UpdateBeritaRequest
php artisan make:request StoreDesaRequest
php artisan make:request StoreSikemaRequest
```

## 🎨 Prioritas Development

### Week 1: Core Foundation
- ✅ Database setup
- 🔄 Authentication (Breeze)
- 🔄 Admin panel basic layout
- 🔄 Public homepage layout
- 🔄 Models & relationships

### Week 2: Public Features
- 🔄 Homepage with hero video
- 🔄 Berita list & detail
- 🔄 Website Desa carousel
- 🔄 Profil kecamatan pages
- 🔄 Leaflet maps integration

### Week 3: Admin Features & SIKEMA
- 🔄 Admin CRUD complete
- 🔄 SIKEMA system
- 🔄 File uploads
- 🔄 Image optimization

### Week 4: Optimization & Polish
- 🔄 Caching implementation
- 🔄 Queue jobs
- 🔄 PWA setup
- 🔄 Performance tuning
- 🔄 Testing

## 🔧 Useful Commands

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database
php artisan migrate:fresh --seed
php artisan db:seed

# Generate key
php artisan key:generate

# Create admin user
php artisan tinker
>>> User::create(['name'=>'Admin','email'=>'admin@test.com','role'=>'admin','password'=>bcrypt('password')])
```

## 📝 Git Workflow

```bash
# Initial commit
git init
git add .
git commit -m "Initial commit with Laravel 11 setup"

# Feature branch
git checkout -b feature/homepage
# ... development ...
git add .
git commit -m "Add homepage with hero video"
git checkout main
git merge feature/homepage
```

## 🎯 Next Steps

Setelah Quick Start selesai, lanjut ke:

1. **Implementasi Models dengan relationships** (lihat: docs/MODELS.md)
2. **Setup Livewire components** (lihat: docs/LIVEWIRE.md)
3. **Create public pages** (lihat: docs/VIEWS.md)
4. **Admin panel development** (lihat: docs/ADMIN.md)
5. **Performance optimization** (lihat: docs/OPTIMIZATION.md)

## 🆘 Troubleshooting

### Redis Connection Error
```bash
# Install Redis untuk Windows
# Download: https://github.com/microsoftarchive/redis/releases
# Atau gunakan file cache sementara
CACHE_DRIVER=file
```

### Node Modules Error
```bash
rm -rf node_modules
rm package-lock.json
npm cache clean --force
npm install
```

### Permission Error
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

**Ready to start?** 🚀

Mari kita mulai dengan setup authentication dan admin panel terlebih dahulu!
