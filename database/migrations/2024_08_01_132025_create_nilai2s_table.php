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
        Schema::create('nilai2s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rombel_id')->constrained('rombels')->onDelete('cascade');
            $table->string('nilai_ki1')->nullable();  // Pastikan ini ada
            $table->string('nilai_ki2')->nullable();
            $table->text('deskripsi_ki1')->nullable();
            $table->text('deskripsi_ki2')->nullable();
            $table->json('ekstrakulikuler')->nullable(); // Kolom JSON untuk kegiatan ekstrakurikuler
            $table->json('predikat_ekstrakulikuler')->nullable(); // Kolom JSON untuk predikat ekstrakurikuler
            $table->json('deskripsi_ekstrakulikuler')->nullable(); // Kolom JSON untuk deskripsi ekstrakurikuler
            $table->json('prestasi')->nullable(); // Kolom JSON untuk deskripsi ekstrakurikuler
            $table->json('deskripsi_prestasi')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai2s');
    }
};
