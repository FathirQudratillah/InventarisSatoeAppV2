<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAngkatan extends Model
{
    protected $table = 'data_angkatan';
    protected $fillable = ['angkatan', 
                            'tahun_masuk', 
                            'tahun_lulus'
                            ];

    protected $primaryKey = 'angkatan';
    public $incrementing = false;
    
}
