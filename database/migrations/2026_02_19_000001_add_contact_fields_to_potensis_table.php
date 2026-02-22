<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * Menambahkan kolom kontak ke tabel potensis
     */
    public function up(): void
    {
        Schema::table('potensis', function (Blueprint $table) {
            if (!Schema::hasColumn('potensis', 'contact')) {
                $table->string('contact')->nullable()->after('location');
            }
            if (!Schema::hasColumn('potensis', 'email')) {
                $table->string('email')->nullable()->after('contact');
            }
            if (!Schema::hasColumn('potensis', 'website')) {
                $table->string('website')->nullable()->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('potensis', function (Blueprint $table) {
            $table->dropColumn(['contact', 'email', 'website']);
        });
    }
};
