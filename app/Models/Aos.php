<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aos extends Model
{
     protected $table    ='aoss';
    protected $fillable =[  
    						'slogam',
    						'fdate',
    						'tdate',
    						'active',
    						];
}
