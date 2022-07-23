<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table    ='categories';
    protected $fillable =[	'type_id',
    						'type',
    						'category',
    						'email',
    						'sub_category',
    						'keyvalue',
    						];
}
