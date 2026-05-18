<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\DataAngkatanController;
use App\Http\Controllers\Admin\DataBarangController;
use App\Http\Controllers\Admin\DataGuruController;
use App\Http\Controllers\Admin\DataJenisBarangController;
use App\Http\Controllers\Admin\DataJurusanController;
use App\Http\Controllers\Admin\DataKategoriBarangController;
use App\Http\Controllers\Admin\DataKelasController;
use App\Http\Controllers\Admin\DataPenanggungJawabController;
use App\Http\Controllers\Admin\DataRuangController;
use App\Http\Controllers\Admin\DataSiswaController;
use App\Http\Controllers\Admin\DetailPeminjamanController;
use App\Http\Controllers\Admin\PemeliharaanBarangController;
use App\Http\Controllers\Admin\PeminjamanBarangController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);


Route::middleware('auth:sanctum', 'role:admin')->group(function() {
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/admin', [DashboardController::class, 'admin']);

    Route::resource('data-kelas', DataKelasController::class);
    
    // Route::resource('data-siswa', DataSiswaController::class);

    // Route::resource('data-guru', DataGuruController::class);

    Route::resource('data-jurusan', DataJurusanController::class);//tested

    Route::resource('data-angkatan', DataAngkatanController::class);//tested

    // Route::resource('data-admin', DataAdminController::class);

    Route::resource('data-ruang', DataRuangController::class);//tested

    Route::resource('data-barang', DataBarangController::class);//tested

    Route::resource('data-kategori-barang', DataKategoriBarangController::class);//tested

    Route::resource('data-jenis-barang', DataJenisBarangController::class);//tested

    Route::resource('peminjaman-barang', PeminjamanBarangController::class);

    Route::resource('pemeliharaan-barang', PemeliharaanBarangController::class);//tested

    Route::resource('detail-peminjaman', DetailPeminjamanController::class);//tested

    Route::resource('data-penanggung-jawab', DataPenanggungJawabController::class); //tested

    Route::get('/peminjaman/{id}/accept', [PeminjamanBarangController::class, 'accept'])
        ->name('peminjaman-barang.accept');

    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanBarangController::class, 'kembalikan'])
        ->name('peminjaman-barang.kembalikan');
});

Route::middleware('auth:sanctum', 'role:siswa,guru')->group(function() {
    Route::get('/user', [DashboardController::class, 'index'])->name('dashboard.user');
    route::get('/peminjaman/{id}/back', [PeminjamanBarangController::class, 'back'])
        ->name('peminjaman-barang.back');
    Route::post('/peminjaman-barang.store', [PeminjamanBarangController::class, 'store'])->name('user.peminjaman-barang.store');
});


