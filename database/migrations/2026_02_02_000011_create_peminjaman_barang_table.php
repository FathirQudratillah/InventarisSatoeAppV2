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
        Schema::create('peminjaman_barang', function (Blueprint $table) {
            $table->char('id_peminjaman', 13)->primary();
            $table->char('user_id', 10);
            $table->char('data_admin', 10)->nullable();

            $table->foreign('user_id')
            ->references('user_id')
            ->on('data_akun')
            ->cascadeOnDelete();

            $table->foreign('data_admin')
            ->references('user_id')
            ->on('data_akun')
            ->cascadeOnDelete();

            $table->string('status_peminjaman', 16);
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_barang');
    }
};
