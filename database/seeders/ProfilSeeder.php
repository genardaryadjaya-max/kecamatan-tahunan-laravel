<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profils = [
            [
                'slug' => 'sejarah',
                'title' => 'Sejarah Kecamatan Tahunan',
                'content' => '<p>Kecamatan Tahunan merupakan salah satu kecamatan di Kabupaten Jepara yang memiliki sejarah panjang. Nama Tahunan sendiri memiliki makna historis yang erat kaitannya dengan tradisi dan budaya masyarakat setempat.</p><p>Pembentukan Kecamatan Tahunan tidak terlepas dari perkembangan pemerintahan di Kabupaten Jepara. Seiring berjalannya waktu, Kecamatan Tahunan terus berkembang menjadi pusat pemerintahan dan pelayanan masyarakat yang lebih baik.</p>',
                'image' => null,
            ],
            [
                'slug' => 'geografis',
                'title' => 'Letak Geografis',
                'content' => '<p>Kecamatan Tahunan terletak di wilayah Kabupaten Jepara, Provinsi Jawa Tengah. Secara geografis, Kecamatan Tahunan memiliki batas-batas wilayah sebagai berikut:</p><ul><li>Sebelah Utara: Laut Jawa</li><li>Sebelah Timur: Kecamatan Kedung</li><li>Sebelah Selatan: Kecamatan Pecangaan</li><li>Sebelah Barat: Kecamatan Jepara</li></ul><p>Luas wilayah Kecamatan Tahunan mencapai ±XX km² dengan topografi yang beragam, mulai dari dataran rendah hingga perbukitan.</p>',
                'image' => null,
            ],
            [
                'slug' => 'visi_misi',
                'title' => 'Visi dan Misi Kecamatan Tahunan',
                'content' => '<h3>VISI</h3><p>"Terwujudnya Kecamatan Tahunan yang Maju, Sejahtera, dan Religius"</p><h3>MISI</h3><ol><li>Meningkatkan kualitas pelayanan publik yang profesional dan akuntabel</li><li>Mengembangkan potensi ekonomi lokal untuk kesejahteraan masyarakat</li><li>Meningkatkan kualitas pendidikan dan kesehatan masyarakat</li><li>Mewujudkan tata kelola pemerintahan yang baik dan bersih</li><li>Melestarikan nilai-nilai religius dan budaya lokal</li></ol>',
                'image' => null,
            ],
        ];

        foreach ($profils as $profil) {
            DB::table('profils')->insert(array_merge($profil, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
