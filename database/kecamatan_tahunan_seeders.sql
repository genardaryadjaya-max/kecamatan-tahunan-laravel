-- =============================================
-- Insert Sample Data
-- =============================================

USE `kecamatan_tahunan_laravel`;

-- =============================================
-- Insert Users (Admin)
-- =============================================
INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@kecamatantahunan.id', 'super_admin', '$2y$12$LQv3c1ydem15plSGtuLkau3.RWgOPP.5Hv3BZ9jGyO6YjBdJ3KYN6', 1, NOW(), NOW()),
(2, 'Admin Kecamatan', 'admin@tahunan.id', 'admin', '$2y$12$LQv3c1ydem15plSGtuLkau3.RWgOPP.5Hv3BZ9jGyO6YjBdJ3KYN6', 1, NOW(), NOW());
-- Password untuk kedua user: password123

-- =============================================
-- Insert Settings
-- =============================================
INSERT INTO `settings` (`key`, `value`, `type`, `group`, `created_at`, `updated_at`) VALUES
('site_name', 'Kecamatan Tahunan', 'text', 'general', NOW(), NOW()),
('site_description', 'Website Resmi Kecamatan Tahunan', 'textarea', 'general', NOW(), NOW()),
('site_keywords', 'kecamatan tahunan, pemerintahan, berita, pengumuman', 'text', 'general', NOW(), NOW()),
('site_logo', '', 'image', 'general', NOW(), NOW()),
('contact_phone', '(0274) 123456', 'text', 'contact', NOW(), NOW()),
('contact_email', 'kecamatan@tahunan.id', 'text', 'contact', NOW(), NOW()),
('contact_address', 'Jl. Raya Tahunan No.1, Kecamatan Tahunan, Kabupaten Jepara', 'textarea', 'contact', NOW(), NOW()),
('contact_work_hours', 'Senin - Jumat: 08:00 - 16:00', 'text', 'contact', NOW(), NOW()),
('social_facebook', 'https://facebook.com/kecamatantahunan', 'text', 'social', NOW(), NOW()),
('social_instagram', 'https://instagram.com/kecamatantahunan', 'text', 'social', NOW(), NOW()),
('social_twitter', 'https://twitter.com/kectahunan', 'text', 'social', NOW(), NOW()),
('social_youtube', 'https://youtube.com/@kecamatantahunan', 'text', 'social', NOW(), NOW()),
('map_center_lat', '-6.5333', 'text', 'map', NOW(), NOW()),
('map_center_lng', '110.6667', 'text', 'map', NOW(), NOW()),
('map_zoom_level', '13', 'text', 'map', NOW(), NOW());

-- =============================================
-- Insert Sliders
-- =============================================
INSERT INTO `sliders` (`title`, `description`, `image`, `link`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
('Selamat Datang di Kecamatan Tahunan', 'Melayani dengan Sepenuh Hati untuk Masyarakat', 'slider1.jpg', NULL, 1, 1, NOW(), NOW()),
('Kecamatan Tahunan Maju dan Sejahtera', 'Bersama Membangun Daerah yang Lebih Baik', 'slider2.jpg', NULL, 2, 1, NOW(), NOW()),
('Pelayanan Prima untuk Masyarakat', 'Transparansi, Akuntabilitas, dan Profesional', 'slider3.jpg', NULL, 3, 1, NOW(), NOW());

-- =============================================
-- Insert Profils
-- =============================================
INSERT INTO `profils` (`type`, `title`, `content`, `image`, `additional_data`, `created_at`, `updated_at`) VALUES
('sejarah', 'Sejarah Kecamatan Tahunan', '<p>Kecamatan Tahunan merupakan salah satu kecamatan di Kabupaten Jepara yang memiliki sejarah panjang. Nama Tahunan sendiri memiliki makna historis yang erat kaitannya dengan tradisi dan budaya masyarakat setempat.</p><p>Pembentukan Kecamatan Tahunan tidak terlepas dari perkembangan pemerintahan di Kabupaten Jepara. Seiring berjalannya waktu, Kecamatan Tahunan terus berkembang menjadi pusat pemerintahan dan pelayanan masyarakat yang lebih baik.</p>', NULL, NULL, NOW(), NOW()),
('geografis', 'Letak Geografis', '<p>Kecamatan Tahunan terletak di wilayah Kabupaten Jepara, Provinsi Jawa Tengah. Secara geografis, Kecamatan Tahunan memiliki batas-batas wilayah sebagai berikut:</p><ul><li>Sebelah Utara: Laut Jawa</li><li>Sebelah Timur: Kecamatan Kedung</li><li>Sebelah Selatan: Kecamatan Pecangaan</li><li>Sebelah Barat: Kecamatan Jepara</li></ul><p>Luas wilayah Kecamatan Tahunan mencapai ±25.5 km² dengan topografi yang beragam, mulai dari dataran rendah hingga perbukitan.</p>', NULL, '{"luas_wilayah":"25.5","koordinat":"-6.5333, 110.6667"}', NOW(), NOW()),
('visi_misi', 'Visi dan Misi Kecamatan Tahunan', '<h3>VISI</h3><p>"Terwujudnya Kecamatan Tahunan yang Maju, Sejahtera, dan Religius"</p><h3>MISI</h3><ol><li>Meningkatkan kualitas pelayanan publik yang profesional dan akuntabel</li><li>Mengembangkan potensi ekonomi lokal untuk kesejahteraan masyarakat</li><li>Meningkatkan kualitas pendidikan dan kesehatan masyarakat</li><li>Mewujudkan tata kelola pemerintahan yang baik dan bersih</li><li>Melestarikan nilai-nilai religius dan budaya lokal</li></ol>', NULL, NULL, NOW(), NOW());

-- =============================================
-- Insert Beritas
-- =============================================
INSERT INTO `beritas` (`title`, `slug`, `excerpt`, `content`, `image`, `category`, `views`, `is_published`, `published_at`, `created_by`, `created_at`, `updated_at`) VALUES
('Penyerahan Bantuan Sosial kepada Masyarakat Kurang Mampu', 'penyerahan-bantuan-sosial-kepada-masyarakat-kurang-mampu', 'Kecamatan Tahunan menyerahkan bantuan sosial kepada 150 keluarga kurang mampu sebagai bentuk kepedulian pemerintah.', '<p>Kecamatan Tahunan telah menyerahkan bantuan sosial kepada 150 keluarga kurang mampu di wilayah Kecamatan Tahunan. Bantuan ini diberikan sebagai bentuk kepedulian pemerintah terhadap masyarakat yang membutuhkan.</p><p>Camat Tahunan menyampaikan bahwa program ini merupakan wujud nyata dari komitmen pemerintah untuk meningkatkan kesejahteraan masyarakat, khususnya bagi mereka yang kurang mampu.</p>', 'berita1.jpg', 'Berita', 125, 1, DATE_SUB(NOW(), INTERVAL 5 DAY), 1, NOW(), NOW()),
('Pengumuman: Jadwal Pelayanan Administrasi Kependudukan', 'pengumuman-jadwal-pelayanan-administrasi-kependudukan', 'Informasi jadwal pelayanan administrasi kependudukan di Kantor Kecamatan Tahunan periode Februari 2026.', '<p>Kepada seluruh masyarakat Kecamatan Tahunan, dengan ini kami sampaikan jadwal pelayanan administrasi kependudukan untuk periode Februari 2026:</p><ul><li>Senin - Kamis: 08.00 - 14.00 WIB</li><li>Jumat: 08.00 - 11.00 WIB</li><li>Sabtu - Minggu: Libur</li></ul><p>Mohon masyarakat untuk mempersiapkan dokumen yang diperlukan sebelum datang ke kantor.</p>', 'berita2.jpg', 'Pengumuman', 89, 1, DATE_SUB(NOW(), INTERVAL 3 DAY), 1, NOW(), NOW()),
('Musyawarah Rencana Pembangunan (Musrenbang) Kecamatan Tahunan 2026', 'musyawarah-rencana-pembangunan-musrenbang-kecamatan-tahunan-2026', 'Kecamatan Tahunan menggelar Musrenbang untuk merencanakan pembangunan tahun 2026 dengan melibatkan seluruh stakeholder.', '<p>Musyawarah Rencana Pembangunan (Musrenbang) Kecamatan Tahunan tahun 2026 telah dilaksanakan dengan melibatkan seluruh kepala desa, tokoh masyarakat, dan berbagai elemen masyarakat.</p><p>Dalam forum ini, dibahas berbagai rencana pembangunan yang akan dilaksanakan di tahun mendatang, termasuk perbaikan infrastruktur, peningkatan pendidikan, dan pemberdayaan ekonomi masyarakat.</p>', 'berita3.jpg', 'Berita', 203, 1, DATE_SUB(NOW(), INTERVAL 7 DAY), 1, NOW(), NOW()),
('Vaksinasi COVID-19 untuk Lansia di Kecamatan Tahunan', 'vaksinasi-covid-19-untuk-lansia-di-kecamatan-tahunan', 'Program vaksinasi COVID-19 untuk lansia telah dilaksanakan di berbagai titik di Kecamatan Tahunan.', '<p>Kecamatan Tahunan bersama Puskesmas setempat telah melaksanakan program vaksinasi COVID-19 untuk lansia. Program ini diikuti oleh lebih dari 500 lansia dari berbagai desa di wilayah Kecamatan Tahunan.</p><p>Camat Tahunan mengimbau masyarakat, khususnya lansia, untuk tetap menjaga protokol kesehatan meskipun sudah divaksinasi.</p>', 'berita4.jpg', 'Berita', 167, 1, DATE_SUB(NOW(), INTERVAL 10 DAY), 1, NOW(), NOW()),
('Peringatan Hari Kemerdekaan RI ke-79 di Kecamatan Tahunan', 'peringatan-hari-kemerdekaan-ri-ke-79-di-kecamatan-tahunan', 'Kecamatan Tahunan menggelar berbagai lomba dan kegiatan dalam rangka memeriahkan HUT RI ke-79.', '<p>Dalam rangka memperingati HUT RI ke-79, Kecamatan Tahunan menggelar berbagai kegiatan dan lomba untuk seluruh masyarakat. Kegiatan ini meliputi upacara bendera, lomba-lomba tradisional, dan berbagai kegiatan seni budaya.</p><p>Kegiatan ini diharapkan dapat memupuk rasa nasionalisme dan kebersamaan di kalangan masyarakat Kecamatan Tahunan.</p>', 'berita5.jpg', 'Berita', 342, 1, DATE_SUB(NOW(), INTERVAL 15 DAY), 1, NOW(), NOW());

-- =============================================
-- Insert Desas
-- =============================================
INSERT INTO `desas` (`name`, `slug`, `description`, `website_url`, `logo`, `contact`, `social_media`, `is_active`, `created_at`, `updated_at`) VALUES
('Desa Tahunan', 'desa-tahunan', 'Desa Tahunan merupakan desa yang terletak di pusat kecamatan dengan akses yang mudah.', 'https://desatahunan.id', NULL, '{"phone":"(0274) 111111","email":"desa@tahunan.id","address":"Jl. Desa Tahunan No.1"}', '{"facebook":"https://facebook.com/desatahunan","instagram":"@desatahunan"}', 1, NOW(), NOW()),
('Desa Ngabul', 'desa-ngabul', 'Desa Ngabul dikenal dengan hasil pertaniannya yang melimpah.', 'https://desangabul.id', NULL, '{"phone":"(0274) 222222","email":"desa@ngabul.id","address":"Jl. Desa Ngabul No.1"}', '{"facebook":"https://facebook.com/desangabul","instagram":"@desangabul"}', 1, NOW(), NOW()),
('Desa Mindahan', 'desa-mindahan', 'Desa Mindahan memiliki potensi wisata alam yang indah.', 'https://desamindahan.id', NULL, '{"phone":"(0274) 333333","email":"desa@mindahan.id","address":"Jl. Desa Mindahan No.1"}', '{"facebook":"https://facebook.com/desamindahan","instagram":"@desamindahan"}', 1, NOW(), NOW());

-- =============================================
-- Insert Statistiks
-- =============================================
INSERT INTO `statistiks` (`category`, `name`, `value`, `unit`, `icon`, `year`, `order`, `created_at`, `updated_at`) VALUES
('penduduk', 'Jumlah Penduduk', '45.230', 'jiwa', 'users', 2024, 1, NOW(), NOW()),
('penduduk', 'Jumlah Kepala Keluarga', '12.450', 'KK', 'home', 2024, 2, NOW(), NOW()),
('penduduk', 'Laki-laki', '22.890', 'jiwa', 'male', 2024, 3, NOW(), NOW()),
('penduduk', 'Perempuan', '22.340', 'jiwa', 'female', 2024, 4, NOW(), NOW()),
('pendidikan', 'SD/MI', '18', 'sekolah', 'school', 2024, 1, NOW(), NOW()),
('pendidikan', 'SMP/MTs', '8', 'sekolah', 'school', 2024, 2, NOW(), NOW()),
('pendidikan', 'SMA/SMK/MA', '5', 'sekolah', 'school', 2024, 3, NOW(), NOW()),
('kesehatan', 'Puskesmas', '2', 'unit', 'hospital', 2024, 1, NOW(), NOW()),
('kesehatan', 'Posyandu', '25', 'unit', 'medkit', 2024, 2, NOW(), NOW()),
('ekonomi', 'UMKM', '350', 'unit', 'briefcase', 2024, 1, NOW(), NOW()),
('ekonomi', 'Pasar Tradisional', '3', 'unit', 'shopping-cart', 2024, 2, NOW(), NOW());

-- =============================================
-- Insert Potensis
-- =============================================
INSERT INTO `potensis` (`name`, `slug`, `category`, `description`, `image`, `location`, `gallery`, `is_active`, `created_at`, `updated_at`) VALUES
('Pertanian Padi', 'pertanian-padi', 'Pertanian', 'Kecamatan Tahunan memiliki lahan pertanian padi yang luas dengan hasil panen yang melimpah. Mayoritas masyarakat bekerja sebagai petani padi.', 'potensi1.jpg', 'Seluruh wilayah kecamatan', NULL, 1, NOW(), NOW()),
('Kerajinan Ukir Kayu', 'kerajinan-ukir-kayu', 'Ekonomi', 'Kerajinan ukir kayu merupakan produk unggulan yang telah dikenal hingga mancanegara. Produk ini menjadi salah satu penggerak ekonomi masyarakat.', 'potensi2.jpg', 'Desa Tahunan', NULL, 1, NOW(), NOW()),
('Wisata Pantai', 'wisata-pantai', 'Wisata', 'Pantai-pantai di Kecamatan Tahunan menawarkan keindahan alam yang memukau dengan pasir putih dan air laut yang jernih.', 'potensi3.jpg', 'Pesisir utara kecamatan', NULL, 1, NOW(), NOW()),
('Peternakan Sapi', 'peternakan-sapi', 'Peternakan', 'Peternakan sapi berkembang pesat di wilayah ini, menghasilkan daging dan susu berkualitas untuk memenuhi kebutuhan lokal dan regional.', 'potensi4.jpg', 'Desa Ngabul', NULL, 1, NOW(), NOW());

-- =============================================
-- Insert Strukturs (Hierarchy)
-- =============================================
INSERT INTO `strukturs` (`id`, `name`, `position`, `nip`, `photo`, `description`, `order`, `parent_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Drs. Ahmad Suharto, M.Si', 'Camat', '197001011994031001', NULL, 'Camat Tahunan', 1, NULL, 1, NOW(), NOW()),
(2, 'Ir. Budi Santoso, M.M', 'Sekretaris Camat', '197505101995031002', NULL, 'Sekretaris Camat Tahunan', 2, 1, 1, NOW(), NOW()),
(3, 'Sri Wahyuni, S.Sos', 'Kepala Seksi Pemerintahan', '198001152005012001', NULL, NULL, 3, 2, 1, NOW(), NOW()),
(4, 'Rudi Hartono, S.E', 'Kepala Seksi Ekonomi dan Pembangunan', '198203202006041001', NULL, NULL, 4, 2, 1, NOW(), NOW()),
(5, 'Dwi Prasetyo, S.H', 'Kepala Seksi Kesejahteraan Rakyat', '198505252008011002', NULL, NULL, 5, 2, 1, NOW(), NOW()),
(6, 'Ani Susilowati, S.Pd', 'Kepala Seksi Pelayanan Umum', '198708102009012001', NULL, NULL, 6, 2, 1, NOW(), NOW());

-- =============================================
-- Insert FAQs
-- =============================================
INSERT INTO `faqs` (`question`, `answer`, `category`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
('Bagaimana cara mengurus KTP di Kecamatan Tahunan?', 'Untuk mengurus KTP, silakan datang ke kantor kecamatan dengan membawa dokumen persyaratan: Kartu Keluarga asli, Surat Pengantar dari RT/RW, dan Pas Foto 4x6 sebanyak 2 lembar. Pelayanan dilakukan setiap hari kerja pada jam 08.00 - 14.00 WIB.', 'Administrasi Kependudukan', 1, 1, NOW(), NOW()),
('Bagaimana prosedur pembuatan Kartu Keluarga (KK)?', 'Untuk membuat KK baru, persiapkan dokumen: Surat Pengantar RT/RW, KTP asli semua anggota keluarga, Akta Nikah (jika sudah menikah), dan Surat Keterangan Pindah (jika pindahan). Datang ke kantor kecamatan dan isi formulir yang disediakan.', 'Administrasi Kependudukan', 2, 1, NOW(), NOW()),
('Berapa lama proses pengurusan surat keterangan?', 'Proses pengurusan surat keterangan umumnya dapat diselesaikan dalam 1-3 hari kerja, tergantung jenis surat yang diurus dan kelengkapan dokumen persyaratan.', 'Pelayanan Umum', 3, 1, NOW(), NOW()),
('Kapan jam pelayanan kantor kecamatan?', 'Jam pelayanan kantor Kecamatan Tahunan adalah Senin-Kamis pukul 08.00-14.00 WIB, Jumat pukul 08.00-11.00 WIB. Sabtu, Minggu, dan hari libur nasional tutup.', 'Umum', 4, 1, NOW(), NOW()),
('Apakah ada biaya untuk pengurusan dokumen kependudukan?', 'Tidak ada biaya (GRATIS) untuk pengurusan dokumen kependudukan seperti KTP, KK, Akta Kelahiran, dan surat keterangan lainnya. Jika ada pihak yang meminta biaya, silakan laporkan ke kantor kecamatan.', 'Pelayanan Umum', 5, 1, NOW(), NOW());
