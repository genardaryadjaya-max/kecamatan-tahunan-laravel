<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara mengurus KTP di Kecamatan Tahunan?',
                'answer' => 'Untuk mengurus KTP, silakan datang ke kantor kecamatan dengan membawa dokumen persyaratan: Kartu Keluarga asli, Surat Pengantar dari RT/RW, dan Pas Foto 4x6 sebanyak 2 lembar. Pelayanan dilakukan setiap hari kerja pada jam 08.00 - 14.00 WIB.',
                'category' => 'Administrasi Kependudukan',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana prosedur pembuatan Kartu Keluarga (KK)?',
                'answer' => 'Untuk membuat KK baru, persiapkan dokumen: Surat Pengantar RT/RW, KTP asli semua anggota keluarga, Akta Nikah (jika sudah menikah), dan Surat Keterangan Pindah (jika pindahan). Datang ke kantor kecamatan dan isi formulir yang disediakan.',
                'category' => 'Administrasi Kependudukan',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Berapa lama proses pengurusan surat keterangan?',
                'answer' => 'Proses pengurusan surat keterangan umumnya dapat diselesaikan dalam 1-3 hari kerja, tergantung jenis surat yang diurus dan kelengkapan dokumen persyaratan.',
                'category' => 'Pelayanan Umum',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Kapan jam pelayanan kantor kecamatan?',
                'answer' => 'Jam pelayanan kantor Kecamatan Tahunan adalah Senin-Kamis pukul 08.00-14.00 WIB, Jumat pukul 08.00-11.00 WIB. Sabtu, Minggu, dan hari libur nasional tutup.',
                'category' => 'Umum',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah ada biaya untuk pengurusan dokumen kependudukan?',
                'answer' => 'Tidak ada biaya (GRATIS) untuk pengurusan dokumen kependudukan seperti KTP, KK, Akta Kelahiran, dan surat keterangan lainnya. Jika ada pihak yang meminta biaya, silakan laporkan ke kantor kecamatan.',
                'category' => 'Pelayanan Umum',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            DB::table('faqs')->insert(array_merge($faq, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
