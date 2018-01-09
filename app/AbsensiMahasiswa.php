<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsensiMahasiswa extends Model
{
    public function Mahasiswa() {
        return $this->belongsTo('App\Mahasiswa', 'nim', 'nim');
    }
}
