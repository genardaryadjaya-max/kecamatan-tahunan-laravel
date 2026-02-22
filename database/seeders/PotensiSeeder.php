<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PotensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $potensis = [
            [
                'name' => 'Pertanian Padi',
                'slug' => Str::slug('Pertanian Padi'),
                'category' => 'pertanian',
                'description' => 'Kecamatan Tahunan memiliki lahan pertanian padi yang luas dengan hasil panen yang melimpah. Mayoritas masyarakat bekerja sebagai petani padi.',
                'image' => 'potensi1.jpg',
                'location' => 'Seluruh wilayah kecamatan',
                'gallery' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Kerajinan Ukir Kayu',
                'slug' => Str::slug('Kerajinan Ukir Kayu'),
                'category' => 'industri',
                'description' => 'Kerajinan ukir kayu merupakan produk unggulan yang telah dikenal hingga mancanegara. Produk ini menjadi salah satu penggerak ekonomi masyarakat.',
                'image' => 'potensi2.jpg',
                'location' => 'Desa Tahunan',
                'gallery' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Wisata Pantai',
                'slug' => Str::slug('Wisata Pantai'),
                'category' => 'wisata',
                'description' => 'Pantai-pantai di Kecamatan Tahunan menawarkan keindahan alam yang memukau dengan pasir putih dan air laut yang jernih.',
                'image' => 'potensi3.jpg',
                'location' => 'Pesisir utara kecamatan',
                'gallery' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Peternakan Sapi',
                'slug' => Str::slug('Peternakan Sapi'),
                'category' => 'peternakan',
                'description' => 'Peternakan sapi berkembang pesat di wilayah ini, menghasilkan daging dan susu berkualitas untuk memenuhi kebutuhan lokal dan regional.',
                'image' => 'potensi4.jpg',
                'location' => 'Desa Ngabul',
                'gallery' => null,
                'is_active' => true,
            ],
        ];

        foreach ($potensis as $potensi) {
            DB::table('potensis')->insert(array_merge($potensi, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
