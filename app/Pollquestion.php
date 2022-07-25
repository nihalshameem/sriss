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
    						
    
    public function response(){
        return $this->hasMany('App\Pollanswer','question_id');
    }
    
    public function responsecount(){
        return $this->hasMany('App\Pollanswer','question_id');
    }
}
