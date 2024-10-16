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
        Schema::table('apply', function (Blueprint $table) {
            $table->dropUnique(['email']); // Menghapus constraint unique dari kolom email
            $table->dropUnique(['no_tlp']); // Menghapus constraint unique dari kolom no_tlp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apply', function (Blueprint $table) {
            $table->unique('email'); // Menambahkan kembali constraint unique pada email
            $table->unique('no_tlp'); // Menambahkan kembali constraint unique pada no_tlp
        });
    }
};
