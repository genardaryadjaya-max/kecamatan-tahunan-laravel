<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Dikosongkan - kolom video dan type sudah digabung ke 2024_01_01_000001_create_sliders_table.php
return new class extends Migration {
    public function up(): void
    {
        // Sudah ada di create_sliders_table migration
    }

    public function down(): void
    {
        // Tidak ada yang di-drop
    }
};
