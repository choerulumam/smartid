<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'tbl_jadwal';
    
    protected $fillable = [
        'hari', 'matakuliah', 'ruangan','jam_masuk', 'jam_keluar'
    ];
}
