<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemeliharaanBarang extends Model
{
    use HasFactory;
    protected $table = 'pemeliharaan_barang';
    protected $fillable = [
        'id_pemeliharaan',
        'id_pj',
        'kode_barang',
        'kegiatan_pemeliharaan',
        'tanggal_pemeliharaan',
        'keterangan',
    ];

    protected $primaryKey = 'id_pemeliharaan';
    public $incrementing = false;
    protected $keyType = 'string';

    public function barang()
    {
        return $this->hasMany(DataBarang::class, 'kode_barang', 'kode_barang');
    }

    public function penanggungjawab()
    {
        return $this->belongsTo(DataPenanggungJawab::class, 'id_pj', 'id_pj');
    }
}
