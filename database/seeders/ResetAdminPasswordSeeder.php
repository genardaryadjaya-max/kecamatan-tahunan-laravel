<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetAdminPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah user admin sudah ada, jika ada update, jika tidak buat baru
        $admin = User::where('email', 'admin@tahunan.id')->first();

        if ($admin) {
            $admin->update([
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'name' => 'Administrator' // Opsional
            ]);
            $this->command->info('User admin@tahunan.id berhasil di-reset passwordnya menjadi: admin123');
        } else {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@tahunan.id',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
            $this->command->info('User admin@tahunan.id berhasil dibuat dengan password: admin123');
        }
    }
}
