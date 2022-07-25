<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pollreceipt extends Model
{
    protected $table    ='pollreceipts';
    protected $fillable =[	'question_id',
    						'zone_id',
    						'district_id',
    						'taluk_id',
    						'pincode_id',
    						'active',
    						];
}
