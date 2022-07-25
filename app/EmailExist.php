<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailExist extends Model
{
    protected $table    ='emailexists';
    protected $fillable =[	'email',
    						'mobile_number',
    						];
}
