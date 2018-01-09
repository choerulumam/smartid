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

    public function data_mahasiswa() {
    	return $this->belongsTo('App\Mahasiswa', 'nim', 'nim');
    }

    public function data_matakuliah() {
     	return $this->belongsTo('App\Matakuliah', 'matakuliah', 'kode');
    }

    public function data_jadwal() {
    	return $this->belongsTo('App\Jadwal', 'jadwal', 'id');
    }

    public function get_schedule_by_hari($nim, $day, $room) {
        return MatakuliahMahasiswa::where('nim', $nim)
                                  ->with(['data_jadwal' => function($query) use ($day,$room){
                            $query->where('hari', $day)
                                  ->where('ruangan', $room);
                        }, 'data_matakuliah', 'data_mahasiswa'])
                                  ->get();
    }

}
