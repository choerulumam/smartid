<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatakuliahMahasiswa extends Model
{
    protected $table = 'tbl_matakuliah_mahasiswa';
    public $timestamps = false;
    
    protected $fillable = [
        'nim', 'matakuliah', 'jadwal'
    ];
    
    public function mahasiswa() {
    	return $this->belongsTo('App\Mahasiswa', 'nim', 'nim');
    }

    public function matakuliah() {
     	return $this->belongsTo('App\Matakuliah', 'matakuliah', 'kode');
    }

    public function jadwal() {
    	return $this->belongsTo('App\Jadwal', 'jadwal', 'id');
    }


}
