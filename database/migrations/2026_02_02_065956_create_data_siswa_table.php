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
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->char('nis', 10)->primary();
            $table->char('user_id', 10)->unique();
            $table->char('id_kelas', 6);
            $table->char('no_absen', 2);
            $table->string('nama', 60);
            $table->string('email', 255)->unique();
            $table->string('jenis_kelamin', 9);
            $table->string('no_kontak', 13);
            $table->string('alamat', 255);
            $table->timestamps();

            $table->foreign('id_kelas')
                ->references('id_kelas')
                ->on('data_kelas')
                ->cascadeOnDelete();
                
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
        Schema::dropIfExists('data_siswa');
    }
};
