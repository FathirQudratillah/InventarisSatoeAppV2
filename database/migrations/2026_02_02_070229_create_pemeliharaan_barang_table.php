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
        Schema::create('pemeliharaan_barang', function (Blueprint $table) {
            $table->char('id_pemeliharaan', 17)->primary();
            $table->char('kode_barang', 10);
            $table->char('id_pj', 4);

            $table->foreign('kode_barang')
            ->references('kode_barang')
            ->on('data_barang')
            ->cascadeOnDelete();

            $table->foreign('id_pj')
            ->references('id_pj')
            ->on('data_penanggung_jawab')
            ->cascadeOnDelete();
            
            $table->string('kegiatan_pemeliharaan', 32);
            $table->date('tanggal_pemeliharaan');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeliharaan_barang');
    }
};
