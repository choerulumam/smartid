<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'tbl_ruangan';

    public $timestamps = false;
    
    protected $fillable = [
        'kode','kapasitas'
    ];
}
