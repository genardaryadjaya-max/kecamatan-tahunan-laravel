<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'Kecamatan Tahunan', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Website Resmi Kecamatan Tahunan', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'site_keywords', 'value' => 'kecamatan tahunan, pemerintahan, berita, pengumuman', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => '', 'type' => 'image', 'group' => 'general'],

            // Contact Settings
            ['key' => 'contact_phone', 'value' => '(0274) 123456', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'kecamatan@tahunan.id', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Jl. Raya Tahunan No.1, Kecamatan Tahunan, Kabupaten Jepara', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'contact_work_hours', 'value' => 'Senin - Jumat: 08:00 - 16:00', 'type' => 'text', 'group' => 'contact'],

            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/kecamatantahunan', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/kecamatantahunan', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/kectahunan', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@kecamatantahunan', 'type' => 'text', 'group' => 'social'],

            // Map Settings
            ['key' => 'map_center_lat', 'value' => '-6.5333', 'type' => 'text', 'group' => 'map'],
            ['key' => 'map_center_lng', 'value' => '110.6667', 'type' => 'text', 'group' => 'map'],
            ['key' => 'map_zoom_level', 'value' => '13', 'type' => 'text', 'group' => 'map'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insert([
                'key' => $setting['key'],
                'value' => $setting['value'],
                'type' => $setting['type'],
                'group' => $setting['group'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
