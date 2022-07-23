<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    protected $table    ='visions';
    protected $fillable =[  
    						'languageId',
    						'typeId',
    						'description',
    						];
}
