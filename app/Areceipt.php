<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Areceipt extends Model
{
    protected $table    ='areceipts';
    protected $fillable =[	'advertisement_id',
    						'zone_id',
    						'district_id',
    						'taluk_id',
    						'pincode_id',
    						'active',
    						];
}
