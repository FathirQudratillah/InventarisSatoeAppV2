<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataAdmin extends Model
{
    use HasFactory;
    protected $table = 'data_admin';
    protected $fillable = ['nip', 'user_id', 'nama', 'email', 'no_kontak', 'alamat'];
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    public function akun()
    {
        return $this->belongsTo(DataAkun::class, 'user_id', 'user_id');
    }
}
