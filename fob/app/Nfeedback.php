<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nfeedback extends Model
{
    protected $table    ='nfeedbacks';
    protected $fillable =[	'member_id',
    						'notification_id',
    						'description',
    						'date',
    						];
}
