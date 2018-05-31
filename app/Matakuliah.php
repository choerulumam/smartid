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

    public function data_dosen() {
    	return $this->hasMany('App\Dosen', 'kode_dosen', 'kode_dosen');
    }

    public function data_mahasiswa() {
    	return $this->hasMany('App\MatakuliahMahasiswa', 'matakuliah', 'kode');
    }

    public function data_jadwal() {
        return $this->hasMany('App\Jadwal', 'matakuliah', 'kode');
    }

    public function get_schedule_by_kode_dosen($kode, $day, $room) {
        return Matakuliah::where('kode_dosen', $kode)
                                  ->with(['data_jadwal' => function($query) use ($day, $room){
                            $query->where('hari', $day)
                                  ->where('ruangan', $room);
                              }, 'data_dosen'])
                                  ->get();
    }

}
