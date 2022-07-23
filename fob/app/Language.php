<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table    ='cfg_languages';
    protected $fillable =[  
    						'language',
    						];
}

