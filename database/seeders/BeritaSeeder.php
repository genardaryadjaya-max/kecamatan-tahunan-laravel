<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beritas = [
            [
                'title' => 'Penyerahan Bantuan Sosial kepada Masyarakat Kurang Mampu',
                'slug' => Str::slug('Penyerahan Bantuan Sosial kepada Masyarakat Kurang Mampu'),
                'excerpt' => 'Kecamatan Tahunan menyerahkan bantuan sosial kepada 150 keluarga kurang mampu sebagai bentuk kepedulian pemerintah.',
                'content' => '<p>Kecamatan Tahunan telah menyerahkan bantuan sosial kepada 150 keluarga kurang mampu di wilayah Kecamatan Tahunan. Bantuan ini diberikan sebagai bentuk kepedulian pemerintah terhadap masyarakat yang membutuhkan.</p><p>Camat Tahunan menyampaikan bahwa program ini merupakan wujud nyata dari komitmen pemerintah untuk meningkatkan kesejahteraan masyarakat, khususnya bagi mereka yang kurang mampu.</p>',
                'image' => 'berita1.jpg',
                'category' => 'Berita',
                'views' => 125,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'created_by' => 1,
            ],
            [
                'title' => 'Pengumuman: Jadwal Pelayanan Administrasi Kependudukan',
                'slug' => Str::slug('Pengumuman: Jadwal Pelayanan Administrasi Kependudukan'),
                'excerpt' => 'Informasi jadwal pelayanan administrasi kependudukan di Kantor Kecamatan Tahunan periode Februari 2026.',
                'content' => '<p>Kepada seluruh masyarakat Kecamatan Tahunan, dengan ini kami sampaikan jadwal pelayanan administrasi kependudukan untuk periode Februari 2026:</p><ul><li>Senin - Kamis: 08.00 - 14.00 WIB</li><li>Jumat: 08.00 - 11.00 WIB</li><li>Sabtu - Minggu: Libur</li></ul><p>Mohon masyarakat untuk mempersiapkan dokumen yang diperlukan sebelum datang ke kantor.</p>',
                'image' => 'berita2.jpg',
                'category' => 'Pengumuman',
                'views' => 89,
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'created_by' => 1,
            ],
            [
                'title' => 'Musyawarah Rencana Pembangunan (Musrenbang) Kecamatan Tahunan 2026',
                'slug' => Str::slug('Musyawarah Rencana Pembangunan (Musrenbang) Kecamatan Tahunan 2026'),
                'excerpt' => 'Kecamatan Tahunan menggelar Musrenbang untuk merencanakan pembangunan tahun 2026 dengan melibatkan seluruh stakeholder.',
                'content' => '<p>Musyawarah Rencana Pembangunan (Musrenbang) Kecamatan Tahunan tahun 2026 telah dilaksanakan dengan melibatkan seluruh kepala desa, tokoh masyarakat, dan berbagai elemen masyarakat.</p><p>Dalam forum ini, dibahas berbagai rencana pembangunan yang akan dilaksanakan di tahun mendatang, termasuk perbaikan infrastruktur, peningkatan pendidikan, dan pemberdayaan ekonomi masyarakat.</p>',
                'image' => 'berita3.jpg',
                'category' => 'Berita',
                'views' => 203,
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'created_by' => 1,
            ],
            [
                'title' => 'Vaksinasi COVID-19 untuk Lansia di Kecamatan Tahunan',
                'slug' => Str::slug('Vaksinasi COVID-19 untuk Lansia di Kecamatan Tahunan'),
                'excerpt' => 'Program vaksinasi COVID-19 untuk lansia telah dilaksanakan di berbagai titik di Kecamatan Tahunan.',
                'content' => '<p>Kecamatan Tahunan bersama Puskesmas setempat telah melaksanakan program vaksinasi COVID-19 untuk lansia. Program ini diikuti oleh lebih dari 500 lansia dari berbagai desa di wilayah Kecamatan Tahunan.</p><p>Camat Tahunan mengimbau masyarakat, khususnya lansia, untuk tetap menjaga protokol kesehatan meskipun sudah divaksinasi.</p>',
                'image' => 'berita4.jpg',
                'category' => 'Berita',
                'views' => 167,
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'created_by' => 1,
            ],
            [
                'title' => 'Peringatan Hari Kemerdekaan RI ke-79 di Kecamatan Tahunan',
                'slug' => Str::slug('Peringatan Hari Kemerdekaan RI ke-79 di Kecamatan Tahunan'),
                'excerpt' => 'Kecamatan Tahunan menggelar berbagai lomba dan kegiatan dalam rangka memeriahkan HUT RI ke-79.',
                'content' => '<p>Dalam rangka memperingati HUT RI ke-79, Kecamatan Tahunan menggelar berbagai kegiatan dan lomba untuk seluruh masyarakat. Kegiatan ini meliputi upacara bendera, lomba-lomba tradisional, dan berbagai kegiatan seni budaya.</p><p>Kegiatan ini diharapkan dapat memupuk rasa nasionalisme dan kebersamaan di kalangan masyarakat Kecamatan Tahunan.</p>',
                'image' => 'berita5.jpg',
                'category' => 'Berita',
                'views' => 342,
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'created_by' => 1,
            ],
        ];

        foreach ($beritas as $berita) {
            DB::table('beritas')->insert(array_merge($berita, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
