<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * StatistikController menggunakan field 'label', tapi migration lama
     * membuat kolom 'name'. Migration ini menambah kolom 'label' jika belum ada,
     * dan men-copy data dari 'name' ke 'label'.
     */
    public function up(): void
    {
        Schema::table('statistiks', function (Blueprint $table) {
            // Tambah kolom 'label' jika belum ada
            if (!Schema::hasColumn('statistiks', 'label')) {
                $table->string('label')->nullable()->after('category');
            }
        });

        // Copy data dari 'name' ke 'label' jika label masih kosong
        if (Schema::hasColumn('statistiks', 'name') && Schema::hasColumn('statistiks', 'label')) {
            \DB::table('statistiks')->whereNull('label')->orWhere('label', '')->update([
                'label' => \DB::raw('`name`')
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statistiks', function (Blueprint $table) {
            if (Schema::hasColumn('statistiks', 'label')) {
                $table->dropColumn('label');
            }
        });
    }
};
