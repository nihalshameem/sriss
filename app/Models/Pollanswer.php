<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pollanswer extends Model
{
    protected $table    ='pollanswers';
    protected $fillable =[	'question_id',
    						'response',
    						'response_count',
    						];
}
