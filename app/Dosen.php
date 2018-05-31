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

    public function get_dosen_by_nip($nip) {
        return Dosen::where('nip', $nip)
                        ->with('matakuliahDosen')
                        ->first();
    }

    public function get_nip_by_kode($kode) {
        return Dosen::where('kode_dosen', $kode)->first();
    }

}
