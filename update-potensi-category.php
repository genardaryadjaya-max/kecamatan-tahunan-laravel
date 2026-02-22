<?php

/*
|--------------------------------------------------------------------------
| Update Kategori Potensi
|--------------------------------------------------------------------------
|
| Script untuk update kategori potensi di database
| Run: php update-potensi-category.php
|
*/

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "\n🔄 Updating Potensi Categories...\n";
echo "==================================\n\n";

try {
    // Update kategori
    $updated = 0;

    // Ekonomi -> industri
    $count = DB::table('potensis')->where('category', 'Ekonomi')->update(['category' => 'industri']);
    $updated += $count;
    echo "✅ Updated {$count} rows: Ekonomi → industri\n";

    // Pertanian -> pertanian (lowercase)
    $count = DB::table('potensis')->where('category', 'Pertanian')->update(['category' => 'pertanian']);
    $updated += $count;
    echo "✅ Updated {$count} rows: Pertanian → pertanian\n";

    // Wisata -> wisata (lowercase)
    $count = DB::table('potensis')->where('category', 'Wisata')->update(['category' => 'wisata']);
    $updated += $count;
    echo "✅ Updated {$count} rows: Wisata → wisata\n";

    // Pariwisata -> wisata
    $count = DB::table('potensis')->where('category', 'Pariwisata')->update(['category' => 'wisata']);
    $updated += $count;
    echo "✅ Updated {$count} rows: Pariwisata → wisata\n";

    // Peternakan -> peternakan (lowercase)
    $count = DB::table('potensis')->where('category', 'Peternakan')->update(['category' => 'peternakan']);
    $updated += $count;
    echo "✅ Updated {$count} rows: Peternakan → peternakan\n";

    echo "\n📊 Total updated: {$updated} rows\n\n";

    // Show current categories
    echo "Current categories in database:\n";
    echo "--------------------------------\n";
    $categories = DB::table('potensis')->select('category')->distinct()->orderBy('category')->get();
    foreach ($categories as $cat) {
        $count = DB::table('potensis')->where('category', $cat->category)->count();
        echo "  • {$cat->category} ({$count} items)\n";
    }
    echo "\n✅ Done!\n\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n\n";
}
