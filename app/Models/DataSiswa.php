<?php

namespace App\Models;

use App\Models\DataAkun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataSiswa extends Model
{
    use HasFactory;
    protected $table = 'data_siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nis', 'id_kelas', 'no_absen', 'user_id', 'nama', 'email', 'jenis_kelamin', 'no_kontak', 'alamat'];
    
    public function akun()
    {
        return $this->belongsTo(DataAkun::class, 'user_id', 'user_id');
    }

}
