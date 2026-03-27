<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJurusan extends Model
{
    use HasFactory;
    protected $table = 'data_jurusan';
    protected $fillable = ['id_jurusan', 
                            'jurusan', 
                            ];

    protected $primaryKey = 'id_jurusan';
    public $incrementing = false;
    protected $keyType = 'string';
}
