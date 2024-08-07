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
        Schema::create('wali_siswas', function (Blueprint $table) {
            $table->id(); // Kolom id dengan AUTO_INCREMENT
            $table->unsignedBigInteger('siswa_id'); // Kolom siswa_id
            $table->string('wali'); // Kolom wali
            $table->string('nik_ayah')->nullable(); // Kolom nik_ayah
            $table->string('nama_ayah')->nullable(); // Kolom nama_ayah
            $table->string('status_ayah')->nullable(); // Kolom status_ayah
            $table->string('tempat_lahir_ayah')->nullable(); // Kolom tempat_lahir_ayah
            $table->string('tanggal_lahir_ayah')->nullable(); // Kolom tanggal_lahir_ayah
            $table->string('agama_ayah')->nullable(); // Kolom agama_ayah
            $table->string('pekerjaan_ayah')->nullable(); // Kolom pekerjaan_ayah
            $table->string('penghasilan_ayah')->nullable(); // Kolom penghasilan_ayah
            $table->string('handphone_ayah')->nullable(); // Kolom handphone_ayah
            $table->string('nik_ibu')->nullable(); // Kolom nik_ibu
            $table->string('nama_ibu')->nullable(); // Kolom nama_ibu
            $table->string('status_ibu')->nullable(); // Kolom status_ibu
            $table->string('tempat_lahir_ibu')->nullable(); // Kolom tempat_lahir_ibu
            $table->string('tanggal_lahir_ibu')->nullable(); // Kolom tanggal_lahir_ibu
            $table->string('agama_ibu')->nullable(); // Kolom agama_ibu
            $table->string('pekerjaan_ibu')->nullable(); // Kolom pekerjaan_ibu
            $table->string('penghasilan_ibu')->nullable(); // Kolom penghasilan_ibu
            $table->string('handphone_ibu')->nullable(); // Kolom handphone_ibu
            $table->string('nik_wali')->nullable(); // Kolom nik_wali
            $table->string('nama_wali')->nullable(); // Kolom nama_wali
            $table->string('tempat_lahir_wali')->nullable(); // Kolom tempat_lahir_wali
            $table->string('tanggal_lahir_wali')->nullable(); // Kolom tanggal_lahir_wali
            $table->string('agama_wali')->nullable(); // Kolom agama_wali
            $table->string('pekerjaan_wali')->nullable(); // Kolom pekerjaan_wali
            $table->string('penghasilan_wali')->nullable(); // Kolom penghasilan_wali
            $table->string('handphone_wali')->nullable(); // Kolom handphone_wali
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali_siswa');
    }
};
