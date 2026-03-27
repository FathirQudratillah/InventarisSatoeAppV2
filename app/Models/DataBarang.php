<?php

namespace App\Models;

use App\Models\DataJenisBarang;
use App\Models\DetailPeminjaman;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;
    protected $table = 'data_barang';
    protected $fillable = ['kode_barang', 
                            'id_ruang', 
                            'id_kategori',
                            'jenis_barang',
                            
                            'kondisi_barang',
                            'tahun_perolehan',
                            'keterangan',
                            ];

    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    protected $keyType = 'string';

    public function jenis()
    {
        return $this->belongsTo(DataJenisBarang::class, 'jenis_barang', 'jenis_barang');
    }

    public function detail()
    {
        return $this->hasMany(DetailPeminjaman::class, 'kode_barang', 'kode_barang');
    }

    public function pemeliharaanbarang()
    {
        return $this->belongsTo(pemeliharaanbarang::class, 'kode_barang', 'kode_barang');
    }
}
