<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taluk extends Model
{
    protected $table    ='taluks';
    protected $fillable =[	'taluk',
    						'pincode',
    						'distid',
    						'active_vol',
    						];
}
