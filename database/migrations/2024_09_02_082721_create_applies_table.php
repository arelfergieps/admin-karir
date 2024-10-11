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
        Schema::create('apply', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();  // Menambahkan constraint unique pada email
            $table->string('no_tlp')->unique(); // Menambahkan constraint unique pada no_tlp
            $table->string('alamat');
            $table->string('cv');
            $table->string('portofolio');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apply');
    }
};
