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
        Schema::create('data_barang', function (Blueprint $table) {
            $table->char('kode_barang', 10)->primary();
            $table->char('id_ruang', 5);
            $table->char('jenis_barang', 7);
            
            $table->string('kondisi_barang', 10);
            $table->integer('tahun_perolehan');
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('id_ruang')
                ->references('id_ruang')
                ->on('data_ruang')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
                

            $table->foreign('jenis_barang')
                ->references('jenis_barang')
                ->on('data_jenis_barang')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_barang');
    }
};
