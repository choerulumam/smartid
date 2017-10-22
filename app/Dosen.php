<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tbl_dosen';

    protected $fillable = [
        'name', 'email', 'password', 'mac', 'nip'
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
        return $this->belongsTo('App\Matakuliah', 'kode_dosen', 'kode_dosen');
    }
}
