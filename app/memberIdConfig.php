<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class memberIdConfig extends Model
{
    protected $table = "memberid_configs";
    
    protected $fillable =[	'memberIdFormat',
    						];
}
