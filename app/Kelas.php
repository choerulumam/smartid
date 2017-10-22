<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'tbl_kelas';
    
    protected $fillable = [
        'kode', 'name'
    ];
}
