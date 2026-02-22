<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statistiks', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // penduduk, pendidikan, ekonomi, dll
            $table->string('name');
            $table->string('value');
            $table->string('unit')->nullable(); // orang, persen, rupiah, dll
            $table->string('icon')->nullable();
            $table->integer('year')->default(2024);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistiks');
    }
};
