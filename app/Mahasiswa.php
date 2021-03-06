<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tbl_mahasiswa';

    protected $fillable = [
        'name', 'email', 'password', 'mac', 'nim'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function matakuliahDosen() {
        return $this->hasMany('App\Dosen', 'kode_dosen', 'kode_dosen');
    }

    public function data_matakuliah() {
        return $this->hasMany('App\MatakuliahMahasiswa', 'nim', 'nim');
    }

}
