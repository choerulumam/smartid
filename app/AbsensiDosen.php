<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsensiDosen extends Model
{
    protected $table = 'tbl_jadwal';

    public function Dosen() {
        return $this->belongsTo('App\Dosen', 'nip', 'nip');
    }
    
}
