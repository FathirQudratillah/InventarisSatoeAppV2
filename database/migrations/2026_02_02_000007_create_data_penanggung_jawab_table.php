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
        Schema::create('data_penanggung_jawab', function (Blueprint $table) {
            $table->char('id_pj', 4)->primary();
            $table->string('nama', 60);
            $table->string('nama_perusahaan', 60);
            $table->string('alamat_perusahaan', 255);
            $table->string('no_kontak', 13);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penanggung_jawab');
    }
};
