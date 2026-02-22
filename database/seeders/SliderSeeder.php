<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Selamat Datang di Kecamatan Tahunan',
                'description' => 'Melayani dengan Sepenuh Hati untuk Masyarakat',
                'image' => 'slider1.jpg',
                'link' => null,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Kecamatan Tahunan Maju dan Sejahtera',
                'description' => 'Bersama Membangun Daerah yang Lebih Baik',
                'image' => 'slider2.jpg',
                'link' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Pelayanan Prima untuk Masyarakat',
                'description' => 'Transparansi, Akuntabilitas, dan Profesional',
                'image' => 'slider3.jpg',
                'link' => null,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $slider) {
            DB::table('sliders')->insert(array_merge($slider, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
