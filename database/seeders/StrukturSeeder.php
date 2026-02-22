<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrukturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Camat (Level 1)
        $camatId = DB::table('strukturs')->insertGetId([
            'name' => 'Drs. Ahmad Suharto, M.Si',
            'position' => 'Camat',
            'nip' => '197001011994031001',
            'photo' => null,
            'description' => 'Camat Tahunan',
            'order' => 1,
            'parent_id' => null,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sekretaris Camat (Level 2)
        $sekretarisId = DB::table('strukturs')->insertGetId([
            'name' => 'Ir. Budi Santoso, M.M',
            'position' => 'Sekretaris Camat',
            'nip' => '197505101995031002',
            'photo' => null,
            'description' => 'Sekretaris Camat Tahunan',
            'order' => 2,
            'parent_id' => $camatId,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Kepala Seksi (Level 3)
        $strukturs = [
            [
                'name' => 'Sri Wahyuni, S.Sos',
                'position' => 'Kepala Seksi Pemerintahan',
                'nip' => '198001152005012001',
                'order' => 3,
                'parent_id' => $sekretarisId,
            ],
            [
                'name' => 'Rudi Hartono, S.E',
                'position' => 'Kepala Seksi Ekonomi dan Pembangunan',
                'nip' => '198203202006041001',
                'order' => 4,
                'parent_id' => $sekretarisId,
            ],
            [
                'name' => 'Dwi Prasetyo, S.H',
                'position' => 'Kepala Seksi Kesejahteraan Rakyat',
                'nip' => '198505252008011002',
                'order' => 5,
                'parent_id' => $sekretarisId,
            ],
            [
                'name' => 'Ani Susilowati, S.Pd',
                'position' => 'Kepala Seksi Pelayanan Umum',
                'nip' => '198708102009012001',
                'order' => 6,
                'parent_id' => $sekretarisId,
            ],
        ];

        foreach ($strukturs as $struktur) {
            DB::table('strukturs')->insert(array_merge($struktur, [
                'photo' => null,
                'description' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
