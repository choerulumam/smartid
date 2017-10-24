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
    
}
