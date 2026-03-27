<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPenanggungJawab extends Model
{
    use HasFactory;
    protected $table = 'data_penanggung_jawab';
    protected $fillable = ['id_pj', 
                            'nama', 
                            'nama_perusahaan',
                            'alamat_perusahaan',
                            'no_kontak',
                            
                            ];

    protected $primaryKey = 'id_pj';
    public $incrementing = false;
    protected $keyType = 'string';

    public function pemeliharaanbarang()
    {
        return $this->belongsTo(PemeliharaanBarang::class, 'id_pj', 'id_pj');
    }
}
