<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desaNames = [
            'Desa Demangan', 'Desa Kecapi', 'Desa Krapyak', 'Desa Langon', 'Desa Mangunan',
            'Desa Mantingan', 'Desa Ngabul', 'Desa Petekeyan', 'Desa Platar', 'Desa Semat',
            'Desa Senenan', 'Desa Sukodono', 'Desa Tahunan', 'Desa Wisata Tegalsambi', 'Desa Telukawur'
        ];

        $desas = [];

        foreach ($desaNames as $index => $name) {
            $baseName = str_replace(['Desa ', 'Wisata '], '', $name); // Get base name for emails/urls
            
            $desas[] = [
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'Website resmi Pemerintah ' . $name . ', Kecamatan Tahunan, Kabupaten Jepara.',
                'website_url' => 'https://desa' . Str::slug($baseName, '') . '.jepara.go.id',
                'logo' => null,
                'contact' => json_encode([
                    'phone' => '(0291) ' . rand(100000, 999999),
                    'email' => 'desa.' . Str::slug($baseName, '') . '@jepara.go.id',
                    'address' => 'Balai ' . $name . ', Kec. Tahunan, Jepara',
                ]),
                'social_media' => json_encode([
                    'facebook' => 'https://facebook.com/Pemdes' . str_replace(' ', '', $baseName),
                    'instagram' => '@pemdes_' . Str::slug($baseName, '_'),
                ]),
                'is_active' => true,
            ];
        }

        foreach ($desas as $desa) {
            DB::table('desas')->insert(array_merge($desa, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
