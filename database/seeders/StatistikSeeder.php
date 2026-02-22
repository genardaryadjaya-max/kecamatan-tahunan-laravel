<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statistiks = [
            // Statistik Penduduk
            ['category' => 'penduduk', 'name' => 'Jumlah Penduduk', 'value' => '45.230', 'unit' => 'jiwa', 'icon' => 'users', 'year' => 2024, 'order' => 1],
            ['category' => 'penduduk', 'name' => 'Jumlah Kepala Keluarga', 'value' => '12.450', 'unit' => 'KK', 'icon' => 'home', 'year' => 2024, 'order' => 2],
            ['category' => 'penduduk', 'name' => 'Laki-laki', 'value' => '22.890', 'unit' => 'jiwa', 'icon' => 'male', 'year' => 2024, 'order' => 3],
            ['category' => 'penduduk', 'name' => 'Perempuan', 'value' => '22.340', 'unit' => 'jiwa', 'icon' => 'female', 'year' => 2024, 'order' => 4],

            // Statistik Pendidikan
            ['category' => 'pendidikan', 'name' => 'SD/MI', 'value' => '18', 'unit' => 'sekolah', 'icon' => 'school', 'year' => 2024, 'order' => 1],
            ['category' => 'pendidikan', 'name' => 'SMP/MTs', 'value' => '8', 'unit' => 'sekolah', 'icon' => 'school', 'year' => 2024, 'order' => 2],
            ['category' => 'pendidikan', 'name' => 'SMA/SMK/MA', 'value' => '5', 'unit' => 'sekolah', 'icon' => 'school', 'year' => 2024, 'order' => 3],

            // Statistik Kesehatan
            ['category' => 'kesehatan', 'name' => 'Puskesmas', 'value' => '2', 'unit' => 'unit', 'icon' => 'hospital', 'year' => 2024, 'order' => 1],
            ['category' => 'kesehatan', 'name' => 'Posyandu', 'value' => '25', 'unit' => 'unit', 'icon' => 'medkit', 'year' => 2024, 'order' => 2],

            // Statistik Ekonomi
            ['category' => 'ekonomi', 'name' => 'UMKM', 'value' => '350', 'unit' => 'unit', 'icon' => 'briefcase', 'year' => 2024, 'order' => 1],
            ['category' => 'ekonomi', 'name' => 'Pasar Tradisional', 'value' => '3', 'unit' => 'unit', 'icon' => 'shopping-cart', 'year' => 2024, 'order' => 2],
        ];

        foreach ($statistiks as $statistik) {
            DB::table('statistiks')->insert(array_merge($statistik, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
