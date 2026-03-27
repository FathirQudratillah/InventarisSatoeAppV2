<?php

namespace App\Models;

use App\Models\PeminjamanBarang;
use App\Models\DataBarang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;
    protected $table = 'detail_peminjaman';
    protected $fillable = [
        'id_detail',
        'kode_barang',
        'id_peminjaman',
        'kondisi_sebelum',
        'kondisi_sesudah',

    ];

    protected $primaryKey = 'id_detail';
    public $incrementing = false;
    protected $keyType = 'string';

    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanBarang::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function barang()
    {
        return $this->belongsTo(DataBarang::class, 'kode_barang', 'kode_barang');
    }
}
