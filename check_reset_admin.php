<?php
/**
 * Script untuk cek & reset password admin
 * Jalankan via: php check_reset_admin.php
 * Atau akses via browser: http://127.0.0.1:8000/check_reset_admin.php (taruh di /public)
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

echo "=== CEK DATABASE USERS ===\n\n";

try {
    $users = DB::table('users')->get();
    
    if ($users->isEmpty()) {
        echo "⚠️  Tidak ada user di database!\n";
        echo "Insert user admin sekarang...\n\n";
        
        DB::table('users')->insert([
            'name'       => 'Super Admin',
            'email'      => 'admin@kecamatantahunan.id',
            'role'       => 'super_admin',
            'password'   => Hash::make('admin123'),
            'is_active'  => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('users')->insert([
            'name'       => 'Admin Kecamatan',
            'email'      => 'admin@tahunan.id',
            'role'       => 'admin',
            'password'   => Hash::make('admin123'),
            'is_active'  => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        echo "✅ User admin berhasil dibuat!\n";
    } else {
        echo "User yang ada di database:\n";
        foreach ($users as $user) {
            echo "  - ID: {$user->id} | Email: {$user->email} | Role: {$user->role} | Active: {$user->is_active}\n";
        }
    }

    echo "\n=== RESET PASSWORD SEMUA ADMIN ===\n";
    $newPassword = 'admin123';
    $hash = Hash::make($newPassword);
    
    $updated = DB::table('users')->update([
        'password'   => $hash,
        'is_active'  => 1,
        'updated_at' => now(),
    ]);
    
    echo "✅ Password semua user ({$updated} user) berhasil direset!\n\n";
    echo "=== INFO LOGIN ===\n";
    echo "  Email    : admin@kecamatantahunan.id\n";
    echo "  Password : admin123\n";
    echo "\n  atau\n\n";
    echo "  Email    : admin@tahunan.id\n";
    echo "  Password : admin123\n";
    echo "\n=== SELESAI ===\n";

} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "\nPastikan:\n";
    echo "  1. Database sudah diimport\n";
    echo "  2. File .env sudah sesuai\n";
    echo "  3. Composer install sudah dijalankan\n";
}
