<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\Public\ProfilController;
use App\Http\Controllers\Public\PotensiController;
use App\Http\Controllers\Public\KontakController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

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
Route::get('/potensi/daftar', [PublicController::class, 'createPotensi'])->name('potensi.create.public');
Route::post('/potensi/daftar', [PublicController::class, 'storePotensi'])->name('potensi.store.public');
Route::get('/potensi/{slug}', [PotensiController::class, 'show'])->name('potensi.show');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// Statistik
Route::get('/statistik', [PublicController::class, 'statistik'])->name('statistik');

// Unduhan
Route::get('/unduhan', [PublicController::class, 'unduhan'])->name('unduhan');

// FAQ
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Content Management
    Route::resource('slider', \App\Http\Controllers\Admin\SliderController::class);
    Route::get('/berita/scrape', [\App\Http\Controllers\Admin\BeritaController::class, 'scrape'])->name('berita.scrape');
    Route::resource('berita', \App\Http\Controllers\Admin\BeritaController::class)->parameters(['berita' => 'berita']);
    Route::resource('desa', \App\Http\Controllers\Admin\DesaController::class);
    Route::resource('potensi', \App\Http\Controllers\Admin\PotensiController::class);
    Route::resource('layanan', \App\Http\Controllers\Admin\LayananController::class)->except(['show']);
    Route::resource('agenda', \App\Http\Controllers\Admin\AgendaController::class)->except(['show']);
    Route::get('setting', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting.index');
    Route::put('setting', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('setting.update');
    Route::resource('statistik', \App\Http\Controllers\Admin\StatistikController::class);
    Route::resource('profil', \App\Http\Controllers\Admin\ProfilController::class)->only(['index', 'edit', 'update']);
    Route::resource('struktur', \App\Http\Controllers\Admin\StrukturController::class)->except(['show']);
});

// Manual Auth Routes (Fallback if Breeze fails)
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// NOTE: Route debug sudah dihapus demi keamanan

if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}
