<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table    ='zones';
    protected $fillable =[	'zone',
    						'description',
    						'active_vol',
    						];
}
