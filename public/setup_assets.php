<?php
/**
 * Script untuk menyalin semua assets ke folder public
 * Akses via browser: http://localhost/kecamatan_tahunan_laravel/public/setup_assets.php
 * HAPUS FILE INI SETELAH SELESAI!
 */

echo "<h2>📦 Copying Assets to Public Folder...</h2><pre>";

$basePath = dirname(__DIR__);

// Buat folder yang diperlukan
$folders = [
    'public/uploads/video',
    'public/uploads/slider',
    'public/uploads/berita',
    'public/uploads/desa',
    'public/uploads/profil',
    'public/uploads/struktur',
    'public/uploads/potensi',
    'public/images',
];

foreach ($folders as $folder) {
    $fullPath = $basePath . '/' . $folder;
    if (!is_dir($fullPath)) {
        mkdir($fullPath, 0777, true);
        echo "✅ Created: $folder\n";
    } else {
        echo "📁 Exists:  $folder\n";
    }
}

echo "\n--- Copying Files ---\n\n";

// Copy list
$copies = [
    ['assets/video/banner.mp4', 'public/uploads/video/banner.mp4'],
    ['assets/images/Logo Kabupaten Jepara.png', 'public/images/logo-jepara.png'],
    ['assets/images/Pedesaan.jpg', 'public/images/Pedesaan.jpg'],
    ['assets/images/29251003_city-walk.webp', 'public/images/29251003_city-walk.webp'],
    ['assets/images/slider/slider_1769572120_6979871859176.jpg', 'public/uploads/slider/slider_1769572120_6979871859176.jpg'],
];

foreach ($copies as [$src, $dst]) {
    $srcPath = $basePath . '/' . $src;
    $dstPath = $basePath . '/' . $dst;

    if (file_exists($srcPath)) {
        if (copy($srcPath, $dstPath)) {
            $size = round(filesize($dstPath) / 1024, 1);
            echo "✅ Copied:  $src -> $dst ({$size}KB)\n";
        } else {
            echo "❌ FAILED:  $src -> $dst\n";
        }
    } else {
        echo "⚠️ MISSING: $src\n";
    }
}

// Copy semua berita images
echo "\n--- Berita Images ---\n";
$beritaDir = $basePath . '/assets/images/berita';
if (is_dir($beritaDir)) {
    foreach (scandir($beritaDir) as $file) {
        if ($file === '.' || $file === '..')
            continue;
        $src = $beritaDir . '/' . $file;
        $dst = $basePath . '/public/uploads/berita/' . $file;
        if (copy($src, $dst)) {
            echo "✅ Copied:  berita/$file\n";
        }
    }
}

// Copy semua desa logos
echo "\n--- Desa Logos ---\n";
$desaDir = $basePath . '/assets/images/desa';
if (is_dir($desaDir)) {
    foreach (scandir($desaDir) as $file) {
        if ($file === '.' || $file === '..')
            continue;
        $src = $desaDir . '/' . $file;
        $dst = $basePath . '/public/uploads/desa/' . $file;
        if (copy($src, $dst)) {
            echo "✅ Copied:  desa/$file\n";
        }
    }
}

echo "\n</pre>";
echo "<h2>🎉 Done! All assets copied successfully!</h2>";
echo "<p><strong>Video Hero:</strong> public/uploads/video/banner.mp4</p>";
echo "<p><strong>Logo Jepara:</strong> public/images/logo-jepara.png</p>";
echo "<p style='color:red; font-weight:bold;'>⚠️ HAPUS FILE INI SETELAH SELESAI! (setup_assets.php)</p>";
echo "<p><a href='/kecamatan_tahunan_laravel/public/'>← Kembali ke Homepage</a></p>";
