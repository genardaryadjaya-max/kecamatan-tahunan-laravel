<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create single admin account
        // Email: admin@tahunan.id
        // Password: admin123
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@tahunan.id',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'is_active' => true,
        ]);

        echo "\n✅ Admin user created successfully!\n";
        echo "   Email: admin@tahunan.id\n";
        echo "   Password: admin123\n\n";
    }
}
