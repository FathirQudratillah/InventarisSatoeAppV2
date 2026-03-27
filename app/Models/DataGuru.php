<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataGuru extends Model
{
    use HasFactory;
    protected $table = 'data_guru';
    protected $fillable = ['nip', 'user_id', 'nama', 'email','jenis_kelamin', 'no_kontak', 'alamat'];
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    public function akun()
    {
        return $this->belongsTo(DataAkun::class, 'user_id', 'user_id');
    }
}
