<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataKategoriBarang extends Model
{
    use HasFactory;
    protected $table = 'data_kategori_barang';
    protected $fillable = ['id_kategori', 
                            'kategori', 
                           
                            ];

    protected $primaryKey = 'id_kategori';
    public $incrementing = false;
    protected $keyType = 'string';

    public function jenis()
    {
        return $this->hasMany(DataJenisBarang::class, 'id_kategori', 'id_kategori');
    }

}
