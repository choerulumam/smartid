<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'tbl_matakuliah';
    public $timestamps = false;
    
    protected $fillable = [
        'kode', 'name', 'nip'
    ];

    public function matakuliahDosen() {
    	return $this->hasMany('App\Dosen', 'kode_dosen', 'kode_dosen');
    }

    public function mahasiswa() {
    	return $this->hasMany('App\MatakuliahMahasiswa', 'kode', 'kode');
    }
    
}
