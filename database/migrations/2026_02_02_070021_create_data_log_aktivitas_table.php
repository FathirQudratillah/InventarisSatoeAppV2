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
        Schema::create('data_log_aktivitas', function (Blueprint $table) {
            $table->char('id_log', 8)->primary();
            $table->char('user_id', 10);
            $table->text('aksi');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('data_akun')
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_log_aktivitas');
    }
};
