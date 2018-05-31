<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'tbl_jadwal';

    public $timestamps = false;

    protected $fillable = [
        'hari', 'matakuliah', 'ruangan','jam_masuk', 'jam_keluar'
    ];

    public function data_jadwal() {
        return $this->hasMany('App\MatakuliahMahasiswa', 'jadwal', 'id');
    }

    public function data_matakuliah(){
        return $this->belongsTo('App\Matakuliah', 'matakuliah', 'kode');
    }


}
