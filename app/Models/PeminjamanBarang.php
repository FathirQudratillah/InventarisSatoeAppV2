<?php

namespace App\Models;

use App\Models\DetailPeminjaman;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    use HasFactory;
    protected $table = 'peminjaman_barang';
    protected $fillable = ['id_peminjaman', 
                            'user_id', 
                            'data_admin',
                            'status_peminjaman',
                            'tanggal_peminjaman',
                            'tanggal_pengembalian',
                            ];

    protected $primaryKey = 'id_peminjaman';
    public $incrementing = false;
    protected $keyType = 'string';

    public function detail(){
        return $this->hasMany(DetailPeminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function user()
    {
        return $this->belongsTo(DataAkun::class, 'user_id', 'user_id');
    }
}
