<?php

/*
|--------------------------------------------------------------------------
| Create/Reset Admin User
|--------------------------------------------------------------------------
|
| Run this file to create or reset admin user:
| php create-admin.php
|
*/

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "\n🔑 Creating Admin User...\n";
echo "========================\n\n";

try {
    // Delete old admin if exists
    User::where('email', 'admin@tahunan.id')->delete();

    // Create new admin
    $admin = User::create([
        'name' => 'Administrator',
        'email' => 'admin@tahunan.id',
        'role' => 'admin',
        'password' => Hash::make('admin123'),
        'is_active' => true,
    ]);

    echo "✅ Admin user created successfully!\n\n";
    echo "   Name     : {$admin->name}\n";
    echo "   Email    : {$admin->email}\n";
    echo "   Password : admin123\n";
    echo "   Role     : {$admin->role}\n\n";
    echo "🌐 Login URL: " . config('app.url') . "/login\n\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n\n";
}
