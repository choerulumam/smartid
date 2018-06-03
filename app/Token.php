<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'tbl_token';
    
    protected $fillable = [
        'token'
    ];
}
