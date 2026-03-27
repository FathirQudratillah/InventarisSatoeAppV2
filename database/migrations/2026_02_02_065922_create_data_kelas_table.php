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
        Schema::create('data_kelas', function (Blueprint $table) {
            $table->char('id_kelas', 6)->primary();
            $table->char('id_jurusan', 3);
            $table->string('angkatan');
            $table->string('kelas');
            $table->string('subkelas', 1);
            $table->timestamps();

            $table->foreign('id_jurusan')
                  ->references('id_jurusan')
                  ->on('data_jurusan')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
                  
            $table->foreign('angkatan')
                ->references('angkatan')
                ->on('data_angkatan')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kelas');
    }
};
