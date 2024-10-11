<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('karir', function (Blueprint $table) {
            $table->string('kategori')->nullable();    // Menambahkan kolom kategori
            $table->text('kualifikasi')->nullable();    // Menambahkan kolom kualifikasi
            $table->string('divisi')->nullable();       // Menambahkan kolom divisi
            $table->integer('gaji')->nullable();        // Menambahkan kolom gaji
            $table->enum('status', [1, 2])->default(1); // Menambahkan kolom status (1 = show, 2 = hide)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karir', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'kualifikasi', 'divisi', 'gaji', 'status']);
        });
    }
};
