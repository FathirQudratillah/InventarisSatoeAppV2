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
        Schema::create('data_jenis_barang', function (Blueprint $table) {
            $table->char('jenis_barang', 7)->primary();
            $table->char('id_kategori', 3);
            $table->string('nama_barang', 100);

            $table->foreign('id_kategori')
            ->references('id_kategori')
            ->on('data_kategori_barang')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            
            
            $table->string('sumber', 15);
            $table->text('spesifikasi');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_jenis_barang');
    }
};
