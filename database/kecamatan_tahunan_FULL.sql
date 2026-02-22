-- =============================================
-- Database Kecamatan Tahunan Laravel - OPTIMIZED
-- Import file ini saja (sudah include struktur + data)
-- =============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 0;

-- Drop & Create Database
DROP DATABASE IF EXISTS `kecamatan_tahunan_laravel`;
CREATE DATABASE `kecamatan_tahunan_laravel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `kecamatan_tahunan_laravel`;

-- =============================================
-- TABLE: migrations
-- =============================================
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: users
-- =============================================
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin',
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` VALUES 
(1,'Super Admin','admin@kecamatantahunan.id','super_admin',NULL,NULL,1,NULL,NULL,'$2y$12$LQv3c1ydem15plSGtuLkau3.RWgOPP.5Hv3BZ9jGyO6YjBdJ3KYN6',NULL,NOW(),NOW()),
(2,'Admin Kecamatan','admin@tahunan.id','admin',NULL,NULL,1,NULL,NULL,'$2y$12$LQv3c1ydem15plSGtuLkau3.RWgOPP.5Hv3BZ9jGyO6YjBdJ3KYN6',NULL,NOW(),NOW());

-- =============================================
-- TABLE: password_reset_tokens
-- =============================================
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: failed_jobs
-- =============================================
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: personal_access_tokens
-- =============================================
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: sliders
-- =============================================
CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sliders` VALUES 
(1,'Selamat Datang di Kecamatan Tahunan','Melayani dengan Sepenuh Hati untuk Masyarakat','slider1.jpg',NULL,1,1,NOW(),NOW()),
(2,'Kecamatan Tahunan Maju dan Sejahtera','Bersama Membangun Daerah yang Lebih Baik','slider2.jpg',NULL,2,1,NOW(),NOW()),
(3,'Pelayanan Prima untuk Masyarakat','Transparansi, Akuntabilitas, dan Profesional','slider3.jpg',NULL,3,1,NOW(),NOW());

-- =============================================
-- TABLE: beritas
-- =============================================
CREATE TABLE `beritas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'Berita',
  `views` int(11) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beritas_slug_unique` (`slug`),
  KEY `beritas_created_by_foreign` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `beritas` VALUES 
(1,'Penyerahan Bantuan Sosial kepada Masyarakat Kurang Mampu','penyerahan-bantuan-sosial-kepada-masyarakat-kurang-mampu','Kecamatan Tahunan menyerahkan bantuan sosial kepada 150 keluarga kurang mampu.','<p>Kecamatan Tahunan telah menyerahkan bantuan sosial kepada 150 keluarga kurang mampu di wilayah Kecamatan Tahunan.</p>','berita1.jpg','Berita',125,1,DATE_SUB(NOW(),INTERVAL 5 DAY),1,NOW(),NOW()),
(2,'Pengumuman: Jadwal Pelayanan Administrasi Kependudukan','pengumuman-jadwal-pelayanan-administrasi-kependudukan','Informasi jadwal pelayanan administrasi kependudukan periode Februari 2026.','<p>Jadwal pelayanan: Senin-Kamis 08.00-14.00 WIB, Jumat 08.00-11.00 WIB.</p>','berita2.jpg','Pengumuman',89,1,DATE_SUB(NOW(),INTERVAL 3 DAY),1,NOW(),NOW()),
(3,'Musrenbang Kecamatan Tahunan 2026','musrenbang-kecamatan-tahunan-2026','Kecamatan Tahunan menggelar Musrenbang untuk merencanakan pembangunan tahun 2026.','<p>Musrenbang telah dilaksanakan dengan melibatkan seluruh stakeholder.</p>','berita3.jpg','Berita',203,1,DATE_SUB(NOW(),INTERVAL 7 DAY),1,NOW(),NOW()),
(4,'Vaksinasi COVID-19 untuk Lansia','vaksinasi-covid-19-untuk-lansia','Program vaksinasi COVID-19 untuk lansia di Kecamatan Tahunan.','<p>Program vaksinasi diikuti lebih dari 500 lansia.</p>','berita4.jpg','Berita',167,1,DATE_SUB(NOW(),INTERVAL 10 DAY),1,NOW(),NOW()),
(5,'Peringatan HUT RI ke-79','peringatan-hut-ri-ke-79','Kecamatan Tahunan menggelar berbagai lomba memeriahkan HUT RI.','<p>Kegiatan meliputi upacara bendera dan lomba tradisional.</p>','berita5.jpg','Berita',342,1,DATE_SUB(NOW(),INTERVAL 15 DAY),1,NOW(),NOW());

-- =============================================
-- TABLE: profils
-- =============================================
CREATE TABLE `profils` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `additional_data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `profils` VALUES 
(1,'sejarah','Sejarah Kecamatan Tahunan','<p>Kecamatan Tahunan merupakan salah satu kecamatan di Kabupaten Jepara yang memiliki sejarah panjang.</p>',NULL,NULL,NOW(),NOW()),
(2,'geografis','Letak Geografis','<p>Kecamatan Tahunan terletak di Kabupaten Jepara, Jawa Tengah. Luas wilayah ±25.5 km².</p>',NULL,'{\"luas_wilayah\":\"25.5\",\"koordinat\":\"-6.5333, 110.6667\"}',NOW(),NOW()),
(3,'visi_misi','Visi dan Misi','<h3>VISI</h3><p>Terwujudnya Kecamatan Tahunan yang Maju, Sejahtera, dan Religius</p><h3>MISI</h3><ol><li>Meningkatkan pelayanan publik</li><li>Mengembangkan ekonomi lokal</li></ol>',NULL,NULL,NOW(),NOW());

-- =============================================
-- TABLE: potensis
-- =============================================
CREATE TABLE `potensis` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `gallery` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `potensis_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `potensis` VALUES 
(1,'Pertanian Padi','pertanian-padi','Pertanian','Kecamatan Tahunan memiliki lahan pertanian padi yang luas.','potensi1.jpg','Seluruh wilayah',NULL,1,NOW(),NOW()),
(2,'Kerajinan Ukir Kayu','kerajinan-ukir-kayu','Ekonomi','Kerajinan ukir kayu produk unggulan yang dikenal mancanegara.','potensi2.jpg','Desa Tahunan',NULL,1,NOW(),NOW()),
(3,'Wisata Pantai','wisata-pantai','Wisata','Pantai dengan keindahan alam yang memukau.','potensi3.jpg','Pesisir utara',NULL,1,NOW(),NOW()),
(4,'Peternakan Sapi','peternakan-sapi','Peternakan','Peternakan sapi berkembang pesat.','potensi4.jpg','Desa Ngabul',NULL,1,NOW(),NOW());

-- =============================================
-- TABLE: statistiks
-- =============================================
CREATE TABLE `statistiks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(100) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `year` int(11) NOT NULL DEFAULT 2024,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `statistiks` VALUES 
(1,'penduduk','Jumlah Penduduk','45.230','jiwa','users',2024,1,NOW(),NOW()),
(2,'penduduk','Jumlah KK','12.450','KK','home',2024,2,NOW(),NOW()),
(3,'penduduk','Laki-laki','22.890','jiwa','male',2024,3,NOW(),NOW()),
(4,'penduduk','Perempuan','22.340','jiwa','female',2024,4,NOW(),NOW()),
(5,'pendidikan','SD/MI','18','sekolah','school',2024,1,NOW(),NOW()),
(6,'pendidikan','SMP/MTs','8','sekolah','school',2024,2,NOW(),NOW()),
(7,'pendidikan','SMA/SMK/MA','5','sekolah','school',2024,3,NOW(),NOW()),
(8,'kesehatan','Puskesmas','2','unit','hospital',2024,1,NOW(),NOW()),
(9,'kesehatan','Posyandu','25','unit','medkit',2024,2,NOW(),NOW()),
(10,'ekonomi','UMKM','350','unit','briefcase',2024,1,NOW(),NOW()),
(11,'ekonomi','Pasar','3','unit','shopping-cart',2024,2,NOW(),NOW());

-- =============================================
-- TABLE: desas
-- =============================================
CREATE TABLE `desas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `contact` json DEFAULT NULL,
  `social_media` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `desas_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `desas` VALUES 
(1,'Desa Tahunan','desa-tahunan','Desa di pusat kecamatan.','https://desatahunan.id',NULL,'{\"phone\":\"(0274) 111111\",\"email\":\"desa@tahunan.id\"}','{\"facebook\":\"https://facebook.com/desatahunan\"}',1,NOW(),NOW()),
(2,'Desa Ngabul','desa-ngabul','Desa dengan hasil pertanian melimpah.','https://desangabul.id',NULL,'{\"phone\":\"(0274) 222222\",\"email\":\"desa@ngabul.id\"}','{\"facebook\":\"https://facebook.com/desangabul\"}',1,NOW(),NOW()),
(3,'Desa Mindahan','desa-mindahan','Desa dengan potensi wisata alam.','https://desamindahan.id',NULL,'{\"phone\":\"(0274) 333333\",\"email\":\"desa@mindahan.id\"}','{\"facebook\":\"https://facebook.com/desamindahan\"}',1,NOW(),NOW());

-- =============================================
-- TABLE: strukturs
-- =============================================
CREATE TABLE `strukturs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `strukturs_parent_id_foreign` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `strukturs` VALUES 
(1,'Drs. Ahmad Suharto, M.Si','Camat','197001011994031001',NULL,'Camat Tahunan',1,NULL,1,NOW(),NOW()),
(2,'Ir. Budi Santoso, M.M','Sekretaris Camat','197505101995031002',NULL,'Sekretaris',2,1,1,NOW(),NOW()),
(3,'Sri Wahyuni, S.Sos','Kasi Pemerintahan','198001152005012001',NULL,NULL,3,2,1,NOW(),NOW()),
(4,'Rudi Hartono, S.E','Kasi Ekonomi','198203202006041001',NULL,NULL,4,2,1,NOW(),NOW()),
(5,'Dwi Prasetyo, S.H','Kasi Kesra','198505252008011002',NULL,NULL,5,2,1,NOW(),NOW()),
(6,'Ani Susilowati, S.Pd','Kasi Pelayanan','198708102009012001',NULL,NULL,6,2,1,NOW(),NOW());

-- =============================================
-- TABLE: unduhans
-- =============================================
CREATE TABLE `unduhans` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_size` int(11) NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'Dokumen',
  `downloads` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- TABLE: faqs
-- =============================================
CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'Umum',
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `faqs` VALUES 
(1,'Bagaimana cara mengurus KTP?','Datang ke kantor kecamatan dengan KK asli, surat RT/RW, dan pas foto 2 lembar.','Administrasi',1,1,NOW(),NOW()),
(2,'Bagaimana prosedur pembuatan KK?','Persiapkan surat RT/RW, KTP asli semua anggota keluarga, dan akta nikah.','Administrasi',2,1,NOW(),NOW()),
(3,'Berapa lama proses surat keterangan?','Umumnya 1-3 hari kerja tergantung kelengkapan dokumen.','Pelayanan',3,1,NOW(),NOW()),
(4,'Kapan jam pelayanan?','Senin-Kamis 08.00-14.00 WIB, Jumat 08.00-11.00 WIB.','Umum',4,1,NOW(),NOW()),
(5,'Apakah ada biaya pengurusan?','Tidak ada biaya (GRATIS) untuk semua dokumen kependudukan.','Pelayanan',5,1,NOW(),NOW());

-- =============================================
-- TABLE: settings
-- =============================================
CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'text',
  `group` varchar(100) NOT NULL DEFAULT 'general',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` VALUES 
(1,'site_name','Kecamatan Tahunan','text','general',NULL,NOW(),NOW()),
(2,'site_description','Website Resmi Kecamatan Tahunan','textarea','general',NULL,NOW(),NOW()),
(3,'site_keywords','kecamatan tahunan, pemerintahan, berita','text','general',NULL,NOW(),NOW()),
(4,'site_logo','','image','general',NULL,NOW(),NOW()),
(5,'contact_phone','(0274) 123456','text','contact',NULL,NOW(),NOW()),
(6,'contact_email','kecamatan@tahunan.id','text','contact',NULL,NOW(),NOW()),
(7,'contact_address','Jl. Raya Tahunan No.1, Kecamatan Tahunan, Kabupaten Jepara','textarea','contact',NULL,NOW(),NOW()),
(8,'contact_work_hours','Senin - Jumat: 08:00 - 16:00','text','contact',NULL,NOW(),NOW()),
(9,'social_facebook','https://facebook.com/kecamatantahunan','text','social',NULL,NOW(),NOW()),
(10,'social_instagram','https://instagram.com/kecamatantahunan','text','social',NULL,NOW(),NOW()),
(11,'social_twitter','https://twitter.com/kectahunan','text','social',NULL,NOW(),NOW()),
(12,'social_youtube','https://youtube.com/@kecamatantahunan','text','social',NULL,NOW(),NOW()),
(13,'map_center_lat','-6.5333','text','map',NULL,NOW(),NOW()),
(14,'map_center_lng','110.6667','text','map',NULL,NOW(),NOW()),
(15,'map_zoom_level','13','text','map',NULL,NOW(),NOW());

-- =============================================
-- Add Foreign Keys
-- =============================================
ALTER TABLE `beritas` ADD CONSTRAINT `beritas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
ALTER TABLE `strukturs` ADD CONSTRAINT `strukturs_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `strukturs` (`id`) ON DELETE CASCADE;

-- =============================================
-- Complete
-- =============================================
SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
