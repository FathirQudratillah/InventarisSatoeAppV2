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
        Schema::create('data_ruang', function (Blueprint $table) {
            $table->char('id_ruang', 5)->primary();
            $table->string('nama_ruang');
            $table->string('jenis_ruang');
            $table->string('kapasitas', 4);
            $table->string('lokasi', 32);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_ruang');
    }
};
