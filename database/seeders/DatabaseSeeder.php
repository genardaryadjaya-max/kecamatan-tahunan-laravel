<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            SliderSeeder::class,
            ProfilSeeder::class,
            BeritaSeeder::class,
            DesaSeeder::class,
            StatistikSeeder::class,
            PotensiSeeder::class,
            StrukturSeeder::class,
            FaqSeeder::class,
        ]);
    }
}
