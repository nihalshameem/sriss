<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $table    ='volunteers';
    protected $fillable =[	'type',
    						'type_id',
    						'member_id',
    						'name',
    						'fdate',
    						'tdate',
    						'active',
    						];
}