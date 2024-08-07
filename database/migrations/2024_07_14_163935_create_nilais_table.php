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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('japel_id');
            $table->unsignedBigInteger('rombel_id');
            $table->integer('nilai_k3');
            $table->integer('nilai_k4');
            $table->text('deskripsi_k3');
            $table->text('deskripsi_k4');
            $table->timestamps();

            $table->foreign('japel_id')->references('id')->on('jadwal_pelajarans')->onDelete('cascade');
            $table->foreign('rombel_id')->references('id')->on('rombels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
