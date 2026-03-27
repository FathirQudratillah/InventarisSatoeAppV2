<?php

namespace App\Models;

use App\Models\DataSiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class DataAkun extends Authenticatable
{
    use HasApiTokens, HasFactory;
    protected $table = 'data_akun';
    protected $fillable = ['user_id', 'username', 'password', 'role'];
    protected $hidden = ['password',];
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function siswa()
    {
        return $this->hasOne(DataSiswa::class, 'user_id', 'user_id');
    }

    public function guru()
    {
        return $this->hasOne(DataGuru::class, 'user_id', 'user_id');
    }

    public function admin()
    {
        return $this->hasOne(DataAdmin::class, 'user_id', 'user_id');
    }
}
