<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pollquestion extends Model
{
    protected $table    ='pollquestions';
    protected $fillable =[	'taluk',
    						'description',
    						'volunteer',
    						'distid',
    						'zoneid',
    						];
}
