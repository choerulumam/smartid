<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'tbl_matakuliah';
    
    protected $fillable = [
        'kode', 'name', 'nip'
    ];

    public function matakuliahDosen() {
    	return $this->hasMany('App\Dosen', 'kode_dosen', 'kode_dosen');
    }
}