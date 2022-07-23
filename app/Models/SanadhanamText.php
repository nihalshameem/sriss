<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanadhanamText extends Model
{
    protected $table    ='sanadhanam_text';
    protected $fillable =[	'type',
    						'category',
    						'subcategory',
    						'tamil',
    						'english',
    						'hindi',
    						'amount',
    						'link',
    						];
}
