<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if role column exists
        if (!Schema::hasColumn('users', 'role')) {
            $this->command->error('Users table does not have role column! Please run migrations first.');
            return;
        }

        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@kecamatantahunan.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@kecamatantahunan.id');
        $this->command->info('Password: admin123');
    }
}
