<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table    ='districts';
    protected $fillable =[	'district',
    						'description',
    						'zoneid',
    						];
}
