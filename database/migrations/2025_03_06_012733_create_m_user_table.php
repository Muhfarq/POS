<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('user_id');
            $table->unsignedBigInteger('level_id')->index(); // Indexing untuk Foreign Key
            $table->string('username', 20)->unique(); // Pastikan username tidak duplikat
            $table->string('nama', 100);
            $table->string('password');
            $table->timestamps();

            // Definisi Foreign Key level_id mengacu ke tabel m_level
            $table->foreign('level_id')->references('level_id')->on('m_level');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
};
