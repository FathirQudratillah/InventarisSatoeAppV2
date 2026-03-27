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
        Schema::table('peminjaman_barang', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('status_peminjaman');
            $table->index(['user_id', 'status_peminjaman']); // composite index
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman_barang', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['status_peminjaman']);
            $table->dropIndex(['user_id', 'status_peminjaman']);
        });
    }
};
