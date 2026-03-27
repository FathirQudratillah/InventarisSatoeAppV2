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
        Schema::create('data_angkatan', function (Blueprint $table) {
            $table->string('angkatan')->primary();
            $table->integer('tahun_masuk', 4);
            $table->integer('tahun_lulus', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_angkatan');
    }
};
